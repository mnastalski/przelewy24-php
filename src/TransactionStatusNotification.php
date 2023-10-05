<?php

namespace Przelewy24;

use Przelewy24\Enums\Currency;

class TransactionStatusNotification
{
    public function __construct(
        private readonly Config $config,
        private readonly array $parameters,
    ) {}

    public function merchantId(): int
    {
        return $this->parameters['merchantId'];
    }

    public function posId(): int
    {
        return $this->parameters['posId'];
    }

    public function sessionId(): string
    {
        return $this->parameters['sessionId'];
    }

    public function amount(): int
    {
        return $this->parameters['amount'];
    }

    public function originAmount(): int
    {
        return $this->parameters['originAmount'];
    }

    public function currency(): Currency
    {
        return Currency::from($this->parameters['currency']);
    }

    public function orderId(): int
    {
        return $this->parameters['orderId'];
    }

    public function methodId(): int
    {
        return $this->parameters['methodId'];
    }

    public function statement(): string
    {
        return $this->parameters['statement'];
    }

    public function sign(): string
    {
        return $this->parameters['sign'];
    }

    public function isSignValid(
        string $sessionId,
        int $amount,
        int $originAmount,
        int $orderId,
        int $methodId,
        string $statement,
        Currency $currency = Currency::PLN,
    ): bool {
        $sign = Przelewy24::createSignature([
            'merchantId' => $this->config->merchantId(),
            'posId' => $this->config->posId(),
            'sessionId' => $sessionId,
            'amount' => $amount,
            'originAmount' => $originAmount,
            'currency' => $currency->value,
            'orderId' => $orderId,
            'methodId' => $methodId,
            'statement' => $statement,
            'crc' => $this->config->crc(),
        ]);

        return $this->sign() === $sign;
    }
}
