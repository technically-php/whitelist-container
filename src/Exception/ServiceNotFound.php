<?php

declare(strict_types=1);

namespace Technically\WhitelistContainer\Exception;

use Psr\Container\NotFoundExceptionInterface;

/** @internal */
final class ServiceNotFound extends \RuntimeException implements NotFoundExceptionInterface
{
}
