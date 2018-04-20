<?php
/**
 * Created by PhpStorm.
 * User: koen
 * Date: 3-4-18
 * Time: 15:42
 */

namespace PimpleTests;
use baseTest\Basetest;
use TestClasses;

class PimpleTest implements Basetest
{
    /**
     * @var instance of the Pimple Container class
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
        $this->singleTonContainer();

        $results = array();

        $classes = ClassNameProvider::getSingletons();

        foreach ($classes as $class) {

            $LocatedClass = $this->container[$class];
            $className = get_class($LocatedClass);
            unset($LocatedClass);

            $startTime = microtime(true);
            for ($j = 0; $j < $this->testRounds; $j++) {

                $LocatedClass = $this->container[$class];
                unset($LocatedClass);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $className));
        }

        return $results;
    }

    public function loadSingletonsIncrementally()
    {
        $this->singleTonContainer();

        $results = array();

        $resultName = "Incremental loading of singletons";

        $classes = ClassNameProvider::getSingletons();

        $startTime = microtime(true);
        for ($j = 0; $j < $this->testRounds; $j++) {
            foreach ($classes as $class) {

                $LocatedClass = $this->container[$class];
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

        $classes = ClassNameProvider::getNonSingletons();

        foreach ($classes as $class) {

            $LocatedClass = $this->container[$class];
            $className = get_class($LocatedClass);
            unset($LocatedClass);

            $startTime = microtime(true);
            for ($j = 0; $j < $this->testRounds; $j++) {

                $LocatedClass = $this->container[$class];
                unset($LocatedClass);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $className));
        }

        return $results;
    }

    public function loadNonSingletonsIncrementally()
    {
        $this->nonSingleTonContainer();

        $results = array();

        $resultName = "Incremental loading of non singletons";

        $classes = ClassNameProvider::getNonSingletons();

        $startTime = microtime(true);
        for ($j = 0; $j < $this->testRounds; $j++) {
            foreach ($classes as $class) {

                $LocatedClass = $this->container[$class];
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

    /**
     * add all the singleton classes to the pimple container
     */
    public function singleTonContainer(){

        $this->container['minimumsingleton'] = $this->container->factory(function ($container) {
            return new TestClasses\MinimumSingleton();
        });

        $this->container['smallsingleton'] = $this->container->factory(function ($container) {
            return new TestClasses\SmallSingleton();
        });

    }

    /**
     * add all the non singleton classes to the pimple container
     */
    public function nonSingleTonContainer(){

        $this->container['minimumnonsingleton'] = $this->container->factory(function ($container) {
            return new TestClasses\MinimumNonSingleton();
        });

        $this->container['smallnonsingleton'] = $this->container->factory(function ($container) {
            return new TestClasses\SmallNonSingleton('foo');
        });

    }
}