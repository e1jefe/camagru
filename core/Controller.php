<?php


namespace core;

use \core\View;

abstract class Controller
{

    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        debug($this->checkAcl());
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = '\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }
    }

    public function checkAcl()
    {
        $acl = require 'acl/' . $this->route['controller'] . '.php';
        if ($this->isAcl('all')) {
            return true;
        }
    }
    public function isAcl($key){
        return in_array($this->route['action'], $acl[$key]);
    }

}