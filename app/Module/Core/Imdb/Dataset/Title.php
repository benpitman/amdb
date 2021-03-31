<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Imdb\Template\ADataset;

use App\Module\Core\Genre\Entity\GenreCollectionEntity;
use App\Module\Core\Genre\Entity\GenreMap;
use App\Module\Core\Genre\GenreSqlService;
use App\Module\Core\Title\TitleSqlService;
use App\Module\Core\TitleGenre\TitleGenreSqlService;
use App\Module\Core\Type\Entity\TypeCollectionEntity;
use App\Module\Core\Type\TypeSqlService;

final class Title extends ADataset
{
    private const FILE_NAME = "title";

    private $titleFileIndex = 0;
    private $genreFileIndex = 0;

    public function __construct()
    {
        $this->gzPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".gz";
        $this->rawPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".raw.tsv";

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
        $titleTsvHandle = fopen($this->getTitlePath(), "w+");
        $genreTsvHandle = fopen($this->getGenrePath(), "w+");

        /** @var TypeCollectionEntity */
        $typeCollectionEntity = TypeSqlService::getAll()->getRootEntity();
        /** @var GenreCollectionEntity */
        $genreCollectionEntity = GenreSqlService::getAll()->getRootEntity();

        rewind($rawFileHandle);
        $line = fgets($rawFileHandle); // Ignore first line

        $titleCount = 1;
        $genreCount = 1;

        while (!feof($rawFileHandle)) {
            $line = stream_get_line($rawFileHandle, 0, PHP_EOL);

            if ($line === false) {
                break;
            }
            $columns = explode("\t", $line);

            // Convert string title type to constant ID
            $typeId = $typeCollectionEntity->getIdByText($columns[1]);
            if (is_null($typeId) || $typeId !== 2) { // Ignore anything but movies for now to save space
                // If this title type is not in the expected constant list, ignore it
                // This applies to things like audiobooks and radio series'
                continue;
            }
            $columns[1] = $typeId;

            // If Primary name is the same as Original name, drop Original
            if ($columns[2] === $columns[3]) {
                $columns[3] = "\\N";
            }

            // If is_adult is true
            if ($columns[4] === 1) {
                continue;
            }

            // If genres is not null
            if ($columns[8] !== "\\N") {
                // Convert string genres to constant IDs
                foreach (explode(",", $columns[8]) as $genre) {
                    $genreId = $genreCollectionEntity->getIdByText($genre);

                    if (is_null($genreId)) {
                        $genreId = GenreSqlService::insertOne($genre);
                    }

                    if ($genreId === GenreMap::ADULT) {
                        continue 2;
                    }

                    fwrite($genreTsvHandle, "{$columns[0]}\t{$genreId}" . PHP_EOL);

                    if ($genreCount++ === 500_000) {
                        fclose($genreTsvHandle);

                        $this->genreFileIndex++;
                        $genreCount = 1;

                        $genreTsvHandle = fopen($this->getGenrePath(), "w+");
                    }
                }
            }

            fwrite($titleTsvHandle, implode("\t", $this->formatColumns($columns)) . PHP_EOL);

            if ($titleCount++ === 500_000) {
                fclose($titleTsvHandle);

                $this->titleFileIndex++;
                $titleCount = 1;

                $titleTsvHandle = fopen($this->getTitlePath(), "w+");
            }
        }

        fclose($titleTsvHandle);
        fclose($genreTsvHandle);
    }

    protected function insert(): void
    {
        for ($titleFileIndex = 0; $titleFileIndex <= $this->titleFileIndex; $titleFileIndex++) {
            $tsvPath = $this->getTitlePath($titleFileIndex);
            if (!TitleSqlService::bulkInsert($tsvPath)) {
                $this->addError("Failed to insert title_{$titleFileIndex} data to database");
            }
            unlink($tsvPath);
        }

        for ($genreFileIndex = 0; $genreFileIndex <= $this->genreFileIndex; $genreFileIndex++) {
            $genrePath = $this->getGenrePath($genreFileIndex);
            if (!TitleGenreSqlService::bulkInsert($genrePath)) {
                $this->addError("Failed to insert title_genre_{$genreFileIndex} data to database");
            }
            unlink($genrePath);
        }
    }

    private function getTitlePath(int $titleFileIndex = null): string
    {
        return STORAGE_DIR . "/" . $this::FILE_NAME . "_" . ($titleFileIndex ?? $this->titleFileIndex) . ".tsv";
    }

    private function getGenrePath(int $genreFileIndex = null): string
    {
        return STORAGE_DIR . "/" . $this::FILE_NAME . "_genres_" . ($genreFileIndex ?? $this->genreFileIndex) . ".tsv";
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
            $columns[2], // primary
            $columns[3], // original
            $columns[7], // runtime
            $columns[5], // start_year
            $columns[6] // end_year
        ];
    }
}
