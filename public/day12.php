<?php

use Advent2016\Day12\Checker;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new Local(__DIR__ . '\..\src\Day12');
$filesystem = new Filesystem($adapter);

$checker = new Checker($filesystem);
$checker->import('input.txt');

$checker->processInstructions();
echo $checker->registers('a') . PHP_EOL;

$checker->init(0, 0, 1, 0);
$checker->processInstructions();
echo $checker->registers('a') . PHP_EOL;
