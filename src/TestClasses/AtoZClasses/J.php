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


namespace TestClasses;


class J
{
    private $J;

    /**
     * SmallNonSingleton constructor.
     * @param J
     */
    public function __construct(J $J)
    {
        $this->J = $J;
    }


}