<?php

namespace Przelewy24\Api\Response;

class RegisterTransactionResponse extends ApiResponse
{
    /**
     * @var string|null
     */
    protected $token;

    /**
     * @var string|null
     */
    private $gatewayUrl;

    /**
     * @return string|null
     */
    public function token(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $url
     * @return \Przelewy24\Api\Response\RegisterTransactionResponse
     */
    public function setGatewayUrl(string $url): self
    {
        $this->gatewayUrl = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function redirectUrl(): string
    {
        return $this->gatewayUrl . '/' . $this->token;
    }
}
