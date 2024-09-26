<?php

declare(strict_types=1);

namespace LenderModule\Factory\Process;

use Laminas\ServiceManager\Factory\FactoryInterface;
use LenderModule\Process\LenderApplicantApplySubmitProcess;
use LenderModule\Process\LenderPreparationDataApplicantApplyProcess;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;
use Psr\Container\ContainerInterface;

class LenderApplicantApplySubmitProcessFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @param array|null $options
     * @return LenderApplicantApplySubmitProcess
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $dataPreparationProcess = $container->get(LenderPreparationDataApplicantApplyProcess::class);
        $submitRequest          = $container->get(LenderSubmitApplicantApplyRequest::class);
        return new LenderApplicantApplySubmitProcess($dataPreparationProcess, $submitRequest);
    }
}
