<?php

namespace Huobi\Action\Result;

use Huobi\Action\Result\Result;

class TransResult extends Result
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
            case 'base-symbol-error':
                $_msg = "交易对不存在";
                break;
            case 'base-currency-error':
                $_msg = "币种不存在";
                break;
            case 'base-date-error':
                $_msg = "错误的日期格式";
                break;
            case 'account-transfer-balance-insufficient-error':
                $_msg = "余额不足无法划转";
                break;
            case 'account-frozen-balance-insufficient-error':
                $_msg = "余额不足无法冻结";
                break;
            case 'bad-argument':
                $_msg = "无效参数";
                break;
            case 'api-signature-not-valid':
                $_msg = "API签名错误";
                break;
            case 'gateway-internal-error':
                $_msg = "系统繁忙，请稍后再试";
                break;
            case 'ad-ethereum-addresss':
                $_msg = "请输入有效的以太坊地址";
                break;
            case 'order-accountbalance-error':
                $_msg = "账户余额不足";
                break;
            case 'order-limitorder-price-error':
                $_msg = "限价单下单价格超出限制";
                break;
            case 'order-limitorder-amount-error':
                $_msg = "限价单下单数量超出限制";
                break;
            case 'order-orderprice-precision-error':
                $_msg = "下单价格超出精度限制";
                break;
            case 'order-orderamount-precision-error':
                $_msg = "下单数量超过精度限制";
                break;
            case 'order-marketorder-amount-error':
                $_msg = "下单数量超出限制";
                break;
            case 'order-queryorder-invalid':
                $_msg = "查询不到此条订单";
                break;
            case 'order-orderstate-error':
                $_msg = "订单状态错误";
                break;
            case 'order-datelimit-error':
                $_msg = "查询超出时间限制";
                break;
            case 'order-update-error':
                $_msg = "订单更新出错";
                break;
        }
        // 特别处理accout-id错误
        if ($_msg == "") {
            if (strpos($this->status, "account for id") !== false) {
                $this->cn_msg = "account-id 错误，请使用GET /v1/account/accounts 接口查询";
            }
        }
        $this->cn_msg = $_msg;
        return $_msg;
    }
}