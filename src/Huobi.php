<?php

namespace Huobi;

use GuzzleHttp\Client;
use Huobi\Exception\ConfigException;

/**
 * main
 * 1. 实现构建请求
 * 2. 检测网络
 * 3. 创建指定分类
 */
class Huobi
{

    // 测试环境Domin
    const DOMIN_DEV = "http://api.testnet.huobi.pro";

    // 正式应用
    const DOMIN_API = "https://www.baidu.com/";  // TODO 修改成正确DOMIN

    // 正式应用标记
    const APP_API = 1;

    // 测试应用标记
    const APP_DEV = 0;

    public function __construct($env)
    {
        $client = new Client();
        $res = $client->request('OPTIONS', $this->getDomin($env), []);
        var_dump($res);
    }

    private function getDomin($env)
    {
        $_domin = null;
        switch ($env) {
            case self::APP_API:
                $_domin = self::DOMIN_API;
                break;
            case self::APP_DEV:
                $_domin = self::DOMIN_DEV;
                break;
            default:
                throw new ConfigException(ConfigException::ERROR_ENV);
                break;
        }
        return $_domin;
    }

    public function getDate()
    {
        return date("Y-m-d H:i:s");
    }
}