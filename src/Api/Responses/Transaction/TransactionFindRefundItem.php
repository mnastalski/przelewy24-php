<?php

namespace Przelewy24\Api\Responses\Transaction;

use Przelewy24\Enums\TransactionFindRefundStatus;

class TransactionFindRefundItem
{
    public function __construct(
        private readonly int $batchId,
        private readonly string $requestId,
        private readonly string $date,
        private readonly string $login,
        private readonly string $description,
        private readonly int $status,
        private readonly int $amount,
    ) {}

    public function batchId(): int
    {
        return $this->batchId;
    }

    public function requestId(): string
    {
        return $this->requestId;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function login(): string
    {
        return $this->login;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function status(): ?TransactionFindRefundStatus
    {
        return TransactionFindRefundStatus::tryFrom($this->status);
    }

    public function amount(): int
    {
        return $this->amount;
    }
}
