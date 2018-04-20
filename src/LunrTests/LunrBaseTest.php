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


namespace LunrTests;

interface LunrBaseTest
{

    public function loadSingletonsRepeatedly();

    public function loadSingletonsIncrementally();

    public function loadNonSingletonsRepeatedly();

    public function loadNonSingletonsIncrementally();


}