<?php

use Advent2016\Day5\Door;

require_once __DIR__ . '/../vendor/autoload.php';

$door = new Door();
$door->generatePassword('ugkcyxxp');
echo $door->getPassword() . PHP_EOL;

$door = new Door();
$door->generatePassword('ugkcyxxp', true);
echo $door->getPassword();
