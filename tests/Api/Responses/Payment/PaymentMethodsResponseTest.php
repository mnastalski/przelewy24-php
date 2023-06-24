<?php

namespace Przelewy24\Tests\Api\Responses\Payment;

use PHPUnit\Framework\TestCase;
use Przelewy24\Api\Responses\Payment\PaymentMethodsResponse;

class PaymentMethodsResponseTest extends TestCase
{
    public function testGetters(): void
    {
        $response = new PaymentMethodsResponse([
            'data' => [
                [
                    'name' => 'Provider-Przelewy24',
                    'id' => 123,
                    'group' => 'FastTransfers',
                    'subgroup' => 'FastTransfers',
                    'status' => true,
                    'imgUrl' => 'https://static.przelewy24.pl/payment-form-logo/svg/123',
                    'mobileImgUrl' => 'https://static.przelewy24.pl/payment-form-logo/svg/mobile/123',
                    'mobile' => true,
                    'availabilityHours' => [
                        'mondayToFriday' => '00-24',
                        'saturday' => '00-24',
                        'sunday' => '00-24',
                    ],
                ],
            ],
            'agreements' => [],
            'responseCode' => 0,
        ]);

        $this->assertSame([
            [
                'name' => 'Provider-Przelewy24',
                'id' => 123,
                'group' => 'FastTransfers',
                'subgroup' => 'FastTransfers',
                'status' => true,
                'imgUrl' => 'https://static.przelewy24.pl/payment-form-logo/svg/123',
                'mobileImgUrl' => 'https://static.przelewy24.pl/payment-form-logo/svg/mobile/123',
                'mobile' => true,
                'availabilityHours' => [
                    'mondayToFriday' => '00-24',
                    'saturday' => '00-24',
                    'sunday' => '00-24',
                ],
            ],
        ], $response->methods());

        $this->assertSame([], $response->agreements());
    }
}
