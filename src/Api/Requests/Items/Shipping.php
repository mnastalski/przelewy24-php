<?php

namespace Przelewy24\Api\Requests\Items;

use Przelewy24\Enums\Country;
use Przelewy24\Enums\ShippingType;

class Shipping
{
    public function __construct(
        private readonly ShippingType $type,
        private readonly string $address,
        private readonly string $zip,
        private readonly string $city,
        private readonly Country $country = Country::POLAND,
    ) {}

    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'address' => $this->address,
            'zip' => $this->zip,
            'city' => $this->city,
            'country' => $this->country->value,
        ];
    }
}
