<?php

namespace LenderModuleTest\Strategy;

use PHPUnit\Framework\TestCase;
use LenderModule\Strategy\LenderApplicantApplySubmitStrategy;
use LenderModule\Process\LenderApplicantApplySubmitProcess;

class LenderApplicantApplySubmitStrategyTest extends TestCase
{
    public function testSubmit()
    {
        $applicantData = ['customer_details' => ['name' => 'John Doe']];

        $submitProcessMock = $this->createMock(LenderApplicantApplySubmitProcess::class);
        $submitProcessMock->expects($this->once())
            ->method('execute')
            ->with($applicantData)
            ->willReturn('response_body');

        $strategy = new LenderApplicantApplySubmitStrategy($submitProcessMock);

        $result = $strategy->submit($applicantData);

        $this->assertEquals('response_body', $result);
    }
}
