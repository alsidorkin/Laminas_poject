<?php

declare(strict_types=1);

namespace LenderModule;

use LenderModule\Controller\SubmitController;
use LenderModule\Factory\SubmitControllerFactory;

return [
    'service_manager' => [
        'factories' => [
            LenderPreparationDataApplicantApplyProcess::class
            => LenderModule\Factory\Process\LenderPreparationDataApplicantApplyProcessFactory::class,
            LenderSubmitApplicantApplyRequest::class
            => LenderModule\Factory\Request\LenderSubmitApplicantApplyRequestFactory::class,
            LenderApplicantApplySubmitProcess::class
            => LenderModule\Factory\Process\LenderApplicantApplySubmitProcessFactory::class,
            LenderApplicantApplySubmitStrategy::class
            => LenderModule\Factory\Strategy\LenderApplicantApplySubmitStrategyFactory::class,
            EncryptionService::class
            => LenderModule\Factory\EncryptionServiceFactory::class,
        ],
    ],
    'encryption'      => [
        'public_key' => "-----BEGIN PUBLIC KEY-----\n1111111111111111111111111111111111111111111\n---END PUBLIC KEY---",
    ],
    'controllers'     => [
        'factories' => [
            SubmitController::class => SubmitControllerFactory::class,
        ],
    ],
    'router'          => [
        'routes' => [
            'lender-module' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/lender-module',
                    'defaults' => [
                        'controller' => SubmitController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
];
