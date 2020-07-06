# Przelewy24 PHP library

PHP wrapper for [www.przelewy24.pl](https://www.przelewy24.pl/).

## Usage

### Creating an instance

```php
use Przelewy24\Przelewy24;

$przelewy24 = new Przelewy24([
    'merchant_id' => '12345',
    'crc' => 'aef0...',
    'mode' => 'sandbox', // live for production
]);
```

### Creating a transaction

```php
$transaction = $przelewy24->transaction([
    'session_id' => 'unique order identifier from your application',
    'url_return' => 'url to return to post transaction',
    'url_status' => 'url to which the transaction status webhook will be sent',
    'amount' => 'transaction amount as an integer (1.25 PLN = 125)',
    'description' => 'transaction description',
    'email' => 'buyer email address',
]);
```

Retrieve the transaction's token:

```php
$transaction->token();
```

Retrieve the redirect URL to the payment gateway:

```php
$transaction->redirectUrl();
```

### Listening for transaction status webhook

```php
$webhook = $przelewy24->handleWebhook();
```

### Verifying a transaction

```php
$przelewy24->verify([
    'session_id' => 'unique order identifier from your application',
    'order_id' => $webhook->orderId(),   // przelewy24 order id
    'amount' => 'transaction amount as an integer (1.25 PLN = 125)',
]);
```
