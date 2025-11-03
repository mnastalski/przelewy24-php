<?php

declare(strict_types=1);

namespace Przelewy24\Tests\Api\Responses\Test;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Test\TestAccessResponse;

class TestAccessResponseTest extends TestCase
{
    public function testGetters(): void
    {
        $response = new TestAccessResponse([
            'data' => true,
            'error' => '',
        ]);

        $this->assertTrue($response->data());
        $this->assertSame('', $response->error());
    }
}
