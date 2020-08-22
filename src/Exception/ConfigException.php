<?php

namespace Huobi\Exception;

use Huobi\Exception\HbBaseException;

/**
 * 配置异常
 */
class ConfigException extends HbBaseException
{

    /*异常code定义*/
    const ERROR_ENV = 1001;

    /*异常code与消息约定 */
    protected $_msg_map = [
        self::ERROR_ENV => "error env config.check ENV!"
    ];
}