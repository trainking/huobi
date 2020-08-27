<?php

namespace Huobi\Exception;

use Huobi\Exception\HbBaseException;

/**
 * 配置异常
 */
class JsonException extends HbBaseException
{
    /*异常code与消息约定 */
    protected $_msg_map = [
        JSON_ERROR_DEPTH => "到达了最大堆栈深度",
        JSON_ERROR_STATE_MISMATCH => "无效或异常的 JSON",
        JSON_ERROR_CTRL_CHAR => "控制字符错误，可能是编码不对",
        JSON_ERROR_SYNTAX => "语法错误",
        JSON_ERROR_UTF8 => "异常的 UTF-8 字符，也许是因为不正确的编码",
        JSON_ERROR_RECURSION => "One or more recursive references in the value to be encoded",
        JSON_ERROR_INF_OR_NAN => "One or more NAN or INF values in the value to be encoded",
        JSON_ERROR_UNSUPPORTED_TYPE => "指定的类型，值无法编码",
        JSON_ERROR_INVALID_PROPERTY_NAME => "指定的属性名无法编码",
        JSON_ERROR_UTF16 => "畸形的 UTF-16 字符，可能因为字符编码不正确"
    ];
}