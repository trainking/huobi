<?php

namespace Huobi\Sign;

class Signature
{
    // 请求方法
    private $method;
    
    // domain 小写的访问域名
    private $domain;

    // 访问方法路径
    private $path;

    private $params;

    public function __constrcut(
        string $method = '',
        string $domain = '',
        string $path = '',
        array $params = [])
    {
        $this->setMethod($method);
        $this->setDomain($domain);
        $this->path = $path;
        $this->params = $params;
    }

    // method getter setter
    public function setMethod(string $method)
    {
        if ($method == "GET" || $method == "POST") {
            $this->method = $method;
        }
    }
    public function getMethod()
    {
        return $this->method;
    }

    // domain getter setter
    public function setDomain(string $domain)
    {
        $this->domain = strtolower($domain);
    }
    public function getDomain()
    {
        return $this->domain;
    }

    // path getter setter
    public function setPath(string $path)
    {
        $this->path = $path;
    }
    public function getPath()
    {
        return $this->path;
    }

    // params getter setter
    public function setParams(array $params)
    {
        $this->params = $params;
    }
    public function getParams()
    {
        return $this->params;
    }

    /**
     * 构造签名字符串
     */
    public function signStr()
    {
        $s = '';
        $s = $s.$this->getMethod().'\n';
        $s = $s.$this->getDomain().'\n';
        $s = $s.$this->getPath().'\n';

        $params = $this->getParams();
        ksort($params);
        end($params);
        $last_key = key($params);
        foreach($params as $k=>$v) {
            $s = $s.sprintf("%s=%s", urlencode($k), urlencode($v));
            if ($k != $last_key) {
                $s = $s."&";
            }
        }
        return $s;
    }

    // 返回签名
    public function sign(string $secret_key)
    {
        $_signstr = $this->signStr();
        $_sign = \hash_hmac('sha256', $_signstr, $secret_key);
        return base64_encode($_sign);
    }
}