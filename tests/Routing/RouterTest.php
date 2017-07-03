<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\Router;
use Dedsimple\Routing\Route;

class RouterTest extends TestCase {

    /**
     * @covers Router::_callStatic
     * @expectedException Dedsimple\Exceptions\Routing\InvalidMethodName
     */
    public function testDefineInvalidMethodRouteThrowsException()
    {
        Router::INVALID('/', function() { return 'invalid'; });
    }

    /**
     * @covers Router::_callStatic
     */
    public function testDefineGetRootRoute()
    {
        Router::GET('/', function() { return 'root'; });
        $route = Router::$routes["GET"]["/"];

        $this->assertArrayHasKey("GET", Router::$routes);
        $this->assertArrayHasKey("/", Router::$routes["GET"]);

        $this->assertInstanceOf(Route::class, $route);
        $this->assertEquals("root", call_user_func($route->callback));
    }

    /**
     * @covers Router::_callStatic
     */
    public function testDefineMultipleRoutes()
    {
        Router::GET('/', function() { return 'get/'; });
        Router::GET('/asd', function() { return 'get/asd'; });
        Router::POST('/', function() { return 'post/'; });
        Router::POST('/asd', function() { return 'post/asd'; });

        $this->assertCount(2, Router::$routes);
        $this->assertCount(2, Router::$routes["GET"]);
        $this->assertCount(2, Router::$routes["POST"]);
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
