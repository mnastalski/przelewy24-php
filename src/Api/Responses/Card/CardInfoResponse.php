<?php

namespace Przelewy24\Api\Responses\Card;

use Przelewy24\Api\Responses\AbstractResponse;

class CardInfoResponse extends AbstractResponse
{
    /**
     * Gets the refId.
     *
     * @return string|null
     */
    public function refId(): ?string
    {
        return $this->parameters['data']['refId'] ?? null;
    }

    /**
     * Gets the bin.
     *
     * @return int|null
     */
    public function bin(): ?int
    {
        return $this->parameters['data']['bin'] ?? null;
    }

    /**
     * Gets the mask.
     *
     * @return string|null
     */
    public function mask(): ?string
    {
        return $this->parameters['data']['mask'] ?? null;
    }

    /**
     * Gets the cardType.
     *
     * @return string|null
     */
    public function cardType(): ?string
    {
        return $this->parameters['data']['cardType'] ?? null;
    }

    /**
     * Gets the cardDate.
     *
     * @return string|null
     */
    public function cardDate(): ?string
    {
        return $this->parameters['data']['cardDate'] ?? null;
    }

    /**
     * Gets the hash.
     *
     * @return string|null
     */
    public function hash(): ?string
    {
        return $this->parameters['data']['hash'] ?? null;
    }
}
