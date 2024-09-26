<?php

declare(strict_types=1);

namespace LenderModule;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    /** @return array*/
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
