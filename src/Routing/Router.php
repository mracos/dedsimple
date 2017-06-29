<?php

namespace Dedsimple\Routing;

use Dedsimple\Routing\Route;

/**
 * Deal with all the things related to routing and resolving
 * routes
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class Router {

    /**
     * Resolve the requested route
     *
     * @param Route $route
     * @return void
     */
    public static function resolve(Route $route)
    {
        dd($route);
    }
}
