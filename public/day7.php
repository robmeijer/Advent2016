<?php

use Advent2016\Day7\Address;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new Local(__DIR__ . '\..\src\Day7');
$filesystem = new Filesystem($adapter);

$address = new Address($filesystem);
$address->verifyTLS('input.txt');
echo count($address->getAddresses()) . PHP_EOL;

$address = new Address($filesystem);
$address->verifySSL('input.txt');
echo count($address->getAddresses());
