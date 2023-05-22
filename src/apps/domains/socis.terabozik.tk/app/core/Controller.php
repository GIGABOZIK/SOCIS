<?php

namespace app\core;

use app\core\Model;


abstract class Controller {

    public $routeParams;
    public $view;
    public $model;
    public $acl;

    public function __construct($routeParams) {
        $this->routeParams = $routeParams;

        //` Инициализация данных в сессии
        // session_destroy(); //! debug
        $_SESSION['sessid'] = (isset($_COOKIE['PHPSESSID'])) ? $_COOKIE['PHPSESSID'] : ''; //` Установить идентификатор сессии
        $this->initUserDefault();
        $this->initHistory(5);
        $this->initPreferences();

        //` Проверка доступности страницы
        if (!$this->checkAcl()) {
            View::errorCode(403);
            exit; //!
        }

        //` Загрузка Отображения
        $this->view = new View($this->routeParams);

        //` Загрузка Модели
        $this->model = $this->loadModel($this->routeParams['controller']);
    }

    public function checkAcl() {
        $this->acl = require 'app/acl/' . $this->routeParams['controller'] . 'ACL.php';
        return (
            in_array($this->routeParams['action'], $this->acl['all'])
            or
            in_array($this->routeParams['action'], $this->acl[($_SESSION['user']['role_name'])])
        );
    }

    public function loadModel($controllerName) {
        $modelClassPath = 'app\\models\\' . ucfirst($controllerName) . 'Model';
        // $modelClassPath = 'app\\models\\' . ucfirst($this->routeParams['controller']) . 'Model';
        if (class_exists($modelClassPath)) {
            return new $modelClassPath;
        }
    }


    public function initUserDefault() {
        //>> Информация о пользователе
        if (isset($_SESSION['user'])) {
            if (
                isset($_POST['logout'])
                or isset($_GET['logout']) and $_GET['logout'] == 1
                // or (date_diff($currentTime, $_SESSION['user']['last_visited']) > NUM)
            ) unset($_SESSION['user']);
        }
        //! Не объединять в if-else
        if (!isset($_SESSION['user'])) {
            //` В Model аналогичные действия
            $_SESSION['user'] = [
                'id' => 0,
                'login' => 'Guest',
                'role_name' => 'guest',
                // 'ip' => get_ip_list(),
            ];
            // $_SESSION['user']['id'] = 999_999_999_999;
        }
    }

    public function initHistory($historyLimit = 5) {
        //>> История посещений
        // $_SESSION['history']['last_visited'] = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
        $_SESSION['history']['last_visited'] = $_SERVER['REQUEST_TIME'];
        $currentURL = $_SERVER['REQUEST_URI']; // . random_int(10, 99);
        if (isset($_SESSION['history']['pages'])) {
            if ($_SESSION['history']['pages'][0] != $currentURL) {
                array_unshift($_SESSION['history']['pages'], $currentURL);
                $_SESSION['history']['pages'] = array_slice($_SESSION['history']['pages'], 0, $historyLimit);
            }
        } else $_SESSION['history']['pages'] = [$currentURL];
    }

    public function initPreferences() {
        //>> Настройки предпочтений
        if (!isset($_SESSION['preferences'])) {
            $_SESSION['preferences'] = [
                // 'language' => 'ru',
                // 'theme' => 'light',
                // 'timezone' => 'UTC',
                // 'notifications' => true,
                // 'currency' => 'RUB',
            ];
        }
    }


}