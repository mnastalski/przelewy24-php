<?php

declare(strict_types=1);

namespace Przelewy24\Api;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Przelewy24\Config;

class Api
{
    private const URL_LIVE = 'https://secure.przelewy24.pl/';

    private const URL_SANDBOX = 'https://sandbox.przelewy24.pl/';

    private ?GuzzleClient $client = null;

    public function __construct(
        protected readonly Config $config,
    ) {}

    protected function client(): ClientInterface
    {
        if ($this->client) {
            return $this->client;
        }

        return $this->client = new GuzzleClient([
            'base_uri' => $this->apiUrl(),
            RequestOptions::AUTH => [
                $this->config->posId(),
                $this->config->reportsKey(),
            ],
            RequestOptions::CONNECT_TIMEOUT => 10,
            RequestOptions::CRYPTO_METHOD => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
            RequestOptions::TIMEOUT => 30,
        ]);
    }

    protected function apiUrl(): string
    {
        return $this->config->isLiveMode() ? self::URL_LIVE : self::URL_SANDBOX;
    }
}
