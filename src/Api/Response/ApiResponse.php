<?php

namespace Przelewy24\Api\Response;

use Przelewy24\Exceptions\ApiResponseException;
use Psr\Http\Message\ResponseInterface;

abstract class ApiResponse
{
    /**
     * @var string
     */
    protected $error;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @throws \Przelewy24\Exceptions\ApiResponseException
     */
    public function __construct(ResponseInterface $response)
    {
        $contents = $response->getBody();

        parse_str($contents, $parameters);

        foreach ($parameters as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        if ($this->hasError()) {
            throw new ApiResponseException(
                $this->getError()
            );
        }
    }

    /**
     * @return bool
     */
    protected function hasError(): bool
    {
        return (int) $this->error > 0;
    }

    /**
     * @return string|null
     */
    protected function getError(): ?string
    {
        return $this->errorMessage;
    }
}
