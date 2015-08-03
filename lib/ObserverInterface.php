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

namespace FlameCore\EventObserver;

/**
 * The Observer interface
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
interface ObserverInterface
{
    /**
     * Notifies the observer of an event.
     *
     * @param string $event The name of the event ("action.event")
     * @param array $data Optional data to store for this event
     * @throws \InvalidArgumentException if the event name is invalid.
     */
    public function notify($event, array $data = []);

    /**
     * Gets all registered responders assigned to the given event action.
     *
     * @param string $action The event action
     * @return array
     * @throws \InvalidArgumentException if the action name is invalid.
     */
    public function getResponders($action);

    /**
     * Assigns a responder to the given event action.
     *
     * @param string|array $action The event action to assign the responder to
     * @param \FlameCore\EventObserver\Responder\ResponderInterface|callable $responder The responder to add
     * @param array $data Optional data to store for all events of the given action(s)
     * @throws \InvalidArgumentException if the action name is invalid.
     */
    public function addResponder($actions, $responder, array $data = null);

    /**
     * Gets the value of the given data key.
     *
     * @param string $action The event action
     * @param string $key The data key name
     * @return mixed
     * @throws \InvalidArgumentException if the action name or data key name is invalid.
     */
    public function getData($action, $key);

    /**
     * Sets the given data key to the specified value.
     *
     * @param string|array $actions The event action(s) to set the data for
     * @param string $key The data key name
     * @param mixed $value The data value
     * @throws \InvalidArgumentException if the action name or data key name is invalid.
     */
    public function setData($action, $key, $value);
}
