<?php

namespace App\Module\Core\Imdb\Dataset;

use App\Module\Core\Entity\Database\Title\TitleDBEntity;
use App\Module\Core\Imdb\Template\ADataset;

final class Title extends ADataset
{
    protected $filename = "title";
    protected $uri = "title.basics.tsv.gz";

    public function __construct()
    {
        $this->columns = (new TitleDBEntity())->getColumns();

        parent::__construct();
    }
}
