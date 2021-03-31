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
    protected $gzPath;
    /**
     * @var string
     */
    protected $rawPath;
    /**
     * @var string
     */
    protected $tsvPath;

    /**
     * @var string
     */
    private $url;

    public function __construct(string $uri)
    {
        $this->url = Imdb::DATASET_URL . $uri;
    }

    /**
     * Abstract methods
     */

    abstract protected function process($rawFileHandle): void;
    abstract protected function insert(): void;

    /**
     * Helpers
     */

    /**
     * Download the gzipped dataset
     *
     * @return void
     */
    public function download(): void
    {
        // $curl = new Curl();
        // $fileHandle = fopen($this->gzPath, "w");

        // $curl->setGet();
        // $curl->setUrl($this->url);

        // $callback = function ($ch, string $string) use ($fileHandle) {
        //     fwrite($fileHandle, $string);
        //     return strlen($string);
        // };

        // $curl->setOpt(CURLOPT_WRITEFUNCTION, $callback);

        // if (!$curl->execute()) {
        //     $this->addError($curl->getErrors());
        //     fclose($fileHandle);

        //     return;
        // }

        // fclose($fileHandle);

        $this->uncompress();

        if ($this->hasErrors()) {
            return;
        }

        $this->insert();
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
        unlink($this->rawPath);
    }
}
