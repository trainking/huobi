<?php

namespace Huobi\Action\Result;

use Huobi\Action\Result\Result;
use Huobi\Action\Result\QuotesResult;
use Huobi\Action\Result\TransResult;
use Huobi\Excetion\JsonException;

class ResultFactory
{
    // 行情API
    const API_QUOTES = 1;

    // 交易API
    const API_TRANS = 1;

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
                $_resutl_arr['data'],
                $_resutl_arr['ch'] ?? ''
            );
        } elseif ($apiType == self::API_TRANS) {
            $_obj = new JsonException(
                $_resutl_arr['status'],
                $_resutl_arr['ts'],
                $_resutl_arr['data'],
                $_resutl_arr['ch'] ?? ''
            );
        } else {
            // TODO 其他
        }
        
        return $_obj;
    }
}