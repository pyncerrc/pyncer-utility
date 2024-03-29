<?php
namespace Pyncer\Utility;

use Pyncer\Utility\EqualsInterface;
use Stringable;

use function base64_encode;
use function hash_equals;
use function random_bytes;
use function rtrim;
use function strstr;
use function substr;

class Token implements EqualsInterface
{
    private string $token;

    public function __construct(?string $token = null)
    {
        if ($token === null) {
            $this->token = $this->generateToken();
        } else {
            $this->token = $token;
        }
    }

    public function getValue(): string
    {
        return $this->token;
    }
    public function setValue(string $value): static
    {
        $this->token = $value;
        return $this;
    }

    public function equals(mixed $value): bool
    {
        if ($value instanceof Token) {
            $value = $value->getValue();
        } elseif ($value instanceof Stringable) {
            $value = strval($value);
        }

        if (!is_string($value)) {
            return false;
        }

        return hash_equals($this->token, $value);
    }

    private function generateToken(): string
    {
        $token = base64_encode(random_bytes(96));
        $token = rtrim(strtr($token, '+/', '-_'), '=');
        $token = substr($token, 0, 96);

        return $token;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
