<?php
/**
 *this file contains the tests for LunrTests locator
 *
 * PHP Version 7.0
 *
 * @package
 * @author     Koen Hengsdijk
 * @copyright  2012-2018, M2Mobi BV, Amsterdam, The Netherlands
 */

namespace LunrTests;
use baseTest\Basetest;

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
     * @var instance of the LunrTests locator
     */
    protected $locator;

    /**
     * @var instance of the util class
     */
    protected $util;
    /**
     *  instance of the service locator.
     * @var \Lunr\Core\ConfigServiceLocator
     */
    public function __construct($locator, $config, $testRounds, $util)
    {
       $this->locator    = $locator;
       $this->config     = $config;
       $this->testRounds = $testRounds;
       $this->util       = $util;
    }

    /**
     * Tests the loading of singletons repeatedly
     *
     * @return array the results of the test
     */
    public function loadSingletonsRepeatedly()
    {
        $results = array();

        $classes = LunrLocatorNames::getSingletons();

        foreach ($classes as $class) {

            $LocatedClass = $this->locator->$class();
            $className = get_class($LocatedClass);
            unset($LocatedClass);

            $startTime = microtime(true);
            for ($j = 0; $j < $this->testRounds; $j++) {
                $LocatedClass = $this->locator->$class();
                unset($LocatedClass);
            }

            $endTime = microtime(true);
            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $className));
        }

        return $results;
    }

    public function loadSingletonsIncrementally()
    {
        $results = array();
        $resultName = "Incremental loading of singletons";
        $classes = LunrLocatorNames::getSingletons();

        $startTime = microtime(true);
        for ($j = 0; $j < $this->testRounds; $j++) {
            foreach ($classes as $class) {
                $LocatedClass = $this->locator->$class();
                unset($LocatedClass);
            }
        }
        $endTime = microtime(true);
        array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $resultName));

        return $results;
    }

    public function loadNonSingletonsRepeatedly()
    {
        $results = array();

        $classes = LunrLocatorNames::getNonSingletons();

        foreach ($classes as $class) {

            $LocatedClass = $this->locator->$class();
            $className = get_class($LocatedClass);

            $startTime = microtime(true);
            for ($j = 0; $j < $this->testRounds; $j++) {
                $LocatedClass = $this->locator->$class();
                unset($LocatedClass);
            }
            $endTime = microtime(true);
            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $className));
        }

        return $results;
    }

    public function loadNonSingletonsIncrementally()
    {
        $results = array();
        $resultName = "Incremental loading of non singletons";
        $classes = LunrLocatorNames::getNonSingletons();

        $startTime = microtime(true);
        for ($j = 0; $j < $this->testRounds; $j++) {

            foreach ($classes as $class) {
                $LocatedClass = $this->locator->$class();
                unset($LocatedClass);
            }
        }
        $endTime = microtime(true);
        array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $resultName));

        return $results;
    }

    public function loadAllClassesIncrementally()
    {
        // TODO: Implement loadAllClassesIncrementally() method.
    }

}

?>