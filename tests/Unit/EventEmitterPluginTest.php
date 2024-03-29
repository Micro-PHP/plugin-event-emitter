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

namespace Micro\Plugin\EventEmitter\Test\Unit;

use Micro\Component\EventEmitter\EventInterface;
use Micro\Kernel\App\AppKernel;
use Micro\Plugin\EventEmitter\EventsFacadeInterface;
use PHPUnit\Framework\TestCase;

class EventEmitterPluginTest extends TestCase
{
    public function testPlugin()
    {
        $kernel = new AppKernel(
            [],
            []
        );
        $kernel->run();

        /** @var EventsFacadeInterface $facade */
        $facade = $kernel->container()->get(EventsFacadeInterface::class);
        $this->assertInstanceOf(EventsFacadeInterface::class, $facade);
        $evt = $this->createMock(EventInterface::class);
        $facade->emit($evt);
    }
}
