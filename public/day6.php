<?php

use Advent2016\Day6\Message;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new Local(__DIR__ . '\..\src\Day6');
$filesystem = new Filesystem($adapter);

$message = new Message($filesystem);
echo $message->decode('input.txt') . PHP_EOL;
echo $message->decode('input.txt', 'ASC');
