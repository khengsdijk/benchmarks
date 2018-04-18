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

    protected $container;

    /**
     * BasePimpleTest constructor.
     *
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function loadSingletonsRepeatedly()
    {

    }

    public function loadSingletonsIncrementally()
    {
        // TODO: Implement loadSingletonsIncrementally() method.
    }

    public function loadNonSingletonsRepeatedly()
    {
        // TODO: Implement loadNonSingletonRepeatedly() method.
    }

    public function loadNonSingletonsIncrementally()
    {
        // TODO: Implement loadNonSingletonsIncrementally() method.
    }


    public function executeTest()
    {
        $t1 = microtime(true);

        $container['a'] = $this->container->factory(function ($c) {
            return new foo();
        });

        for ($i = 0; $i < 10000; $i++) {
            $j = $container['a'];
        }

        $t2 = microtime(true);

        $results = [
            'time' => $t2 - $t1,
            'files' => count(get_included_files()),
            'memory' => memory_get_peak_usage()/1024/1024
        ];

        echo json_encode($results) . "\n";
    }

}