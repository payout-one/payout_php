# Payout API Client PHP Library

The Payout PHP library for API client.

## Features

* Card payments
* Bank transfers
* Multi-language (english, slovak, czech)
* Multi-currency

## Requirements

* PHP 5.5 or later
* cUrl extension enabled
* Payout account

## Getting Started

### Installation

Download [the latest release](https://github.com/payout-one/payout_php/releases), unpack the ZIP file and upload
``Payout`` directory to your project library folder. Then include the `init.php` file.
 ```php
require_once('/path-to-your-system-library/Payout/init.php');
 ```

### Namespace

All the examples below assume the Bigcommerce\Api\Client class is imported into the scope with the following namespace
declaration:

```php
use Payout\Client;
```

### Configuration

Configure Payout API Client and initialize PHP object.

```php
$config = array(
        'client_id' => 'a3f30b76-5b01-4250-9718-96d933bf91c9',
        'client_secret' => '4e6fiCXTzuNwUhYjecEEOa94Ne3_zRItqUNqcJr1kMaWVsRuB7rs_nscT7HDN7be',
        'sandbox' => true
    );

$payout = new Client($config);
```

### Test installation

You can print library version to test the installation.

```php
echo $payout->getLibraryVersion();
```

### Create checkout 

Prepare array with checkout data and pass it to the `createCheckout()` method. Response from 
[API POST Create checkout](https://postman.payout.one/?version=latest#d5b91144-1e72-4c9b-bd10-22aa14aa526e) 
is returned as PHP object.

```php
$checkout_data = array(
        'amount' => '683.50',
        'currency' => 'EUR',
        'customer' => [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@payout.one'
        ],
        'external_id' => '20190001',
        'redirect_url' => 'https://payout.one/payment/redirect'
    );

$response = $payout->createCheckout($checkout_data);
var_dump($response);
```

## Basic example

Simple usage looks like:

```php
<?php
// Load Payout API Client PHP Library
require_once('system/library/Payout/init.php');

// Namespace
use Payout\Client;

try {
    // Config Payout API
    $config = array(
        'client_id' => 'a3f30b76-5b01-4250-9718-96d933bf91c9',
        'client_secret' => '4e6fiCXTzuNwUhYjecEEOa94Ne3_zRItqUNqcJr1kMaWVsRuB7rs_nscT7HDN7be',
        'sandbox' => true
    );

    // Initialize Payout
    $payout = new Client($config);

    // Test installation
    echo $payout->getLibraryVersion();

    // Create checkout
    $checkout_data = array(
        'amount' => '683.50',
        'currency' => 'EUR',
        'customer' => [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@payout.one'
        ],
        'external_id' => '20190001',
        'redirect_url' => 'https://payout.one/payment/redirect'
    );

    $response = $payout->createCheckout($checkout_data);
    print_r($response);

} catch (Exception $e) {
    echo $e->getMessage();
}
```

Output of example above looks like:

```text
1.0.0
stdClass Object
(
    [amount] => 68350
    [checkout_url] => https://sandbox.payout.one/checkouts/2rZz6v4Xjogmq3xMELLbR5dBnyxwkJaW
    [currency] => EUR
    [customer] => stdClass Object
        (
            [email] => john.doe@payout.one
            [first_name] => John
            [last_name] => Doe
        )

    [external_id] => 20190001
    [id] => 476661
    [idempotency_key] => 
    [metadata] => 
    [nonce] => dmc0OUljd08yUmhycldkUQ
    [object] => checkout
    [payment] => 
    [redirect_url] => https://payout.one/payment/redirect
    [signature] => 56e5469cb716c224c765359e1178667f8c652c76973aee61f03fa691cfe60484
    [status] => processing
)
```

## Version

Stable version: 1.0.0

See the [CHANGELOG.md](CHANGELOG.md) file for list off all changes.

## Compatibility

* Tested with PHP 5.5

## Documentation

The [Payout API](https://postman.payout.one/?version=latest) documentation.

## License

This open-source software is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

Copyright © 2019 [Payout, s.r.o.](https://payout.one/)