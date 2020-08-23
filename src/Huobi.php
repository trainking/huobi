<?php

namespace Huobi;

// use GuzzleHttp\Promise\Client;
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
    const DOMIN_API = "https://api.huobi.pro";  // 修改成正确DOMIN

    // AWS-日本优化环境
    const DOMIN_AWS = "https://api-aws.huobi.pro";

    // 正式应用标记
    const APP_API = 1;

    // 测试应用标记
    const APP_DEV = 0;

    // AWS优化环境应用
    const APP_AWS = 2;

    public function __construct($env)
    {
        // $client = new Client();
        // $res = $client->request('OPTIONS', $this->getDomin($env), []);
        // var_dump($res);
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
        $_timeZone = new \DateTimeZone("UTC");
        $_dateTime = new \DateTime();
        $_dateTime->setTimezone($_timeZone);
        return $_dateTime->format("Y-m-d\TH:i:s");
    }
}