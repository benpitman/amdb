<?php

namespace App\Http\Api\Controller;

use Kentron\Template\Http\AController;

// Services
use Kentron\Service\Provider\Template\AProviderService;

// Entities
use Kentron\Entity\TransportEntity;
use Kentron\Entity\ProviderTransportEntity;

// Factories
use App\Http\Api\Schema\SchemaFactory;

/**
 * Abstract extension of the base controller for API routes
 */
abstract class AApiController extends AController
{
    private $providerTransportEntity;

    public function __construct (TransportEntity $transportEntity)
    {
        parent::__construct($transportEntity);

        $this->providerTransportEntity = new ProviderTransportEntity();
    }

    final protected function getSchemaFactory (): string
    {
        return SchemaFactory::class;
    }

    final protected function requestProvider (AProviderService $provider, ?object $requestData = null): ?array
    {
        $this->providerTransportEntity->setRequestData($requestData);

        if (!$provider->makeRequest($this->providerTransportEntity)) {
            $this->transportEntity->addError($this->providerTransportEntity->getErrors());
        }

        return $this->providerTransportEntity->getResponseData();
    }
}
