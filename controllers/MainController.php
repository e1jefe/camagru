<?php
namespace controllers;
use core\Controller;
use lib\Pagination;
use models\Admin;
class MainController extends Controller {
    /**
     *
     */
    public function indexAction() {
        $vars = $this->model->getPics();
        $this->view->render('index', $vars);

    }
    public function authorizeAction(){

    }
    public function privacyAction() {
                $this->view->render('privacy');
    }
}