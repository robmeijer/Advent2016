<?php

namespace Tests\Advent2016\DayTwo;

use Advent2016\DayTwo\Keypad;

class KeypadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Find the code based on the given keypad and position
     *
     * @test
     */
    public function it_can_find_the_test_code()
    {
        $keypad = new Keypad([1, 1], [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ]);

        $this->assertEquals('1', $keypad->findNumber('ULL'));
        $this->assertEquals('9', $keypad->findNumber('RRDDD'));
        $this->assertEquals('8', $keypad->findNumber('LURDL'));
        $this->assertEquals('5', $keypad->findNumber('UUUUD'));
    }

    /**
     * Find the code based on the default keypad and position
     *
     * @test
     */
    public function it_can_find_the_actual_code()
    {
        $keypad = new Keypad();

        $this->assertEquals('5', $keypad->findNumber('ULL'));
        $this->assertEquals('D', $keypad->findNumber('RRDDD'));
        $this->assertEquals('B', $keypad->findNumber('LURDL'));
        $this->assertEquals('3', $keypad->findNumber('UUUUD'));
    }
}
