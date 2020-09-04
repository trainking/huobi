<?php

namespace Huobi;

use GuzzleHttp\Client;
use Huobi\Action\Action;
use Huobi\Action\Result\Result;
use Huobi\Exception\ConfigException;

/**
 * main  使用单例
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

    private $client = null;

    private $domin = "";

    private static $instance = null;

    private function __construct(int $env) 
    {
        $this->domin = $this->getDomin($env);
        $this->client = new Client();
    }

    private function __clone() {}

    private function getDomin(int $env)
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

    /**
     * 单例出口
     * @param int $env 应用标记
     * @return Huobi 单例实现
     */
    final public static function getInstance(int $env) 
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }

        self::$instance = new self($env);
        return self::$instance;
    }

    /**
     * 执行调用
     * @param Action $action 接口实例
     * @return Result 返回结构化返回
     */
    public function doAction(Action $action)
    {
        $this->clent->request($action->getMethod(), $action->getUri(), $action->getOptions());
    }

    public function getDate()
    {
        $_timeZone = new \DateTimeZone("UTC");
        $_dateTime = new \DateTime();
        $_dateTime->setTimezone($_timeZone);
        return $_dateTime->format("Y-m-d\TH:i:s");
    }
}