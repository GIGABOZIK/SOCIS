<?php

namespace app\core;

class View {

    public $viewPath;
    public $routeParams;
    public $layout = 'default';

    public function __construct($routeParams) {
        $this->routeParams = $routeParams;
        $this->viewPath = $routeParams['controller'] . '/' . $routeParams['action'];
        // debug($this->viewPath);
    }

    public function render($title, $vars = []) {
        extract($vars); //? Выносит элементы массива в отдельные переменные с именем ключа
        $viewFilePath = 'app/views/' . $this->viewPath . '.php';
        if (file_exists($viewFilePath)) {
            //? Сборка буфера вывода контента (типа prepare)
            ob_start();
            require $viewFilePath;
            $content = ob_get_clean(); //& Здесь можно наверн заменить на мою систему генерации страницы
            //? Конец буферизации
            require 'app/views/layouts/' . $this->layout . '.php'; //? Вывод выбранного шаблона
        }
        // else $this::errorCode(404); //!
        // } else echo 'Не найдено отображение: ' . $this->viewPath;
    }

    public function redirect($url) {
        header('location: ' . $url);
        exit;
    }

    public static function errorCode($code) {
        http_response_code($code);
        //& ПОТОМ ПОМЕНЯТЬ СИСТЕМУ ТУТ (Обрабатывать с помощью htaccess)
        $errorViewFilePath = 'app/views/errors/' . $code . '.php';
        if (file_exists($errorViewFilePath)) {
            require $errorViewFilePath;
        }
        // exit; //!
    }

    //& Для ajax js
    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }
    public function location($url) {
        exit(json_encode(['url' => $url]));
    }

}
