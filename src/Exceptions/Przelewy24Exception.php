<?php

namespace Przelewy24\Exceptions;

use GuzzleHttp\Exception\BadResponseException;
use Przelewy24\Utilities\Json;

class Przelewy24Exception extends BadResponseException
{
    public static function fromBadResponseException(BadResponseException $exception): static
    {
        return new static($exception->getMessage(), $exception->getRequest(), $exception->getResponse(), $exception->getPrevious(), $exception->getHandlerContext());
    }

    public function errorMessage(): array|string|null
    {
        $contents = Json::decodeResponse($this->getResponse());

        return $contents['error'] ?? null;
    }
}
