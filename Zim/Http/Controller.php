<?php
/**
 * File Controller.php
 * @henter
 * Time: 2018-11-24 20:07
 *
 */

namespace Zim\Http;

use Zim\Traits\InjectContainer;

class Controller
{
    use InjectContainer;

    protected static $method;

    protected $actions = [];

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->app('request');
    }

    /**
     * @param $uri
     * @return mixed|null
     */
    public function getActionClass($uri)
    {
        return $this->actions[$uri] ?? null;
    }

    /**
     * @param $uri
     * @return null
     */
    public function getAction($uri)
    {
        if (method_exists($this, $uri.'Action')) {
            return $uri.'Action';
        }

        foreach (get_class_methods($this) as $method) {
            if (strtolower($method) == strtolower($uri).'action') {
                return $method;
            }
        }
        return null;
    }

    public function getActions()
    {
        return $this->actions;
    }

}