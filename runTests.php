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
require __DIR__  . '/decomposer.autoload.inc.php';
require __DIR__ . '/vendor/autoload.php';


set_include_path(
    get_include_path() . ':' .
    $base . '/config' . ':' .
    $base . '/src'
);

$config = new Lunr\Core\Configuration();

//lunr stuff

echo "\n LUNR RESULTS INCOMING\n";

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

// pimple stuff

echo "\n PIMPLE RESULTS INCOMING \n";

$pimpleContainer = new Pimple\Container();

$pimpletest = new PimpleTests\PimpleTest($pimpleContainer, $util, 1000);

$pimpleSingletonResult = $pimpletest->loadSingletonsRepeatedly();

$pimpleSingletonIncrementalResult = $pimpletest->loadSingletonsIncrementally();

$pimpleNonSingletonResult = $pimpletest->loadNonSingletonsRepeatedly();

$pimpleNonSingletonIncrementalResult = $pimpletest->loadNonSingletonsIncrementally();

print_r($pimpleSingletonResult);

print_r($pimpleSingletonIncrementalResult);

print_r($pimpleNonSingletonResult);

print_r($pimpleNonSingletonIncrementalResult);

// php-di stuff

echo "\n PHP-DI RESULTS INCOMING \n";

$phpDiContainer = new \DI\Container();

$phpDiTest = new \PhpDiTests\PhpDiTest($phpDiContainer, $util, 1000);

$phpDiResults = $phpDiTest->loadSingletonsRepeatedly();

$phpDiResultsIncremental = $phpDiTest->loadSingletonsIncrementally();

$phpDiResultsNonSingleton = $phpDiTest->loadNonSingletonsRepeatedly();

$phpDiResultsNonSingletonIncremental = $phpDiTest->loadNonSingletonsIncrementally();

print_r($phpDiResults);

print_r($phpDiResultsIncremental);

print_r($phpDiResultsNonSingleton);

print_r($phpDiResultsNonSingletonIncremental);

echo "\nAURA.DI RESULTS INCOMING \n";

$builder = new \Aura\Di\ContainerBuilder();

$auraContainer = $builder->newInstance();

$auraDiTest = new \auraDiTests\AuraDiTest($auraContainer, $util, 1000);

$phpAuraDiSingletonResults = $auraDiTest->loadSingletonsRepeatedly();

$phpAuraDiResultsIncremental = $auraDiTest->loadSingletonsIncrementally();

$phpAuraDiNonSingletonResults = $auraDiTest->loadNonSingletonsRepeatedly();

$phpAuraDiResultsNonSingletonIncremental = $auraDiTest->loadNonSingletonsIncrementally();

print_r($phpAuraDiSingletonResults);

print_r($phpAuraDiResultsIncremental);

print_r($phpAuraDiNonSingletonResults);

print_r($phpAuraDiResultsNonSingletonIncremental);

echo "\nCONTAINER RESULTS INCOMING \n";

$containerContainer = new League\Container\Container();

$containerTest = new \containerTests\ContainerTest($containerContainer, $util, 1000);

$containerTestResult = $containerTest->loadSingletonsRepeatedly();

$containerResultsIncremental = $containerTest->loadSingletonsIncrementally();

$containerNonSingletonResults = $containerTest->loadNonSingletonsRepeatedly();

$containerResultsNonSingletonIncremental = $containerTest->loadNonSingletonsIncrementally();

print_r($containerTestResult);

print_r($containerResultsIncremental);

print_r($containerNonSingletonResults);

print_r($containerResultsNonSingletonIncremental);

