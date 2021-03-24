<?php

namespace App\Http\Ajax\Controller\Dashboard;

use App\Http\Ajax\Controller\AAjaxController;
use App\Module\System\Media\MediaService as SystemMediaService;

final class DashboardController extends AAjaxController
{
    public function getMedia (): void
    {
        $mediaService = new SystemMediaService();

        $mediaEntity = $mediaService->getDashboardMedias();

        $this->transportEntity->setData($mediaEntity->getNormalised());
    }
}
