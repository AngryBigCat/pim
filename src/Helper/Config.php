<?php

namespace Pim\Helper;

class Config
{
    private static $instance;

    private static $config;

    public static function __callStatic($method, $params)
    {
        if(!isset(self::$instance)){
            self::$instance = new Config();
        }

        if (!isset(self::$config)) {
            self::$instance = require_once __DIR__.'/../../config/config.php';
        }

        call_user_func_array([self::$instance, $method], $params); 
    }

    public function get($name)
    {
        return isset(self::$config[$name]) ? self::$config[$name] : null;
    }
}