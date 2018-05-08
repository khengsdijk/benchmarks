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


class LargeNonSingleton
{
    private $foo;

    private $things;

    /**
     * LargeNonSingleton constructor.
     * @param $foo
     * @param $things
     */
    public function __construct(string $foo = 'foo', string $things = 'things')
    {
        $this->foo = $foo;
        $this->things = $things;
    }

    /**
     * @return mixed
     */
    public function getThings()
    {
        return $this->things;
    }

    /**
     * @param mixed $things
     */
    public function setThings($things): void
    {
        $this->things = $things;
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
        if (is_string($this->foo)) {
            echo "foo is a string and the string contains this: " . $this->foo . "\n";
        } elseif (is_bool($this->foo)) {
            echo "foo is a boolean and its value: " . $this->foo . "\n";
        } elseif (is_object($this->foo)) {
            echo "foo is an object and the object name is: " . get_class($this->foo) . "\n";
        } elseif (is_numeric($this->foo)) {
            echo "foo is a numeric value and its value is: " . $this->foo . "\n";
        } else {
            echo "foo is this this type: " . gettype($this->foo) . "\n";
        }
    }

    public function recursiveFunction($something = '')
    {

        echo "this is something: " . $something . "\n";

        foreach ($this->things as $thing) {
            $this->recursiveFunction($thing);
        }

    }

    public function comparingFunction($a, $b)
    {

        if ($a > $b) {
            return 1;
        } elseif ($a < $b) {
            return -1;
        }

        return 0;
    }

    public function returnSomeHtml()
    {

        $html = "<!DOCTYPE html>
                <html>
                    <body>

                    <h1>My First Heading</h1>
                    <p>My first paragraph.</p>
                    </body>
                </html>";

        return $html;
    }

    public function returnSomeXml(){

        $xml = "<note>
                    <to>Tove</to>
                    <from>Jani</from>
                    <heading>Reminder</heading>
                    <body>Don't forget me this weekend!</body>  
                </note>";

        return $xml;
    }


    public function generateAlphabet(){

        $alphabet = array();

        foreach(range('a','z') as $i)
        {
            echo $i;

            array_push($alphabet, $i);
        }
    }

}