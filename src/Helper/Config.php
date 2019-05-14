<?php

namespace Pim\Helper;

class Config
{
    private static $config;

    public static function get($name)
    {
        if (is_null(self::$config)) {
            self::$config = require_once ROOT_PATH.'/config/config.php';
        }

        return isset(self::$config[$name]) ? self::$config[$name] : null;
    }
}