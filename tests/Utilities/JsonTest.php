<?php

namespace Przelewy24\Tests\Utilities;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Przelewy24\Utilities\Json;

class JsonTest extends TestCase
{
    public function testDecodeResponse(): void
    {
        $decodeResponse = Json::decodeResponse(
            new Response(200, [], '{"foo":"bar"}')
        );

        $this->assertSame(['foo' => 'bar'], $decodeResponse);
    }
}
