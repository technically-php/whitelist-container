<?php

declare(strict_types=1);

namespace Technically\WhitelistContainer;

use Psr\Container\ContainerInterface;
use Technically\WhitelistContainer\Exception;

final class WhitelistContainer implements ContainerInterface
{
    private ContainerInterface $container;

    /** @var string[] */
    private array $whitelistedEntries;

    private string $containerName;

    /**
     * @param string[] $whitelistedEntries
     */
    public function __construct(
        ContainerInterface $container,
        array $whitelistedEntries,
        string $containerName = 'whitelist'
    ) {
        $this->container = $container;
        $this->whitelistedEntries = $whitelistedEntries;
        $this->containerName = $containerName;
    }

    final public function get(string $id)
    {
        if (! $this->has($id)) {
            throw new Exception\ServiceNotFound($id . ' not found in "' . $this->containerName . '" container');
        }

        return $this->container->get($id);
    }

    final public function has(string $id): bool
    {
        return in_array($id, $this->whitelistedEntries, true)
            && $this->container->has($id);
    }
}
