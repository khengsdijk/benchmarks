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


namespace containerTests;


use baseTest\Basetest;

class ContainerTest implements Basetest
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
        $this->container  = $container;
        $this->util       = $util;
        $this->testRounds = $testRounds;
    }


    public function loadSingletonsRepeatedly()
    {
        $this->singleTonContainer();

        $results = array();

        $classes = $this->singletonNameProvider();

        foreach ($classes as $class) {

            $startTime = microtime(true);
            for ($j = 0; $j < $this->testRounds; $j++) {

                $LocatedClass = $this->container->get($class);
                unset($LocatedClass);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $class));
        }

        return $results;
    }

    public function loadSingletonsIncrementally()
    {
        $this->singleTonContainer();

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
        $this->nonSingleTonContainer();

        $results = array();

        $classes = $this->NonSingletonNameProvider();

        foreach ($classes as $class) {

            $startTime = microtime(true);
            for ($j = 0; $j < $this->testRounds; $j++) {

                $LocatedClass = $this->container->get($class);
                unset($LocatedClass);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $class));
        }

        return $results;
    }

    public function loadNonSingletonsIncrementally()
    {
        $this->nonSingleTonContainer();

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
        // TODO: Implement loadAtoZClasses() method.
    }

    public function executeTests()
    {
        // TODO: Implement executeTests() method.
    }

    /**
     * add all the singleton classes to the pimple container
     */
    public function singleTonContainer(){

        $this->container->add('minimumSingleton', 'TestClasses\MinimumSingleton');

        $this->container->add('smallSingleton', 'TestClasses\SmallSingleton');
    }

    /**
     * add all the non singleton classes to the pimple container
     */
    public function nonSingleTonContainer(){

        $this->container->add('minimumNonSingleton', '\TestClasses\MinimumNonSingleton');

        $this->container->add('smallNonSingleton', '\TestClasses\smallNonSingleton');
    }

    public function singletonNameProvider(){
        $singletons =
            [
                'minimumSingleton',
                'smallSingleton'
            ];

        return $singletons;
    }

    public function nonSingletonNameProvider(){
        $singletons =
            [
                'minimumNonSingleton',
                'smallNonSingleton'
            ];

        return $singletons;
    }

}