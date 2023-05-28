<?php

namespace app\controllers;

use app\core\Controller;


class ServicesController extends Controller {

    public function indexAction() {
        $this->view->render("Услуги");
    }
}

?>