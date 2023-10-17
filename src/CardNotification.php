<?php

namespace Przelewy24;

class CardNotification extends AbstractNotification
{
    public function amount(): ?int
    {
        return $this->get('amount');
    }

    public function is3ds(): ?bool
    {
        return $this->get('3ds');
    }

    public function method(): ?int
    {
        return $this->get('method');
    }

    public function refId(): ?string
    {
        return $this->get('refId');
    }

    public function orderId(): ?int
    {
        return $this->get('orderId');
    }

    public function sessionId(): ?string
    {
        return $this->get('sessionId');
    }

    public function bin(): ?int
    {
        return $this->get('bin');
    }

    public function maskedCCNumber(): ?string
    {
        return $this->get('maskedCCNumber');
    }

    public function ccExp(): ?string
    {
        return $this->get('ccExp');
    }

    public function hash(): ?string
    {
        return $this->get('hash');
    }

    public function cardCountry(): ?string
    {
        return $this->get('cardCountry');
    }

    public function risk(): ?int
    {
        return $this->get('risk');
    }

    public function liabilityshift(): ?bool
    {
        return $this->get('liabilityshift');
    }

    public function sign(): ?string
    {
        return $this->get('sign');
    }

    public function errorCode(): ?string
    {
        return $this->get('errorCode');
    }

    public function errorMessage(): ?string
    {
        return $this->get('errorMessage');
    }

    /**
     * @inheritDoc
     */
    public function isSignatureValid(): bool
    {
        return $this->sign() === $this->calculateSign();
    }

    /**
     * Calculates the signature of the notification.
     */
    private function calculateSign(): string
    {
        if ($this->errorCode()) {
            return Przelewy24::createSignature([
                'amount' => (int) $this->amount(),
                '3ds' => (bool) $this->is3ds(),
                'method' => (int) $this->method(),
                'orderId' => (int) $this->orderId(),
                'sessionId' => (string) $this->sessionId(),
                'errorCode' => (string) $this->errorCode(),
                'errorMessage' => (string) $this->errorMessage(),
                'crc' => $this->config->crc(),
            ]);
        }

        return Przelewy24::createSignature([
            'amount' => (int) $this->amount(),
            '3ds' => (bool) $this->is3ds(),
            'method' => (int) $this->method(),
            'refId' => (string) $this->refId(),
            'orderId' => (int) $this->orderId(),
            'sessionId' => (string) $this->sessionId(),
            'bin' => (int) $this->bin(),
            'maskedCCNumber' => (string) $this->maskedCCNumber(),
            'ccExp' => (string) $this->ccExp(),
            'hash' => (string) $this->hash(),
            'cardCountry' => (string) $this->cardCountry(),
            'risk' => (int) $this->risk(),
            'liabilityshift' => (bool) $this->liabilityshift(),
            'crc' => $this->config->crc(),
        ]);
    }
}
