<?php

namespace Dedsimple\Routing;

use Dedsimple\Routing\Route;

/**
 * Representation of the requested route
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class RequestRoute extends Route {

    /**
     * Constructs a Route representation from the $_SERVER
     *
     *
     * @param array global $server
     */
    public function __construct(array $server = [])
    {
        if (empty($server))
            $server = $_SERVER;

        $this->method = $server["REQUEST_METHOD"];
        $this->uri = $server["PATH_INFO"] ?? '/';
    }
}
