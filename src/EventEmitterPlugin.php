<?php

namespace Micro\Plugin\EventEmitter;

use Micro\Component\DependencyInjection\Container;
use Micro\Component\EventEmitter\EventEmitterFactory;
use Micro\Component\EventEmitter\EventEmitterFactoryInterface;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\EventEmitter\Business\Facade\EventsFacade;

class EventEmitterPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(EventsFacadeInterface::class, function (Container $container) {
            return $this->createFacade();
        });
    }

    /**
     * @return EventsFacadeInterface
     */
    protected function createFacade(): EventsFacadeInterface
    {
        return new EventsFacade($this->createEventEmitterFactory());
    }

    /**
     * @return EventEmitterFactoryInterface
     */
    protected function createEventEmitterFactory(): EventEmitterFactoryInterface
    {
        return new EventEmitterFactory();
    }
}
