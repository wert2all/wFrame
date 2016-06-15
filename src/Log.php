<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace wert2all\wFrame;

class Log
{

    public static function dump($value, $isCli = false)
    {
        $dump = print_r($value, true);
        if ($isCli) {
            var_dump($dump);
        } else {
            highlight_string($dump);
        }

    }
}
