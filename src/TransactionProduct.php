<?php

namespace Przelewy24;

class TransactionProduct
{
    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }
}
