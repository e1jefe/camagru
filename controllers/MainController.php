<?php

namespace controllers;

use core\Controller;

class MainController extends Controller{

    public function indexAction(){
        $vars = [
            'name' => 'Nick',
            'age' => 21,
        ];
        $this->view->render('Main page', $vars);
    }
}
