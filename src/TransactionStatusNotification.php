<?php

namespace Przelewy24;

use Przelewy24\Enums\Currency;

class TransactionStatusNotification extends AbstractNotification
{
    public function merchantId(): ?int
    {
        return $this->get('merchantId');
    }

    public function posId(): ?int
    {
        return $this->get('posId');
    }

    public function sessionId(): ?string
    {
        return $this->get('sessionId');
    }

    public function amount(): ?int
    {
        return $this->get('amount');
    }

    public function originAmount(): ?int
    {
        return $this->get('originAmount');
    }

    public function currency(): ?Currency
    {
        return Currency::tryFrom($this->get('currency'));
    }

    public function orderId(): ?int
    {
        return $this->get('orderId');
    }

    public function methodId(): ?int
    {
        return $this->get('methodId');
    }

    public function statement(): ?string
    {
        return $this->get('statement');
    }

    public function sign(): ?string
    {
        return $this->get('sign');
    }

    /**
     * @deprecated Use isSignatureValid instead
     *
     * @param string $sessionId
     * @param int $amount
     * @param int $originAmount
     * @param int $orderId
     * @param int $methodId
     * @param string $statement
     * @param Currency $currency
     * @return bool
     */
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

    /**
     * @inheritDoc
     */
    public function isSignatureValid(): bool
    {
        return $this->sign() === $this->calculateSign();
    }

    /**
     * Calculates the signature of the notification.
     */
    private function calculateSign(): string
    {
        return Przelewy24::createSignature([
            'merchantId' => $this->config->merchantId(),
            'posId' => $this->config->posId(),
            'sessionId' => (string) $this->sessionId(),
            'amount' => (int) $this->amount(),
            'originAmount' => (int) $this->originAmount(),
            'currency' => (string) $this->currency()?->value,
            'orderId' => (int) $this->orderId(),
            'methodId' => (int) $this->methodId(),
            'statement' => (string) $this->statement(),
            'crc' => $this->config->crc(),
        ]);
    }
}
