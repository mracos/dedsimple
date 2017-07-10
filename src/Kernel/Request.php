<?php

namespace Dedsimple\Kernel;

use Dedsimple\Routing\Route;

/**
 * Represent the request that is sent to the browser
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class Request {

    /**
     * @var array
     */
    public $request;

    /**
     * @var Dedsimple\Routing\Route
     */
    public $route;

    /**
     * Constructor
     *
     * @param array $sources
     */
    public function __construct(array $sources = [])
    {
        if(empty($sources)) {
            $sources = [
                $_GET,
                $_POST,
                $_FILES,
                $_REQUEST
            ];
        }

        $this->request = array_merge(...$sources);
        $this->route = new Route();
    }
}
