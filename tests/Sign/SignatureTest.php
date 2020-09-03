<?php

namespace Huobi\Tests\Sign;

use PHPUnit\Framework\TestCase;
use Huobi\Sign\Signature;

class SignatureTest extends TestCase
{

    public function testSignStr()
    {
        $obj = new Signature();
        $obj->setMethod("GET");
        $obj->setDomain("api.huobi.pro");
        $obj->setPath("/v1/order/orders");
        $obj->setParams([
            "AccessKeyId" => "e2xxxxxx-99xxxxxx-84xxxxxx-7xxxx",
            "order-id" => "1234567890",
            "SignatureMethod" => "HmacSHA256",
            "SignatureVersion" => 2,
            "Timestamp" => "2017-05-11T15:19:30"
        ]);

        $this->assertEquals(
            'GET\napi.huobi.pro\n/v1/order/orders\nAccessKeyId=e2xxxxxx-99xxxxxx-84xxxxxx-7xxxx&SignatureMethod=HmacSHA256&SignatureVersion=2&Timestamp=2017-05-11T15%3A19%3A30&order-id=1234567890',
            $obj->signStr()
        );
    }
}