<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\Router;
use Dedsimple\Routing\AppRoute;

class RouterTest extends TestCase {

    public function testAddRoute()
    {
        $mockAppRoute = new AppRoute([
            "METHOD" => "GET",
            "URI" => "/",
            "CALLBACK" => function() { return 'ok'; }
        ]);

        Router::addRoute($mockAppRoute);
        $this->assertInstanceOf(
            AppRoute::class,
            Router::$routes["GET"]["/"]
        );
    }

    public function testDefineInvalidMethodRoute()
    {
        $this->markTestIncomplete();
    }

    public function testDefineGetRoute()
    {
        Router::GET('/', function() { return 'root'; });
        $route = Router::$routes["GET"]["/"];

        $this->assertArrayHasKey("GET", Router::$routes);
        $this->assertArrayHasKey("/", Router::$routes["GET"]);

        $this->assertInstanceOf(AppRoute::class, $route);
        $this->assertEquals("root", call_user_func($route->callback));
    }

    public function testResolveExistentRoute()
    {
        $this->markTestIncomplete();
    }

    public function testResolveInexistentRoute()
    {
        $this->markTestIncomplete();
    }

}
