<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Request;

use ArrayObject;
use wert2all\wFrame\Request\Http\Get;
use wert2all\wFrame\Request\Http\ServerData;

class HttpRequest implements IRequest
{
    /** @var Get */
    protected $get;
    /** @var  array */
    protected $baseArray;
    /** @var  array */
    protected $otherUrlArray;

    /**
     * HttpRequest constructor.
     * @param ServerData $serverDataValue
     */
    public function __construct(ServerData $serverDataValue)
    {
        $this->baseArray = new ArrayObject();
        $this->otherUrlArray = array();

        $this->makeBaseUrl(
            $this->removeGet($serverDataValue->getRequestUrl()),
            $serverDataValue->getScriptName()
        );

        $this->updateSlashes();
    }

    /**
     * @param  string $url
     * @param string $scriptName
     */
    private function makeBaseUrl($url, $scriptName)
    {
        $url = $this->splitUrl($url);

        $diffFlag = false;
        $counter = 0;

        $serverIterator = (new ArrayObject($this->splitUrl($scriptName)))->getIterator();
        while ($serverIterator->valid() and $diffFlag !== true) {
            if (isset($url[$counter]) and $serverIterator->current() == $url[$counter]) {
                $this->baseArray->append($serverIterator->current());
            } else {
                $diffFlag = true;
            }
            $serverIterator->next();
            $counter++;
        }

        $this->otherUrlArray = $this->deleteNullElements(
            array_slice($url, $this->baseArray->count(), count($url))
        );
    }

    /**
     * @param string $url
     * @return array
     */
    private function splitUrl($url)
    {
        return explode("/", $url);
    }

    protected function deleteNullElements(array  $otherUrlArray)
    {
        foreach ($otherUrlArray as $key => $item) {
            if (is_null($item) or $item == "") {
                return array_slice($otherUrlArray, 0, $key);
            }
        }
        return $otherUrlArray;
    }

    private function removeGet($requestURL)
    {
        if (false !== $spliced = explode("?", $requestURL)) {
            if (isset($spliced[1])) {
                $this->get = new Get($spliced[1]);
                return $spliced[0];
            }
        }
        return $requestURL;
    }

    private function updateSlashes()
    {
        $arrayCopy = $this->baseArray->getArrayCopy();
        if (end($arrayCopy) != "") {
            $this->baseArray->append("");
        }
    }

    /**
     * @return string
     */
    public function getBase()
    {
        return implode("/", $this->baseArray->getArrayCopy());
    }

    /**
     * @param mixed $index
     * @return mixed
     */
    public function getParameter($index)
    {
        return isset($this->otherUrlArray[(int)$index]) ? $this->otherUrlArray[(int)$index] : null;
    }

    /**
     * @return int
     */
    public function getParametersCount()
    {
        return count($this->otherUrlArray);
    }
}
