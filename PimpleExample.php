<?php
/**
 * Created by PhpStorm.
 * User: koen
 * Date: 3-4-18
 * Time: 13:59
 */

class A {

}

$base = __DIR__;
// Include libraries
require_once $base . '/decomposer.autoload.inc.php';

$t1 = microtime(true);



$container = new Pimple\Container();

$container['a'] = $container->factory(function ($c) {
    return new A();
});

for ($i = 0; $i < 10000; $i++) {
    $j = $container['a'];
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage()/1024/1024
];

echo json_encode($results) . "\n";