<?php

namespace Przelewy24\Api\Responses\Test;

use Przelewy24\Api\Responses\AbstractResponse;

class TestAccessResponse extends AbstractResponse
{
    public function data(): bool
    {
        return $this->parameters['data'];
    }

    public function error(): string
    {
        return $this->parameters['error'];
    }
}
