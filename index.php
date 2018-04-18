<?php
/**
 * Created by PhpStorm.
 * User: koen
 * Date: 29-3-18
 * Time: 10:51
 */

use LunrTests\LunrTest;

$base = __DIR__;
// Include libraries
require_once $base . '/decomposer.autoload.inc.php';

set_include_path(
    get_include_path() . ':' .
    $base . '/config' . ':' .
    $base . '/src'
);

$config = new Lunr\Core\Configuration();
$locator = new Lunr\Core\ConfigServiceLocator($config);
$util = new util\Util();

$lunrtest = new LunrTest($locator, $config, 1000, $util);

$singletonResults = $lunrtest->loadSingletonsRepeatedly();

$incrementalSingletonResults = $lunrtest->loadSingletonsIncrementally();

$nonSingletonResults = $lunrtest->loadNonSingletonsRepeatedly();

$incrementalNonSingletonResults = $lunrtest->loadNonSingletonsIncrementally();

print_r($singletonResults);

print_r($incrementalSingletonResults);

print_r($nonSingletonResults);

print_r($incrementalNonSingletonResults);



