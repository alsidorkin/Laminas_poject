<?php

declare(strict_types=1);

namespace LenderModule\Factory\Request;

use GuzzleHttp\Client;
use Laminas\ServiceManager\Factory\FactoryInterface;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;
use Psr\Container\ContainerInterface;

class LenderSubmitApplicantApplyRequestFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @param array|null $options
     * @return LenderSubmitApplicantApplyRequest
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $client = $container->get(Client::class);
        return new LenderSubmitApplicantApplyRequest($client);
    }
}
