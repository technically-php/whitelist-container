# Technically Whitelist Container

`Technically\WhitelistContainer` is a small PSR-11 container utility, 
that wraps any PSR-11 container instance, but provides access only to selected list of entries.

Any other entries that are not explicitly whitelisted will be reported as not found.

![Tests](https://github.com/technically-php/whitelist-container/actions/workflows/test.yml/badge.svg)


## Installation

This library requires PHP 7.4 or 8.0.
You can install it via Composer:

```shell
composer require technically/whitelist-container
```


## Usage

```php
<?php

class Allowed {}
class Prohibited {}

use Technically\WhitelistContainer\WhitelistContainer;

/** @var \Psr\Container\ContainerInterface $innerContainer */
$whitelistContainer = new WhitelistContainer(
    $innerContainer,
    [ Allowed::class ],
    'my-container-name', // optional, used only for exception message
);

$whitelistContainer->has(Allowed::class); // true
$whitelistContainer->has(Prohibited::class); // false
$whitelistContainer->get(Allowed::class); // Allowed instance
$whitelistContainer->get(Prohibited::class); // @throws NotFoundExceptionInterface
```


## Credits

Implemented by [someniatko](https://github.com/someniatko).
