<?php

declare(strict_types=1);

namespace LenderModule\Process;

use LenderModule\Model\ModelInterface;
use LenderModule\Process\LenderPreparationDataApplicantApplyProcessAbstract;
use LenderModule\Service\EncryptionService;

use function json_encode;

class LenderPreparationDataApplicantApplyProcess extends LenderPreparationDataApplicantApplyProcessAbstract
{
    /** @var ModelInterface|null*/
    protected $lenderSettings;
    /** @var EncryptionService|null*/
    protected $encryptionService;

    public function __construct(ModelInterface $lenderSettings, EncryptionService $encryptionService)
    {
        $this->lenderSettings    = $lenderSettings;
        $this->encryptionService = $encryptionService;
    }

    public function prepareData(array $applicantData): array
    {
        $preparedData = [
            'username'     => $this->lenderSettings->getUsername(),
            'request_data' => [
                'return_urls'      => $this->lenderSettings->getReturnUrls(),
                'request_type'     => $this->lenderSettings->getRequestType(),
                'test_mode'        => $this->lenderSettings->isTestMode(),
                'order_details'    => $this->lenderSettings->getOrderDetails(),
                'customer_details' => $applicantData['customer_details'],
            ],
        ];

        $preparedData['request_data'] = $this->encryptionService->encryptData(
            json_encode($preparedData['request_data'])
        );
        $preparedData['item_data']    = $this->encryptionService->encryptLargeData(
            $preparedData['item_data'] ?? []
        );

        return $preparedData;
    }
}
