<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Imdb\Template\ADataset;

use App\Module\Core\Genre\Entity\GenreCollectionEntity;
use App\Module\Core\Genre\Entity\GenreMap;
use App\Module\Core\Genre\GenreSqlService;
use App\Module\Core\TitleType\Entity\TitleTypeCollectionEntity;
use App\Module\Core\TitleType\TitleTypeSqlService;

final class Title extends ADataset
{
    private const FILE_NAME = "title";

    /**
     * @var int[]
     */
    private $restrictedGenres;
    /**
     * @var string
     */
    private $ratingTsvPath;
    /**
     * @var array[]
     */
    private $ratings;

    public function __construct()
    {
        $this->restrictedGenres = [
            GenreMap::ADULT
        ];
        $this->ratingTsvPath = (new Rating)->getTsvPath();

        $this->gzPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".gz";
        $this->rawPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".raw.tsv";
        $this->tsvPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".tsv";

        $this->upload = false;

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
        $this->processRatings();

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
            $this->reIndex($columns);

            // Convert string title type to constant ID
            $typeId = $titleTypeCollectionEntity->getIdByText($columns[2]);
            if (is_null($typeId)) {
                // If this title type is not in the expected constant list, ignore it
                // This applies to things like audiobooks and radio series'
                continue;
            }
            $columns[2] = $typeId;

            // If Primary name is the same as Original name, drop Primary
            if ($columns[3] === $columns[4]) {
                $columns[3] = "\\N";
            }

            if ($columns[6] === 1) {
                continue;
            }

            if ($columns[10] !== "\\N") {
                // Convert string genres to constant IDs
                $genres = [];
                foreach (explode(",", $columns[10]) as $genre) {
                    $genreId = $genreCollectionEntity->getIdByText($genre);

                    if (is_null($genreId)) {
                        $genreId = GenreSqlService::insertOne($genre);
                    }

                    if ($genreId === GenreMap::ADULT) {
                        continue;
                    }

                    $genres[] = $genreId;
                }
                $columns[10] = json_encode($genres);
            }

            fwrite($tsvFileHandle, implode("\t", $this->formatColumns($columns)) . PHP_EOL);
        }

        fclose($tsvFileHandle);
    }

    private function processRatings(): void
    {
        $ratingFileHandle = fopen($this->ratingTsvPath, "r");

        while (!feof($ratingFileHandle)) {
            $line = stream_get_line($ratingFileHandle, 0, PHP_EOL);

            if ($line === false) {
                break;
            }

            [$const, $rating, $votes] = explode("\t", $line);
            $this->ratings[$const] = [
                $rating,
                $votes
            ];
        }

        fclose($ratingFileHandle);
        // unlink($this->ratingTsvPath);
    }

    private function reIndex(array &$columns): void
    {
        array_splice($columns, 0, 0, "\\N");
        array_splice($columns, 5, 0, "\\N");
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
            $columns[0], // id
            $columns[1], // const
            $columns[2], // type
            $columns[10], // genres
            $columns[3], // primary
            $columns[4], // original
            $columns[5], // description
            $columns[9], // runtime
            $this->ratings[$columns[1]][0] ?? "\\N", // ratings
            $this->ratings[$columns[1]][1] ?? "\\N", // votes
            $columns[7], // start_year
            $columns[8] // end_year
        ];
    }
}
