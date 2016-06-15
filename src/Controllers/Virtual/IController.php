<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Controllers\Virtual;

use wert2all\electro_api\Framework\Exception\ControllerException;
use wert2all\electro_api\Framework\Request;
use wert2all\electro_api\Framework\Request\IRequest;

interface IController
{

    /**
     * @param IRequest $request
     * @return bool
     */
    public function isCurrent(IRequest $request);

    /**
     * @param IRequest $request
     * @return void
     * @throws ControllerException
     */
    public function run(IRequest $request);
}
