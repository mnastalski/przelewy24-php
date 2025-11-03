<?php

declare(strict_types=1);

namespace Przelewy24\Tests\Api\Requests\Items;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Requests\Items\Shipping;
use Przelewy24\Enums\Country;
use Przelewy24\Enums\ShippingType;

class ShippingTest extends TestCase
{
    public function testToArray(): void
    {
        $cartItem = new Shipping(
            type: ShippingType::PARCEL_LOCKER,
            address: 'Address',
            zip: '10-123',
            city: 'City',
            country: Country::UNITED_KINGDOM
        );

        $this->assertSame([
            'type' => ShippingType::PARCEL_LOCKER->value,
            'address' => 'Address',
            'zip' => '10-123',
            'city' => 'City',
            'country' => Country::UNITED_KINGDOM->value,
        ], $cartItem->toArray());
    }
}
