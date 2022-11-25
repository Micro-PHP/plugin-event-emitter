<?php

namespace Micro\Plugin\EventEmitter\Business\Provider;

use Micro\Component\DependencyInjection\Autowire\AutowireHelperFactoryInterface;
use Micro\Component\DependencyInjection\Autowire\AutowireHelperInterface;
use Micro\Component\EventEmitter\EventListenerInterface;
use Micro\Component\EventEmitter\ListenerProviderInterface;
use Micro\Plugin\EventEmitter\Business\Locator\EventListenerClassLocatorFactoryInterface;

class ProviderFactory implements ProviderFactoryInterface
{
    /**
     * @param AutowireHelperInterface $autowireHelper
     * @param EventListenerClassLocatorFactoryInterface $eventListenerClassLocatorFactory
     */
    public function __construct(
        private readonly AutowireHelperInterface $autowireHelper,
        private readonly EventListenerClassLocatorFactoryInterface $eventListenerClassLocatorFactory
    )
    {
    }

    /**
     *{@inheritDoc}
     */
    public function create(): ListenerProviderInterface
    {
        $listeners = $this->eventListenerClassLocatorFactory
            ->create()
            ->lookupListenerClasses();

        return $this->createProvider($listeners);
    }

    /**
     * @param iterable<class-string<EventListenerInterface>> $listeners
     *
     * @return ListenerProviderInterface
     */
    protected function createProvider(iterable $listeners): ListenerProviderInterface
    {
        return new ApplicationListenerProvider(
            $this->autowireHelper,
            $listeners
        );
    }
}