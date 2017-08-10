<?php

namespace Lidercap\Tests\Component\Listener;

use Lidercap\Component\Listener\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testBindSuccess()
    {
        $event = Event::getInstance();
        $event->bind('event.name', function() {});

        $property = new \ReflectionProperty($event, 'events');
        $property->setAccessible(true);

        print_r($event::$events['event.name']);
    }
}
