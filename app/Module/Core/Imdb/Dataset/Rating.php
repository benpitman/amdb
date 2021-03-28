<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Imdb\Template\ADataset;
use App\Module\Core\Rating\RatingSqlService;

final class Rating extends ADataset
{
    private const FILE_NAME = "rating";

    public function __construct()
    {
        parent::__construct("title.ratings.tsv.gz");

        $this->gzPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".gz";
        $this->rawPath = STORAGE_DIR . "/" . $this::FILE_NAME . ".tsv";
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
        // No need to process this file
    }

    protected function insert(): void
    {
        if (RatingSqlService::bulkInsert($this->rawPath)) {
            $this->addError("Failed to insert rating data to database");
        }
    }

}
