<?php

namespace App\Http\Api\Middleware\Auth;

use Kentron\Template\Http\AMiddleware;

use App\Module\Core\System\Auth\AuthSqlService;
use App\Core\Store\Variable\Variable;

final class AuthMiddleware extends AMiddleware
{
    public function customRun (): void
    {
        if (!$this->authTokenIsValid()) {
            return;
        }

        $this->transportEntity->next();
    }

    /**
     * Checks the API auth token against the one stored
     * @return bool
     */
    private function authTokenIsValid (): bool
    {
        $request = $this->transportEntity->getRequest();
        if (!$request->hasHeader("X-AUTH-TOKEN")) {
            $this->transportEntity->addError("Auth token missing");
            $this->transportEntity->setUnauthorised();
            return false;
        }

        $authDBEntity = AuthSqlService::getOneByApplicationKey(
            Variable::encrypt($request->getHeader("X-AUTH-TOKEN")[0])
        );

        if ($authDBEntity->hasErrors()) {
            $this->transportEntity->addError($authDBEntity->getErrors());
            $this->transportEntity->setUnauthorised();
            return false;
        }

        Variable::setAuthID($authDBEntity->getID());
        $this->transportEntity->setRequest($request);

        return true;
    }
}
