<?php

namespace LenderModule\Service;

class EncryptionService
{
    protected $publicKey;

    public function __construct(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function encryptData(string $data): string
    {
        openssl_public_encrypt($data, $encryptedData, $this->publicKey);
        return base64_encode($encryptedData);
    }

    public function encryptLargeData(array $data): array
    {
        $jsonString = json_encode($data, TRUE);
        $splitJsonStrings = str_split($jsonString, 800);
        $encryptedParts = [];

        foreach ($splitJsonStrings as $jsonString) {
            $encryptedParts[] = $this->encryptData($jsonString);
        }

        return $encryptedParts;
    }
}
