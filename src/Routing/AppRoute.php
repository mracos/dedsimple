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
    public $nickname;

    /**
     * The callback to execute when matched to a URI
     *
     * @var callable
     */
    public $callback;

    /**
     * Constructs a Route representation of a app defined route
     * from the Router::METHOD call
     *
     * @param array $source
     */
    public function __construct(array $source = [])
    {
        if (!empty($source)) {
            $this->method = $source["METHOD"];
            $this->uri = $source["URI"];
            $this->callback = $source["CALLBACK"];
        }
    }

}
