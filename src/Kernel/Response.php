<?php

namespace Dedsimple\Kernel;

use Dedsimple\Routing\Route;

/**
 * Represents the response that is sent to the browser
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class Response {

    /**
     * The headers that is sent to the browser
     *
     * @var string
     */
    private $headers;

    /**
     * The content to display
     *
     * @var string
     */
    private $content;

    /**
     * Constructor
     *
     * @param Dedsimple\Routing\Route $route
     * @param array $headers
     */
    public function __construct(Route $route, array $headers = [])
    {
        $this->content = call_user_func($route->callback);
    }

    /**
     * Send the content with the headers
     *
     * @return void
     */
    public function send()
    {
        echo $this->content;
    }
}
