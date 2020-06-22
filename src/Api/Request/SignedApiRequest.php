<?php

namespace Przelewy24\Api\Request;

use Przelewy24\Config;

interface SignedApiRequest
{
    /**
     * @param \Przelewy24\Config $config
     * @return \Przelewy24\Api\Request\SignedApiRequest
     */
    public function setConfig(Config $config): self;

    /**
     * @return array
     */
    public function parameters(): array;

    /**
     * @return string
     */
    public function signature(): string;
}
