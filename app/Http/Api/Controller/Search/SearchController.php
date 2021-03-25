<?php

namespace App\Http\Api\Controller\Search;

use App\Http\Api\Controller\AApiController;
use App\Http\Api\Schema\SchemaFactory;
use App\Module\Api\Entity\SearchEntity;

final class SearchController extends AApiController
{
    public function search(): void
    {
        $searchEntity = new SearchEntity();

        $searchEntity->setSchema(SchemaFactory::getSearchSchema());

        $extracted = $searchEntity->validate(json_encode(
            $this->transportEntity->getQueryParameters()
        ));

        if (is_null($extracted)) {
            $this->transportEntity->mergeAlerts($searchEntity);
            return;
        }

        $searchEntity->build($extracted);
    }
}
