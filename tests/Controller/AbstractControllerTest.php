<?php
/**
 * Created by PhpStorm.
 * User: wert2all
 * Date: 16.06.16
 * Time: 17:05
 */

namespace wert2all\wFrame\Tests\Controller;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use wert2all\wFrame\Controllers\Virtual\AbstractController;
use wert2all\wFrame\Tests\TestHelpers\WebServer;

class AbstractControllerTest extends PHPUnit_Framework_TestCase
{

    public function testIsCurrent()
    {
        $mock = $this->mockForIsCurrent("test");

        $request = new WebServer();

        $this->assertTrue($mock->isCurrent($request->getRequest("test/")));
        $this->assertFalse($mock->isCurrent($request->getRequest("fake/")));
    }

    /**
     * @param string $value
     * @return PHPUnit_Framework_MockObject_MockObject|AbstractController
     */
    public function mockForIsCurrent($value)
    {
        /** @var AbstractController | PHPUnit_Framework_MockObject_MockObject $mock */
        $mock = $this->getMockBuilder(AbstractController::class)
            ->setMethods(['getControllerUrl', "run"])
            ->getMock();

        $mock->expects($this->any())
            ->method("run")
            ->will($this->returnValue(null));

        $mock->expects($this->any())
            ->method("getControllerUrl")
            ->will($this->returnValue($value));


        return $mock;
    }
}
