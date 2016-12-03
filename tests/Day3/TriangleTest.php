<?php

namespace Tests\Advent2016\Day3;

use Advent2016\Day3\Triangle;

class TriangleTest extends \PHPUnit_Framework_TestCase
{

    public function testCanValidateTriangles()
    {
        $triangle = new Triangle();

        $triangle->validate('5 10 25');
        $this->assertEquals(0, $triangle->getValid());
        $triangle->validate('3 4 5');
        $this->assertEquals(1, $triangle->getValid());
        $triangle->validate('5 10 12');
        $this->assertEquals(2, $triangle->getValid());
        $triangle->validate('213 20 1212');
        $this->assertEquals(2, $triangle->getValid());
        $triangle->validate('4 5 6 7 8 9');
        $this->assertEquals(4, $triangle->getValid());
        $triangle->validate('1 12 123 12 23 34 4 5 6');
        $this->assertEquals(6, $triangle->getValid());
    }

    public function testCanValidateTrianglesVertically()
    {
        $triangle = new Triangle();

        $triangle->validate('1 12 123 12 23 34 4 5 6');
        $triangle->validate('1 12 4 12 23 5 123 34 6', 'vertical');
        $this->assertEquals(4, $triangle->getValid());
    }
}
