<?php
namespace Pyncer\Utility;

use Pyncer\Exception\RuntimeException;

use function base64_encode;
use function base64_decode;
use function openssl_cipher_iv_length;
use function openssl_encrypt;
use function openssl_decrypt;
use function random_bytes;

class Crypt
{
    private string $key;
    private string $method;
    private string $iv;

    public function __construct(string $key, string $method = 'AES-256-CBC')
    {
        $this->key = $key;

        $this->method = $method;

        $length = openssl_cipher_iv_length($this->method);

        if ($length === false || $length < 1) {
            throw new RuntimeException('Cipher length could not be determined.');
        }

        $this->iv = random_bytes($length);
    }

    public function encrypt(string $value): string
    {
        $output = openssl_encrypt(
            $value,
            $this->method,
            $this->key,
            0,
            $this->iv
        );

        if ($output === false) {
            throw new RuntimeException('Value could not be encrypted.');
        }

        return base64_encode($output);
    }

    public function decrypt(string $value): string
    {
        $output = base64_decode($value);

        $output = openssl_decrypt(
            $output,
            $this->method,
            $this->key,
            0,
            $this->iv
        );

        if ($output === false) {
            throw new RuntimeException('Value could not be decrypted.');
        }

        return $output;
    }
}
