<?php

namespace app\controllers;

use app\core\Controller;


class MainController extends Controller {

    public function indexAction() {
        // echo 'MAIN ACTION';

        // $vars = [
        //     'name' => 'Вася',
        //     'age' => '22',
        //     'array' => [1, 2, 3],
        // ];

        // $db = new Db;

        // $params = [
            // 'id' => 2,
        // ];

        // $data = $db->column('SELECT `name` FROM `users` WHERE `id`=2;');
        // $data = $db->row('SELECT * FROM `users`;');
        // $data = $db->column('SELECT `name` FROM `users` WHERE `id` = :id', $params);
        // debug($data);

        // $this->view->redirect('https://google.com');

        // if (!empty($_POST)) {
            // $this->view->message('success))', '123123123123');
        //     $this->view->location('/account/signup');
        // }

        // $this->view->path = 't/t';
        // $this->view->layout = 'custom';

        $result = $this->model->getSmth();
        $vars = [
            'news' => $result,
        ];

        $this->view->render('Главная страница', $vars);
        // $this->view->render($title = 'Главная страница');
    }

}

?>