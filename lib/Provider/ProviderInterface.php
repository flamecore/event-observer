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

namespace FlameCore\EventObserver\Provider;

use FlameCore\EventObserver\Responder\ResponderInterface;

/**
 * The Provider interface
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
interface ProviderInterface
{
    /**
     * Checks if a responder is assigned to the given type.
     *
     * @param string $type The type of responder
     * @return bool
     * @throws \InvalidArgumentException if the responder type is invalid.
     */
    public function hasResponder($type);

    /**
     * Gets the responder of the given type.
     *
     * @param string $type The type of responder
     * @return \FlameCore\EventObserver\Responder\ResponderInterface
     * @throws \InvalidArgumentException if the responder type is invalid.
     */
    public function getResponder($type);

    /**
     * Assigns the responder to the given type.
     *
     * @param string $type The type of responder
     * @param \FlameCore\EventObserver\Responder\ResponderInterface $responder The responder to assign
     * @throws \InvalidArgumentException if the responder type is invalid.
     */
    public function setResponder($type, ResponderInterface $responder);
}
