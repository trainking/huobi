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

    /**
     * 构造签名字符串
     */
    private function signStr()
    {
        $s = '';
        $s.$this->getMethod()."\n";
        $s.$this->getDomain()."\n";
        $s.$this->getPath()."\n";

        ksort($this->params);
        $last_key = key(end($this->params));
        foreach($this->parasm as $k=>$v) {
            $s.sprintf("%s=%s", urlencode($k), urlencode($v));
            if ($k != $last_key) {
                $s."&";
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