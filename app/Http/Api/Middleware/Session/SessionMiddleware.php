<?php

namespace App\Http\Api\Middleware\Session;

use Kentron\Template\Http\AMiddleware;

use App\Module\Core\Session\SessionSqlService;

use App\Core\Store\Variable\Variable;

final class SessionMiddleware extends AMiddleware
{
    protected function customRun (): void
    {
        if (!$this->sessionIDIsValid()) {
            $this->transportEntity->renderResponse();
            return;
        }

        $this->transportEntity->next();
    }

    /**
     * Validate the session hash in the URL
     * @return bool
     */
    private function sessionIDIsValid (): bool
    {
        $sessionDBEntity = SessionSqlService::getOneByID(
            $this->transportEntity->getRequest()->getAttribute("routeInfo")[2]["session_id"]
        );

        if ($sessionDBEntity->hasErrors()) {
            $this->transportEntity->addError($sessionDBEntity->getErrors());
            return false;
        }

        Variable::setSessionID($sessionDBEntity->getID());
        return true;
    }
}
