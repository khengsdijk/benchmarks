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


class Util
{
    /**
     *
     * @param $beginTime  int    the begin time
     * @param $endTime    int    the end time
     * @param $testRounds int    number of times the test is executed
     * @param $className  string the name of the class that is tested
     *
     * @return array
     */
    public function averageTime($beginTime, $endTime, $testRounds, $className){

        $averageTime = ($beginTime-$endTime) / $testRounds;

        return array($className => $averageTime);
    }



}