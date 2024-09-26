<?php

declare(strict_types=1);

namespace LenderModule\Service;

use RuntimeException;

use function base64_encode;
use function json_encode;
use function json_last_error_msg;
use function openssl_error_string;
use function openssl_public_encrypt;
use function str_split;

class EncryptionService
{
    /** @var string|null*/
    protected $publicKey;

    public function __construct(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function encryptData(string $data): string
    {
        if (! openssl_public_encrypt($data, $encryptedData, $this->publicKey)) {
            throw new RuntimeException('Ошибка шифрования данных: ' . openssl_error_string());
        }
        return base64_encode($encryptedData);
    }

    public function encryptLargeData(array $data): array
    {
        $jsonString = json_encode($data, true);
        if ($jsonString === false) {
            throw new RuntimeException('Ошибка кодирования JSON: ' . json_last_error_msg());
        }

        $chunkSize        = 245;
        $splitJsonStrings = str_split($jsonString, $chunkSize);
        $encryptedParts   = [];

        foreach ($splitJsonStrings as $chunk) {
            $encryptedParts[] = $this->encryptData($chunk);
        }

        return $encryptedParts;
    }
}
