<?php

use Advent2016\Day8\Keypad;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new Local(__DIR__ . '\..\src\Day8');
$filesystem = new Filesystem($adapter);

$keypad = new Keypad($filesystem);
$keypad->import('input.txt');
$keypad->followInstructions();
$keypad->showKeypad();
