<?php

declare(strict_types=1);

namespace Someniatko\WhitelistContainer;

use Psr\Container\ContainerInterface;

abstract class WhitelistContainer implements ContainerInterface
{
    private ContainerInterface $container;

    final public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    final public function get(string $id)
    {
        if (! $this->has($id)) {
            throw new NotFoundException($id . ' not found in "' . $this->getContainerName() . '" container');
        }

        return $this->container->get($id);
    }

    final public function has(string $id): bool
    {
        return in_array($id, static::getWhitelistedContainerEntries())
            && $this->container->has($id);
    }

    /** @return string[] */
    abstract protected function getWhitelistedContainerEntries(): array;

    /** Override this function in order to get more precise exception message when resolving unwhitelisted entry */
    protected function getContainerName(): string
    {
        return 'whitelist';
    }
}
