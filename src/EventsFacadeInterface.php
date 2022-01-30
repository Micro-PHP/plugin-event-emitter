<?php

namespace Micro\Plugin\EventEmitter;

use Micro\Component\EventEmitter\EventInterface;
use Micro\Component\EventEmitter\ListenerProviderInterface;

interface EventsFacadeInterface
{
    /**
     * @param ListenerProviderInterface $listenerProvider
     *
     * @return void
     */
    public function addProvider(ListenerProviderInterface $listenerProvider): void;

    /**
     * @param EventInterface $event
     * @return void
     */
    public function emit(EventInterface $event): void;
}
