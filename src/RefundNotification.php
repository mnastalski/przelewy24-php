<?php

namespace Przelewy24;

class RefundNotification
{
    public function __construct(
        private readonly Config $config,
        private readonly array $parameters,
    ) {}
}
