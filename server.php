<?php

require_once __DIR__.'/vendor/autoload.php';

use \Minesweeper\src;

$app = new Silex\Application();

$gameInstances = [];

$tile = new src\BlankTile();
$tile->setDisplayValue('test');
$tile->setActivated(true);
$tile->setHasFlag(true);

$serializer = JMS\Serializer\SerializerBuilder::create()->build();
$jsonContent = $serializer->serialize($tile, 'json');
//echo $jsonContent; // or return it in a Response


$app->get('/', function () use ($app, $jsonContent) {
    return 'home';
});

$app->get('/new', function () use ($app) {
    $game = new \Minesweeper\Minesweeper(10, 10, 5);
});

$app->run();
