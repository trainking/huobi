<?php

namespace Huobi\Action\Result;

// 基础返回结果类
abstract class Result
{
    // string API接口返回状态
    protected $status = "";

    // string 接口数据对应的数据流。部分接口没有对应数据流因此不返回此字段
    protected $ch = "";

    // long 接口返回的UTC时间的时间戳，单位毫秒
    protected $ts = 0;

    // object 接口返回数据主体
    protected $data = null;

    // string 返回状态对应的中文意思
    protected $cn_msg = "";

    public function __construct(string $status, int $ts, array $data, string $ch = "")
    {
        $this->status = $status;
        $this->ts = $ts;
        $this->data = $data;
        $this->ch = $ch;

        $this->cn_msg = $this->getCnMsg();
    }

    // getter
    public function getStatus()
    {
        return $this->status;
    }

    public function getTs()
    {
        return $this->ts;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getCh()
    {
        return $this->ch;
    }

    // 判断是否有返回ch
    public function existCh()
    {
        if ($this->ch == "")
        {
            return false;
        }
        return true;
    }

    abstract function getCnMsg();

}