<?php

/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Controllers\Virtual;

use wert2all\wFrame\Request\IRequest;

abstract class AbstractController implements IController
{

    /**
     * @param IRequest $request
     * @return bool
     */
    public function isCurrent(IRequest $request)
    {
        return ($request->getParameter($this->getControllerIndex()) === $this->getControllerUrl());
    }

    protected function getControllerIndex()
    {
        return 0;
    }

    /**
     * @return string
     */
    abstract protected function getControllerUrl();
}
