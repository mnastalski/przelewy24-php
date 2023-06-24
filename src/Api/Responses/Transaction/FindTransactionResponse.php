<?php

namespace Przelewy24\Api\Responses\Transaction;

use Przelewy24\Api\Responses\AbstractResponse;
use Przelewy24\Enums\Currency;

class FindTransactionResponse extends AbstractResponse
{
    public function orderId(): int
    {
        return $this->parameters['data']['orderId'];
    }

    public function sessionId(): string
    {
        return $this->parameters['data']['sessionId'];
    }

    public function status(): int
    {
        return $this->parameters['data']['status'];
    }

    public function amount(): int
    {
        return $this->parameters['data']['amount'];
    }

    public function currency(): Currency
    {
        return Currency::from($this->parameters['data']['currency']);
    }

    public function date(): string
    {
        return $this->parameters['data']['date'];
    }

    public function dateOfTransaction(): string
    {
        return $this->parameters['data']['dateOfTransaction'];
    }

    public function clientEmail(): string
    {
        return $this->parameters['data']['clientEmail'];
    }

    public function accountMD5(): string
    {
        return $this->parameters['data']['accountMD5'];
    }

    public function paymentMethod(): int
    {
        return $this->parameters['data']['paymentMethod'];
    }

    public function description(): string
    {
        return $this->parameters['data']['description'];
    }

    public function clientName(): string
    {
        return $this->parameters['data']['clientName'];
    }

    public function clientAddress(): string
    {
        return $this->parameters['data']['clientAddress'];
    }

    public function clientCity(): string
    {
        return $this->parameters['data']['clientCity'];
    }

    public function clientPostcode(): string
    {
        return $this->parameters['data']['clientPostcode'];
    }

    public function batchId(): int
    {
        return $this->parameters['data']['batchId'];
    }

    public function fee(): string
    {
        return $this->parameters['data']['fee'];
    }

    public function statement(): string
    {
        return $this->parameters['data']['statement'];
    }
}
