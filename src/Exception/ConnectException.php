<?php

namespace Pim\Exception;

class ConnectExceiption extends BaseException 
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        // 自定义的代码

        // 确保所有变量都被正确赋值
        parent::__construct($message, $code, $previous);
    }
}