<?php

namespace app\controllers;

use app\core\Controller;


class AccountController extends Controller {

    // public function before() {
    //     $this->view->layout = 'custom';
    // }

    public function indexAction() {
        //
        // echo 'accountIndex';
        $this->view->render('Аккаунт');
    }

    public function loginAction() {
        // echo 'LOGIN';
        // $this->view->redirect('https://google.com');

        if (!empty($_POST)) {
            $this->view->message('success))', '123123123123');
            // $this->view->location('/account/signup');
        }

        $this->view->render('Вход');
    }

    public function signupAction() {
        // echo 'SIGNUP';
        $this->view->render('Регистрация');
    }
}

?>