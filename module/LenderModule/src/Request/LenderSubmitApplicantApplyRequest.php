<?php

declare(strict_types=1);

namespace LenderModule\Request;

use GuzzleHttp\Client;
use LenderModule\Request\LenderSubmitApplicantApplyRequestAbstract;

class LenderSubmitApplicantApplyRequest extends LenderSubmitApplicantApplyRequestAbstract
{
    /** @var Client|null*/
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendRequest(array $preparedData): string
    {
        $response = $this->client->post('https://payl8r.com/process', [
            'form_params' => [
                'rid'       => 'sandbox',
                'data'      => $preparedData['request_data'],
                'item_data' => $preparedData['item_data'],
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
