<?php

namespace Micro\Plugin\EventEmitter\Business\Locator;

use Micro\Component\EventEmitter\EventListenerInterface;

interface EventListenerClassLocatorInterface
{
    /**
     * @return iterable<class-string<EventListenerInterface>>
     */
    public function lookupListenerClasses(): iterable;
}