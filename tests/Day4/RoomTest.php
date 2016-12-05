<?php

namespace Tests\Advent2016\Day4;

use Advent2016\Day4\Room;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class RoomTest extends \PHPUnit_Framework_TestCase
{
    public function testItCanReadSeparateLines()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $room = new Room($filesystem);
        $room->process('test.txt');

        $this->assertEquals(1337, $room->getSum());
    }

    public function testItDecryptsTheRooms()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $room = new Room($filesystem);
        $room->process('test.txt');

        $this->assertEquals('991. northpole object storage', $room->getRoom());
    }
}
