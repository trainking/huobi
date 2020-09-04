<?php

namespace Huobi\Action\Result;

use Huobi\Action\Result\Result;

class MarketStatusResult extends Result
{
    public function __construct(string $status, int $ts, array $data, string $ch = "")
    {
        parent::__construct($status, $ts, $data, $ch = "");
    }

    public function getCnMsg()
    {
        if ($this->cn_msg !== "") {
            return $this->cn_msg;
        }
        $_msg = "";
        if (!empty($this->data) && isset($this->data['marketStatus'])) {
            switch($this->data['marketStatus']) {
                case 1:
                    $_msg = "正常";
                    break;
                case 2:
                    $_msg = "挂起（不可下单不可撤单）";
                    break;
                case 3:
                    $_msg = "仅撤单（不可下单可撤单）";
                    break;
            }
        }
        $this->cn_msg = $_msg;
        return $_msg;
    }
}

