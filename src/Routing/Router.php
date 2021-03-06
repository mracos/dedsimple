<?php

namespace Dedsimple\Routing;

use Dedsimple\Routing\Route;
use Dedsimple\Kernel\Response;
use Dedsimple\Exceptions\Routing\InvalidMethodName;
use Dedsimple\Exceptions\Routing\UndefinedRoute;


/**
 * Deal with all the things related to routing and resolving
 * routes
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class Router {

    /**
     * The Application defined routes
     *
     * @var array
     * @access public
     */
    static $routes = [];

    /**
     * All the HTTP verbs supported
     *
     * @var array
     */
    const METHODS = [
        "GET", "POST", "PUT", "PATCH", "DELETE"
    ];

    /**
     * Resolve the requested route
     *
     * @param Route $route
     * @return Response
     */
    public static function resolve(Route $route) :Response
    {
        if (self::existsRoute($route)) {
            $route = self::$routes[$route->method][$route->uri];
            $response = new Response($route);
            return $response;
        } else
            throw new UndefinedRoute;
    }

    /**
     * __callStatic to dynamic define routes with the following
     * syntax Router::METHOD('/path', callable $callback);
     *
     * @param string $name
     * @param array $args
     * @return Dedsimple\Routing\Route;
     */
    public static function __callStatic(string $name, array $args) :Route
    {
        if (!self::isMethod($name))
            throw new InvalidMethodName;

        $method = self::normalizeMethodName($name);
        $uri = $args[0];
        $callback = $args[1];

        $source = [
            "REQUEST_METHOD" => $method,
            "PATH_INFO" => $uri,
        ];

        $route = new Route($source);
        $route->callback = $callback;

        self::addRoute($route);
        return $route;
    }

    /**
     * Returns whether $name is a valid HTTP method
     *
     * @param string $name
     * @return bool
     */
    private static function isMethod(string $name) :bool
    {
        return in_array(self::normalizeMethodName($name), self::METHODS);
    }

    /**
     * Returns the normalized (UPPERCASE) method name
     *
     * @param string $method
     * @return string
     */
    private static function normalizeMethodName(string $methodName) :string
    {
        return mb_strtoupper($methodName);
    }

    /**
     * Add the Route to the self::$routes mapping
     *
     * @param Route $route
     * @return void
     */
    private static function addRoute(Route $route)
    {
        if (!$route->isEmpty()) {
            $routes =& self::$routes;

            if (!array_key_exists($route->method, $routes)) {
                $routes[$route->method] = [];
            }

            if (!array_key_exists($route->uri, $routes[$route->method])) {
                $routes[$route->method][$route->uri] = $route;
            }
        }
    }

    /**
     * Tests if a given route exists
     *
     * @param Route $route
     * @return bool
     */
    public static function existsRoute(Route $route) :bool
    {
        return (
            array_key_exists($route->method, self::$routes) &&
            array_key_exists($route->uri, self::$routes[$route->method])
        );
    }
}
