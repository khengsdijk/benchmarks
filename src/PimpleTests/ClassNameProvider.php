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


namespace PimpleTests;

class ClassNameProvider
{
    /**
     * provide all the singleton class names
     *
     * @return array a array with all the singleton class names
     */
    public static function getSingletons(){
        $singletons =
            [
                'minimumsingleton',
                'smallsingleton',
                'largesingleton'
            ];

        return $singletons;
    }

    /**
     * provide all the singleton class names
     *
     * @return array a array with all the singleton class names
     */
    public static function getNonSingletons(){
        $singletons =
            [
                'minimumnonsingleton',
                'smallnonsingleton',
                'largenonsingleton'
            ];

        return $singletons;
    }

}