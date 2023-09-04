<?php

namespace Przelewy24\Api\Responses\Card;

use Przelewy24\Api\Responses\AbstractResponse;

class CardChargeResponse extends AbstractResponse
{
    public function orderId(): ?string
    {
        return $this->parameters['data']['orderId'];
    }
}
