<?php
/**
 * Created by PhpStorm.
 * User: koen
 * Date: 3-4-18
 * Time: 13:59
 */

$base = __DIR__;
// Include libraries
require_once $base . '/decomposer.autoload.inc.php';

use Pimple\Container;
use TestClasses\MinimumSingleton;

$container = new Container();

$container['min'] = $container->factory(function ($c) {
    return new MinimumSingleton();

});

for ($i = 0; $i < 10000; $i++) {
    $j = $container['min'];
    echo get_class($j);
}


