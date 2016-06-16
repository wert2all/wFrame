<?php
/**
 * Created by PhpStorm.
 * User: wert2all
 * Date: 16.06.16
 * Time: 17:30
 */

namespace wert2all\wFrame\Tests\TestHelpers;

use wert2all\wFrame\Request\Http\ServerData;
use wert2all\wFrame\Request\HttpRequest;

class WebServer
{

    const PUB_INDEX_PHP = "/pub/index.php";

    /**
     * @param string $addUrl
     * @return HttpRequest
     */
    public function getRequest($addUrl)
    {
        return new HttpRequest(

            (new ServerData())
                ->setScriptName(self::PUB_INDEX_PHP)
                ->setRequestUrl(self::PUB_INDEX_PHP . "/" . $addUrl)
        );
    }
}
