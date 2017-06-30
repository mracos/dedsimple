<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\RequestRoute;

class RequestRouteTest extends TestCase {

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
        $mockServer = $this->serverGetRoot();
        $route = new RequestRoute($mockServer);
        $this->assertEquals("GET", $route->method);
    }

    public function testUriIsRoot()
    {
        $mockServer = $this->serverGetRoot();
        $route = new RequestRoute($mockServer);
        $this->assertEquals("/", $route->uri);
    }

    public function testUriIsAsd()
    {
        $mockServer = $this->serverGetAsdPath();
        $route = new RequestRoute($mockServer);
        $this->assertEquals("/asd", $route->uri);
    }
}
