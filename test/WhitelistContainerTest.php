<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use PHPWatch\SimpleContainer\Container;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Someniatko\WhitelistContainer\WhitelistContainer;

final class WhitelistContainerTest extends TestCase
{
    private ContainerInterface $whitelistA;
    private ContainerInterface $whitelistNonexistent;

    public function setUp(): void
    {
        $inner = new Container([
            'a' => 1,
            'b' => 2
        ]);

        $this->whitelistA = new class($inner) extends WhitelistContainer {
            protected function getWhitelistedContainerEntries(): array
            {
                return [ 'a' ];
            }
        };

        $this->whitelistNonexistent = new class($inner) extends WhitelistContainer {
            protected function getWhitelistedContainerEntries(): array
            {
                return [ 'nonexistent' ];
            }
        };
    }

    public function testInnerHasWhitelisted(): void
    {
        self::assertTrue($this->whitelistA->has('a'));
        self::assertSame(1, $this->whitelistA->get('a'));
    }

    public function testInnerHasNotWhitelisted(): void
    {
        self::assertFalse($this->whitelistA->has('b'));

        $this->expectException(NotFoundExceptionInterface::class);
        $this->whitelistA->get('b');
    }

    public function testInnerDoesNotHaveButItIsWhitelisted(): void
    {
        self::assertFalse($this->whitelistNonexistent->has('nonexistent'));

        $this->expectException(NotFoundExceptionInterface::class);
        $this->whitelistNonexistent->get('nonexistent');
    }
}
