<?php

namespace Przelewy24\Api\Responses\Transaction;

use Przelewy24\Api\Responses\AbstractResponse;

class RegisterTransactionResponse extends AbstractResponse
{
    private string $gatewayBaseUri;

    public function setGatewayBaseUri(string $uri): self
    {
        $this->gatewayBaseUri = $uri;

        return $this;
    }

    public function token(): string
    {
        return $this->parameters['data']['token'];
    }

    public function gatewayUrl(): string
    {
        return $this->gatewayBaseUri . 'trnRequest/' . $this->token();
    }
}
