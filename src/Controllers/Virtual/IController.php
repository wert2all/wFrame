<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Controllers\Virtual;

use wert2all\wFrame\Exception\ControllerException;
use wert2all\wFrame\Request\IRequest;

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
