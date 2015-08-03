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

namespace FlameCore\EventObserver\Tests;

use FlameCore\EventObserver\Provider\Provider;
use FlameCore\EventObserver\Responder\Responder;

/**
 * Test class for Provider
 */
class ProviderTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $responder = new Responder();

        $provider = new Provider();
        $provider->setResponder('foo', $responder);

        $this->assertTrue($provider->hasResponder('foo'));
        $this->assertEquals($responder, $provider->getResponder('foo'));
    }
}
