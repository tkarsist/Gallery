<?php
include('postgraph.class.php'); 

$data = array(1 => 0, 1, 2, 4, 16, 20, 22,.17, 7, 2, 1, 0);

// creates graph object
$graph = new PostGraph(550,330);

// set titles
$graph->setGraphTitles('My Title', 'x axis description', 'y axis description');

// set format of number on Y axe
$graph->setYNumberFormat('integer');

// set number of ticks on Y axe
$graph->setYTicks(10);

// set data
$graph->setData($data);

$graph->setBackgroundColor(array(255,255,0));

$graph->setTextColor(array(144,144,144));

// set orientation of text on X axe
$graph->setXTextOrientation('horizontal');

// prepare image
$graph->drawImage();

// print image to the screem
$graph->printImage();
?>

