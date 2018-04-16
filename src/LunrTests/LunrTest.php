<?php
/**
 *this file contains the tests for Lunr locator
 *
 * PHP Version 7.0
 *
 * @package
 * @author     Koen Hengsdijk
 * @copyright  2012-2018, M2Mobi BV, Amsterdam, The Netherlands
 */


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

   //    $this->util = new Util();
    }

    /**
     * Tests the loading of singletons repeatedly
     *
     * @return array the results of the test
     */
    public function loadSingletonRepeatedly()
    {

        $classes = LunrLocatorNames::getSingletons();

        $before = microtime(true);

        foreach ($classes as $class) {
            for ($j = 0; $j < $this->testRounds; $j++) {

                $LocatedClass = $this->{$this->locator[$class]}();
                unset($LocatedClass);
            }
        }

        $after = microtime(true);

        return Util::averageTime($before, $after, $this->testRounds ,"minimumSingleton");
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