<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Controllers;

use wert2all\electro_api\Framework\Controllers\Virtual\AbstractController;
use wert2all\electro_api\Framework\Controllers\Virtual\IController;
use wert2all\electro_api\Framework\Exception\ControllerException;
use wert2all\electro_api\Framework\Request;
use wert2all\electro_api\Framework\Request\IRequest;

class Error404 extends AbstractController implements IController
{

    /**
     * @param IRequest $request
     * @return bool
     */
    public function isCurrent(IRequest $request)
    {
        return true;
    }

    /**
     * @param IRequest $request
     * @param \Throwable $exception
     * @return void
     * @throws ControllerException
     */
    public function run(IRequest $request)
    {
        echo "404";
    }
}
