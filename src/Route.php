<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame;

use ArrayIterator;
use ArrayObject;
use wert2all\wFrame\Controllers\Virtual\AbstractExceptionController;
use wert2all\wFrame\Controllers\Virtual\IController;
use wert2all\wFrame\Request\IRequest;

class Route
{
    /** @var ArrayObject */
    protected $controllers;
    /** @var IController */
    protected $defaultController;
    /** @var IRequest */
    protected $request;
    /** @var  AbstractExceptionController */
    protected $exceptionController = null;

    /**
     * Route constructor.
     * @param IRequest $request
     * @param IController $defaultController
     */
    public function __construct(IRequest $request, IController $defaultController)
    {

        $this->controllers = new ArrayObject();
        $this->defaultController = $defaultController;
        $this->request = $request;
    }

    public function run()
    {
        echo "Run...";
        /** @var IController $controller */
        $controller = $this->getController();
        try {
            if (!is_null($controller)) {
                $controller->run($this->request);
            } else {
                $this->defaultController->run($this->request);
            }
        } catch (\Exception $e) {
            $this->throwError($e);
        }

    }

    /**
     * @return null|IController
     */
    protected function getController()
    {
        $controller = null;
        /** @var ArrayIterator $iterator */
        $iterator = $this->controllers->getIterator();
        while ($iterator->valid() and is_null($controller)) {
            /** @var IController $iteratedController */
            $iteratedController = $iterator->current();
            if ($iteratedController->isCurrent($this->request)) {
                $controller = $iteratedController;
            }
            $iterator->next();
        }
        return $controller;
    }

    private function throwError(\Throwable $error)
    {
        if (!is_null($this->exceptionController)) {
            $this->exceptionController->setError($error)
                ->run($this->request);
        } else {
            throw $error;
        }
    }

    public function addController(IController $controller)
    {
        $this->controllers->append($controller);
        return $this;
    }

    /**
     * @param AbstractExceptionController $exceptionController
     * @return $this
     */
    public function setExceptionController(AbstractExceptionController $exceptionController)
    {
        $this->exceptionController = $exceptionController;
        return $this;
    }
}
