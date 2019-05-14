<?php

namespace Pim\Table;

abstract class BaseTable
{
    protected static $prefix_key;

    protected static $table;
   
    public function set($key, $value)
    {
        self::$table->set(self::$prefix_key.'.'.$key, $value);
    }
}