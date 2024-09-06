<?php

namespace LenderModuleTest\Request;

use PHPUnit\Framework\TestCase;
use LenderModule\Request\LenderSubmitApplicantApplyRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class LenderSubmitApplicantApplyRequestTest extends TestCase
{
    public function testSendRequest()
    {
        $clientMock = $this->createMock(Client::class);

        $preparedData = [
            'request_data' => 'encrypted_request_data',
            'item_data' => ['encrypted_item_data'],
        ];

        $expectedParams = [
            'form_params' => [
                'rid' => 'sandbox',
                'data' => 'encrypted_request_data',
                'item_data' => ['encrypted_item_data'],
            ],
        ];

        $responseMock = new Response(200, [], 'response_body');

        $clientMock->expects($this->once())
            ->method('post')
            ->with('https://payl8r.com/process', $expectedParams)
            ->willReturn($responseMock);

        $request = new LenderSubmitApplicantApplyRequest($clientMock);

        $result = $request->sendRequest($preparedData);

        $this->assertEquals('response_body', $result);
    }
}
