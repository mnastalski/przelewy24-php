<?php

namespace Przelewy24\Tests;

use PHPUnit\Framework\TestCase;
use Przelewy24\Przelewy24;

class Przelewy24Test extends TestCase
{
    public function testCreateSignature(): void
    {
        $signature = Przelewy24::createSignature([
            'slash' => 'foo/bar',
            'unicode' => 'ąźćż',
        ]);

        $this->assertSame('4e9e3bc8c346c7487dbd4a4b4c6b5ec4561685d9018b775980e362159e3d4436e971036c3b278a07d9dd233298f0e45d', $signature);
    }
}
