<?php
namespace Pyncer\Utility;

use Pyncer\Utility\Exception\DriverNotFoundException;

abstract class AbstractDriver extends Params
{
    public function __construct(
        string $name,
        array $params = []
    ) {
        // Set params first so other specific fields take precedence
        $this->setData($params);

        $this->setName($name);
    }

    public function getName(): string
    {
        /** @var string **/
        return $this->getString('name');
    }
    public function setName(string $value): static
    {
        return $this->setString('name', $value);
    }

    public function set(string $key, mixed $value): static
    {
        if ($key === 'name') {
            if ($value instanceof Stringable) {
                $value = strval($value);
            }

            if (!is_string($value)) {
                throw new InvalidArgumentException('The ' . $key . ' param must be a string.');
            }

            if (!preg_match('/\A[A-Za-z0-9_]+\z/', $value)) {
                throw new InvalidArgumentException(
                    'The specified driver name, ' . $value . ', is invalid.'
                );
            }

            if (!class_exists($this->getClass(), true)) {
                throw new DriverNotFoundException($this->getType(), $value);
            }
        }

        return parent::set($key, $value);
    }

    protected abstract function getType(): string;
    protected abstract function getClass(): string;

    public function __toString(): string
    {
        return $this->getName();
    }
}
