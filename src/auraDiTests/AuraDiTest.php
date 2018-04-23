<?php
/**
 * This file contains the DatabaseDMLQueryBuilderQueryPartsWithTest class.
 *
 * PHP Version 7.0
 *
 * @package
 * @author     Koen Hengsdijk
 * @copyright  2012-2018, M2Mobi BV, Amsterdam, The Netherlands
 */


namespace auraDiTests;


use baseTest\Basetest;

class AuraDiTest implements Basetest
{

    /**
     * @var instance of the aura container
     */
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
                $min = $this->container->newInstance($class);
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

                $LocatedClass = $this->container->newInstance($class);
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

        $classes = $this->NonsingletonNameProvider();

        foreach ($classes as $class) {
            $startTime = microtime(true);
            for ($i = 0; $i < $this->testRounds; $i++) {
                $min = $this->container->newInstance($class);
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

        $classes = $this->singletonNameProvider();

        $startTime = microtime(true);
        for ($j = 0; $j < $this->testRounds; $j++) {
            foreach ($classes as $class) {

                $LocatedClass = $this->container->newInstance($class);
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
        // TODO: Implement loadAtoZClasses() method.
    }

    public function executeTests()
    {
        // TODO: Implement executeTests() method.
    }


    public function singletonNameProvider(){
        $singletons =
            [
                'TestClasses\MinimumSingleton',
                'TestClasses\SmallSingleton'
            ];

        return $singletons;
    }

    public function nonSingletonNameProvider(){
        $singletons =
            [
                'TestClasses\MinimumNonSingleton',
                'TestClasses\SmallNonSingleton'
            ];

        return $singletons;
    }

}