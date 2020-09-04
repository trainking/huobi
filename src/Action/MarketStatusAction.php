<?php

namespace Huobi\Action;

use Huobi\Action\BaseAction;
use Huobi\Action\Result\ResultFactory;

/**
 * 获取当前市场状态，此接口只有正式环境有（2020/09/04）
 * 此节点返回当前最新市场状态。
 * 状态枚举值包括: 1 - 正常（可下单可撤单），2 - 挂起（不可下单不可撤单），3 - 仅撤单（不可下单可撤单）。
 * 挂起原因枚举值包括: 2 - 紧急维护，3 - 计划维护。
 * @path GET /v2/market-status
 * @params 此接口不接受任何参数
 */
class MarketStatusAction extends BaseAction
{
    protected $category_link = "/v2/market-status";
    protected $request_method = "GET";

    /**
     * 返回请求options
     */
    public  function getOptions()
    {
        return [];
    }

    /**
     * 返回Result
     * @param string $jsonStr 返回结果json
     * @return Result
     */
    public function toResult(string $jsonStr)
    {
        $factory = new ResultFactory();
        return $factory->getResult(ResultFactory::API_MARKET_STATUS, $jsonStr);
    }

}
