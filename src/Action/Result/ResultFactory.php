<?php

namespace Huobi\Action\Result;

use Huobi\Action\Result\Result;
use Huobi\Action\Result\QuotesResult;
use Huobi\Action\Result\TransResult;
use Huobi\Action\Result\MarketStatusResult;
use Huobi\Exception\JsonException;

class ResultFactory
{
    // 行情API
    const API_QUOTES = 1;

    // 交易API
    const API_TRANS = 1;

    // 市场状态
    const API_MARKET_STATUS = 3;

    /**
     * Result 工厂方法
     * @param int $apiType API类型
     * @param string $jsonStr 返回的json字符串
     * @return Result 构造好对象
     */
    public function getResult(int $apiType, string $jsonStr)
    {
        $_obj = null;
        $_resutl_arr = \json_decode($jsonStr, true);
        if ( $_code = \json_last_error() != JSON_ERROR_NONE) {
            throw new JsonException($_code);
        }
        if ($apiType == self::API_QUOTES) {
            $_obj = new  QuotesResult(
                $_resutl_arr['status'],
                $_resutl_arr['ts'],
                $_resutl_arr['data'] ?? [],
                $_resutl_arr['ch'] ?? ''
            );
        } elseif ($apiType == self::API_TRANS) {
            $_obj = new TransResult(
                $_resutl_arr['status'],
                $_resutl_arr['ts'],
                $_resutl_arr['data'] ?? [],
                $_resutl_arr['ch'] ?? ''
            );
        } elseif ($apiType == self::API_MARKET_STATUS) {
            $_obj = new MarketStatusResult(
                $_resutl_arr['code'],
                $this->nowMillisecond(),
                $_resutl_arr['data'] ?? [],
                $_resutl_arr['ch'] ?? ''
            );
        }
        
        return $_obj;
    }

    /**
     * 获取当前时间的毫秒级别
     * @return float
     */
    private function nowMillisecond()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf("%.0f", (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }
}