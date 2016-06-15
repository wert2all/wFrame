<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Tests\Format;

use wert2all\wFrame\Format\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerEncode
     * @param  mixed $value
     * @param string $expected
     */
    public function testEncode($value, $expected)
    {
        $this->assertEquals($expected, Json::encode($value));
    }

    /**
     * @dataProvider providerDecode
     * @param  mixed $expectedValue
     * @param string $string
     */
    public function testDecode($expectedValue, $string)
    {
        $this->assertEquals($expectedValue, Json::decode($string));
    }

    public function providerEncode()
    {
        $return = $this->simpleTypesProvider();
        $return[] = array(
            array(
                "1" => 1,
                "2" => 2
            ),
            "{\"1\":1,\"2\":2}"
        );
        return $return;
    }

    private function simpleTypesProvider()
    {
        return array(
            array("1", "\"1\""),
            array(1, "1"),
            array(array(), "[]"),
            array(
                array("1", "2"),
                "[\"1\",\"2\"]"
            ),
        );
    }

    public function providerDecode()
    {
        $return = $this->simpleTypesProvider();
        $object = new \stdClass();
        $object->{1} = 1;
        $object->{2} = 2;

        $return[] = array(
            $object,
            "{\"1\":1,\"2\":2}"
        );
        return $return;
    }
}
