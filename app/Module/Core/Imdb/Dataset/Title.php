<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Imdb\Template\ADataset;

use App\Module\Core\Entity\Database\Title\TitleDBEntity;
use App\Module\Core\Genre\Entity\GenreCollectionEntity;
use App\Module\Core\Genre\GenreSqlService;
use App\Module\Core\TitleType\Entity\TitleTypeCollectionEntity;
use App\Module\Core\TitleType\TitleTypeSqlService;

final class Title extends ADataset
{
    protected $filename = "title";

    /**
     * @var string[]
     */
    private $columns;

    public function __construct()
    {
        $this->columns = (new TitleDBEntity())->getColumns();

        parent::__construct("title.basics.tsv.gz");
    }

    /**
     * Convert the raw uncompressed data to a new tsv that our database can use
     *
     * @param resource $rawFileHandle
     *
     * @return void
     */
    protected function process($rawFileHandle): void
    {
        $tsvFileHandle = fopen($this->tsvPath, "w+");

        /** @var TitleTypeCollectionEntity */
        $titleTypeCollectionEntity = TitleTypeSqlService::getAll()->getRootEntity();
        /** @var GenreCollectionEntity */
        $genreCollectionEntity = GenreSqlService::getAll()->getRootEntity();

        fseek($rawFileHandle, 0);
        $line = fgets($rawFileHandle); // Ignore first line
        fwrite($tsvFileHandle, implode("\t", $this->columns));

        while (true) {
            $line = stream_get_line($rawFileHandle, 0, PHP_EOL);
            var_dump($line);

            if ($line === false) {
                die("here");
                break;
            }
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

            if ($columns[8] !== "\\N;") {
                // Convert string genres to constant IDs
                $genres = [];
                foreach (explode(",", rtrim($columns[8], ';')) as $genre) {
                    $genreId = $genreCollectionEntity->getIdByText($genre);
                    if (is_null($genreId)) {
                        $genreId = GenreSqlService::insertOne($genre);
                    }
                    $genres[] = $genreId;
                }
                $columns[8] = json_encode($genres);
            }

            fwrite($tsvFileHandle, implode("\t", $columns) . ';');
        }

        fclose($tsvFileHandle);
    }
}
