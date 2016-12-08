<?php

namespace Tests\Advent2016\Day8;

use Advent2016\Day8\Keypad;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class KeypadTest extends \PHPUnit_Framework_TestCase
{
    public function testItCanFollowSimpleInstructions()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $keypad = new Keypad($filesystem, 7, 3);
        $keypad->import('test1.txt');
        $keypad->followInstructions();
        $this->assertEquals([0,1,0,0,1,0,1], $keypad->getRow(0));
        $this->assertEquals([1,0,1,0,0,0,0], $keypad->getRow(1));
        $this->assertEquals([0,1,0,0,0,0,0], $keypad->getRow(2));
        $this->assertEquals(6, $keypad->countPixels());
    }

    public function testItCanFollowComplicatedInstructions()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $keypad = new Keypad($filesystem, 7, 6);
        $keypad->import('test2.txt');
        $keypad->followInstructions();
        $this->assertEquals([1,0,0,0,0,0,0], $keypad->getRow(0));
        $this->assertEquals([0,1,0,0,0,0,0], $keypad->getRow(1));
        $this->assertEquals([0,0,1,0,0,0,0], $keypad->getRow(2));
        $this->assertEquals([0,0,0,1,0,0,0], $keypad->getRow(3));
        $this->assertEquals([0,0,0,0,0,0,0], $keypad->getRow(4));
        $this->assertEquals([0,0,0,0,0,0,0], $keypad->getRow(5));
        $this->assertEquals(4, $keypad->countPixels());
    }

    public function testItCanFollowLiveInstructions()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $keypad = new Keypad($filesystem);
        $keypad->import('test3.txt');
        $keypad->followInstructions();
        $this->assertEquals(28, $keypad->countPixels());
    }
}
