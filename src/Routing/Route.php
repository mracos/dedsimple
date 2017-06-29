<?php

namespace Dedsimple\Routing;

/**
 * Representation of the requested route
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class Route {
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
     * @param array $server
     */
    public function __construct(array $server = [])
    {
        if (empty($server))
            $server = $_SERVER;

        $this->method = $server["REQUEST_METHOD"];
        $this->uri = $server["PATH_INFO"] ?? '/';
    }

    /**
     * Attribute accessor
     *
     * @param string $attribute
     * @return mixed
     */
    public function __get(string $attribute)
    {
        return $this->{$attribute};
    }

}
