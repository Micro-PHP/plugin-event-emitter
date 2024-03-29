<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\EventEmitter\Test\Unit\Business\Provider;

use Micro\Component\DependencyInjection\Autowire\AutowireHelperInterface;
use Micro\Component\EventEmitter\EventInterface;
use Micro\Component\EventEmitter\EventListenerInterface;
use Micro\Plugin\EventEmitter\Business\Provider\ApplicationListenerProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ApplicationListenerProviderTest extends TestCase
{
    private ApplicationListenerProvider $listener;

    protected function setUp(): void
    {
        $autowireHelper = $this->createMock(AutowireHelperInterface::class);
        $autowireHelper
            ->method('autowire')
            ->with(TestEventListener::class)
            ->willReturn(fn () => new TestEventListener());

        $listenersClasses = new \ArrayObject([
            TestEventListener::class,
        ]);

        $this->listener = new ApplicationListenerProvider(
            $autowireHelper,
            $listenersClasses,
        );
    }

    public function testGetName()
    {
        $this->assertIsString($this->listener->getName());
    }

    public function testGetListenersForEvent()
    {
        $evt = $this->createMock(EventInterface::class);

        foreach ($this->listener->getListenersForEvent($evt) as $listener) {
            $this->assertInstanceOf(TestEventListener::class, $listener);
        }
    }

    public function testGetListenersEmptyForEvent()
    {
        $evt = new class() implements EventInterface {};
        $empty = [];
        foreach ($this->listener->getListenersForEvent($evt) as $evt) {
            $empty[] = $evt;
        }

        $this->assertEmpty($empty);
    }

    public function testToString()
    {
        $name = $this->listener->getName();
        $this->assertEquals($name, (string) $this->listener);
    }

    public function testGetEventListeners()
    {
        $events = $this->listener->getEventListeners();
        foreach ($events as $class) {
            $this->assertEquals(TestEventListener::class, $class);
        }
    }
}

class TestEventListener implements EventListenerInterface
{
    public function on(EventInterface $event): void
    {
    }

    public static function supports(EventInterface $event): bool
    {
        return $event instanceof MockObject;
    }
}
