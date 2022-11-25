<?php

namespace Micro\Plugin\EventEmitter;

use Micro\Component\DependencyInjection\Autowire\AutowireHelperFactory;
use Micro\Component\DependencyInjection\Autowire\AutowireHelperFactoryInterface;
use Micro\Component\DependencyInjection\Autowire\AutowireHelperInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Component\EventEmitter\EventEmitterFactoryInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Plugin\EventEmitter\Business\Facade\EventsFacade;
use Micro\Plugin\EventEmitter\Business\Factory\EventEmitterFactory;
use Micro\Plugin\EventEmitter\Business\Locator\EventListenerClassLocatorFactory;
use Micro\Plugin\EventEmitter\Business\Locator\EventListenerClassLocatorFactoryInterface;
use Micro\Plugin\EventEmitter\Business\Provider\ProviderFactory;
use Micro\Plugin\EventEmitter\Business\Provider\ProviderFactoryInterface;
use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;

class EventEmitterPlugin implements DependencyProviderInterface
{
    /**
     * @var LocatorFacadeInterface
     */
    private readonly LocatorFacadeInterface $locatorFacade;

    /**
     * @var AutowireHelperInterface $autowireHelper
     */
    private readonly AutowireHelperInterface $autowireHelper;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(EventsFacadeInterface::class, function (
            AutowireHelperInterface $autowireHelper,
            LocatorFacadeInterface $locatorFacade,
        ) {
            $this->locatorFacade = $locatorFacade;
            $this->autowireHelper = $autowireHelper;

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
        return new EventEmitterFactory(
            $this->createProviderFactory()
        );
    }

    /**
     * @return ProviderFactoryInterface
     */
    protected function createProviderFactory(): ProviderFactoryInterface
    {
        return new ProviderFactory(
            $this->autowireHelper,
            $this->createEventListenerClassLocatorFactory(),
        );
    }

    /**
     * @return EventListenerClassLocatorFactoryInterface
     */
    protected function createEventListenerClassLocatorFactory(): EventListenerClassLocatorFactoryInterface
    {
        return new EventListenerClassLocatorFactory(
            $this->locatorFacade
        );
    }
}
