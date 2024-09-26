<?php

declare(strict_types=1);

namespace LenderModule\Factory\Process;

use Laminas\ServiceManager\Factory\FactoryInterface;
use LenderModule\Model\LenderSettings;
use LenderModule\Process\LenderPreparationDataApplicantApplyProcess;
use Psr\Container\ContainerInterface;

class LenderPreparationDataApplicantApplyProcessFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @param array|null $options
     * @return LenderPreparationDataApplicantApplyProcess
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $lenderSettings = $container->get(LenderSettings::class);
        return new LenderPreparationDataApplicantApplyProcess($lenderSettings);
    }
}
