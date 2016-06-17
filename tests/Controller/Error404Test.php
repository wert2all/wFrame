<?php
/**
 * Created by PhpStorm.
 * User: wert2all
 * Date: 17.06.16
 * Time: 13:27
 */

namespace wert2all\wFrame\Tests\Controller;

use PHPUnit_Framework_TestCase;
use wert2all\wFrame\Controllers\Error404;
use wert2all\wFrame\Tests\TestHelpers\WebServer;

class Error404Test extends PHPUnit_Framework_TestCase
{
    public function testIsCurrent()
    {
        $controller = new Error404();

        $this->assertTrue($controller->isCurrent(
            (new WebServer())->getRequest("test")
        ));
    }
}
