<?php

namespace App\Module\Core\Imdb\Template;

use Kentron\Template\AAlert;

use Kentron\Facade\Curl;
use App\Core\Store\Imdb;
use App\Module\Core\Genre\Entity\GenreCollectionEntity;
use App\Module\Core\Genre\GenreSqlService;
use App\Module\Core\TitleType\Entity\TitleTypeCollectionEntity;
use App\Module\Core\TitleType\TitleTypeSqlService;

abstract class ADataset extends AAlert
{
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var string
     */
    protected $uri;
    /**
     * @var string[]
     */
    protected $columns;

    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $gzPath;
    /**
     * @var string
     */
    private $rawPath;
    /**
     * @var string
     */
    private $tsvPath;

    public function __construct()
    {
        $this->url = Imdb::DATASET_URL . $this->uri;

        $this->gzPath = STORAGE_DIR . "/{$this->filename}.gz";
        $this->rawPath = STORAGE_DIR . "/{$this->filename}.tsv";
        $this->tsvPath = STORAGE_DIR . "/{$this->filename}.tsv";
    }

    public function getTsvPath(): string
    {
        return $this->tsvPath;
    }

    public function run(): bool
    {
        $curl = new Curl();
        $fileHandle = fopen($this->gzPath, "w");

        $curl->setGet();
        $curl->setUrl("{$this->url}/{$this->uri}");

        $callback = function ($ch, string $string) use ($fileHandle) {
            fwrite($fileHandle, $string);
            return strlen($string);
        };

        $curl->setOpt(CURLOPT_WRITEFUNCTION, $callback);

        if (!$curl->execute()) {
            $this->addError($curl->getErrors());
            fclose($fileHandle);

            return false;
        }

        fclose($fileHandle);
        $this->uncompress();

        return true;
    }

    private function uncompress(): void
    {
        $gzFileHandle = gzopen($this->gzPath, "rb");
        $rawFileHandle = fopen($this->rawPath, "w+");

        while (!gzeof($gzFileHandle)) {
            $string = gzread($gzFileHandle, 4096);
            fwrite($rawFileHandle, $string, strlen($string));
        }

        gzclose($gzFileHandle);
        unlink($this->gzPath);

        $this->process($rawFileHandle);

        fclose($rawFileHandle);
        unlink($this->rawPath);
    }

    private function process($rawFileHandle): void
    {
        $tsvFileHandle = fopen($this->tsvPath, "w+");
        /** @var TitleTypeCollectionEntity */
        $titleTypeCollectionEntity = TitleTypeSqlService::getAll()->getRootEntity();
        /** @var GenreCollectionEntity */
        $genreCollectionEntity = GenreSqlService::getAll()->getRootEntity();

        rewind($rawFileHandle);
        fgets($rawFileHandle); // Ignore first line
        fwrite($tsvFileHandle, implode("\t", $this->columns));

        while (!feof($rawFileHandle)) {
            $line = fgets($rawFileHandle);
            $columns = explode("\t", $line);

            // Convert string title type to constant ID
            $typeId = $titleTypeCollectionEntity->getIdByText($columns[1]);
            if (is_null($typeId)) {
                // If this title type is not in the expected constant list, ignore it
                // This applies to things like audiobooks and radio series'
                continue;
            }
            $columns[1] = $typeId;

            // If Primary name is the same as Original name, drop Primary
            if ($columns[2] === $columns[3]) {
                $columns[2] = "\\N";
            }

            // Convert string genres to constant IDs
            $genres = [];
            foreach (explode(",", $columns[8]) as $genre) {
                $genreId = $genreCollectionEntity->getIdByText($genre);
                if (is_null($genreId)) {
                    $genreId = GenreSqlService::insertOne($genre);
                }
                $genres[] = $genreId;
            }
            $columns[8] = json_encode($genres);

            fwrite($tsvFileHandle, implode("\t", $columns));
        }

        fclose($tsvFileHandle);
    }
}
