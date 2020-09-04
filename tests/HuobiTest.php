<?php

namespace Huobi\Tests;

use PHPUnit\Framework\TestCase;
use Huobi\Action\MarketStatusAction;
use Huobi\Action\Result\Result;
use Huobi\Huobi;

class HuobiTest extends TestCase
{
    public function testDoAction()
    {
        $huobi = Huobi::getInstance(Huobi::APP_API);
        $this->assertInstanceOf(Huobi::class, $huobi);
        $action = new MarketStatusAction();
        $result = $huobi->doAction($action);
        $this->assertInstanceOf(Result::class, $result);
        $this->assertEquals("正常", $result->getCnMsg());
    }
}
