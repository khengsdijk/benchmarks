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


class HtmlGenerator
{
    /**
     * proces the results of the tests so it can be parsed to html
     *
     * @param $containerName string the name of the container
     * @param $results       array  the raw test results
     *
     * @return string the test results in html format
     */
    public function procesResults($containerName, $results){

        $htmlstuff = '
            <table style="width:100%">
            <tr>
                <th colspan="2" class="framework">' . $containerName . '</th>
            </tr>   
            <tr>
                <th>test name </th>
                <th>time in milliseconds</th> 
            </tr>';


        foreach ($results as $result){
            $htmlstuff .= $this->exportResults($result);
        }


        $htmlstuff .= ' </table>';

        return $htmlstuff;
    }

    /**
     * parse the test result to html format
     *
     * @param $results array the results of a test container
     *
     * @return string the test result in html format
     */
    public function exportResults($results)
    {
        $htmlstuff = '';

            foreach ($results as $result){
                $htmlstuff .= '
                <tr>
                    <td>'. $result[0] .'</td>
                    <td>'. $result[1] .'</td> 
                </tr>
                  ';
            }

        return $htmlstuff;
    }


    public function getStyle()
    {

        return '<style> 
                table, th, td {
                 border: 1px solid black;
                 }   
    
                th, td {
                padding: 15px;
                }

                th {
                    text-align: left;
                }
                table {
                    border-spacing: 5px;
                }

                .framework {
                    border: #ffffff;
                    text-align: center;
                }   
                 </style>';
    }

}