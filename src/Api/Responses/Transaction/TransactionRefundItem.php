<?php

namespace Przelewy24\Api\Responses\Transaction;

/**
 * Represents a single refund item of "TransactionRefundResponse".
 */
class TransactionRefundItem
{
    public function __construct(
        private readonly ?int $orderId,
        private readonly ?string $sessionId,
        private readonly ?int $amount,
        private readonly ?string $description,
        private readonly ?bool $status,
        private readonly ?string $message
    ) {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['orderId'] ?? null,
            $data['sessionId'] ?? null,
            $data['amount'] ?? null,
            $data['description'] ?? null,
            $data['status'] ?? null,
            $data['message'] ?? null,
        );
    }

    public function orderId(): ?int
    {
        return $this->orderId;
    }

    public function sessionId(): ?string
    {
        return $this->sessionId;
    }

    public function amount(): ?int
    {
        return $this->amount;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function status(): ?bool
    {
        return $this->status;
    }

    public function message(): ?string
    {
        return $this->message;
    }
}
