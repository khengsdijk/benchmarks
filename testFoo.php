<?php

$base = __DIR__;

require_once $base  . '/decomposer.autoload.inc.php';

set_include_path(
    get_include_path() . ':' .
    $base . '/config' . ':' .
    $base . '/src'
);

$config = new Lunr\Core\Configuration();

$locator = new Lunr\Core\ConfigServiceLocator($config);

$foo = $locator->foo();

echo get_class($foo);


