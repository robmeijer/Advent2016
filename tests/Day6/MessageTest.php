<?php

namespace Tests\Advent2016\Day6;

use Advent2016\Day6\Message;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testItCanDecodeAMessage()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $message = new Message($filesystem);
        self::assertEquals('easter', $message->decode('test.txt'));
    }

    public function testItCanDecodeAnAlternateMessage()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $message = new Message($filesystem);
        self::assertEquals('advent', $message->decode('test.txt', 'ASC'));
    }
}
