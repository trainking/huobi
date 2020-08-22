<?php

namespace Huobi\Exception;

class HbBaseException extends \Exception
{

    use MessageTrait;

    protected $_msg_map = null;

    public function __construct($code)
    {
        $message = $this->getHbMsg($code);
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return __CLASS__."; Error: ".$this->code."; Msg: ".$this->message."\n";
    }
}