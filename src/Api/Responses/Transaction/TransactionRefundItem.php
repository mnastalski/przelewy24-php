<?php

namespace Przelewy24\Api\Responses\Transaction;

class TransactionRefundItem
{
    public function __construct(
        private readonly int $orderId,
        private readonly string $sessionId,
        private readonly int $amount,
        private readonly bool $status,
        private readonly string $message,
        private readonly ?string $description,
    ) {}

    public function orderId(): int
    {
        return $this->orderId;
    }

    public function sessionId(): string
    {
        return $this->sessionId;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function status(): bool
    {
        return $this->status;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function description(): ?string
    {
        return $this->description;
    }
}
