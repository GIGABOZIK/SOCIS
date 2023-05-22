<?php

namespace app\controllers;

use app\core\Controller;


class AccountController extends Controller {

    public function adminAction() {
        $_SESSION['user']['id'] = 1;
        // printArray($_SESSION['user']); exit;
    }

    public function indexAction() {
        switch ($_SESSION['user']['role_name']) {
            case 'guest':
                $this->view->redirect('/account/login');
                // $this->view->redirect('/account/signup');
            break;
            default:
                $this->view->redirect('/account/profile');
        }
    }

    public function signupAction() {
        if (!empty($_POST)) {
            $response = $this->model->userSignUp($_POST);
            if ($response['status'] == 'Success') {
                $this->view->location('/account?auth=1');
            } else $this->view->message($response['status'], $response['message']);
        }
        $this->view->render('Регистрация');
    }

    public function loginAction() {
        if (!empty($_POST)) {
            $response = $this->model->userSignIn($_POST);
            if ($response['status'] == 'Success') {
                $this->view->location('/account?auth=1');
                // $this->view->message('Отлично!', 'Авторизован');
            } else $this->view->message($response['status'], $response['message']);
        }
        $this->view->render('Авторизация');
    }

    public function profileAction() {
        $this->view->render('Профиль');
    }

}

?>