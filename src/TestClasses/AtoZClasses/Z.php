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


namespace TestClasses\AtoZClasses;


class Z
{
    private $Y;

    /**
     * SmallNonSingleton constructor.
     * @param Y
     */
    public function __construct(Y $Y)
    {
        $this->Y = $Y;
    }


}