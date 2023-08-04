<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\EventEmitter\Business\Locator;

use Micro\Component\EventEmitter\EventListenerInterface;
use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;

class EventListenerClassLocator implements EventListenerClassLocatorInterface
{
    public function __construct(
        private readonly LocatorFacadeInterface $locatorFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function lookupListenerClasses(): iterable
    {
        $classes = [];
        foreach ($this->locatorFacade->lookup(EventListenerInterface::class) as $listenerClass) {
            $classes[] = $listenerClass;
        }

        return $classes;
    }
}
