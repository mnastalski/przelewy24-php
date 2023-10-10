<?php

namespace Przelewy24;

abstract class AbstractNotification
{
    public function __construct(protected Config $config, protected array $parameters) {}

    /**
     * Gets the parameter of given key.
     *
     * @param string $key
     * @return mixed
     */
    protected function get(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }

    /**
     * Checks if the notification signature is valid.
     * @return bool
     */
    abstract public function isSignatureValid(): bool;

    /**
     * Gets all notification data.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->parameters;
    }
}
