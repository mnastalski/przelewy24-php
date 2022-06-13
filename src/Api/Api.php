<?php

namespace Przelewy24\Api;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Przelewy24\Api\Request\SignedApiRequest;
use Przelewy24\Api\Response\RegisterTransactionResponse;
use Przelewy24\Api\Response\TestConnectionResponse;
use Przelewy24\Api\Response\VerifyTransactionResponse;
use Przelewy24\Config;
use Psr\Http\Message\ResponseInterface;

class Api
{
    public const VERSION = '3.2';

    public const URL_LIVE = 'https://secure.przelewy24.pl/';
    public const URL_SANDBOX = 'https://sandbox.przelewy24.pl/';

    public const ENDPOINT_TEST = 'testConnection';
    public const ENDPOINT_REGISTER = 'trnRegister';
    public const ENDPOINT_VERIFY = 'trnVerify';
    public const ENDPOINT_PAYMENT_GATEWAY = 'trnRequest';

    /**
     * @var \Przelewy24\Config
     */
    private $config;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * @param \Przelewy24\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Przelewy24\Api\Response\TestConnectionResponse
     * @throws \Przelewy24\Exceptions\ApiResponseException
     */
    public function testConnection(): TestConnectionResponse
    {
        $response = $this->request(self::ENDPOINT_TEST, [
            'p24_merchant_id' => $this->config->getMerchantId(),
            'p24_pos_id' => $this->config->getPosId(),
            'p24_sign' => md5($this->config->getPosId() . '|' . $this->config->getCrc()),
        ]);

        return new TestConnectionResponse($response);
    }

    /**
     * @param \Przelewy24\Api\Request\SignedApiRequest $apiRequest
     * @return \Przelewy24\Api\Response\RegisterTransactionResponse
     * @throws \Przelewy24\Exceptions\ApiResponseException
     */
    public function registerTransaction(SignedApiRequest $apiRequest): RegisterTransactionResponse
    {
        $apiRequest->setConfig($this->config);

        $response = new RegisterTransactionResponse(
            $this->request(self::ENDPOINT_REGISTER, $apiRequest->parameters())
        );

        $response->setGatewayUrl(
            $this->getApiUrl() . self::ENDPOINT_PAYMENT_GATEWAY
        );

        return $response;
    }

    /**
     * @param \Przelewy24\Api\Request\SignedApiRequest $apiRequest
     * @return \Przelewy24\Api\Response\VerifyTransactionResponse
     * @throws \Przelewy24\Exceptions\ApiResponseException
     */
    public function verifyTransaction(SignedApiRequest $apiRequest): VerifyTransactionResponse
    {
        $apiRequest->setConfig($this->config);

        return new VerifyTransactionResponse(
            $this->request(self::ENDPOINT_VERIFY, $apiRequest->parameters())
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    private function client(): ClientInterface
    {
        if (!$this->client) {
            $this->client = new GuzzleClient([
                'base_uri' => $this->getApiUrl(),
                RequestOptions::CONNECT_TIMEOUT => 10,
                RequestOptions::TIMEOUT => 30,
            ]);
        }

        return $this->client;
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function request(string $endpoint, array $parameters): ResponseInterface
    {
        return $this->client()->post($endpoint, [
            'form_params' => $parameters,
        ]);
    }

    /**
     * @return string
     */
    private function getApiUrl(): string
    {
        return $this->config->isLiveMode() ? self::URL_LIVE : self::URL_SANDBOX;
    }
}
