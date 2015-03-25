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

namespace FlameCore\EventObserver\Tests;

use FlameCore\EventObserver\Observer;
use FlameCore\EventObserver\Responder\Responder;

/**
 * Test class for EventObserver
 */
class EventObserverTest extends \PHPUnit_Framework_TestCase
{
    public function testWithCallable()
    {
        $testinfo = array();

        $observer = new Observer();
        $observer->addResponder('action', function ($event, array $data) use (&$testinfo) {
            $testinfo['event'] = $event;
            $testinfo['data'] = $data;
        });

        $this->doTestEvent($observer, $testinfo);
        $this->doTestEventWithData($observer, $testinfo);
    }

    public function testWithResponderClass()
    {
        $testinfo = array();

        $responder = new Responder();
        $responder->setListener('action.event', function (array $data, $event) use (&$testinfo) {
            $testinfo['event'] = $event;
            $testinfo['data'] = $data;
        });

        $observer = new Observer();
        $observer->addResponder('action', $responder);

        $this->doTestEvent($observer, $testinfo);
        $this->doTestEventWithData($observer, $testinfo);
    }

    private function doTestEvent(Observer $observer, array &$testinfo)
    {
        $observer->notify('action.event');

        $this->assertArrayHasKey('event', $testinfo);
        $this->assertEquals('action.event', $testinfo['event']);
    }

    private function doTestEventWithData(Observer $observer, array &$testinfo)
    {
        $observer->notify('action.event', ['foo' => 'bar']);

        $this->assertArrayHasKey('data', $testinfo);
        $this->assertArrayHasKey('foo', $testinfo['data']);
        $this->assertEquals('bar', $testinfo['data']['foo']);
    }
}
