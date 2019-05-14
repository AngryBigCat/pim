<?php

namespace Pim\Table;

use Swoole\Table;

class OnlineTable extends BaseTable
{
    public static $prefix_key = 'online';

    public static function init()
    {
        self::$table = new Table(4096);
        self::$table->column('user_id', Table::TYPE_INT, 8);
        self::$table->column('fd', Table::TYPE_INT, 8);
        self::$table->create();
    }
}