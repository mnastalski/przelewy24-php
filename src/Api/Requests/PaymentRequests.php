<?php

namespace Przelewy24\Api\Requests;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use Przelewy24\Api\Api;
use Przelewy24\Api\Responses\Payment\PaymentMethodsResponse;
use Przelewy24\Enums\Currency;
use Przelewy24\Enums\PaymentMethodLanguage;
use Przelewy24\Exceptions\Przelewy24Exception;

class PaymentRequests extends Api
{
    public function methods(
        PaymentMethodLanguage $language = PaymentMethodLanguage::POLISH,
        ?int $amount = null,
        ?Currency $currency = null,
    ): PaymentMethodsResponse {
        try {
            $response = $this->client()->get("api/v1/payment/methods/{$language->value}", [
                RequestOptions::QUERY => [
                    'amount' => $amount,
                    'currency' => $currency?->value,
                ],
            ]);

            return PaymentMethodsResponse::fromResponse($response);
        } catch (BadResponseException $exception) {
            throw Przelewy24Exception::fromBadResponseException($exception);
        }
    }
}
