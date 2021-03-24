<?php

namespace App\Module\Core\Region\Repository;

use Kentron\Template\ARepository;

final class RegionRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Region::class;

    public function whereCode (string $code): void
    {
        parent::where("region_code", $code);
    }

    public function whereCountryCode (string $countryCode): void
    {
        parent::where("region_country_code", $countryCode);
    }
}
