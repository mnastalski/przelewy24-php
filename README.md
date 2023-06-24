# Przelewy24 PHP library

PHP wrapper for [Przelewy24](https://www.przelewy24.pl/).

If you are using Laravel, check out [mnastalski/przelewy24-laravel](https://github.com/mnastalski/przelewy24-laravel/).

Przelewy24's API documentation is available at https://developers.przelewy24.pl/.

## Requirements

- PHP >=8.1

For lower PHP versions, check the [0.x](https://github.com/mnastalski/przelewy24-php/tree/0.x) versions.

## Installation

```shell
composer require mnastalski/przelewy24-php
```

## Usage

### Creating an instance

```php
use Przelewy24\Przelewy24;

$przelewy24 = new Przelewy24(
    merchantId: 12345,
    reportsKey: 'f0ae...',
    crc: 'aef0...',
    live: false,
);
```

Use `live: true` for production/live mode.

### Creating a transaction

```php
$transaction = $przelewy24->transactions()->register(
    // Required parameters:
    sessionId: 'unique order identifier from your application',
    amount: 125,
    description: 'transaction description',
    email: 'buyer email address',
    urlReturn: 'url to return to after transaction',

    // Optional parameters:
    urlStatus: 'url to which the transaction status webhook will be sent',

    // client: 'Mateusz Nastalski',
    // currency: \Przelewy24\Enums\Currency::EUR,
    // language: Language::ENGLISH,
    // ...
);
```

Note that `amount` is passed as an integer, so if the actual amount is `1.25 PLN` you will need to pass `125` as value.

For the complete list of available parameters check the signature of [TransactionRequests::register()](src/Api/Requests/TransactionRequests.php#L22).

#### Return the transaction's token:

```php
$transaction->token();
```

#### Return the URL to the payment gateway:

```php
$transaction->gatewayUrl();
```

### Listening for transaction status webhook

To parse the webhook's payload, pass the whole request's POST data as an array to `handleWebhook()`:

```php
// $requestData = $request->request->all();
// $requestData = $request->post();
// $requestData = json_decode(file_get_contents('php://input'), true);

$webhook = $przelewy24->handleWebhook($requestData);
```

`handleWebhook()` returns `TransactionStatusNotification::class`, which has a bunch of useful methods you can use to check the transaction's data, as well as verify the webhook's signature:

```php
$webhook->amount();
$webhook->currency();
$webhook->orderId();
...
$webhook->isSignValid(...);
```

If you would like to make sure the incoming request's IP address belongs to Przelewy24 then a list of valid IPs is available in the `\Przelewy24\Constants\IpAddresses::V4` constant. A helper method that accepts a string with an IP address and returns a boolean is also available: `\Przelewy24\Constants\IpAddresses::isValid($ip)`.

### Verifying a transaction

```php
$przelewy24->transactions()->verify(
    sessionId: 'unique order identifier from your application',
    orderId: $webhook->orderId(),
    amount: 125,
);
```

Similarly to registering a transaction, the `amount` is passed as an integer.

### Error handling

Should Przelewy24's API return an erroneous response, an `ApiResponseException::class` (which extends `Przelewy24Exception::class`) will be thrown. You can therefore use a `try/catch` block to handle any errors:

```php
use Przelewy24\Exceptions\Przelewy24Exception;

try {
    $przelewy24->transactions()->verify([
        // ...
    ]);
} catch (Przelewy24Exception $e) {
    // Handle the error...
}
```
