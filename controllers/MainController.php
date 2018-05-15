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
        $pagination = new Pagination($this->route, $this->model->postsCount());
//        $i = 0;
        $vars = $this->model->getPics();
//        while ($i < count($arr))
//            {
//                    $vars[] = ($arr[$i]['source']);
//                $i++;
//            }
//            print_r($vars);
//        $vars = [
//            'src' => $vars,
//        ];
        $this->view->render('index', $vars);
    }
    public function aboutAction() {
        $this->view->render('Обо мне');
    }
    public function contactAction() {
        if (!empty($_POST)) {
            if (!$this->model->contactValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            mail('dmitry.sheptun@gmail.com', 'Сообщение из блога', $_POST['name'].'|'.$_POST['email'].'|'.$_POST['text']);
            $this->view->message('success', 'Сообщение отправлено Администратору');
        }
        $this->view->render('Контакты');
    }
    public function postAction() {
        $adminModel = new Admin;
        if (!$adminModel->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $vars = [
            'data' => $adminModel->postData($this->route['id'])[0],
        ];
        $this->view->render('Пост', $vars);
    }
    public function authorizeAction(){

    }
}