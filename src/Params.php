<?php
namespace Pyncer\Utility;

use DateTime;
use DateTimeInterface;
use Pyncer\Iterable\Map;
use Pyncer\Utility\ParamsInterface;

use function boolval;
use function floatval;
use function intval;
use function is_array;
use function Pyncer\date_time as pyncer_date_time;
use function Pyncer\basify as pyncer_basify;
use function strval;
use function trim;

use const Pyncer\DATE_TIME_FORMAT as PYNCER_DATE_TIME_FORMAT;

class Params extends Map implements ParamsInterface
{
    public function get(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }
    public function set(string $key, mixed $value): static
    {
        if ($value === null) {
            unset($this->values[$key]);
        } else {
            $this->values[$key] = $value;
        }

        return $this;
    }
    public function has(string ...$keys): bool
    {
        foreach ($keys as $key) {
            if (!isset($this->values[$key])) {
                return false;
            }
        }

        return true;
    }

    public function getParams(string $key, null|array|ParamsInterface $empty = []): ?ParamsInterface
    {
        $value = $this->get($key);

        if ($value === null || !is_array($value)) {
            $value = $empty;
        }

        if (is_array($value)) {
            return new Params($value);
        }

        return $value;
    }
    public function setParams(string $key, ?ParamsInterface $params): static
    {
        if ($value === null) {
            return $this->set($key, null);
        }

        return $this->set($key, $value->getData());
    }

    public function getInt(string $key, ?int $empty = 0): ?int
    {
        $value = $this->get($key);

        if ($value !== null) {
            $value = intval(pyncer_basify($value));
        }

        if ($value === null || $value === 0) {
            $value = $empty;
        }

        return $value;
    }
    public function setInt(string $key, ?int $value): static
    {
        if ($value === null) {
            return $this->set($key, null);
        }

        return $this->set($key, $value);
    }

    public function getStr(string $key, ?string $empty = ''): ?string
    {
        return $this->getString($key, $empty);
    }
    public function setStr(string $key, ?string $value): static
    {
        return $this->setString($key, $value);
    }

    public function getString(string $key, ?string $empty = ''): ?string
    {
        $value = $this->get($key);

        $value = pyncer_basify($value);

        if (is_array($value)) {
            $value = boolval($value);
        }

        $value = match ($value) {
            null => '',
            false => '0',
            default => strval($value),
        };

        $value = trim($value);

        if ($value === '') {
            $value = $empty;
        }

        return $value;
    }
    public function setString(string $key, ?string $value): static
    {
        if ($value === null) {
            return $this->set($key, null);
        }

        return $this->set($key, trim($value));
    }

    public function getBool(string $key, ?bool $empty = false): ?bool
    {
        $value = $this->get($key);

        if ($value !== null) {
            if ($value === 'false') {
                $value = false;
            } else {
                $value = boolval($value);
            }
        }

        if ($value === null || $value === false) {
            $value = $empty;
        }

        return $value;
    }
    public function setBool(string $key, null|bool|string $value): static
    {
        if ($value === null) {
            return $this->set($key, null);
        }

        if ($value === 'false') {
            return $this->set($key, false);
        }

        return $this->set($key, boolval($value));
    }

    public function getFloat(string $key, ?float $empty = 0.0): ?float
    {
        $value = $this->get($key);

        if ($value !== null) {
            $value = floatval(pyncer_basify($value));
        }

        if ($value === null || $value === 0.0) {
            $value = $empty;
        }

        return $value;
    }
    public function setFloat(string $key, ?float $value): static
    {
        if ($value === null) {
            return $this->set($key, null);
        }

        return $this->set($key, $value);
    }

    public function getArray(string $key, ?array $empty = []): ?Array
    {
        $value = $this->get($key);

        if ($value !== null && !is_array($value)) {
            if (is_iterable($value)) {
                $value = [...$value];
            } else {
                $value = [$value];
            }
        }

        if ($value === null || $value === []) {
            $value = $empty;
        }

        return $value;
    }
    public function setArray(string $key, ?iterable $value): static
    {
        if ($value === null) {
            return $this->set($key, null);
        }

        $value = [...$value];

        return $this->set($key, $value);
    }

    public function getDateTime(string $key, null|string|DateTimeInterface $empty = null): ?DateTime
    {
        $value = $this->get($key);

        if ($value === null) {
            if ($empty === null) {
                return $empty;
            }

            return pyncer_date_time($empty);
        }

        return pyncer_date_time($value);
    }
    public function setDateTime(string $key, null|string|DateTimeInterface $value): static
    {
        if ($value === null) {
            return $this->set($key, null);
        }

        $value = pyncer_date_time($value);

        if ($value !== null) {
            $value = $value->format(PYNCER_DATE_TIME_FORMAT);
        }

        return $this->set($key, $value);
    }
}
