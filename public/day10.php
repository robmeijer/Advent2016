<?php

use Advent2016\Day10\BotCollection;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

require_once __DIR__ . '/../vendor/autoload.php';

$adapter = new Local(__DIR__ . '\..\src\Day10');
$filesystem = new Filesystem($adapter);

$bots = new BotCollection($filesystem);
$bots->import('input.txt');

$bots->processInstructions();

foreach ($bots->bots() as $bot) {
    if ($bot->winner()) {
        echo $bot->id() . PHP_EOL;
    }
}

echo $bots->outputs(0)->value() * $bots->outputs()[1]->value() * $bots->outputs()[2]->value();
