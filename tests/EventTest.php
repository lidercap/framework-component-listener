<?php

namespace Lidercap\Tests\Component\Listener;

use Lidercap\Component\Listener\Event;
use Lidercap\Component\Listener\Event\Triggers;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testStrictModeTrue()
    {
        Event::strictMode(true);

        $triggers = Triggers::getInstance();
        $property = new \ReflectionProperty($triggers, 'strict');
        $property->setAccessible(true);

        $value = $property->getValue($triggers);
        $this->assertTrue($value);
    }

    public function testStrictModeFalse()
    {
        Event::strictMode(false);

        $triggers = Triggers::getInstance();
        $property = new \ReflectionProperty($triggers, 'strict');
        $property->setAccessible(true);

        $value = $property->getValue($triggers);
        $this->assertFalse($value);
    }

    public function testBind()
    {
        $number = rand(1000, 2000);
        $event  = 'event-' . rand(1, 100);

        Event::bind($event, function () use ($number) {
            return $number;
        });

        $triggers = Triggers::getInstance();
        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);

        $events = $property->getValue($triggers);
        $this->assertArrayHasKey($event, $events);
        $this->assertEquals($number, $events[$event][0]());
    }

    public function testTriggerSuccess()
    {
        $code = rand(1, 100);
        $list = [
            'event.name' => [
                0 => function ($expected) use ($code) {
                    $this->assertEquals($expected[0], $code);
                }
            ]
        ];

        $triggers = Triggers::getInstance();

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, $list);

        Event::trigger('event.name', [$code]);
    }
}
