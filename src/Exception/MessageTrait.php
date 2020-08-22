<?php

namespace Huobi\Exception;

trait MessageTrait
{
    public function getHbMsg($code)
    {
        return isset($this->_msg_map[$code]) ? $this->_msg_map[$code] : "ERROR NO MSG!";
    }
}