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

abstract class AbstractExceptionController implements IExceptionController
{
    /** @var  \Throwable */
    protected $error;

    /**
     * @param IRequest $request
     * @return bool
     */
    public function isCurrent(IRequest $request)
    {
        return true;
    }

    /**
     * @param \Throwable $error
     * @return IExceptionController
     */
    public function setError(\Throwable $error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @param IRequest $request
     * @throws ControllerException
     */
    final public function run(IRequest $request)
    {
        if (is_null($this->error)) {
            throw new ControllerException("Cant get a Exception object.");
        }
        $this->throwException($request);
    }

    /**
     * @param IRequest $request
     * @return void
     */
    abstract protected function throwException(IRequest $request);
}
