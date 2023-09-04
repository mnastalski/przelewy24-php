<?php

namespace Przelewy24\Api\Requests;

use GuzzleHttp\RequestOptions;
use Przelewy24\Api\Api;
use Przelewy24\Api\Responses\Card\CardChargeResponse;
use Przelewy24\Api\Responses\Card\CardChargeWith3dsResponse;
use Przelewy24\Api\Responses\Card\CardInfoResponse;
use GuzzleHttp\Exception\BadResponseException;
use Przelewy24\Api\Responses\Card\CardPaymentResponse;
use Przelewy24\Exceptions\Przelewy24Exception;

class CardRequests extends Api
{
    /**
     * Gets the card info for given order ID
     *
     * @param string $orderId
     * @return CardInfoResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cardInfo(string $orderId): CardInfoResponse
    {
        try {
            return CardInfoResponse::fromResponse(
                $this->client()->get("api/v1/card/info/{$orderId}")
            );
        } catch (BadResponseException $e) {
            throw Przelewy24Exception::fromBadResponseException($e);
        }
    }

    /**
     * Charges the card with given token
     *
     * @param string $token
     * @return CardChargeResponse
     * @throws Przelewy24Exception
     */
    public function cardCharge(string $token): CardChargeResponse
    {
        try {
            return CardChargeResponse::fromResponse(
                $this->client()->post('api/v1/card/charge', [
                    RequestOptions::JSON => [
                        'token' => $token
                    ],
                ])
            );
        } catch (BadResponseException $e) {
            throw Przelewy24Exception::fromBadResponseException($e);
        }
    }

    /**
     * Charges the card with given token
     *
     * @param string $token
     * @return CardChargeWith3dsResponse
     * @throws Przelewy24Exception
     */
    public function cardChargeWith3ds(string $token): CardChargeWith3dsResponse
    {
        try {
            return CardChargeWith3dsResponse::fromResponse(
                $this->client()->post('api/v1/card/chargeWith3ds', [
                    RequestOptions::JSON => [
                        'token' => $token
                    ],
                ])
            );
        } catch (BadResponseException $e) {
            throw Przelewy24Exception::fromBadResponseException($e);
        }
    }

    /**
     * Performs card payment
     *
     * @param string $transactionToken
     * @param string $cardNumber
     * @param string $cardDate
     * @param string $cardCvv
     * @param string $clientName
     * @return CardPaymentResponse
     */
    public function cardPayment(string $transactionToken, string $cardNumber, string $cardDate, string $cardCvv, string $clientName): CardPaymentResponse
    {
        try {
            return CardPaymentResponse::fromResponse(
                $this->client()->post(
                    'api/v1/card/pay',
                    [
                        RequestOptions::JSON => [
                            'transactionToken' => $transactionToken,
                            'cardNumber' => $cardNumber,
                            'cardDate' => $cardDate,
                            'cvv' => $cardCvv,
                            'clientName' => $clientName
                        ],
                    ]
                )
            );
        } catch (BadResponseException $e) {
            throw Przelewy24Exception::fromBadResponseException($e);
        }
    }
}