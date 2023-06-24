<?php

namespace Przelewy24\Utilities;

use Psr\Http\Message\ResponseInterface;

class Json
{
    public static function decodeResponse(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
