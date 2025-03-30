<?php

namespace Przelewy24\Api\Requests;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use Przelewy24\Api\Api;
use Przelewy24\Api\Requests\Items\CartItem;
use Przelewy24\Api\Requests\Items\Psu;
use Przelewy24\Api\Requests\Items\RefundItem;
use Przelewy24\Api\Requests\Items\Shipping;
use Przelewy24\Api\Responses\Transaction\FindTransactionResponse;
use Przelewy24\Api\Responses\Transaction\RegisterTransactionResponse;
use Przelewy24\Api\Responses\Transaction\TransactionFindRefundResponse;
use Przelewy24\Api\Responses\Transaction\TransactionRefundResponse;
use Przelewy24\Api\Responses\Transaction\VerifyTransactionResponse;
use Przelewy24\Enums\Country;
use Przelewy24\Enums\Currency;
use Przelewy24\Enums\Encoding;
use Przelewy24\Enums\Language;
use Przelewy24\Exceptions\Przelewy24Exception;
use Przelewy24\Przelewy24;

class TransactionRequests extends Api
{
    public function register(
        string $sessionId,
        int $amount,
        string $description,
        string $email,
        string $urlReturn,
        Encoding $encoding = Encoding::UTF_8,
        Language $language = Language::POLISH,
        Currency $currency = Currency::PLN,
        Country $country = Country::POLAND,
        ?int $method = null,
        ?string $client = null,
        ?string $address = null,
        ?string $zip = null,
        ?string $city = null,
        ?string $phone = null,
        ?string $urlStatus = null,
        ?int $timeLimit = null,
        ?int $channel = null,
        ?bool $waitForResult = null,
        ?bool $regulationAccept = null,
        ?int $shipping = null,
        ?string $transferLabel = null,
        ?int $mobileLib = null,
        ?string $sdkVersion = null,
        ?string $methodRefId = null,
        ?array $cart = null,
        ?Shipping $shippingData = null,
        ?string $urlCardPaymentNotification = null,
        ?Psu $psu = null,
    ): RegisterTransactionResponse {
        $sign = Przelewy24::createSignature([
            'sessionId' => $sessionId,
            'merchantId' => $this->config->merchantId(),
            'amount' => $amount,
            'currency' => $currency->value,
            'crc' => $this->config->crc(),
        ]);

        $json = [
            'merchantId' => $this->config->merchantId(),
            'posId' => $this->config->posId(),
            'sessionId' => $sessionId,
            'amount' => $amount,
            'currency' => $currency->value,
            'description' => $description,
            'email' => $email,
            'client' => $client,
            'address' => $address,
            'zip' => $zip,
            'city' => $city,
            'country' => $country->value,
            'phone' => $phone,
            'language' => $language->value,
            'method' => $method,
            'urlReturn' => $urlReturn,
            'urlStatus' => $urlStatus,
            'timeLimit' => $timeLimit,
            'channel' => $channel,
            'waitForResult' => $waitForResult,
            'regulationAccept' => $regulationAccept,
            'shipping' => $shipping,
            'transferLabel' => $transferLabel,
            'mobileLib' => $mobileLib,
            'sdkVersion' => $sdkVersion,
            'sign' => $sign,
            'encoding' => $encoding->value,
            'methodRefId' => $methodRefId,
            'urlCardPaymentNotification' => $urlCardPaymentNotification,
        ];

        if ($cart) {
            $json['cart'] = array_map(fn (CartItem $item): array => $item->toArray(), $cart);
        }

        if ($shippingData) {
            $json['additional']['shipping'] = $shippingData->toArray();
        }

        if ($psu) {
            $json['additional']['PSU'] = $psu->toArray();
        }

        try {
            $response = $this->client()->post('api/v1/transaction/register', [
                RequestOptions::JSON => $json,
            ]);

            return RegisterTransactionResponse::fromResponse($response)->setGatewayBaseUri($this->apiUrl());
        } catch (BadResponseException $exception) {
            throw Przelewy24Exception::fromBadResponseException($exception);
        }
    }

    public function verify(
        string $sessionId,
        int $orderId,
        int $amount,
        ?Currency $currency = Currency::PLN,
    ): VerifyTransactionResponse {
        try {
            $sign = Przelewy24::createSignature([
                'sessionId' => $sessionId,
                'orderId' => $orderId,
                'amount' => $amount,
                'currency' => $currency->value,
                'crc' => $this->config->crc(),
            ]);

            $response = $this->client()->put('api/v1/transaction/verify', [
                RequestOptions::JSON => [
                    'merchantId' => $this->config->merchantId(),
                    'posId' => $this->config->posId(),
                    'sessionId' => $sessionId,
                    'amount' => $amount,
                    'currency' => $currency,
                    'orderId' => $orderId,
                    'sign' => $sign,
                ],
            ]);

            return VerifyTransactionResponse::fromResponse($response);
        } catch (BadResponseException $exception) {
            throw Przelewy24Exception::fromBadResponseException($exception);
        }
    }

    public function find(string $sessionId): FindTransactionResponse
    {
        try {
            $response = $this->client()->get("api/v1/transaction/by/sessionId/{$sessionId}");

            return FindTransactionResponse::fromResponse($response);
        } catch (BadResponseException $exception) {
            throw Przelewy24Exception::fromBadResponseException($exception);
        }
    }

    public function refund(
        string $requestId,
        string $refundsId,
        array $refunds,
        ?string $urlStatus = null,
    ): TransactionRefundResponse {
        try {
            $response = $this->client()->post('api/v1/transaction/refund', [
                RequestOptions::JSON => [
                    'requestId' => $requestId,
                    'refundsUuid' => $refundsId,
                    'refunds' => array_map(fn (RefundItem $item): array => $item->toArray(), $refunds),
                    'urlStatus' => $urlStatus,
                ],
            ]);

            return TransactionRefundResponse::fromResponse($response);
        } catch (BadResponseException $exception) {
            throw Przelewy24Exception::fromBadResponseException($exception);
        }
    }

    public function findRefund(int $orderId): TransactionFindRefundResponse
    {
        try {
            $response = $this->client()->get("api/v1/refund/by/orderId/{$orderId}");

            return TransactionFindRefundResponse::fromResponse($response);
        } catch (BadResponseException $exception) {
            throw Przelewy24Exception::fromBadResponseException($exception);
        }
    }
}
