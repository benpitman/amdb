<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Imdb\Template\ADataset;
use App\Module\Core\TitleRating\TitleRatingSqlService;

final class Rating extends ADataset
{
    private const FILE_NAME = "rating";

    private $ratingFileIndex = 0;

    public function __construct()
    {
        parent::__construct("title.ratings.tsv.gz");

        $this->gzPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".gz";
        $this->rawPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".raw.tsv";
        $this->tsvPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".tsv";
    }

    /**
     * No processing needed, just copy the file
     *
     * @param resource $rawFileHandle
     *
     * @return void
     */
    protected function process($rawFileHandle): void
    {
        $ratingTsvHandle = fopen($this->getRatingPath(), "w+");
        $count = 1;

        rewind($rawFileHandle);
        $line = fgets($rawFileHandle); // Ignore first line

        while (!feof($rawFileHandle)) {

            $line = fgets($rawFileHandle);

            if ($line === false) {
                break;
            }

            fwrite($ratingTsvHandle, $line);

            if ($count++ === 1_000_000) {
                fclose($ratingTsvHandle);

                $this->ratingFileIndex++;
                $count = 1;

                $ratingTsvHandle = fopen($this->getRatingPath(), "w+");
            }
        }

        fclose($ratingTsvHandle);
    }

    protected function insert(): void
    {
        for ($ratingFileIndex = 0; $ratingFileIndex <= $this->ratingFileIndex; $ratingFileIndex++) {
            $ratingPath = $this->getRatingPath($ratingFileIndex);
            if (!TitleRatingSqlService::bulkInsert($ratingPath)) {
                $this->addError("Failed to insert title_rating_{$ratingFileIndex} data to database");
            }
            unlink($ratingPath);
        }
    }

    private function getRatingPath(int $ratingFileIndex = null): string
    {
        return STORAGE_DIR . "/" . $this::FILE_NAME . "_" . ($ratingFileIndex ?? $this->ratingFileIndex) . ".tsv";
    }
}
