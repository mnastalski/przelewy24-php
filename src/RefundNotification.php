<?php

namespace Przelewy24;

use Przelewy24\Enums\Currency;

class RefundNotification
{
    public function __construct(
        private readonly Config $config,
        private readonly array $parameters,
    ) {}

    public function orderId(): int
    {
        return $this->parameters['orderId'];
    }

    public function sessionId(): string
    {
        return $this->parameters['sessionId'];
    }

    public function merchantId(): int
    {
        return $this->parameters['merchantId'];
    }

    public function requestId(): string
    {
        return $this->parameters['requestId'];
    }

    public function refundsUuid(): string
    {
        return $this->parameters['refundsUuid'];
    }

    public function amount(): int
    {
        return $this->parameters['amount'];
    }

    public function currency(): Currency
    {
        return Currency::from($this->parameters['currency']);
    }

    public function timestamp(): int
    {
        return $this->parameters['timestamp'];
    }

    public function status(): int
    {
        return $this->parameters['status'];
    }

    public function sign(): string
    {
        return $this->parameters['sign'];
    }

    public function isSignValid(
        int $orderId,
        string $sessionId,
        string $refundsId,
        int $amount,
        int $status,
        Currency $currency = Currency::PLN,
    ): bool {
        $sign = Przelewy24::createSignature([
            'orderId' => $orderId,
            'sessionId' => $sessionId,
            'refundsUuid' => $refundsId,
            'merchantId' => $this->config->merchantId(),
            'amount' => $amount,
            'currency' => $currency->value,
            'status' => $status,
            'crc' => $this->config->crc(),
        ]);

        return $this->sign() === $sign;
    }
}
