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
        $results = array();

        $startTime = microtime(true);
        for ($i = 0; $i < $this->testRounds; $i++) {
            $min = $this->container->newInstance('TestClasses\AtoZClasses\Z');
            unset($min);
        }
        $endTime = microtime(true);

        array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, 'AtoZ'));

        return $results;
    }

    public function executeTests()
    {
        $this->setAtoZparams();

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

    public function setAtoZparams(){

        $this->container->params['TestClasses\AtoZClasses\B'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\A');

        $this->container->params['TestClasses\AtoZClasses\C'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\B');

        $this->container->params['TestClasses\AtoZClasses\D'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\C');

        $this->container->params['TestClasses\AtoZClasses\E'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\D');

        $this->container->params['TestClasses\AtoZClasses\F'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\E');

        $this->container->params['TestClasses\AtoZClasses\G'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\F');

        $this->container->params['TestClasses\AtoZClasses\H'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\G');

        $this->container->params['TestClasses\AtoZClasses\I'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\H');

        $this->container->params['TestClasses\AtoZClasses\J'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\I');

        $this->container->params['TestClasses\AtoZClasses\K'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\J');

        $this->container->params['TestClasses\AtoZClasses\L'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\K');

        $this->container->params['TestClasses\AtoZClasses\M'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\L');

        $this->container->params['TestClasses\AtoZClasses\N'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\M');

        $this->container->params['TestClasses\AtoZClasses\O'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\N');

        $this->container->params['TestClasses\AtoZClasses\P'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\O');

        $this->container->params['TestClasses\AtoZClasses\Q'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\P');

        $this->container->params['TestClasses\AtoZClasses\R'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\Q');

        $this->container->params['TestClasses\AtoZClasses\S'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\R');

        $this->container->params['TestClasses\AtoZClasses\T'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\S');

        $this->container->params['TestClasses\AtoZClasses\U'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\T');

        $this->container->params['TestClasses\AtoZClasses\V'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\U');

        $this->container->params['TestClasses\AtoZClasses\W'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\V');

        $this->container->params['TestClasses\AtoZClasses\X'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\W');

        $this->container->params['TestClasses\AtoZClasses\Y'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\X');

        $this->container->params['TestClasses\AtoZClasses\Z'][0] = $this->container->lazyNew('TestClasses\AtoZClasses\Y');
    }


}