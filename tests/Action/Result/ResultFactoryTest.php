<?php

namespace Huobi\Tests\Action\Result;

use PHPUnit\Framework\TestCase;
use Huobi\Action\Result\Result;
use Huobi\Action\Result\ResultFactory;
use Huobi\Exception\HbBaseException;

class ResultFactoryTest extends TestCase
{

    public function testGetResult()
    {
        $factory = new ResultFactory();
        try {
            $_obj = $factory->getResult(
                ResultFactory::API_TRANS,
                "{\"status\":\"ok\",\"ch\":\"market.btcusdt.kline.1day\",\"ts\":1499223904680,\"data\":null}"
            );
        } catch (\HbBaseException $th) {
            echo $th;
        }

        // 是否是result的子类
        $this->assertInstanceOf(Result::class, $_obj);
        $this->assertEquals("ok", $_obj->getStatus());
    }

}
