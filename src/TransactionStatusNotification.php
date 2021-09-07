<?php

namespace Przelewy24;

class TransactionStatusNotification
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
        return $this->parameters['p24_session_id'];
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->parameters['p24_amount'];
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->parameters['p24_currency'];
    }

    /**
     * @return int
     */
    public function orderId(): int
    {
        return $this->parameters['p24_order_id'];
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->parameters['p24_method'];
    }

    /**
     * @return string
     */
    public function statement(): string
    {
        return $this->parameters['p24_statement'];
    }

    /**
     * @return string
     */
    public function sign(): string
    {
        return $this->parameters['p24_sign'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->parameters;
    }
}
