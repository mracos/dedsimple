<?php

namespace Dedsimple\Routing;


/**
 * Route representation
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class Route {

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
     * Builds the Route representation from a $source
     *
     * @param array $source
     * If empty, by default is used the $_SERVER superglobal
     */
    public function __construct(array $source = [])
    {
        if (empty($source))
            $source = $_SERVER;

        $this->method = $source["REQUEST_METHOD"];
        $this->uri = $source["PATH_INFO"] ?? '/';
    }

    /**
     * Check if is an empty Route
     *
     * @return bool
     */
    public function isEmpty() :bool
    {
        return (
            !isset($this->method) && !isset($this->uri)
        );
    }

    /**
     * Call the Route callback
     *
     * @return string
     */
    public function callCallback() :string
    {
        if (is_callable($this->callback))
            return call_user_func($this->callback);
    }
}
