<?php

declare(strict_types=1);

namespace Przelewy24\Tests\Enums;

use PHPUnit\Framework\TestCase;
use Przelewy24\Enums\TransactionChannel;

class TransactionChannelTest extends TestCase
{
    public function testMultiple(): void
    {
        $multiple = TransactionChannel::multiple([
            TransactionChannel::CARDS,
            TransactionChannel::TRADITIONAL_TRANSFER,
            TransactionChannel::BLIK,
        ]);

        $this->assertSame(1 + 4 + 8192, $multiple);
    }
}
