<?php

namespace Micro\Plugin\EventEmitter\Business\Provider;

use Micro\Component\EventEmitter\ListenerProviderInterface;

interface ProviderFactoryInterface
{
    /**
     * @return ListenerProviderInterface
     */
    public function create(): ListenerProviderInterface;
}