<?php

namespace LenderModule\Request;

use LenderModule\Request\LenderSubmitApplicantApplyRequestAbstract;
use GuzzleHttp\Client;

class LenderSubmitApplicantApplyRequest extends LenderSubmitApplicantApplyRequestAbstract
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendRequest(array $preparedData): string
    {
        $response = $this->client->post('https://payl8r.com/process', [
            'form_params' => [
                'rid' => 'sandbox',
                'data' => $preparedData['request_data'],
                'item_data' => $preparedData['item_data'],
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
