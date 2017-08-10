<?php

namespace Lidercap\Tests\Component\Listener;

use Lidercap\Component\Listener\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testBindSuccess()
    {
        Event::bind('event.name', function() {
            var_dump('TESTE');
        });

        // Event::StrictMode(true);

        Event::trigger('event.name');
    }
}
