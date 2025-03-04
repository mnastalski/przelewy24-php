<?php

namespace Przelewy24\Api\Requests\Items;

class Psu
{
    public function __construct(
        private readonly string $ip,
        private readonly ?string $userAgent = null,
    ) {}

    public function toArray(): array
    {
        return [
            'IP' => $this->ip,
            'userAgent' => $this->userAgent,
        ];
    }
}
