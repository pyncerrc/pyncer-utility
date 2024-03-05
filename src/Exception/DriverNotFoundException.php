<?php
namespace Pyncer\Utility\Exception;

use Pyncer\Exception\RuntimeException;
use Throwable;

class DriverNotFoundException extends RuntimeException
{
    public function __construct(
        protected string $type,
        protected string $driver,
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        $this->driver = $driver;

        parent::__construct(
            'The specified ' . $type . ' driver, ' . $driver . ', was not found.',
            $code,
            $previous
        );
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }
}
