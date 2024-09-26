<?php

declare(strict_types=1);

namespace LenderModuleTest\Process;

use LenderModule\Process\LenderApplicantApplySubmitProcess;
use LenderModule\Process\LenderPreparationDataApplicantApplyProcess;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;
use PHPUnit\Framework\TestCase;

class LenderApplicantApplySubmitProcessTest extends TestCase
{
    public function testExecute()
    {
        $applicantData = ['customer_details' => ['name' => 'John Doe']];

        $preparedData = ['request_data' => 'encrypted_request_data', 'item_data' => ['encrypted_item_data']];

        $dataPreparationProcessMock = $this->createMock(LenderPreparationDataApplicantApplyProcess::class);
        $dataPreparationProcessMock->expects($this->once())
            ->method('prepareData')
            ->with($applicantData)
            ->willReturn($preparedData);

        $submitRequestMock = $this->createMock(LenderSubmitApplicantApplyRequest::class);
        $submitRequestMock->expects($this->once())
            ->method('sendRequest')
            ->with($preparedData)
            ->willReturn('response_body');

        $process = new LenderApplicantApplySubmitProcess($dataPreparationProcessMock, $submitRequestMock);

        $result = $process->execute($applicantData);

        $this->assertEquals('response_body', $result);
    }
}
