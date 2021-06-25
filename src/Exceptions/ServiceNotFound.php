<?php

declare(strict_types=1);

namespace Technically\WhitelistContainer\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

/**
 * @internal
 */
final class ServiceNotFound extends \RuntimeException implements NotFoundExceptionInterface
{
}
