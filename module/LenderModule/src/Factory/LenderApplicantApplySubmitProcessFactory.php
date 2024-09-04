<?php

namespace LenderModule\Factory\Process;

use LenderModule\Process\LenderApplicantApplySubmitProcess;
use LenderModule\Process\LenderPreparationDataApplicantApplyProcess;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class LenderApplicantApplySubmitProcessFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $dataPreparationProcess = $container->get(LenderPreparationDataApplicantApplyProcess::class);
        $submitRequest = $container->get(LenderSubmitApplicantApplyRequest::class);
        return new LenderApplicantApplySubmitProcess($dataPreparationProcess, $submitRequest);
    }
}
