<?php
/**
 * Utility functions used everywhere
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */

/**
 * "pretty" var_dump && die
 *
 * @param mixed $dumped
 * @global
 * @return void
 */
function dd($dumped)
{
    echo "<pre>";
    var_dump($dumped);
    echo "</pre>";
    die();
}

/**
 * Get data from enviroments variables
 *
 * @param string $key
 * @param string $default
 * @global
 * @return mixed
 */
function env(string $key, string $default = '')
{
    $env = getenv($key);
    return empty(getenv($key)) ? $default : getenv($key);
}
