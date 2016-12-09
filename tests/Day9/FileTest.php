<?php

namespace Tests\Advent2016\Day9;

use Advent2016\Day9\File;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class FileTest extends \PHPUnit_Framework_TestCase
{
    public function testItCanImportFileContents()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $file = new File($filesystem);
        $file->import('test1.txt');
        $expected = 'ADVENTA(1x5)BC(3x3)XYZA(2x2)BCD(2x2)EFG(6x1)(1x3)AX(8x2)(3x3)ABCY';
        $this->assertEquals($expected, $file->getContents());
    }

    public function testItCanDecompressALine()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $file = new File($filesystem);
        $file->import('test1.txt');
        $file->decompress();
        $expected = 'ADVENTABBBBBCXYZXYZXYZABCBCDEFEFG(1x3)AX(3x3)ABC(3x3)ABCY';
        $this->assertEquals(strlen($expected), $file->getLength());
    }

    public function testItCanRecursivelyDecompressALine()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $file = new File($filesystem);
        $file->import('test1.txt');
        $file->decompress(true);
        $expected = 'ADVENTABBBBBCXYZXYZXYZABCBCDEFEFGAAAXABCABCABCABCABCABCY';
        $this->assertEquals(strlen($expected), $file->getLength());
    }
}
