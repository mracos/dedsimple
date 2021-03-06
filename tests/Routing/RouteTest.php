<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\Route;

class RouteTest extends TestCase {

    private function getGetRoute()
    {
        return new Route(["REQUEST_METHOD" => "GET"]);
    }

    private function getGetRootRoute()
    {
        return new Route([
            "REQUEST_METHOD" => "GET",
            "PATH_INFO" => "/"
        ]);
    }

    private function getGetAsdRoute()
    {
        return new Route([
            "REQUEST_METHOD" => "GET",
            "PATH_INFO" => "/asd"
        ]);
    }

    private function getGetRootRouteCallback()
    {
        $route = new Route([
            "REQUEST_METHOD" => "GET",
            "PATH_INFO" => "/",
        ]);
        $route->callback = function () { return 'ok'; };
        return $route;
    }


    /**
     * @covers Route::method
     */
    public function testMethodIsGet()
    {
        $route = $this->getGetRoute();
        $this->assertEquals("GET", $route->method);
    }

    /**
     * @covers Route::uri
     */
    public function testUriIsRoot()
    {
        $route = $this->getGetRootRoute();
        $this->assertEquals("/", $route->uri);
    }

    /**
     * @covers Route::uri
     */
    public function testUriIsAsd()
    {
        $route = $this->getGetAsdRoute();
        $this->assertEquals("/asd", $route->uri);
    }

    /**
     * @covers Route::callback
     */
    public function testCallback()
    {
        $mockRoute = $this->getGetRootRouteCallback();
        $this->assertInstanceOf(\Closure::class, $mockRoute->callback);
        $this->assertEquals('ok', call_user_func($mockRoute->callback));
    }
}
