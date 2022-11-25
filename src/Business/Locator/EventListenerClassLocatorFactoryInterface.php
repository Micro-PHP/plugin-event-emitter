<?php

namespace Micro\Plugin\EventEmitter\Business\Locator;

interface EventListenerClassLocatorFactoryInterface
{
    /**
     * @return EventListenerClassLocatorInterface
     */
    public function create(): EventListenerClassLocatorInterface;
}