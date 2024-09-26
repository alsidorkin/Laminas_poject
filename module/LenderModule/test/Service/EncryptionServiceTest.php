<?php

declare(strict_types=1);

namespace LenderModuleTest\Service;

use LenderModule\Service\EncryptionService;
use PHPUnit\Framework\TestCase;

use function base64_decode;
use function json_decode;
use function openssl_pkey_export;
use function openssl_pkey_get_details;
use function openssl_pkey_new;
use function openssl_private_decrypt;
use function str_repeat;

use const OPENSSL_KEYTYPE_RSA;

class EncryptionServiceTest extends TestCase
{
     /** @var string|null*/
    private $publicKey;
     /** @var string|null*/
    private $privateKey;

    protected function setUp(): void
    {
        $config = [
            "digest_alg"       => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ];

        $res = openssl_pkey_new($config);
        openssl_pkey_export($res, $privateKey);

        $keyDetails = openssl_pkey_get_details($res);
        $publicKey  = $keyDetails["key"];

        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
    }

    public function testEncryptData()
    {
        $encryptionService = new EncryptionService($this->publicKey);

        $data = "Test data";

        $encryptedData = $encryptionService->encryptData($data);

        openssl_private_decrypt(base64_decode($encryptedData), $decryptedData, $this->privateKey);

        $this->assertEquals($data, $decryptedData);
    }

    public function testEncryptLargeData()
    {
        $encryptionService = new EncryptionService($this->publicKey);

        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => str_repeat('a', 2000),
        ];

        $encryptedParts = $encryptionService->encryptLargeData($data);

        $this->assertIsArray($encryptedParts);

        $jsonString = '';
        foreach ($encryptedParts as $encryptedPart) {
            openssl_private_decrypt(base64_decode($encryptedPart), $decryptedPart, $this->privateKey);
            $jsonString .= $decryptedPart;
        }

        $decryptedData = json_decode($jsonString, true);

        $this->assertEquals($data, $decryptedData);
    }
}
