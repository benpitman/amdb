<?php

namespace App\Module\Core\Imdb\Template;

use App\Core\Service\Error;
use App\Core\Store\Variable\Variable;
use Kentron\Facade\Curl;
use Kentron\Template\AAlert;

abstract class ADataset extends AAlert
{
    private $url;
    private $uri;

    public function __construct(string $uri)
    {
        $this->url = Variable::getProviderUrl();
        $this->uri = $uri;
    }

    final public function downloadTo($putPath): bool
    {
        $curl = new Curl();
        $fileHandle = fopen($putPath, "w+");

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
}
