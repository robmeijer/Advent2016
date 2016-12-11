<?php

namespace Tests\Advent2016\Day10;

use Advent2016\Day10\BotCollection;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class BotCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanReadInstructions()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $bots = new BotCollection($filesystem);
        $bots->import('test1.txt');
        $expected = [
            'value 5 goes to bot 2',
            'bot 2 gives low to bot 1 and high to bot 0',
            'value 3 goes to bot 1',
            'bot 1 gives low to output 1 and high to bot 0',
            'bot 0 gives low to output 2 and high to output 0',
            'value 2 goes to bot 2',
        ];
        $this->assertEquals($expected, $bots->instructions());
    }

    public function testItCanReadAnInstruction()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $bots = new BotCollection($filesystem);
        $bots->import('test1.txt');

        $bots->processInstructions();
        self::assertEquals($bots->outputs(0)->value(), 5);
        self::assertEquals($bots->outputs(1)->value(), 2);
        self::assertEquals($bots->outputs(2)->value(), 3);
    }
}
