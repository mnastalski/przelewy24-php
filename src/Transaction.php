<?php

namespace Przelewy24;

use Przelewy24\Api\Api;
use Przelewy24\Api\Request\ApiRequest;

class Transaction extends ApiRequest
{
    public const LANGUAGE_PL = 'pl';
    public const LANGUAGE_EN = 'en';
    public const LANGUAGE_DE = 'de';
    public const LANGUAGE_ES = 'es';
    public const LANGUAGE_IT = 'it';

    public const CHANNEL_CARD = 1;
    public const CHANNEL_WIRE = 2;
    public const CHANNEL_TRADITIONAL_WIRE = 4;
    public const CHANNEL_ALL_24_7 = 16;
    public const CHANNEL_PREPAYMENT = 32;
    public const CHANNEL_PAY_BY_LINK = 64;

    public const ENCODING_ISO_8859_2 = 'ISO-8859-2';
    public const ENCODING_UTF_8 = 'UTF-8';
    public const ENCODING_WINDOWS_1250 = 'Windows-1250';

    /**
     * @var array
     */
    protected $signatureAttributes = [
        'session_id',
        'merchant_id',
        'amount',
        'currency',
        'crc',
    ];

    /**
     * @var array|\Przelewy24\TransactionProduct[]
     */
    private $products = [];

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = array_merge([
            'currency' => 'PLN',
            'language' => self::LANGUAGE_PL,
            'encoding' => self::ENCODING_UTF_8,
            'api_version' => Api::VERSION,
        ], $parameters);
    }

    /**
     * @param array $product
     * @return \Przelewy24\Transaction
     */
    public function addProduct(array $product): self
    {
        $this->products[] = new TransactionProduct($product);

        return $this;
    }
}
