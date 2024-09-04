<?php

namespace LenderModule\Factory;

use LenderModule\Service\EncryptionService;
use Psr\Container\ContainerInterface;

class EncryptionServiceFactory
{
    public function __invoke(ContainerInterface $container): EncryptionService
    {
        $config = $container->get('config');
        $publicKey = $config['encryption']['public_key'];

        return new EncryptionService($publicKey);
    }
}
