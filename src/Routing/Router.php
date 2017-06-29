<?php

namespace Dedsimple\Routing;

use Dedsimple\Routing\Route;
use Dedsimple\Routing\AppRoute;

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
    static $routes;

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
     * @return void
     */
    public static function resolve(Route $route)
    {
        include_once '/home/marcos/dev/mine/dedsimple/config/routes.php';
    }

    /**
     * __callStatic to dynamic define routes with the following
     * syntax Router::METHOD('/path', callable $callback);
     *
     * @param string $name
     * @param array $args
     * @return Dedsimple\Routing\Route;
     */
    public static function __callStatic(string $name, array $args)
    {
        if (self::isMethod($name)) {
            $method = mb_strtoupper($name);
            $uri = $args[0];
            $callback = $args[1];

            $source = [
                "METHOD" => $method,
                "URI" => $uri,
                "CALLBACK" => $callback
            ];

            $route = new AppRoute($source);
            dd($route);
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
        return in_array(mb_strtoupper($name), self::METHODS);
    }
}
