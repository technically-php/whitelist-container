# someniatko/whitelist-container

A PSR-11 container, wrapping existing container, but restricting access only to selected list of classes.


## Installation
This library requires PHP 7.4 or 8.0.
You can install it via Composer:

```shell
composer install someniatko/whitelist-container
```


## Usage

```php
<?php

class Allowed {}
class Prohibited {}

use Someniatko\WhitelistContainer\WhitelistContainer;

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
