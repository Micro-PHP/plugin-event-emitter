<?php

namespace Micro\Plugin\EventEmitter\Business\Locator;

use Micro\Component\EventEmitter\EventListenerInterface;
use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;

class EventListenerClassLocator implements EventListenerClassLocatorInterface
{
    /**
     * @param LocatorFacadeInterface $locatorFacade
     */
    public function __construct(
        private readonly LocatorFacadeInterface $locatorFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookupListenerClasses(): iterable
    {
        $listenerClassCollection = [];

        foreach ($this->locatorFacade->lookup(EventListenerInterface::class) as $listenerClass) {
            $listenerClassCollection[] = $listenerClass;
        }

        return $listenerClassCollection;
    }
}