<?php

namespace App\Module\Core\Imdb;

use App\Core\Service\Error;
use App\Core\Store\Variable\Variable;
use App\Module\Core\Entity\Database\Package\PackageDBCollectionEntity;
use App\Module\Core\Package\Entity\PackageMapEntity;
use Kentron\Facade\Curl;

final class ImdbService
{
    private $url;
    private $uri;

    public function __construct()
    {
        $this->url = Variable::getProviderUrl();
    }

    public function runAll(PackageDBCollectionEntity $packageDBCollectionEntity): bool
    {
        /** @var PackageMapEntity */
        foreach ($packageDBCollectionEntity->iterateEntities() as $packageMapEntity) {
            if (!$this->run($packageMapEntity)) {
                return false;
            }
        }

        return true;
    }

    public function run(PackageMapEntity $packageMapEntity): bool
    {
        $this->uri = $packageMapEntity->getUri();

        $putPath = STORAGE_DIR . "/" . $packageMapEntity->getPutName();
        $gzPath = "{$putPath}.gz";
        $tsvPath = "{$putPath}.tsv";

        if (!$this->download($gzPath)) {
            return false;
        }

        $this->uncompress($gzPath, $tsvPath);

        return true;
    }

    /**
     * Private methods
     */

    private function download($putPath): bool
    {
        $curl = new Curl();
        $fileHandle = fopen($putPath, "w");

        $curl->setGet();
        $curl->setUrl("{$this->url}/{$this->uri}");

        $callback = function ($ch, string $string) use ($fileHandle) {
            fwrite($fileHandle, $string);
            return strlen($string);
        };

        $curl->setOpt(CURLOPT_WRITEFUNCTION, $callback);

        if (!$curl->execute()) {
            Error::save($curl->getErrors());
            fclose($fileHandle);

            return false;
        }

        fclose($fileHandle);

        return true;
    }

    private function uncompress(string $gzPath, string $tsvPath): void
    {
        $gzFileHandle = gzopen($gzPath, "rb");
        $tsvFileHandle = fopen($tsvPath, "w");

        while (!gzeof($gzFileHandle)) {
            $string = gzread($gzFileHandle, 4096);
            fwrite($tsvFileHandle, $string, strlen($string));
        }

        gzclose($gzFileHandle);
        fclose($tsvFileHandle);
        unlink($gzPath);
    }
}
