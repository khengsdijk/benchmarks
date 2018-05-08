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

    public function loadAtoZClasses()
    {
        $this->AtoZcontainer();

        $results = array();

        $startTime = microtime(true);
        for ($i = 0; $i < $this->testRounds; $i++) {

            $LocatedClass = $this->container['T'];
            unset($LocatedClass);

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

        $this->container['largesingleton'] = $this->container->factory(function ($container) {
            return new TestClasses\LargeSingleton();
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

        $this->container['largenonsingleton'] = $this->container->factory(function ($container) {
            return new TestClasses\LargeSingleton();
        });

    }
    public function AtoZcontainer(){


        $this->container['A'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\A();
        });

        $this->container['B'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\B($container['A']);
        });

        $this->container['C'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\C($container['B']);
        });

        $this->container['D'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\D($container['C']);
        });

        $this->container['E'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\E($container['D']);
        });

        $this->container['F'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\F($container['E']);
        });

        $this->container['G'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\G($container['F']);
        });

        $this->container['H'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\H($container['G']);
        });

        $this->container['I'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\I($container['H']);
        });

        $this->container['J'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\J($container['I']);
        });

        $this->container['K'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\K($container['J']);
        });

        $this->container['L'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\L($container['K']);
        });

        $this->container['M'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\M($container['L']);
        });

        $this->container['N'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\N($container['M']);
        });

        $this->container['O'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\O($container['N']);
        });

        $this->container['P'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\P($container['O']);
        });

        $this->container['Q'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\Q($container['P']);
        });

        $this->container['R'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\R($container['Q']);
        });

        $this->container['S'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\S($container['R']);
        });

        $this->container['T'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\T($container['S']);
        });

        $this->container['U'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\U($container['T']);
        });

        $this->container['V'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\V($container['U']);
        });

        $this->container['W'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\W($container['V']);
        });

        $this->container['X'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\X($container['W']);
        });

        $this->container['Y'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\Y($container['X']);
        });

        $this->container['Z'] = $this->container->factory(function ($container) {
            return new TestClasses\AtoZClasses\Z($container['Y']);
        });

    }
}