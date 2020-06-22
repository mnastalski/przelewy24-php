<?php

namespace Przelewy24\Api\Request;

use Przelewy24\Config;

class ApiRequest implements SignedApiRequest
{
    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @var array
     */
    protected $signatureAttributes = [];

    /**
     * @param \Przelewy24\Config $config
     * @return \Przelewy24\Api\Request\SignedApiRequest
     */
    public function setConfig(Config $config): SignedApiRequest
    {
        $this->parameters = array_merge($this->parameters, $config->toArray());

        return $this;
    }

    /**
     * @return array
     */
    public function parameters(): array
    {
        $parameters = [];

        foreach ($this->parameters as $parameter => $value) {
            $parameters['p24_' . $parameter] = $value;
        }

        $parameters['p24_sign'] = $this->signature();

        return $parameters;
    }

    /**
     * @return string
     */
    public function signature(): string
    {
        $parameters = [];

        foreach ($this->signatureAttributes as $param) {
            $parameters[$param] = $this->parameters[$param];
        }

        return md5(
            implode('|', $parameters)
        );
    }

    /**
     * @param string $name
     * @return string
     */
    public function __get(string $name): string
    {
        return $this->parameters[$name];
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function __set(string $name, string $value): void
    {
        $this->parameters[$name] = $value;
    }
}
