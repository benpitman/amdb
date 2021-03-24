<?php

namespace App\Http\System\Controller\Login;

use App\Core\Facade\View;
use App\Http\System\Controller\SystemController;

final class LoginController extends SystemController
{
    public function render (): void
    {
        $this->transportEntity->setBody(
            View::getLogin()->capture()
        );
        $this->transportEntity->setHtml();
    }
}
