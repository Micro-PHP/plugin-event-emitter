<?php

namespace Micro\Plugin\EventEmitter\Business\Factory;

use Micro\Component\EventEmitter\EventEmitterInterface;
use Micro\Component\EventEmitter\EventEmitterFactory as BaseEventEmitterFactory;
use Micro\Plugin\EventEmitter\Business\Provider\ProviderFactoryInterface;

class EventEmitterFactory extends BaseEventEmitterFactory
{
    /**
     * @param ProviderFactoryInterface $providerFactoryInterface
     */
    public function __construct(
        private readonly ProviderFactoryInterface $providerFactoryInterface
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): EventEmitterInterface
    {
        $emitter = parent::create();

        $emitter->addListenerProvider(
            $this->providerFactoryInterface->create()
        );

        return $emitter;
    }
}