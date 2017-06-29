<?php

namespace Dedsimple\Kernel;

use Dedsimple\Routing\Route;
use Dedsimple\Routing\Router;

/**
 * Main app
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class App {

    /**
     * Run the request->response cycle
     *
     * @param array $opts
     * @return void
     */
    public function run($opts = [])
    {
        $route = new Route();
        Router::resolve($route);
    }
}
