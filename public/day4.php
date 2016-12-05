<?php

use Advent2016\Day4\Room;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new Local(__DIR__ . '\..\src\Day4');
$filesystem = new Filesystem($adapter);

$room = new Room($filesystem);
$room->process('input.txt');

echo $room->getSum() . "\n\n";

echo $room->getRoom();
