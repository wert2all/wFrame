<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Tests\Request;

use wert2all\wFrame\Request\Http\ServerData;
use wert2all\wFrame\Request\HttpRequest;
use wert2all\wFrame\Tests\TestHelpers\WebServer;

class HttpRequestTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @dataProvider providerBaseUrl
     * @param ServerData $requestData
     * @param string $expected
     */
    public function testBase(ServerData $requestData, $expected)
    {
        $request = new HttpRequest($requestData);
        $this->assertEquals($expected, $request->getBase());
    }

    public function providerBaseUrl()
    {
        return array(
            array(
                $this->defaultData("/pub/index/xcxc/cxxcxcxc/?fdfd=1/pub/"),
                "/pub/"
            ),
            array(
                $this->defaultData("/pub/index.php/xcxc/cxxcxcxc/?fdfd=1/pub/"),
                "/pub/index.php/"
            ),
            array(
                $this->defaultData("/pub/"),
                "/pub/"
            ),
            array(
                $this->defaultData("/pub"),
                "/pub/"
            )
        );
    }

    /**
     * @param string $url
     * @return ServerData
     */
    private function defaultData($url)
    {
        return (new ServerData())
            ->setScriptName("/pub/index.php")
            ->setRequestUrl($url);
    }

    public function testGettingParameters()
    {
        $webServer = new WebServer();
        $request = $webServer->getRequest("xcxc/cxxcxcxc/?fdfd=1/pub/");

        $this->assertEquals("xcxc", $request->getParameter(0));
        $this->assertEquals("cxxcxcxc", $request->getParameter(1));
        $this->assertEquals(null, $request->getParameter(20));
    }
}
