<?php
/**
 * Created by PhpStorm.
 * User: koen
 * Date: 29-3-18
 * Time: 10:51
 */

// use Lunr\Core\ConfigServiceLocator;

$base = __DIR__;
// Include libraries
require_once $base . '/decomposer.autoload.inc.php';

// Define application config lookup path
set_include_path(
    get_include_path() . ':' .
    $base . '/config' . ':' .
    $base . '/src'
);

$config = new Lunr\Core\Configuration();
$locator = new Lunr\Core\ConfigServiceLocator($config);



// not sure what to do with this as of yet
$reflectionClass = new ReflectionClass('Lunr\Core\ConfigServiceLocator');
$reflectionProperty = $reflectionClass->getProperty('cache');
print_r($reflectionProperty);
$reflectionProperty->setAccessible(true);
$reflectionProperty->setValue($locator, null);

$before = microtime(true);

// test the loading of a singleton class
for ($i=0 ; $i<1000 ; $i++)
{
    $cliparser = $locator->cliparser();
    unset($cliparser);
}

$after = microtime(true);

echoTime($after, $before, $i);

unset($before);
unset($after);

// test the loading of a non singleton class using lunr locator
$before = microtime(true);
for ($i=0 ; $i<1000 ; $i++)
{
    $fao = $locator->fao();
    unset($fao);
}

$after = microtime(true);

echoTime($after, $before, $i);


function echoTime($after, $before, $iterations=1)
{
    $time = ($after-$before) / $iterations;
    $message = 'the averag';

    if ($time >= 1)
        echo $time . " seconds\n";
    else if ($time * 1000 >= 1)
        echo $time * 1000 . " milliseconds\n";
    else if ($time * 1000 * 1000 >= 1)
        echo $time * 1000 * 1000 . " microseconds\n";
    else
        echo $time * 1000 * 1000 * 1000 . " nanoseconds\n";
    echo $time . "\n";
   // return $time;
}
