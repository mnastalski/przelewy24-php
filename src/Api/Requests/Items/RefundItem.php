<?php

namespace Przelewy24\Api\Requests\Items;

/**
 * Represents a single refund item.
 */
class RefundItem
{
    public function __construct(
        private readonly int $orderId,
        private readonly string $sessionId,
        private readonly int $amount,
        private readonly ?string $description = null,
    ) {
        //
    }

    /**
     * Creates an array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'orderId' => $this->orderId,
            'sessionId' => $this->sessionId,
            'amount' => $this->amount,
            'description' => $this->description,
        ];
    }
}
