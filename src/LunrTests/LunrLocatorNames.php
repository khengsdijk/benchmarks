<?php
/**
 * This file contains functions to provide the names of the test classes for the lunr locator
 *
 * PHP Version 7.0
 *
 * @package
 * @author     Koen Hengsdijk
 * @copyright  2012-2018, M2Mobi BV, Amsterdam, The Netherlands
 */

namespace LunrTests;

class LunrLocatorNames
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