<?php

namespace Przelewy24;

class Config
{
    private int $merchantId;

    private string $reportsKey;

    private string $crc;

    private bool $isLive;

    private ?int $posId;

    public function __construct(
        int $merchantId,
        string $reportsKey,
        string $crc,
        bool $isLive = false,
        ?int $posId = null,
    ) {
        $this->merchantId = $merchantId;
        $this->crc = $crc;
        $this->reportsKey = $reportsKey;
        $this->isLive = $isLive;
        $this->posId = $posId;
    }

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
