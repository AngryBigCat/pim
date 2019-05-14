<?php

namespace Pim\Base;

class Protocol implements ProtocolInterface
{
    private $message;

    public function  __construct($message)
    {
        $this->message = json_decode($message, true);
    }

    public function getType()
    {
        return $this->message['type'];
    }

    public function getData()
    {
        return $this->message['data'];
    }
}
