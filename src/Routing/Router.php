<?php

namespace Dedsimple\Routing;

use Dedsimple\Routing\Route;
use Dedsimple\Routing\AppRoute;
use Dedsimple\Kernel\Response;


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
        include_once '/home/marcos/dev/mine/dedsimple/config/routes.php';

        $appRoute = self::$routes[$route->method][$route->uri];
        $response = new Response($appRoute);
        return $response;
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
        if (self::isMethod($name)) {
            $method = self::normalizeMethodName($name);
            $uri = $args[0];
            $callback = $args[1];

            $source = [
                "METHOD" => $method,
                "URI" => $uri,
                "CALLBACK" => $callback
            ];

            $route = new AppRoute($source);
            self::addRoute($route);
            return $route;
        } else {
            return new AppRoute();
        }
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
}
