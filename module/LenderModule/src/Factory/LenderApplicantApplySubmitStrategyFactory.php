<?php

namespace LenderModule\Factory\Strategy;

use LenderModule\Process\LenderApplicantApplySubmitProcess;
use LenderModule\Strategy\LenderApplicantApplySubmitStrategy;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class LenderApplicantApplySubmitStrategyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $submitProcess = $container->get(LenderApplicantApplySubmitProcess::class);
        return new LenderApplicantApplySubmitStrategy($submitProcess);
    }
}
