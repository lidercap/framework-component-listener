<?php

namespace Lidercap\Tests\Component\Listener;

use Lidercap\Component\Listener\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testBindSuccess()
    {
        $event = Event::getInstance();
        $event->bind('event.name', function() {
            var_dump('TESTE 1');
        });

        // $property = new \ReflectionProperty($event, 'events');
        // $property->setAccessible(true);

        // $function = $event::fetch('event.name');
        $function = $event::trigger('event.name');

        // print_r(call_user_func($function));
        // print_r(array_keys($event::fetchAll()));
    }
}
