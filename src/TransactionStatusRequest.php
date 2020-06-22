<?php

namespace Przelewy24;

class TransactionStatusRequest
{
    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->parameters = $data;
    }

    /**
     * @return string
     */
    public function sessionId(): string
    {
        return $this->parameters['session_id'];
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->parameters['amount'];
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->parameters['currency'];
    }

    /**
     * @return int
     */
    public function orderId(): int
    {
        return $this->parameters['order_id'];
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->parameters['method'];
    }

    /**
     * @return int
     */
    public function statement(): int
    {
        return $this->parameters['statement'];
    }

    /**
     * @return int
     */
    public function sign(): int
    {
        return $this->parameters['sign'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->parameters;
    }
}
