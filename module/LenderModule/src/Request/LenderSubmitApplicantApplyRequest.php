<?php

namespace LenderModule\Request;

use LenderModule\LenderSubmitApplicantApplyRequestAbstract;
use GuzzleHttp\Client;

class LenderSubmitApplicantApplyRequest extends LenderSubmitApplicantApplyRequestAbstract
{
    protected $client;
    protected $encryptionService;

    public function __construct(Client $client, EncryptionService $encryptionService)
    {
        $this->client = $client;
        $this->encryptionService = $encryptionService;
    }

    public function sendRequest(array $preparedData): string
    {
        $encryptedData = $this->encryptionService->encryptData(json_encode($preparedData['request_data']));
        $encryptedItemData = $this->encryptionService->encryptLargeData($preparedData['item_data']);

        $response = $this->client->post('https://payl8r.com/process', [
            'form_params' => [
                'rid' => 'sandbox',
                'data' => $encryptedData,
                'item_data' => $encryptedItemData,
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
