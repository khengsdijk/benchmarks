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


class Q
{
    private $P;

    /**
     * SmallNonSingleton constructor.
     * @param P
     */
    public function __construct(P $P)
    {
        $this->P = $P;
    }


}