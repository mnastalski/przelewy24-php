<?php

declare(strict_types=1);

namespace Przelewy24\Api\Responses\Payment;

use Przelewy24\Api\Responses\AbstractResponse;

class PaymentMethodsResponse extends AbstractResponse
{
    public function methods(): array
    {
        return $this->parameters['data'];
    }

    public function agreements(): array
    {
        return $this->parameters['agreements'];
    }
}
