<?php

namespace Lidercap\Tests\Component\Listener;

use Lidercap\Component\Listener\Ola;

class OlaTest extends \PHPUnit_Framework_TestCase
{
    public function testMundo()
    {
        $ola = new Ola();
        $this->assertEquals('Olá mundo!', $ola->mundo());
    }
}
