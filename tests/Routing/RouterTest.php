<?php

namespace Dedsimple\Tests\Routing;

use PHPUnit\Framework\TestCase;

use Dedsimple\Routing\Router;
use Dedsimple\Routing\Route;

class RouterTest extends TestCase {

    public function tearDown()
    {
        Router::$routes = [];
    }

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
        $this->assertEquals("root", $route->callCallback());
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

        $this->assertCount(2, Router::$routes['GET']);
        $this->assertCount(2, Router::$routes['POST']);

        $this->assertEquals('get/', Router::$routes['GET']['/']->callCallback());
        $this->assertEquals('get/asd', Router::$routes['GET']['/asd']->callCallback());
        $this->assertEquals('post/', Router::$routes['POST']['/']->callCallback());
        $this->assertEquals('post/asd', Router::$routes['POST']['/asd']->callCallback());
    }

    private function getAsdRoute()
    {
        return new Route([
            'REQUEST_METHOD' => 'GET',
            'PATH_INFO' => '/asd',
        ]);

    }

    /**
     * @covers Router::resolve
     * @uses Response::send
     */
    public function testResolveExistentRoute()
    {
        Router::GET('/asd', function() { return 'asd'; });

        $route = $this->getAsdRoute();
        $response = Router::resolve($route);
        $response->send();
        $this->expectOutputString('asd');
    }


    /**
     * @covers Router::resolve
     * @expectedException Dedsimple\Exceptions\Routing\UndefinedRoute
     */
    public function testResolveInexistentRoute()
    {
        $route = $this->getAsdRoute();
        Router::resolve($route);
    }

}
