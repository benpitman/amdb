<?php

namespace App\Http\System\Controller;

use Kentron\Template\Http\AController;
use Kentron\Entity\TransportEntity;

use App\Core\Facade\View;

/**
 * Extension of the base controller for system routes
 */
class SystemController extends AController
{
    public function __construct (TransportEntity $transportEntity)
    {
        $transportEntity->setQuiet(false);

        parent::__construct($transportEntity);
    }

    public function render (): void
    {
        $this->transportEntity->setBody(
            View::getApp()->capture()
        );

        $this->transportEntity->setHtml();
    }
}
