<?php

require_once __DIR__.'/vendor/autoload.php';

use \Minesweeper\src;

$app = new Silex\Application();

Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'JMS\Serializer\Annotation',
    __DIR__ . "/vendor/jms/serializer/src");

$gameInstances = [];
$game = new src\Minesweeper(10, 10, 5);

$serializer = JMS\Serializer\SerializerBuilder::create()->build();
$jsonContent = $serializer->serialize($game, 'json');
//echo $jsonContent; // or return it in a Response


$app->get('/', function () use ($app, $jsonContent) {
    return $jsonContent;
});

$app->get('/new', function () use ($app) {
    $game = new src\Minesweeper(10, 10, 5);
});

$app->run();
