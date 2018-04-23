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
     * parse the test result to html format
     *
     * @param $results array the results of a test container
     */
    public function exportResults($containerName, $results)
    {

        $htmlstuff = '
            <table style="width:100%">
            <tr>
                <th colspan="2" id="framework">' . $containerName . '</th>
            </tr>   
            <tr>
                <th>test name </th>
                <th>time</th> 
            </tr>';


            foreach ($results as $result){

            }


            $html = '
            <tr>
                <td>Singleton</td>
                <td>1</td> 
            </tr>
            <tr>
                <td>non singleton</td>
                <td>2</td> 
             </tr>
            </table>';

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

                #framework {
                    border: #ffffff;
                    text-align: center;
                }   
                 </style>';

    }

}