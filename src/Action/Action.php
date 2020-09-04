<?php

namespace Huobi\Action;

/**
 * 操作接口，抽取接口共有特性
 */
interface Action 
{
    // 执行方法
    function getMethod();
    function getUri(string $domin);
    function getOptions();
    function toResult(string $jsonStr);
}