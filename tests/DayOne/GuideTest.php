<?php

namespace Tests\Advent2016\DayOne;

use Advent2016\DayOne\Guide;

class GuideTest extends \PHPUnit_Framework_TestCase
{
    /**
     * It can follow separate directions
     *
     * @test
     */
    public function it_can_follow_separate_directions()
    {
        $guide = new Guide();

        self::assertEquals(5, $guide->navigate('R2, L3', true));
        self::assertEquals(2, $guide->navigate('R2, R2, R2', true));
        self::assertEquals(12, $guide->navigate('R5, L5, R5, R3', true));
        self::assertEquals(10, $guide->navigate('R10', true));
    }

    /**
     * It can follow consecutive directions
     *
     * @test
     */
    public function it_can_follow_consecutive_directions()
    {
        $guide = new Guide();

        self::assertEquals(5, $guide->navigate('R2, L3'));
        self::assertEquals(3, $guide->navigate('R2, R2, R2'));
        self::assertEquals(11, $guide->navigate('R5, L5, R5, R3'));
        self::assertEquals(1, $guide->navigate('R10'));
    }
}
