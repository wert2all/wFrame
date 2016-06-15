<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Controllers;

use wert2all\wFrame\Controllers\Virtual\AbstractController;
use wert2all\wFrame\Controllers\Virtual\IController;
use wert2all\wFrame\Exception\ControllerException;
use wert2all\wFrame\Request\IRequest;

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
     * @return void
     * @throws ControllerException
     */
    public function run(IRequest $request)
    {
        echo "404";
    }
}
