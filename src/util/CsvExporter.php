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


namespace util;


class CsvExporter
{

    /**
     * proces the results of the tests so it can be parsed to html
     *
     * @param $containerName string the name of the container
     * @param $results       array  the raw test results
     *
     * @return string the test results in html format
     */
    public function exportResults($containerName, $results){

        $csvString = $containerName . "\n ";

        $csvString .= " test name , time in milliseconds \n";

        foreach ($results as $result){

           $csvString .= $this->processResults($result);

        }

        $csvString .= "\n \n \n";

        return $csvString;
    }

    /**
     * parse the test result to html format
     *
     * @param $results array the results of a test container
     *
     * @return string the test result in html format
     */
    public function processResults($results)
    {
        $csvStuff = '';

        foreach ($results as $result){
            $csvStuff .= $result[0] . " , " . $result[1] . "\n";
        }

        return $csvStuff;
    }


}