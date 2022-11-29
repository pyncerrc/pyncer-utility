<?php
namespace Pyncer\Utility;

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

        $this->iv = random_bytes(
            openssl_cipher_iv_length($this->method)
        );
    }

    public function encrypt(string $s): string
    {
        $output = openssl_encrypt(
            $s,
            $this->method,
            $this->key,
            0,
            $this->iv
        );

        return base64_encode($output);
    }

    public function decrypt(string $s): string
    {
        $output = base64_decode($s);

        return openssl_decrypt(
            $output,
            $this->method,
            $this->key,
            0,
            $this->iv
        );
    }
}
