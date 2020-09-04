<?php

namespace Huobi\Action;

use Huobi\Action\Action;

abstract class BaseAction implements Action
{

    /**
     * 分类链接, 为空时代表未遵循接口
     * 1. 基础类 /v1/common/ 基础类接口，包括币种、币种对、时间戳等接口
     * 2. 行情类 /market/ 公共行情类接口，包括成交、深度、行情等
     * 3. 账户类 /v1/account/ /v1/subuser/ 账户类接口，包括账户信息，子用户等
     * 4. 订单类 /v1/order/ 订单类接口，包括下单、撤单、订单查询、成交查询等
     * 5. 逐仓杠杆类 /v1/margin/ 逐仓杠杆类接口，包括借币、还币、查询等
     * 6. 全仓杠杆类接口 /v1/cross-margin/ 全仓杠杆类接口，包括借币、还币、查询等
     */
    protected $category_link = "";

    /**
     * 请求方法，目前只有两种 GET POST
     * 1. GET请求：所有的参数都在路径参数里
     * 2. POST请求，所有参数以JSON格式发送在请求主体（body）里
     */
    protected $request_method = "GET";


    /**
     * 返回请求方法
     * @return string 请求犯法 GET|POST...
     */
    public function getMethod()
    {
        return $this->request_method;
    }

    /**
     * 拼接好的请求链接
     * @param string $domin 环境对应的domin
     * @return string uri
     */
    public function getUri(string $domin) 
    {
        return $domin.$this->category_link;
    }

    // 交给子类实现
    abstract function getOptions();
    abstract function toResult(string $jsonStr);
}