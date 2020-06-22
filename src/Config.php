<?php

namespace Przelewy24;

use InvalidArgumentException;

class Config
{
    /**
     * @var string
     */
    public const MODE_SANDBOX = 'sandbox';

    /**
     * @var string
     */
    public const MODE_LIVE = 'live';

    /**
     * @var string
     */
    private $merchantId;

    /**
     * @var string|null
     */
    private $posId;

    /**
     * @var string
     */
    private $crc;

    /**
     * @var string
     */
    private $mode;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->set($parameters);
    }

    /**
     * @param array $parameters
     * @return \Przelewy24\Config
     */
    public function set(array $parameters): self
    {
        if (!$parameters['merchant_id']) {
            throw new InvalidArgumentException('"merchant_id" must be specified in the configuration parameters.');
        }

        if (!$parameters['crc']) {
            throw new InvalidArgumentException('"crc" must be specified in the configuration parameters.');
        }

        $this->merchantId = $parameters['merchant_id'];
        $this->posId = $parameters['pos_id'] ?? null;
        $this->crc = $parameters['crc'];
        $this->mode = $parameters['mode'] ?? self::MODE_LIVE;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * @return string
     */
    public function getPosId(): string
    {
        return $this->posId ?? $this->getMerchantId();
    }

    /**
     * @return string
     */
    public function getCrc(): string
    {
        return $this->crc;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @return bool
     */
    public function isLiveMode(): bool
    {
        return $this->getMode() === self::MODE_LIVE;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'merchant_id' => $this->getMerchantId(),
            'pos_id' => $this->getPosId(),
            'crc' => $this->getCrc(),
        ];
    }
}
