<?php

declare(strict_types=1);

namespace LenderModule\Process;

use LenderModule\Process\LenderApplicantApplySubmitProcessAbstract;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;

class LenderApplicantApplySubmitProcess extends LenderApplicantApplySubmitProcessAbstract
{
     /** @var LenderPreparationDataApplicantApplyProcess|null*/
    protected $dataPreparationProcess;
     /** @var LenderSubmitApplicantApplyRequest|null*/
    protected $submitRequest;

    public function __construct(
        LenderPreparationDataApplicantApplyProcess $dataPreparationProcess,
        LenderSubmitApplicantApplyRequest $submitRequest
    ) {
        $this->dataPreparationProcess = $dataPreparationProcess;
        $this->submitRequest          = $submitRequest;
    }

    public function execute(array $applicantData): string
    {
        $preparedData = $this->dataPreparationProcess->prepareData($applicantData);
        return $this->submitRequest->sendRequest($preparedData);
    }
}
