<?php

namespace Przelewy24;

use Przelewy24\Enums\Currency;

class RefundNotification extends AbstractNotification
{
    public function orderId(): ?int
    {
        return $this->get('orderId');
    }

    public function sessionId(): ?string
    {
        return $this->get('sessionId');
    }

    public function merchantId(): ?int
    {
        return $this->get('merchantId');
    }

    public function requestId(): ?string
    {
        return $this->get('requestId');
    }

    public function refundsUuid(): ?string
    {
        return $this->get('refundsUuid');
    }

    public function amount(): ?int
    {
        return $this->get('amount');
    }

    public function currency(): ?Currency
    {
        return Currency::tryFrom($this->get('currency'));
    }

    public function timestamp(): ?int
    {
        return $this->get('timestamp');
    }

    public function status(): ?int
    {
        return $this->get('status');
    }

    public function sign(): ?string
    {
        return $this->get('sign');
    }

    /**
     * @inheritDoc
     */
    public function isSignatureValid(): bool
    {
        return $this->sign() === $this->calculateSign();
    }

    /**
     *  Calculates the signature of the notification.
     */
    private function calculateSign(): string
    {
        return Przelewy24::createSignature([
            'orderId' => (int) $this->orderId(),
            'sessionId' => (string) $this->sessionId(),
            'refundsUuid' => (string) $this->refundsUuid(),
            'merchantId' => (int) $this->merchantId(),
            'amount' => (int) $this->amount(),
            'currency' => (string) $this->currency()?->value,
            'status' => (int) $this->status(),
            'crc' => $this->config->crc(),
        ]);
    }
}
