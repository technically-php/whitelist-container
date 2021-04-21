<?php

declare(strict_types=1);

namespace Someniatko\WhitelistContainer;

use Psr\Container\NotFoundExceptionInterface;

/** @internal */
final class NotFoundException extends \RuntimeException implements NotFoundExceptionInterface
{
}
