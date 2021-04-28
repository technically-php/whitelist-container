<?php

declare(strict_types=1);

namespace Technically\WhitelistContainer;

use Psr\Container\NotFoundExceptionInterface;

/** @internal */
final class NotFoundException extends \RuntimeException implements NotFoundExceptionInterface
{
}
