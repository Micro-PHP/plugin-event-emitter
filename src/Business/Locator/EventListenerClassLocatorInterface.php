<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\EventEmitter\Business\Locator;

use Micro\Component\EventEmitter\EventListenerInterface;

interface EventListenerClassLocatorInterface
{
    /**
     * @return iterable<class-string<EventListenerInterface>>
     */
    public function lookupListenerClasses(): iterable;
}
