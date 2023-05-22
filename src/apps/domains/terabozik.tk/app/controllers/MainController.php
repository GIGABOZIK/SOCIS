<?php

namespace app\controllers;

use app\core\Controller;


class MainController extends Controller {

    public function indexAction() {
        $this->view->render("Главная страница");
    }

    public function contactsAction() {
        $this->view->render("Контакты");
    }

    public function servicesAction() {
        $this->view->render("Услуги");
    }

    public function faqAction() {
        $this->view->render("FAQ");
    }

}

?>