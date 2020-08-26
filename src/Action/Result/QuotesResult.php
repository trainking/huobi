<?php

namespace Huobi\Action\Result;

use Huobi\Action\Result\Result;

/**
 * 行情类的Result
 */
class QuotesResult extends Result
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
        switch ($this->status) {
            case 'bad-request':
                $_msg = "错误请求";
                break;
            case 'invalid-parameter':
                $_msg = "参数错误";
                break;
            case 'invalid-command':
                $_msg = "指令错误";
                break;
        }
        $this->cn_msg = $_msg;
        return $_msg;
    }
}