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


class R
{
    private $Q;

    /**
     * SmallNonSingleton constructor.
     * @param Q
     */
    public function __construct(Q $Q)
    {
        $this->Q = $Q;
    }


}