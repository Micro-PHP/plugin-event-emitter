<?php

namespace Micro\Plugin\EventEmitter\Business\Facade;

use Micro\Component\EventEmitter\EventEmitterFactoryInterface;
use Micro\Component\EventEmitter\EventEmitterInterface;
use Micro\Component\EventEmitter\EventInterface;
use Micro\Component\EventEmitter\ListenerProviderInterface;
use Micro\Plugin\EventEmitter\EventsFacadeInterface;

class EventsFacade implements EventsFacadeInterface
{
    /**
     * @var EventEmitterInterface
     */
    private readonly EventEmitterInterface $eventEmitter;

    /**
     * @param EventEmitterFactoryInterface $eventEmitterFactory
     */
    public function __construct(
        private readonly EventEmitterFactoryInterface $eventEmitterFactory
    )
    {
        $this->eventEmitter = $this->eventEmitterFactory->create();
    }

    /**
     * {@inheritDoc}
     */
    public function addProvider(ListenerProviderInterface $listenerProvider): void
    {
        $this->eventEmitter->addListenerProvider($listenerProvider);
    }

    /**
     * {@inheritDoc}
     */
    public function emit(EventInterface $event): void
    {
        $this->eventEmitter->emit($event);
    }

    /**
     * @TODO: Provide events to Global
     *
     * {@inheritDoc}
     */
    public function createEventEmitter(bool $provideEventsToGlobal = false): EventEmitterInterface
    {
        return $this->eventEmitterFactory->create();
    }
}
