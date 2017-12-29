<?php

use App\Graph;

$loader = require( __DIR__ . '/vendor/autoload.php' );


$graphData = [
    [0, 1, 1, 0, 0, 0, 1, 0],
    [1, 0, 1, 1, 0, 0, 0, 0],
    [1, 1, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 1, 0, 0, 0],
    [0, 0, 0, 1, 0, 1, 0, 1],
    [0, 0, 0, 0, 1, 0, 1, 0],
    [1, 0, 0, 0, 0, 1, 0, 0],
    [0, 0, 0, 0, 1, 0, 0, 0],
];

$destination = 6;

$graph = new Graph();
$graph->setData($graphData);
$graph->setDestination($destination);

$graph->searchBreadth();
$graph->searchDepth();


