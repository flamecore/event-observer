<?php
/**
 * FlameCore EventObserver
 * Copyright (C) 2015 IceFlame.net
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 *
 * @package  FlameCore\EventObserver
 * @version  1.1-dev
 * @link     http://www.flamecore.org
 * @license  http://opensource.org/licenses/ISC ISC License
 */

namespace FlameCore\EventObserver;

/**
 * Interface ObserverAwareInterface
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
interface ObserverAwareInterface
{
    /**
     * @param \FlameCore\EventObserver\ObserverInterface $observer
     */
    public function observe(ObserverInterface $observer);

    /**
     * @return \FlameCore\EventObserver\ObserverInterface
     */
    public function getObserver();
}
