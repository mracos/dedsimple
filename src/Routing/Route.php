<?php

namespace Dedsimple\Routing;


/**
 * Base class for the Route representation
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
abstract class Route {

    /**
     * HTTP verb of the requested URI
     *
     * @var string
     */
    public $method;

    /**
     * The URI requested
     *
     * @var string
     */
    public $uri;

    /**
     * Builds the Route representation from a $source
     *
     * @param array $source
     */
    abstract function __construct(array $source = []);
}
