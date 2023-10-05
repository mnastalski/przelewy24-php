<?php

namespace Przelewy24\Api\Requests\Items;

class CartItem
{
    public function __construct(
        private readonly string $sellerId,
        private readonly string $sellerCategory,
        private readonly ?string $name = null,
        private readonly ?string $description = null,
        private readonly ?int $quantity = null,
        private readonly ?int $price = null,
        private readonly ?string $number = null,
    ) {}

    public function toArray(): array
    {
        return [
            'sellerId' => $this->sellerId,
            'sellerCategory' => $this->sellerCategory,
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'number' => $this->number,
        ];
    }
}
