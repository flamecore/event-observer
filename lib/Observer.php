<?php
/**
 * EventObserver Library
 * Copyright (C) 2014 IceFlame.net
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE
 * FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY
 * DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER
 * IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING
 * OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 * @package  FlameCore\EventObserver
 * @version  1.0
 * @link     http://www.flamecore.org
 * @license  ISC License <http://opensource.org/licenses/ISC>
 */

namespace FlameCore\EventObserver;

use FlameCore\EventObserver\Responder\ResponderInterface;

/**
 * The Observer class
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
class Observer implements ObserverInterface
{
    /**
     * The registered responders
     *
     * @var array
     */
    protected $responders = array();

    /**
     * Data to store for all events
     *
     * @var array
     */
    protected $data = array();

    /**
     * Notifies the observer of an event.
     *
     * @param string $event The name of the event ("action.event")
     * @param array $data Optional data to store for this event
     * @throws \InvalidArgumentException if the event name is invalid.
     */
    public function notify($event, array $data = [])
    {
        $event = (string) $event;

        if (($pos = strpos($event, '.')) == false) {
            throw new \InvalidArgumentException('The event name is invalid (expecting "action.event")');
        }

        $action = substr($event, 0, $pos);

        if (!isset($this->responders[$action])) {
            return;
        }

        if (isset($this->data[$action])) {
            $data = array_merge($this->data[$action], $data);
        }

        foreach ($this->responders[$action] as $responder) {
            if ($responder instanceof ResponderInterface) {
                $responder->respond($event, $data);
            } elseif (is_callable($responder)) {
                $responder($event, $data);
            }
        }
    }

    /**
     * Gets all registered responders assigned to the given event action.
     *
     * @param string $action The event action
     * @return array
     * @throws \InvalidArgumentException if the action name is invalid.
     */
    public function getResponders($action)
    {
        if (!is_string($action) || empty($action)) {
            throw new \InvalidArgumentException('The action name is invalid');
        }

        return $this->responders[$action];
    }

    /**
     * Assigns a responder to the given event action.
     *
     * @param string|array $actions The event action(s) to assign the responder to
     * @param \FlameCore\EventObserver\Responder\ResponderInterface|callable $responder The responder to add
     * @param array $data Optional data to store for all events of the given action(s)
     * @throws \InvalidArgumentException if the action name is invalid.
     */
    public function addResponder($actions, $responder, array $data = null)
    {
        if (!$responder instanceof ResponderInterface && !is_callable($responder)) {
            throw new \InvalidArgumentException('The $responder parameter must be either a ResponderInterface object or a callable');
        }

        $actions = (array) $actions;

        foreach ($actions as $action) {
            if (!is_string($action) || empty($action)) {
                throw new \InvalidArgumentException('The action name is invalid');
            }

            $this->responders[$action][] = $responder;

            if (isset($data)) {
                $this->data[$action] = $data;
            }
        }
    }

    /**
     * Gets the value of the given data key.
     *
     * @param string $action The event action
     * @param string $key The data key name
     * @return mixed
     * @throws \InvalidArgumentException if the action name or data key name is invalid.
     */
    public function getData($action, $key)
    {
        if (!is_string($action) || empty($action)) {
            throw new \InvalidArgumentException('The action name is invalid');
        }

        if (!is_string($key) || empty($key)) {
            throw new \InvalidArgumentException('The data key name is invalid');
        }

        return $this->data[$action][$key];
    }

    /**
     * Sets the given data key to the specified value.
     *
     * @param string|array $actions The event action(s) to set the data for
     * @param string $key The data key name
     * @param mixed $value The data value
     * @throws \InvalidArgumentException if the action name or data key name is invalid.
     */
    public function setData($actions, $key, $value)
    {
        if (!is_string($key) || empty($key)) {
            throw new \InvalidArgumentException('The data key name is invalid');
        }

        $actions = (array) $actions;

        foreach ($actions as $action) {
            if (!is_string($action) || empty($action)) {
                throw new \InvalidArgumentException('The action name is invalid');
            }

            $this->data[$action][$key] = $value;
        }
    }
}
