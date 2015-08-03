<?php
/**
 * EventObserver Library
 * Copyright (C) 2015 IceFlame.net
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 *
 * @package  FlameCore\EventObserver
 * @version  1.0
 * @link     http://www.flamecore.org
 * @license  http://opensource.org/licenses/ISC ISC License
 */

namespace FlameCore\EventObserver\Responder;

/**
 * The Responder interface
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
interface ResponderInterface
{
    /**
     * Responds to an event.
     *
     * @param string $event The name of the event ("action.event")
     * @param array $data The data for this event (optional)
     * @throws \InvalidArgumentException if the event name is invalid.
     */
    public function respond($event, array $data = []);

    /**
     * Gets the listener assigned to the given event.
     *
     * @param string $event The name of the event
     * @return callable
     * @throws \InvalidArgumentException if the event name is invalid.
     */
    public function getListener($event);

    /**
     * Assigns a listener to the given event.
     *
     * @param string $event The event to assign the listener to
     * @param callable $listener The listener to register
     * @throws \InvalidArgumentException if the event name is invalid.
     */
    public function setListener($event, callable $listener);
}
