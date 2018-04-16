<?php
/**
 * Created by PhpStorm.
 * User: koen
 * Date: 3-4-18
 * Time: 16:00
 */
abstract class BasePimpleTest
{

    protected $container;


    /**
     * BasePimpleTest constructor.
     *
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }


    /**
     * @param $start
     * @param $end
     * @param $type
     */
    public function displayElapsedTime($start, $end, $type)
    {

    }
}