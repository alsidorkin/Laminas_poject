<?php
namespace LenderModule;

return [
    'service_manager' => [
        'factories' => [
            LenderPreparationDataApplicantApplyProcess::class => LenderModule\Factory\Process\LenderPreparationDataApplicantApplyProcessFactory::class,
            LenderSubmitApplicantApplyRequest::class => LenderModule\Factory\Request\LenderSubmitApplicantApplyRequestFactory::class,
            LenderApplicantApplySubmitProcess::class => LenderModule\Factory\Process\LenderApplicantApplySubmitProcessFactory::class,
            LenderApplicantApplySubmitStrategy::class => LenderModule\Factory\Strategy\LenderApplicantApplySubmitStrategyFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            \LenderModule\Controller\SubmitController::class => \LenderModule\Factory\SubmitControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'lender-module' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/lender-module',
                    'defaults' => [
                        'controller' => \LenderModule\Controller\SubmitController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
];
