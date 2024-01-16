<?php

namespace Przelewy24\Api\Responses\Card;

use Przelewy24\Api\Responses\AbstractResponse;

class CardChargeWith3dsResponse extends AbstractResponse
{
    /**
     * Gets the orderId.
     *
     * @return string|null
     */
    public function orderId(): ?string
    {
        return $this->parameters['data']['orderId'] ?? null;
    }

    /**
     * Gets the redirectUrl.
     *
     * @return string|null
     */
    public function redirectUrl(): ?string
    {
        return $this->parameters['data']['redirectUrl'] ?? null;
    }
}
