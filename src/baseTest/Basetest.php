<?php
/**
 *
 *
 * PHP Version 7.0
 *
 * @package
 * @author     Koen Hengsdijk
 * @copyright  2012-2018, M2Mobi BV, Amsterdam, The Netherlands
 */


interface Basetest
{


    public function loadSingletonsIncrementally();

    public function loadNonSingletonRepeatedly();

    public function loadNonSingletonsIncrementally();


}