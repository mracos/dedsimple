<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\Router;
use Dedsimple\Routing\AppRoute;

class RouterTest extends TestCase {

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
