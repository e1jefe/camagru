<?php


namespace core;


 class View
 {

     public $path;
     public $route;
     public $layout = 'default';

     public function __construct($route)
     {
         $this->route = $route;
         $this->path = $route['controller'] . '/' . $route['action'];
     }

     public function render($title, $vars = [])
     {
         extract($vars);
         ob_start();
         require 'views/' . $this->path . '.php';
         $content = ob_get_clean();
         require 'views/layouts/' . $this->layout . '.php';
     }
 }