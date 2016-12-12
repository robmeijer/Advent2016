<?php

namespace Tests\Advent2016\Day12;

use Advent2016\Day12\Checker;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class CheckerTest extends \PHPUnit_Framework_TestCase
{
    public function testItCanImportInstructions()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $checker = new Checker($filesystem);
        $checker->import('test1.txt');
        $expected = ['cpy 41 a', 'inc a', 'inc a', 'dec a', 'jnz a 2', 'dec a'];
        $this->assertEquals($expected, $checker->input());
    }

    public function testItCanProcessInstructions()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $checker = new Checker($filesystem);
        $checker->import('test1.txt');
        $checker->processInstructions();
        $this->assertEquals(42, $checker->registers('a'));
    }
}
