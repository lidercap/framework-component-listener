<?php

namespace Lidercap\Tests\Component\Listener;

use Lidercap\Component\Listener\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testBindSuccess()
    {
        $event = Event::getInstance();

        $callback = function() {};

        var_dump(get_class($callback));
        var_dump(is_object($callback));

        $this->assertInstanceOf(\Closure::class, $callback);

        // $event->bind('event.name', $callback);

        // print_r($event);
    }
}
