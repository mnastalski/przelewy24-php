<?php

namespace Przelewy24;

class Config
{
    public function __construct(
        private readonly int $merchantId,
        private readonly string $reportsKey,
        private readonly string $crc,
        private readonly bool $isLive = false,
        private readonly ?int $posId = null,
    ) {}

    public function merchantId(): int
    {
        return $this->merchantId;
    }

    public function posId(): int
    {
        return $this->posId ?? $this->merchantId();
    }

    public function reportsKey(): string
    {
        return $this->reportsKey;
    }

    public function crc(): string
    {
        return $this->crc;
    }

    public function isLiveMode(): bool
    {
        return $this->isLive;
    }
}
