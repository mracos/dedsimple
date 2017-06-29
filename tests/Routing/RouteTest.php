<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\Route;

class RouteTest extends TestCase {

    private function serverGetRoot()
    {
        return ["REQUEST_METHOD" => "GET"];
    }

    private function serverGetAsdPath()
    {
        return [
            "REQUEST_METHOD" => "GET",
            "PATH_INFO" => "/asd"
        ];
    }

    public function testMethodIsGet()
    {
        $mock_server = $this->serverGetRoot();
        $route = new Route($mock_server);
        $this->assertEquals("GET", $route->method);
    }

    public function testUriIsRoot()
    {
        $mock_server = $this->serverGetRoot();
        $route = new Route($mock_server);
        $this->assertEquals("/", $route->uri);
    }

    public function testUriIsAsd()
    {
        $mock_server = $this->serverGetAsdPath();
        $route = new Route($mock_server);
        $this->assertEquals("/asd", $route->uri);
    }
}
