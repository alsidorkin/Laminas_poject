<?php

declare(strict_types=1);

namespace LenderModule\Strategy;

use LenderModule\Process\LenderApplicantApplySubmitProcess;
use LenderModule\Strategy\LenderApplicantApplySubmitStrategyAbstract;

class LenderApplicantApplySubmitStrategy extends LenderApplicantApplySubmitStrategyAbstract
{
     /** @var LenderApplicantApplySubmitProcess|null*/
    protected $submitProcess;

    public function __construct(LenderApplicantApplySubmitProcess $submitProcess)
    {
        $this->submitProcess = $submitProcess;
    }

    public function submit(array $applicantData): string
    {
        return $this->submitProcess->execute($applicantData);
    }
}
