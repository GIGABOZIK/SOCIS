<?php

namespace app\controllers;

use app\core\Controller;


class ExampleController extends Controller {

    public function indexAction() {
        //` Выполнение перенаправлений
        // $this->view->redirect('https://google.com');

        //` Текст (ранний вывод текста предусматривает отправку заголовков,
        //` что влечет за собой повреждение структуры конечного документа)
        // echo '<hr>/app/controllers/ExampleController :: indexAction()';


        //` Получение данных из БД
        $db_version = $this->model->getVersionDB();
        $db_now = $this->model->getNow();

        //` Создание переменных для шаблонизатора
        $vars = [
            'db_version' => $db_version,
            'db_now' => $db_now,
        ];

        //` Отображение контента страницы (запуск шаблона)
        $this->view->render($title = 'ePage-Index', $vars);

    }

    public function testAction() {
        //` Текст (ранний вывод текста предусматривает отправку заголовков,
        //` что влечет за собой повреждение структуры конечного документа)
        // echo '<hr>/app/controllers/ExampleController :: testAction()';
        
        //` Разное
        // if (!empty($_POST)) {
        // if (!empty($_GET)) {
        if (isset($_GET['test'])) {
            $this->view->message('success', '123123123123');
            $this->view->location('/');
        }

        //` Смена шаблона
        $this->view->layout = 'example';

        //` Смена контента(view) страницы (<controller>/<action>)
        // $this->view->path = 'another/action';

        //` *
        $this->view->render('ePage-Test');
    }
}

?>