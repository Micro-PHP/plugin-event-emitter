<?php

namespace Micro\Plugin\EventEmitter;

use Micro\Component\DependencyInjection\Container;
use Micro\Component\EventEmitter\EventEmitterBuilder;
use Micro\Component\EventEmitter\EventEmitterInterface;
use Micro\Component\EventEmitter\ListenerProviderFactory;
use Micro\Component\EventEmitter\ListenerProviderInterface;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Closure;

class EventEmitterPlugin extends AbstractPlugin
{
    /**
     * @var ListenerProviderInterface
     */
    private ?ListenerProviderInterface $listenerProvider = null;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(EventEmitterInterface::class, $this->createEventEmitterServiceCallback());
        $container->register(ListenerProviderInterface::class, $this->createEventListenerProviderServiceCallback());
    }

    /**
     * @return ListenerProviderInterface
     */
    private function createListenerProvider(): ListenerProviderInterface
    {
        if(!$this->listenerProvider) {
            $this->listenerProvider = (new ListenerProviderFactory())->create();
        }

        return $this->listenerProvider;
    }

    /**
     * @return EventEmitterBuilder
     */
    private function createEventEmitterBuilder(): EventEmitterBuilder
    {
        return new EventEmitterBuilder();
    }

    /**
     * @return Closure
     */
    private function createEventEmitterServiceCallback(): Closure
    {
        return function(Container $container)
        {
            return $this->createEventEmitterService();
        };
    }

    /**
     * @return Closure
     */
    private function createEventListenerProviderServiceCallback(): Closure
    {
        return function(Container $container)
        {
            return $this->createListenerProvider();
        };
    }

    /**
     * @return EventEmitterInterface
     */
    private function createEventEmitterService(): EventEmitterInterface
    {
        $listenerProvider = $this->createListenerProvider();
        $builder = $this->createEventEmitterBuilder();
        $builder->addProvider($listenerProvider);

        return $builder->build();
    }
}
