<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Imdb\Template\ADataset;

final class Title extends ADataset
{
    public function __construct()
    {
        parent::__construct("title.basics.tsv.gz");
    }
}
