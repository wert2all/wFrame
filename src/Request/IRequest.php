<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Request;

interface IRequest
{

    /**
     * @return string
     */
    public function getBase();

    /**
     * @param mixed $index
     * @return mixed
     */
    public function getParameter($index);

    /**
     * @return integer
     */
    public function getParametersCount();
}
