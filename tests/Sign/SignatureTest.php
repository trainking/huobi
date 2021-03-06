<?php

namespace Huobi\Tests\Sign;

use PHPUnit\Framework\TestCase;
use Huobi\Sign\Signature;

class SignatureTest extends TestCase
{

    protected $signature;

    protected function setUp() :void
    {
        parent::setUp();
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
        $this->signature = $obj;
    }

    public function testSignStr()
    {
        $this->assertEquals(
            'GET\napi.huobi.pro\n/v1/order/orders\nAccessKeyId=e2xxxxxx-99xxxxxx-84xxxxxx-7xxxx&SignatureMethod=HmacSHA256&SignatureVersion=2&Timestamp=2017-05-11T15%3A19%3A30&order-id=1234567890',
            $this->signature->signStr()
        );
    }

    public function testSign()
    {
        $this->assertEquals(
            'NTI4YzJlODE2ZmU0OTFkYjYwZDBlOWUxMzc3MGYxMTYwZGQ0Y2I0M2Y5NjNlZDdlMTJkNzkyNzE3MjQxMWY3Yw==',
            $this->signature->sign('abcdasjfalsfdjlas')
        );
    }

    protected function tearDown() :void
    {
        $this->signature = null;
    }
}