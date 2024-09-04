<?php

namespace LenderModule\Process;

use LenderModule\LenderPreparationDataApplicantApplyProcessAbstract;

class LenderPreparationDataApplicantApplyProcess extends LenderPreparationDataApplicantApplyProcessAbstract
{
    protected $lenderSettings;

    public function __construct(ModelInterface $lenderSettings)
    {
        $this->lenderSettings = $lenderSettings;
    }

    public function prepareData(array $applicantData): array
    {
        $preparedData = [
            'username' => $this->lenderSettings->getUsername(),
            'request_data' => [
                'return_urls' => $this->lenderSettings->getReturnUrls(),
                'request_type' => $this->lenderSettings->getRequestType(),
                'test_mode' => $this->lenderSettings->isTestMode(),
                'order_details' => $this->lenderSettings->getOrderDetails(),
                'customer_details' => $applicantData['customer_details'],
            ],
        ];

        return $preparedData;
    }
}
