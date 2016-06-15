<?php
/**
 * Created by PhpStorm.
 * User: wert2all
 * Date: 16.05.16
 * Time: 20:10
 */

namespace wert2all\wFrame\Tests\Request\Http;

use PHPUnit_Framework_TestCase;
use wert2all\wFrame\Request\Http\Get;

class GetTest extends PHPUnit_Framework_TestCase
{
    /** @dataProvider providerRequest
     * @param string $request
     */
    public function testToString($request)
    {
        $get = new Get($request);
        $request = preg_replace("/[? ]/mi", "", $request);
        $this->assertEquals($request, $get->toString());
    }

    /** @dataProvider providerRequest
     * @param string $request
     */
    public function testEqual($request)
    {
        $get = new Get($request);
        $oldObjectHash = spl_object_hash($get);
        $this->assertNotEquals($oldObjectHash, spl_object_hash($get->addValue("test2", "3")));
    }

    /** @dataProvider providerRequest
     * @param string $request
     */
    public function testAddValue($request)
    {
        $get = (new Get($request))->addValue("test2", "2");
        $this->assertEquals("2", $get->getValue("test2"));
    }


    public function providerRequest()
    {
        return array(
            array("?test=1"),
            array("test=1"),
            array("?test3=1&test=1"),
            array(" test=1   ")
        );
    }

    public function testNullRequest()
    {
        $get = new Get();
        $this->assertEquals("", $get->toString());
    }

    public function testEncoded()
    {
        $get = new Get("?test=%D0%BE%D0%BE%D0%B2%D1%8B%D0%BB%D0%B2%D0%BE%D1%8B%D0%B2%D0%BE%20");
        $this->assertEquals("оовылвоыво ", $get->getValue("test"));
    }
}
