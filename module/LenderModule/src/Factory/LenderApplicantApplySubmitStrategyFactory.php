<?php

declare(strict_types=1);

namespace LenderModule\Factory\Strategy;

use Laminas\ServiceManager\Factory\FactoryInterface;
use LenderModule\Process\LenderApplicantApplySubmitProcess;
use LenderModule\Strategy\LenderApplicantApplySubmitStrategy;
use Psr\Container\ContainerInterface;

class LenderApplicantApplySubmitStrategyFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @param array|null $options
     * @return LenderApplicantApplySubmitStrategy
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $submitProcess = $container->get(LenderApplicantApplySubmitProcess::class);
        return new LenderApplicantApplySubmitStrategy($submitProcess);
    }
}
