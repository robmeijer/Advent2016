<?php

namespace Tests\Advent2016\Day5;

use Advent2016\Day5\Door;

class DoorTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanGeneratePassword()
    {
        $door = new Door();
        $door->generatePassword('abc');
        $this->assertEquals('18f47a30', $door->getPassword());
    }

    public function testItCanGeneratePasswordWithPositions()
    {
        $door = new Door();
        $door->generatePassword('abc', true);
        $this->assertEquals('05ace8e3', $door->getPassword());
    }
}
