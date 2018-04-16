<?php

$recipe = [];

$recipe['amsairportspipeline'] = [];

$recipe['amsairportspipeline']['name'] = 'Stellr\Pipeline\Pipeline';

$recipe['amsairportspipeline']['params'] = [ 'locator', __DIR__ . '/../pipelines/ams-contentful-airports.json' ];

$recipe['amsairportspipeline']['singleton'] = TRUE;

?>
