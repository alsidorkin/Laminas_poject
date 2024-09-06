<?php

namespace LenderModuleTest\Model;

use PHPUnit\Framework\TestCase;
use LenderModule\Model\LenderSettings;

class LenderSettingsTest extends TestCase
{
    public function testGetters()
    {
        $lenderSettings = new LenderSettings();

        $reflection = new \ReflectionClass($lenderSettings);

        $properties = [
            'username' => 'testuser',
            'returnUrls' => ['success' => 'http://example.com/success'],
            'requestType' => 'standard',
            'testMode' => true,
            'orderDetails' => ['order_id' => 12345],
            'customerDetails' => ['name' => 'John Doe'],
        ];

        foreach ($properties as $property => $value) {
            $prop = $reflection->getProperty($property);
            $prop->setAccessible(true);
            $prop->setValue($lenderSettings, $value);
        }

        $this->assertEquals('testuser', $lenderSettings->getUsername());
        $this->assertEquals(['success' => 'http://example.com/success'], $lenderSettings->getReturnUrls());
        $this->assertEquals('standard', $lenderSettings->getRequestType());
        $this->assertTrue($lenderSettings->isTestMode());
        $this->assertEquals(['order_id' => 12345], $lenderSettings->getOrderDetails());
        $this->assertEquals(['name' => 'John Doe'], $lenderSettings->getCustomerDetails());
    }
}
