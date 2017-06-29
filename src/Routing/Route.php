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
    private $method;

    /**
     * The URI requested
     *
     * @var string
     */
    private $uri;

    /**
     * Builds the Route representation from a $source
     *
     * @param array $source
     */
    abstract function __construct(array $source = []);

    /**
     * Attribute accessor
     *
     * @param string $attribute
     * @return string
     */
    public function __get($attribute)
    {
        return $this->{$attribute};
    }

    public function __set($attribute, $value)
    {
        return $this->{$attribute} = $value;
    }
}
