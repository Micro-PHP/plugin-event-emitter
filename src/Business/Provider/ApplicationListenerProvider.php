<?php

namespace Micro\Plugin\EventEmitter\Business\Provider;

use Micro\Component\DependencyInjection\Autowire\AutowireHelperInterface;
use Micro\Component\EventEmitter\EventInterface;
use Micro\Component\EventEmitter\ListenerProviderInterface;

class ApplicationListenerProvider implements ListenerProviderInterface
{
    /**
     * @param AutowireHelperInterface $autowireHelper
     * @param iterable $eventListenersClasses
     */
    public function __construct(
        private readonly AutowireHelperInterface $autowireHelper,
        private readonly iterable $eventListenersClasses,
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getListenersForEvent(EventInterface $event): iterable
    {
        foreach ($this->getEventListeners() as $listenerClass) {
            if(!$listenerClass::supports($event)) {
                continue;
            }

            $callback = $this->autowireHelper->autowire($listenerClass);

            yield $callback();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->getName() ?? get_class($this);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'events.listener_provider.default';
    }

    /**
     * {@inheritDoc}
     */
    public function getEventListeners(): iterable
    {
        return $this->eventListenersClasses;
    }
}