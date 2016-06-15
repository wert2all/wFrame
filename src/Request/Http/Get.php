<?php

/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Request\Http;

class Get
{
    /** @var array */
    protected $data = array();

    /**
     * Get constructor.
     * @param string $request
     */
    public function __construct($request = null)
    {
        $this->readData(
            $this->splitRequest($this->cleanRequest($request))
        );
    }

    /**
     * @return string
     */
    public function toString()
    {
        $return = array();
        foreach ($this->data as $key => $value) {
            $return[] = $key . "=" . $value;
        }
        return implode("&", $return);
    }

    public function addValue($name, $value)
    {
        return new Get($this->toString() . "&" . $name . "=" . $value);
    }

    public function getValue($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        return null;
    }

    /**
     * @param string $request
     * @return string
     */
    protected function cleanRequest($request)
    {
        return trim(preg_replace("/[?]/", "", $request));
    }

    /**
     * @param string $request
     * @return array
     */
    protected function splitRequest($request)
    {
        return explode("&", $request);
    }

    /**
     * @param array $request
     */
    protected function readData(array  $request = array())
    {
        foreach ($request as $value) {
            $keyValue = explode("=", $value);
            if (isset($keyValue[1])) {
                $this->data[$keyValue[0]] = $keyValue[1];
            }
        }
    }
}
