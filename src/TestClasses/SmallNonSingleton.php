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


class SmallNonSingleton
{
    private $foo;

    /**
     * SmallNonSingleton constructor.
     * @param string the minimum singleton class
     */
    public function __construct(string $foo = 'foo')
    {
        $this->foo = $foo;
    }

    /**
     * @return mixed
     */
    public function getFoo()
    {
        return $this->foo;
    }

    /**
     * @param mixed $foo
     */
    public function setFoo($foo)
    {
        $this->foo = $foo;
    }

    public function bar()
    {
        if(is_string($this->foo)){
            echo "foo is a string and the string contains this: " . $this->foo . "\n";
        }
        elseif (is_bool($this->foo)){
            echo "foo is a boolean and its value: " . $this->foo . "\n";
        }
        elseif (is_object($this->foo)){
            echo "foo is an object and the object name is: " . get_class($this->foo) . "\n";
        }
        elseif (is_numeric($this->foo)){
            echo "foo is a numeric value and its value is: " . $this->foo . "\n";
        }
        else {
            echo "foo is this this type: " . gettype($this->foo) . "\n";
        }
    }
}