<?php

namespace Przelewy24\Api\Responses;

use Przelewy24\Utilities\Json;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse
{
    public function __construct(
        protected readonly array $parameters,
    ) {
        //
    }

    public static function fromResponse(ResponseInterface $response): static
    {
        return new static(Json::decodeResponse($response));
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}
