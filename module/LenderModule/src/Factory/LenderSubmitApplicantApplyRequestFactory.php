<?php

namespace LenderModule\Factory\Request;

use GuzzleHttp\Client;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class LenderSubmitApplicantApplyRequestFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $client = $container->get(Client::class);
        return new LenderSubmitApplicantApplyRequest($client);
    }
}
