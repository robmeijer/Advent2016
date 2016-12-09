<?php

use Advent2016\Day9\File;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new Local(__DIR__ . '\..\src\Day9');
$filesystem = new Filesystem($adapter);

$file = new File($filesystem);
$file->import('input.txt');
$file->decompress();
echo $file->getLength() . PHP_EOL;
$file->decompress(true);
echo $file->getLength();
