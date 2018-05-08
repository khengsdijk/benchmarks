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


namespace PhpDiTests;

use baseTest\Basetest;
use TestClasses;

class PhpDiTest implements Basetest
{
    protected $container;

    /**
     * @var int Number of times to repeatedly load the test class
     */
    protected $testRounds;

    /**
     * @var instance of the util class
     */
    protected $util;

    /**
     * BasePimpleTest constructor.
     *
     * @param $container
     */
    public function __construct($container, $util, $testRounds)
    {
        $this->container = $container;
        $this->util       = $util;
        $this->testRounds = $testRounds;
    }

    public function loadSingletonsRepeatedly()
    {
        $results = array();

        $classes = $this->singletonNameProvider();

        foreach ($classes as $class) {
            $startTime = microtime(true);
            for ($i = 0; $i < $this->testRounds; $i++) {
                $min = $this->container->get($class);
                unset($min);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $class));
        }

        return $results;
    }

    public function loadSingletonsIncrementally()
    {

        $results = array();

        $resultName = "Incremental loading of singletons";

        $classes = $this->singletonNameProvider();

        $startTime = microtime(true);
        for ($j = 0; $j < $this->testRounds; $j++) {
            foreach ($classes as $class) {

                $LocatedClass = $this->container->get($class);
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

        $classes = $this->nonSingletonNameProvider();

        foreach ($classes as $class) {
            $startTime = microtime(true);
            for ($i = 0; $i < $this->testRounds; $i++) {
                $min = $this->container->get($class);
                unset($min);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $class));
        }
        return $results;
    }

    public function loadNonSingletonsIncrementally()
    {
        $results = array();

        $resultName = "Incremental loading of non singletons";

        $classes = $this->NonSingletonNameProvider();

        $startTime = microtime(true);
        for ($j = 0; $j < $this->testRounds; $j++) {
            foreach ($classes as $class) {

                $LocatedClass = $this->container->get($class);
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

    public function loadAtoZClasses()
    {
        $results = array();

            $startTime = microtime(true);
            for ($i = 0; $i < $this->testRounds; $i++) {
                $min = $this->container->get('TestClasses\AtoZClasses\Z');
                unset($min);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, 'AtoZ'));

        return $results;
    }

    public function executeTests()
    {
        $resultArray = array();

        $resultArray['singletonRepeatedly']       = $this->loadSingletonsRepeatedly();
        $resultArray['singletonIncrementally']    = $this->loadSingletonsIncrementally();
        $resultArray['nonSingletonRepeatedly']    = $this->loadNonSingletonsRepeatedly();
        $resultArray['nonSingletonIncrementally'] = $this->loadNonSingletonsIncrementally();
        $resultArray['AtoZ']                      = $this->loadAtoZClasses();

        return $resultArray;
    }

    public function singletonNameProvider(){
        $singletons =
            [
                'TestClasses\MinimumSingleton',
                'TestClasses\SmallSingleton',
                'TestClasses\LargeSingleton'
            ];

        return $singletons;
    }

    public function nonSingletonNameProvider(){
        $singletons =
            [
                'TestClasses\MinimumNonSingleton',
                'TestClasses\SmallNonSingleton',
                'TestClasses\LargeNonSingleton'
            ];

        return $singletons;
    }
}