<?php

namespace Dedsimple\Routing;

use Dedsimple\Routing\Route;

/**
 * Representation of the App defined route
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class AppRoute extends Route {

    /**
     * The nickname for the route
     *
     * @var string
     */
    private $nickname;

    /**
     * Constructs a Route representation from the
     * Router::METHOD call
     *
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->method = $args["METHOD"];
        $this->uri = $args["URI"];
    }
}
