<?php
/**
 * All the routes for the application are defined here
 *
 */

use Dedsimple\Routing\Router;

Router::GET('/', function() {
    return "hello zombie";
});
