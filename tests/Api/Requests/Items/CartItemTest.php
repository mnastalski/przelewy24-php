<?php

namespace Przelewy24\Tests\Api\Requests\Items;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Requests\Items\CartItem;

class CartItemTest extends TestCase
{
    public function testToArray(): void
    {
        $cartItem = new CartItem(
            sellerId: 'seller_1',
            sellerCategory: 'category',
            name: 'Name',
            description: 'Description',
            quantity: 2,
            price: 1500,
            number: '00013',
        );

        $this->assertSame([
            'sellerId' => 'seller_1',
            'sellerCategory' => 'category',
            'name' => 'Name',
            'description' => 'Description',
            'quantity' => 2,
            'price' => 1500,
            'number' => '00013',
        ], $cartItem->toArray());
    }
}
