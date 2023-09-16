<?php
namespace Pyncer\Utility;

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
