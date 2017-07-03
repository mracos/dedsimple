<?php

namespace Dedsimple;

use Dedsimple\Routing\Route;
use Dedsimple\Routing\Router;

/**
 * Main app
 *
 * @author Marcos Ferreira <merkkp [at] gmail [dot] com>
 */
class App {

    /**
     * The app root path
     *
     * @var string
     */
    public $rootPath;

    /**
     * All the app configurable options
     *
     * @var array
     */
    private $opts;

    /**
     * Run the request->response cycle
     *
     * @param string $rootPath APP root path
     * @param array $opts
     * @return void
     */
    public function run(
        string $rootPath = '',
        array $opts = []
    ) {
        $this->parseRootPath($rootPath);
        $this->parseOpts($opts);
        $this->setDebugOptions();

        $route = new Route();
        $response = Router::resolve($route);

        $response->send();
    }

    /**
     * Set the root path, if empty set it to ../../
     *
     * @param string $rootPath
     * @return void
     */
    public function parseRootPath(string $rootPath)
    {
        if (empty($rootPath)) {
            $this->rootPath = dirname(__DIR__);
        } else {
            $this->rootPath = $rootPath;
        }
    }

    /**
     * Include a file from config/
     *
     * @param string $nameConfig
     * @return void
     */
    public function includeConfig(string $nameConfig)
    {
        $this->opts[$nameConfig] = require_once
            $this->rootPath .  DIRECTORY_SEPARATOR .
            'config' .  DIRECTORY_SEPARATOR .
            "{$nameConfig}.php"
        ;
    }

    /**
     * parseOpts
     *
     * @param array $opts
     * @return void
     */
    private function parseOpts(array $opts) :void
    {
        $this->opts = $opts;
        if (empty($opts)) {
            $this->getOptsFromConfig();
        }
    }

    /**
     * Include all the config files and set its results
     * to the $this->opts array

     * @return void
     */
    private function getOptsFromConfig() :void
    {
        $this->includeConfig('app');
        $this->includeConfig('db');
        $this->includeConfig('routes');
    }

    /**
     * Set to show debug info if DEBUG opt set
     *
     * @return void
     */
    private function setDebugOptions() :void
    {
        $option = empty($this->opts["app"]["DEBUG"]) ? 'Off' : 'On';

        error_reporting(E_ALL);
        ini_set('display_errors', $option);
        ini_set('display_startup_errors', $option);
    }

}
