<?php

namespace LenderModule\Strategy;

use LenderModule\LenderApplicantApplySubmitStrategyAbstract;
use LenderModule\Process\LenderApplicantApplySubmitProcess;

class LenderApplicantApplySubmitStrategy extends LenderApplicantApplySubmitStrategyAbstract
{
    protected $submitProcess;

    public function __construct( LenderApplicantApplySubmitProcess $submitProcess)
    {
        $this->submitProcess = $submitProcess;
    }

    public function submit(array $applicantData): string
    {
        return $this->submitProcess->execute($applicantData);
    }
}

