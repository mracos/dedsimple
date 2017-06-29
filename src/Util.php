<?php
/**
 * Utility functions used everywhere
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */

/**
 * "pretty" var_dump
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
}
