<?php
/**
 *
 *
 * PHP Version 7.0
 *
 * @package
 * @author     Koen Hengsdijk
 * @copyright  2012-2018, M2Mobi BV, Amsterdam, The Netherlands
 */
// use Lunr\Core\ConfigServiceLocator;


$base = dirname(__DIR__, 2);
// Include libraries
require_once $base . '/decomposer.autoload.inc.php';

// Define application config lookup path
set_include_path(
    get_include_path() . ':' .
    $base . '/config' . ':' .
    $base . '/src'
);

use Util;

class LunrTest implements Basetest
{
    /**
     * @var int Number of times to repeatedly load the test class
     */
    protected $testRounds;

    /**
     * @var instance of the lunr config file
     */
    protected $config;

    /**
     * @var instance of the Lunr locator
     */
    protected $locator;

    protected $util;
    /**
     *  instance of the service locator.
     * @var \Lunr\Core\ConfigServiceLocator
     */
    public function __construct($locator, $config, $testRounds)
    {
       $this->locator    = $locator;
       $this->config     = $config;
       $this->testRounds = $testRounds;

       $this->util = new Util();
    }


    public function loadSingletonRepeatedly()
    {
        $before = microtime(true);

        for ($i = 0; $i < $this->testRounds; $i++){
            $class = $this->locator->minimumsingleton();
            unset($class);
        }

        $after = microtime(true);

       return $this->util->averageTime($before, $after, $this->testRounds ,"minimumSingleton");
    }

    public function loadSingletonsIncrementally()
    {
        // TODO: Implement loadSingletonsIncrementally() method.
    }

    public function loadNonSingletonRepeatedly()
    {
        // TODO: Implement loadNonSingletonRepeatedly() method.
    }

    public function loadNonSingletonsIncrementally()
    {
        // TODO: Implement loadNonSingletonsIncrementally() method.
    }


}