<?php

namespace App\Module\Core\Region;

use Kentron\Facade\Geo;
use App\Module\Core\Entity\Database\Region\RegionDBEntity;
use App\Module\Core\Region\Entity\RegionMapEntity;
use App\Module\Core\Region\Repository\RegionRepository;

final class RegionSqlService
{
    public static function getCreate (): RegionDBEntity
    {
        $regionDBEntity = new RegionDBEntity();
        $regionRepository = new RegionRepository();

        try {
            Geo::init();
        }
        catch (\UnexpectedValueException $ex) {
            $regionDBEntity->addErrorCode(RegionMapEntity::CODE_UNKNOWN_LOCATION);

            return $regionDBEntity;
        }

        $regionCode = Geo::getRegionCode();
        $countryCode = Geo::getCountryCode();

        $regionRepository->whereCode($regionCode);
        $regionRepository->whereCountryCode($countryCode);

        if (!$regionRepository->buildFirst($regionDBEntity))
        {
            $regionDBEntity->setCode($regionCode);
            $regionDBEntity->setName(Geo::getRegionName());
            $regionDBEntity->setCountryCode($countryCode);

            self::insertOne($regionDBEntity);
        }

        return $regionDBEntity;
    }

    public static function insertOne (RegionDBEntity $regionDBEntity): void
    {
        $regionRepository = new RegionRepository();

        $regionRepository->insertNew($regionDBEntity);
    }
}
