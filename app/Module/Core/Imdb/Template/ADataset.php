<?php

namespace App\Module\Core\Imdb\Template;

use Kentron\Template\AAlert;

use Kentron\Facade\Curl;
use App\Core\Store\Imdb;

abstract class ADataset extends AAlert
{
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var string
     */
    protected $tsvPath;

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

    public function __construct(string $uri)
    {
        $this->url = Imdb::DATASET_URL . $uri;

        $this->gzPath = STORAGE_DIR . "/{$this->filename}.gz";
        $this->rawPath = STORAGE_DIR . "/{$this->filename}.raw.tsv";
        $this->tsvPath = STORAGE_DIR . "/{$this->filename}.tsv";
    }

    /**
     * Abstract methods
     */

    abstract protected function process($rawFileHandle): void;

    /**
     * Getters
     */

    public function getTsvPath(): string
    {
        return $this->tsvPath;
    }

    /**
     * Helpers
     */

    /**
     * Download the gzipped dataset
     *
     * @return boolean
     */
    public function download(): bool
    {
        $this->process(fopen($this->rawPath, "r"));
        return true;
        $curl = new Curl();
        $fileHandle = fopen($this->gzPath, "w");

        $curl->setGet();
        $curl->setUrl($this->url);

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

    /**
     * Private methods
     */

    /**
     * Uncompress the gzip to a new temporary file
     *
     * @return void
     */
    private function uncompress(): void
    {
        $gzFileHandle = gzopen($this->gzPath, "rb");
        $rawFileHandle = fopen($this->rawPath, "w+");

        while (!gzeof($gzFileHandle)) {
            $string = gzread($gzFileHandle, 4096);
            fwrite($rawFileHandle, $string, strlen($string));
        }

        gzclose($gzFileHandle);
        // unlink($this->gzPath);

        $this->process($rawFileHandle);

        fclose($rawFileHandle);
        // unlink($this->rawPath);
    }
}
