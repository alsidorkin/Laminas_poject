<?php

namespace LenderModule\Request;

use LenderModule\LenderSubmitApplicantApplyRequestAbstract;
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
            'form_params' => $preparedData,
        ]);

        return $response->getBody()->getContents();
    }
}
