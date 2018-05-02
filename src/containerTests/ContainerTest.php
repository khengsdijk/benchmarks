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
        $this->AtoZContainer();

        $results = array();

        $startTime = microtime(true);
        for ($i = 0; $i < $this->testRounds; $i++) {
            $LocatedClass = $this->container->get('Z');
            unset($LocatedClass);
        }
        $endTime = microtime(true);

        array_push($results, $this->util->averageTime($startTime, $endTime, $this->testRounds, 'AtoZ'));

        return $results;
    }

    public function executeTests()
    {
        $resultArray = array();

        $resultArray['singletonRepeatedly'] = $this->loadSingletonsRepeatedly();
        $resultArray['singletonIncrementally'] = $this->loadSingletonsIncrementally();
        $resultArray['nonSingletonRepeatedly'] = $this->loadNonSingletonsRepeatedly();
        $resultArray['nonSingletonIncrementally'] = $this->loadNonSingletonsIncrementally();
        $resultArray['AtoZ']                      = $this->loadAtoZClasses();

        return $resultArray;
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

    public function AtoZContainer(){
        $this->container->add('A', '\TestClasses\AtoZClasses\A');

        $this->container->add('B', '\TestClasses\AtoZClasses\B')
                        ->withArgument('A');

        $this->container->add('C', '\TestClasses\AtoZClasses\C')
                        ->withArgument('B');

        $this->container->add('D', '\TestClasses\AtoZClasses\D')
                        ->withArgument('C');

        $this->container->add('E', '\TestClasses\AtoZClasses\E')
                        ->withArgument('D');

        $this->container->add('F', '\TestClasses\AtoZClasses\F')
                        ->withArgument('E');

        $this->container->add('G', '\TestClasses\AtoZClasses\G')
                        ->withArgument('F');

        $this->container->add('H', '\TestClasses\AtoZClasses\H')
                        ->withArgument('G');

        $this->container->add('I', '\TestClasses\AtoZClasses\I')
                        ->withArgument('H');

        $this->container->add('J', '\TestClasses\AtoZClasses\J')
                        ->withArgument('I');

        $this->container->add('K', '\TestClasses\AtoZClasses\K')
                        ->withArgument('J');

        $this->container->add('L', '\TestClasses\AtoZClasses\L')
                        ->withArgument('K');

        $this->container->add('M', '\TestClasses\AtoZClasses\M')
                        ->withArgument('L');

        $this->container->add('N', '\TestClasses\AtoZClasses\N')
                        ->withArgument('M');

        $this->container->add('O', '\TestClasses\AtoZClasses\O')
                        ->withArgument('N');

        $this->container->add('P', '\TestClasses\AtoZClasses\P')
                        ->withArgument('O');

        $this->container->add('Q', '\TestClasses\AtoZClasses\Q')
                        ->withArgument('P');

        $this->container->add('R', '\TestClasses\AtoZClasses\R')
                        ->withArgument('Q');

        $this->container->add('S', '\TestClasses\AtoZClasses\S')
                        ->withArgument('R');

        $this->container->add('T', '\TestClasses\AtoZClasses\T')
                        ->withArgument('S');

        $this->container->add('U', '\TestClasses\AtoZClasses\U')
                        ->withArgument('T');

        $this->container->add('V', '\TestClasses\AtoZClasses\V')
                        ->withArgument('U');

        $this->container->add('W', '\TestClasses\AtoZClasses\W')
                        ->withArgument('V');

        $this->container->add('X', '\TestClasses\AtoZClasses\X')
                        ->withArgument('W');

        $this->container->add('Y', '\TestClasses\AtoZClasses\Y')
                        ->withArgument('X');

        $this->container->add('Z', '\TestClasses\AtoZClasses\Z')
                        ->withArgument('Y');

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