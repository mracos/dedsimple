<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\AppRoute;

class AppRouteTest extends TestCase {
    private function appRouteGetRoot()
    {
        return $mockAppRoute = new AppRoute([
            "METHOD" => "GET",
            "URI" => "/",
            "CALLBACK" => function() { return 'ok'; }
        ]);
    }

    public function testCallback()
    {
        $mockAppRoute = $this->appRouteGetRoot();
        $this->assertInstanceOf(\Closure::class, $mockAppRoute->callback);
        $this->assertEquals("ok", call_user_func($mockAppRoute->callback));
    }

    public function testGetRootRoute()
    {
        $this->markTestIncomplete();
        $mockAppRoute = $this->appRouteGetRoot();
    }

}
