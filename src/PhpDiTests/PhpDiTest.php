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

        $classes = $this->singletonNameProvider();;

        foreach ($classes as $class) {

            $startTime = microtime(true);
            for ($i = 0; $i < $this->testRounds; $i++) {
                $min = $this->container->get($class);
                unset($min);
            }
            $endTime = microtime(true);

            array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, $class));

            return $results;
        }
    }

    public function loadSingletonsIncrementally()
    {
        // TODO: Implement loadSingletonsIncrementally() method.
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
        // TODO: Implement loadNonSingletonsIncrementally() method.
    }

    public function loadAllClassesIncrementally()
    {
        // TODO: Implement loadAllClassesIncrementally() method.
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