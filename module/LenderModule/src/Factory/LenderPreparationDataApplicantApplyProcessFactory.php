<?php

namespace LenderModule\Factory\Process;

use LenderModule\Model\LenderSettings;
use LenderModule\Process\LenderPreparationDataApplicantApplyProcess;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class LenderPreparationDataApplicantApplyProcessFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $lenderSettings = $container->get(LenderSettings::class);
        return new LenderPreparationDataApplicantApplyProcess($lenderSettings);
    }
}
