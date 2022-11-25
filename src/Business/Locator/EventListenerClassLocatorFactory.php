<?php

namespace Micro\Plugin\EventEmitter\Business\Locator;

use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;

class EventListenerClassLocatorFactory implements EventListenerClassLocatorFactoryInterface
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
    public function create(): EventListenerClassLocatorInterface
    {
        return new EventListenerClassLocator(
            $this->locatorFacade,
        );
    }
}