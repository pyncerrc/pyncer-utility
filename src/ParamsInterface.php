<?php
namespace Pyncer\Utility;

use Pyncer\Iterable\MapInterface;

interface ParamsInterface extends MapInterface
{
    public function getInt(string $key, ?int $empty = 0): ?int;
    public function setInt(string $key, ?int $value): static;

    /**
     * @deprecated Use getString instead.
     */
    public function getStr(string $key, ?string $empty = ''): ?string;
    /**
     * @deprecated Use setString instead.
     */
    public function setStr(string $key, ?string $value): static;

    public function getString(string $key, ?string $empty = ''): ?string;
    public function setString(string $key, ?string $value): static;

    public function getBool(string $key, ?bool $empty = false): ?bool;
    public function setBool(string $key, null|bool|string $value): static;

    public function getFloat(string $key, ?float $empty = 0.0): ?float;
    public function setFloat(string $key, ?float $value): static;

    public function getArray(string $key, ?array $empty = []): ?array;
    public function setArray(string $key, ?iterable $value): static;
}
