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

namespace FlameCore\EventObserver\Provider;

use FlameCore\EventObserver\Responder\ResponderInterface;

/**
 * The Provider class
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
class Provider implements ProviderInterface
{
    /**
     * The registered responders
     *
     * @var array
     */
    protected $responders = array();

    /**
     * Checks if a responder is assigned to the given type.
     *
     * @param string $type The type of responder
     * @return bool
     * @throws \InvalidArgumentException if the responder type is invalid.
     */
    public function hasResponder($type)
    {
        if (!is_string($type) || empty($type)) {
            throw new \InvalidArgumentException('The responder type is invalid');
        }

        return isset($this->responders[$type]);
    }

    /**
     * Gets the responder of the given type.
     *
     * @param string $type The type of responder
     * @return \FlameCore\EventObserver\Responder\ResponderInterface
     * @throws \InvalidArgumentException if the responder type is invalid.
     */
    public function getResponder($type)
    {
        if (!is_string($type) || empty($type)) {
            throw new \InvalidArgumentException('The responder type is invalid');
        }

        return $this->responders[$type] ?: null;
    }

    /**
     * Assigns the responder to the given type.
     *
     * @param string $type The type of responder
     * @param \FlameCore\EventObserver\Responder\ResponderInterface $responder The responder to assign
     * @throws \InvalidArgumentException if the responder type is invalid.
     */
    public function setResponder($type, ResponderInterface $responder)
    {
        if (!is_string($type) || empty($type)) {
            throw new \InvalidArgumentException('The responder type is invalid');
        }

        $this->responders[$type] = $responder;
    }
}
