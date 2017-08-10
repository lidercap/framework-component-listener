<?php

namespace Lidercap\Tests\Component\Listener\Event;

use Lidercap\Component\Listener\Event\Triggers;

class TriggersTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $triggers = Triggers::getInstance();
        $triggers->setStrict(false);

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, []);
        $property->setAccessible(false);
    }

    public function testBind()
    {
        $number = rand(1000, 2000);
        $event  = 'event-' . rand(1, 100);

        $triggers = Triggers::getInstance();
        $object   = $triggers->bind($event, function() use ($number) {
            return $number;
        });

        $this->assertInstanceOf(Triggers::class, $object);

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);

        $events = $property->getValue($object);
        $this->assertArrayHasKey($event, $events);
        $this->assertEquals($number, $events[$event][0]());
    }

    public function testTriggerNotFount()
    {
        Triggers::getInstance()->trigger('not.found');
    }

    /**
     * @expectedException \Lidercap\Component\Listener\Exception\EventListenerException
     * @expectedExceptionMessage Evento não registrado: not.found
     * @expectedExceptionCode -1
     */
    public function testTriggerNotFountException()
    {
        $triggers = Triggers::getInstance();
        $triggers->setStrict(true);
        $triggers->trigger('not.found');
    }

    public function testTriggerSuccess()
    {
        $code = rand(1, 100);
        $list = [
            'event.name' => [
                0 => function($expected) use ($code) {
                    $this->assertEquals($expected[0], $code);
                }
            ]
        ];

        $triggers = Triggers::getInstance();

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, $list);

        $triggers->trigger('event.name', [$code]);
    }

    public function testFetchAllEmpty()
    {
        $triggers = Triggers::getInstance();
        $this->assertEquals([], $triggers->fetchAll());
    }

    public function testFetchAllSuccess()
    {
        $list     = ['this is my trigger list'];
        $triggers = Triggers::getInstance();

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, $list);

        $this->assertEquals($list, $triggers->fetchAll());
    }

    public function testFetchEmpty1()
    {
        $event   = 'event-' . rand(1, 100);
        $trigger = Triggers::getInstance()->fetch($event);
        $this->assertEquals([], $trigger);
    }

    public function testFetchEmpty2()
    {
        $event   = 'event-' . rand(1, 100);
        $trigger = Triggers::getInstance()->setStrict(false)->fetch($event);
        $this->assertEquals([], $trigger);
    }

    /**
     * @expectedException \Lidercap\Component\Listener\Exception\EventListenerException
     * @expectedExceptionMessage Evento não registrado: event.name
     * @expectedExceptionCode -1
     */
    public function testFetchEmptyStrictException1()
    {
        $event   = 'event.name';
        $trigger = Triggers::getInstance()->setStrict()->fetch($event);
        $this->assertEquals([], $trigger);
    }

    /**
     * @expectedException \Lidercap\Component\Listener\Exception\EventListenerException
     * @expectedExceptionMessage Evento não registrado: event.name
     * @expectedExceptionCode -1
     */
    public function testFetchEmptyStrictException2()
    {
        $event   = 'event.name';
        $trigger = Triggers::getInstance()->setStrict(true)->fetch($event);
        $this->assertEquals([], $trigger);
    }

    public function testFetchSuccess()
    {
        $name    = 'event.name.' . rand(1, 100);
        $trigger = ['this is my trigger list'];

        $list     = [$name => $trigger];
        $triggers = Triggers::getInstance();

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, $list);

        $this->assertEquals($trigger, $triggers->fetch($name));
    }

    public function testCleanSuccess()
    {
        $name1   = 'event.name.' . rand(1, 100);
        $name2   = 'event.name.' . rand(1, 100);
        $name3   = 'event.name.' . rand(1, 100);
        $trigger = ['this is my trigger list'];
        $list    = [
            $name1 => $trigger,
            $name2 => $trigger,
            $name3 => $trigger,
        ];

        $triggers = Triggers::getInstance();

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, $list);

        $object = $triggers->clean($name2);
        $this->assertInstanceOf(Triggers::class, $object);

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $cleaned  = $property->getValue($triggers);

        $this->assertArrayHasKey($name1, $cleaned);
        $this->assertArrayHasKey($name3, $cleaned);

        $this->assertArrayNotHasKey($name2, $cleaned);
    }

    public function testCleanFail()
    {
        $name1   = 'event.name.' . rand(1, 100);
        $name2   = 'event.name.' . rand(1, 100);
        $name3   = 'event.name.' . rand(1, 100);
        $trigger = ['this is my trigger list'];
        $list    = [
            $name1 => $trigger,
            $name2 => $trigger,
        ];

        $triggers = Triggers::getInstance();

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, $list);

        $object = $triggers->clean($name3);
        $this->assertInstanceOf(Triggers::class, $object);

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $cleaned  = $property->getValue($triggers);

        $this->assertArrayHasKey($name1, $cleaned);
        $this->assertArrayHasKey($name2, $cleaned);
    }

    public function testCleanAll()
    {
        $name1   = 'event.name.' . rand(1, 100);
        $name2   = 'event.name.' . rand(1, 100);
        $name3   = 'event.name.' . rand(1, 100);
        $trigger = ['this is my trigger list'];
        $list    = [
            $name1 => $trigger,
            $name2 => $trigger,
            $name3 => $trigger,
        ];

        $triggers = Triggers::getInstance();

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $property->setValue($triggers, $list);

        $object = $triggers->cleanAll();
        $this->assertInstanceOf(Triggers::class, $object);

        $property = new \ReflectionProperty($triggers, 'triggers');
        $property->setAccessible(true);
        $this->assertEquals([], $property->getValue($triggers));
    }
}
