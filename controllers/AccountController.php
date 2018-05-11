<?php

namespace controllers;

use core\Controller;

class AccountController extends Controller{

  public function loginAction(){
//      $this->view->redirect('http://google.com.ua');
      if (!empty($_POST)){
          $this->view->location('/');
      }
      $this->view->render('Login');
  }

  public function registerAction(){
      $this->view->render('Registration');
  }
}