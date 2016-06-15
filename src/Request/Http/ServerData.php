<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame\Request\Http;

use wert2all\DataValue\AbstractDataValue;
use wert2all\DataValue\Property;
use wert2all\DataValue\Property\PropertyInterface;

/**
 * Class ServerDataValue
 * @package wert2all\electro_api\Framework\Request\Http
 *
 * @method  ServerData setRequestUrl(string $url);
 * @method  string getRequestUrl();
 * @method  ServerData setScriptName(string $script);
 * @method  string getScriptName();
 */
class ServerData extends AbstractDataValue
{

    /**
     * @return PropertyInterface[]
     */
    protected function getInitPropertyList()
    {
        $request_url = new Property("requestUrl");
        $request_url->setReadOnly(true)->setRequired(true);
        $script_name = new Property("scriptName");
        $script_name->setRequired(true)->setReadOnly(true);
        return array(
            $request_url,
            $script_name,
        );
    }
}
