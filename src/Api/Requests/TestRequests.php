<?php

namespace Przelewy24\Api\Requests;

use GuzzleHttp\Exception\BadResponseException;
use Przelewy24\Api\Api;
use Przelewy24\Api\Responses\Test\TestAccessResponse;
use Przelewy24\Exceptions\Przelewy24Exception;

class TestRequests extends Api
{
    public function testAccess(): TestAccessResponse
    {
        try {
            $response = $this->client()->get('api/v1/testAccess');

            return TestAccessResponse::fromResponse($response);
        } catch (BadResponseException $exception) {
            throw Przelewy24Exception::fromBadResponseException($exception);
        }
    }
}
