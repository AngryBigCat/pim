<?php

namespace Pim\Base;

interface ProtocolInterface
{
    public function getType();

    public function getData();
}