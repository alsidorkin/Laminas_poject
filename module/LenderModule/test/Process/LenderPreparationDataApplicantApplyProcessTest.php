<?php

namespace LenderModuleTest\Process;

use PHPUnit\Framework\TestCase;
use LenderModule\Process\LenderPreparationDataApplicantApplyProcess;
use LenderModule\Service\EncryptionService;
use LenderModule\Model\ModelInterface;

class LenderPreparationDataApplicantApplyProcessTest extends TestCase
{
    protected $lenderSettingsMock;
    protected $encryptionServiceMock;
    protected $process;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lenderSettingsMock = $this->createMock(ModelInterface::class);
        $this->encryptionServiceMock = $this->createMock(EncryptionService::class);

        $this->lenderSettingsMock->method('getUsername')->willReturn('testuser');
        $this->lenderSettingsMock->method('getReturnUrls')->willReturn(['success' => 'http://example.com/success']);
        $this->lenderSettingsMock->method('getRequestType')->willReturn('standard');
        $this->lenderSettingsMock->method('isTestMode')->willReturn(true);
        $this->lenderSettingsMock->method('getOrderDetails')->willReturn(['order_id' => 12345]);

        $this->encryptionServiceMock->method('encryptData')->willReturn('encrypted_request_data');
        $this->encryptionServiceMock->method('encryptLargeData')->willReturn(['encrypted_item_data']);

        $this->process = new LenderPreparationDataApplicantApplyProcess($this->lenderSettingsMock, $this->encryptionServiceMock);
    }

    public function testPrepareData()
    {
        $applicantData = [
            'customer_details' => ['name' => 'John Doe'],
            'item_data' => [['description' => 'Item 1']]
        ];

        $result = $this->process->prepareData($applicantData);

        $this->assertIsArray($result);

        $this->assertArrayHasKey('username', $result);
        $this->assertArrayHasKey('request_data', $result);
        $this->assertArrayHasKey('item_data', $result);
        
        $this->assertEquals('testuser', $result['username']);
        $this->assertEquals('encrypted_request_data', $result['request_data']);
        $this->assertEquals(['encrypted_item_data'], $result['item_data']);
    }
}
