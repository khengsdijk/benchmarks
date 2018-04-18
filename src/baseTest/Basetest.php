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

namespace baseTest;

interface Basetest
{

    public function loadSingletonsRepeatedly();

    public function loadSingletonsIncrementally();

    public function loadNonSingletonsRepeatedly();

    public function loadNonSingletonsIncrementally();

    public function loadAllClassesIncrementally();


}