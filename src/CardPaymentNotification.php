<?php

namespace Przelewy24;

use Przelewy24\Enums\Currency;

class CardPaymentNotification
{
    public function __construct(private Config $config, private array $data)
    {
    }

    /**
     * Gets the amount
     *
     * @return int|null
     */
    public function amount(): ?int
    {
        return $this->data['amount'] ?? null;
    }

    /**
     * Gets the 3ds
     *
     * @return int|null
     */
    public function is3ds(): ?int
    {
        return $this->data['3ds'] ?? null;
    }

    /**
     * Gets the method
     *
     * @return int|null
     */
    public function method(): ?int
    {
        return $this->data['method'] ?? null;
    }

    /**
     * Gets the refId
     *
     * @return string|null
     */
    public function refId(): ?string
    {
        return $this->data['refId'] ?? null;
    }

    /**
     * Gets the orderId
     *
     * @return string|null
     */
    public function orderId(): ?string
    {
        return $this->data['orderId'] ?? null;
    }

    /**
     * Gets the sessionId
     *
     * @return string|null
     */
    public function sessionId(): ?string
    {
        return $this->data['sessionId'] ?? null;
    }

    /**
     * Gets the bin
     *
     * @return int|null
     */
    public function bin(): ?int
    {
        return $this->data['bin'] ?? null;
    }

    /**
     * Gets the maskedCCNumber
     *
     * @return string|null
     */
    public function maskedCCNumber(): ?string
    {
        return $this->data['maskedCCNumber'] ?? null;
    }

    /**
     * Gets the ccExp
     *
     * @return string|null
     */
    public function ccExp(): ?string
    {
        return $this->data['ccExp'] ?? null;
    }

    /**
     * Gets the hash
     *
     * @return string|null
     */
    public function hash(): ?string
    {
        return $this->data['hash'] ?? null;
    }

    /**
     * Gets the cardCountry
     *
     * @return string|null
     */
    public function cardCountry(): ?string
    {
        return $this->data['cardCountry'] ?? null;
    }

    /**
     * Gets the risk
     *
     * @return int|null
     */
    public function risk(): ?int
    {
        return $this->data['rist'] ?? null;
    }

    /**
     * Gets the liabilityshift
     *
     * @return bool|null
     */
    public function liabilityshift(): ?bool
    {
        return $this->data['liabilityshift'] ?? null;
    }

    /**
     * Gets the sign
     *
     * @return string|null
     */
    public function sign(): ?string
    {
        return $this->data['sign'] ?? null;
    }

    /**
     * Checks the response signature
     * @return bool
     */
    public function isSignValid(): bool {
        $sign = Przelewy24::createSignature([
            'amount' => $this->amount(),
            '3ds' => $this->is3ds(),
            'method' => $this->method(),
            'refId' => $this->refId(),
            'orderId' => $this->orderId(),
            'sessionId' => $this->sessionId(),
            'bin' => $this->bin(),
            'maskedCCNumber' => $this->maskedCCNumber(),
            'ccExp' => $this->ccExp(),
            'hash' => $this->hash(),
            'cardCountry' => $this->cardCountry(),
            'rist' => $this->risk(),
            'liabilityshift' => $this->liabilityshift(),
            'crc' => $this->config->crc(),
        ]);

        return $this->sign() === $sign;
    }
}