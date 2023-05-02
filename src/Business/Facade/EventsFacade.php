<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\EventEmitter\Business\Facade;

use Micro\Component\EventEmitter\EventEmitterFactoryInterface;
use Micro\Component\EventEmitter\EventInterface;
use Micro\Plugin\EventEmitter\EventsFacadeInterface;

class EventsFacade implements EventsFacadeInterface
{
    public function __construct(
        private readonly EventEmitterFactoryInterface $eventEmitterFactory
    ) {
    }

    public function emit(EventInterface $event): void
    {
        $this->eventEmitterFactory->create()->emit($event);
    }
}
