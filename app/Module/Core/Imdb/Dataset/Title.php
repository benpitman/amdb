<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Imdb\Template\ADataset;

use App\Module\Core\Genre\Entity\GenreCollectionEntity;
use App\Module\Core\Genre\Entity\GenreMap;
use App\Module\Core\Genre\GenreSqlService;
use App\Module\Core\Title\TitleSqlService;
use App\Module\Core\TitleType\Entity\TitleTypeCollectionEntity;
use App\Module\Core\TitleType\TitleTypeSqlService;

final class Title extends ADataset
{
    private const FILE_NAME = "title";

    public function __construct()
    {
        $this->gzPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".gz";
        $this->rawPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".raw.tsv";
        $this->tsvPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".tsv";

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

        rewind($rawFileHandle);
        $line = fgets($rawFileHandle); // Ignore first line

        while (!feof($rawFileHandle)) {
            $line = stream_get_line($rawFileHandle, 0, PHP_EOL);

            if ($line === false) {
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

            // If is_adult is true
            if ($columns[4] === 1) {
                continue;
            }

            // If genres is null
            if ($columns[8] !== "\\N") {
                // Convert string genres to constant IDs
                $genres = [];
                foreach (explode(",", $columns[8]) as $genre) {
                    $genreId = $genreCollectionEntity->getIdByText($genre);

                    if (is_null($genreId)) {
                        $genreId = GenreSqlService::insertOne($genre);
                    }

                    if ($genreId === GenreMap::ADULT) {
                        continue 2;
                    }

                    $genres[] = $genreId;
                }
                $columns[8] = json_encode($genres);
            }

            fwrite($tsvFileHandle, implode("\t", $this->formatColumns($columns)) . PHP_EOL);
        }

        fclose($tsvFileHandle);
    }

    protected function insert(): void
    {
        if (TitleSqlService::bulkInsert($this->tsvPath)) {
            $this->addError("Failed to insert title data to database");
        }
    }

    /**
     * Format the columns to mirror the database table
     *
     * @param string[] $columns
     *
     * @return string[]
     */
    private function formatColumns(array $columns): array
    {
        return [
            $columns[0], // const
            $columns[1], // type
            $columns[8], // genres
            $columns[2], // primary
            $columns[3], // original
            "\\N", // description
            $columns[7], // runtime
            $columns[5], // start_year
            $columns[6] // end_year
        ];
    }
}
