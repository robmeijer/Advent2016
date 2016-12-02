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

    /**
     * It can detect multiple visits to the same location
     *
     * @test
     */
    public function it_can_detect_a_second_visit_to_the_same_location()
    {
        $guide = new Guide();

        $guide->navigate('R8, R4, R4, R8');
        $this->assertEquals(4, $guide->fewestSteps($guide->visitedTwice()));

        $guide->navigate('R1, L1, L8, L1, L3, L8', true);
        $this->assertEquals(5, $guide->fewestSteps($guide->visitedTwice()));
    }
}
