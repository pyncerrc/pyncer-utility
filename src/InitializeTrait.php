<?php
namespace Pyncer\Utility;

use Pyncer as p;

trait InitializeTrait
{
    private bool $initialized = false;

    public function getInitialized(): bool
    {
        return $this->initialized;
    }
    protected function setInitialized(bool $value): static
    {
        $this->initialized = $value;
        return $this;
    }

    abstract public function initialize(): static;
}
