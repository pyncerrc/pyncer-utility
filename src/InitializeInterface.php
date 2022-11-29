<?php
namespace Pyncer\Utility;

interface InitializeInterface
{
    public function getInitialized(): bool;
    public function initialize(): static;
}
