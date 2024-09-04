<?php

namespace LenderModule\Process;

use LenderModule\LenderApplicantApplySubmitProcessAbstract;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;

class LenderApplicantApplySubmitProcess extends LenderApplicantApplySubmitProcessAbstract
{
    protected $dataPreparationProcess;
    protected $submitRequest;

    public function __construct(
        LenderPreparationDataApplicantApplyProcess $dataPreparationProcess,
        LenderSubmitApplicantApplyRequest $submitRequest
    ) {
        $this->dataPreparationProcess = $dataPreparationProcess;
        $this->submitRequest = $submitRequest;
    }

    public function execute(array $applicantData): string
    {
        $preparedData = $this->dataPreparationProcess->prepareData($applicantData);
        return $this->submitRequest->sendRequest($preparedData);
    }
}
