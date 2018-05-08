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

$html = '<html> <body> ';
$csv  = "";

define("TESTROUNDS", 1000);

//lunr stuff
echo "\n LUNR RESULTS INCOMING\n";

    $locator       = new Lunr\Core\ConfigServiceLocator($config);
    $util          = new util\Util();
    $htmlGenerator = new \util\HtmlGenerator();
    $csvExporter   = new \util\CsvExporter();

    $lunrtest      = new LunrTest($locator, $config, TESTROUNDS, $util);
    $lunrResults   = $lunrtest->executeTests();

    $html .= $htmlGenerator->procesResults('lunr', $lunrResults);
    $csv  .= $csvExporter->exportResults('lunr', $lunrResults);
    print_r($lunrResults);



// pimple stuff
echo "\n PIMPLE RESULTS INCOMING \n";

    $pimpleContainer = new Pimple\Container();
    $pimpletest      = new PimpleTests\PimpleTest($pimpleContainer, $util, TESTROUNDS);
    $pimpleResults   = $pimpletest->executeTests();

    $html .= $htmlGenerator->procesResults('pimple', $pimpleResults);
    $csv  .= $csvExporter->exportResults('pimple', $pimpleResults);
    print_r($pimpleResults);

// php-di stuff
echo "\n PHP-DI RESULTS INCOMING \n";

    $phpDiContainer = new \DI\Container();
    $phpDiTest      = new \PhpDiTests\PhpDiTest($phpDiContainer, $util, TESTROUNDS);
    $phpDiResults   = $phpDiTest->executeTests();
    echo memory_get_peak_usage()/1024/1024;

    $html .= $htmlGenerator->procesResults('php-DI', $phpDiResults);
    $csv  .= $csvExporter->exportResults('php-DI', $phpDiResults);
    print_r($phpDiResults);

//auro results
echo "\nAURA.DI RESULTS INCOMING \n";

    $builder       = new \Aura\Di\ContainerBuilder();
    $auraContainer = $builder->newInstance();
    $auraDiTest    = new \auraDiTests\AuraDiTest($auraContainer, $util, 1000);
    $auraDiResults = $auraDiTest->executeTests();

    $html .= $htmlGenerator->procesResults('aura-DI', $auraDiResults);
    $csv  .= $csvExporter->exportResults('aura-DI', $auraDiResults);
    print_r($auraDiResults);

// container stuff
echo "\nCONTAINER RESULTS INCOMING \n";

    $containerContainer = new League\Container\Container();
    $containerTest      = new \containerTests\ContainerTest($containerContainer, $util, 1000);
    $ContainerResults   = $containerTest->executeTests();

    $html .= $htmlGenerator->procesResults('container', $ContainerResults);
    $csv  .= $csvExporter->exportResults('container', $ContainerResults);
    print_r($ContainerResults);


$html .= ' </body> </html>';
$html .= $htmlGenerator->getStyle();

file_put_contents('test-results.html', $html);
echo $html;



file_put_contents('test-results.csv', $csv);

