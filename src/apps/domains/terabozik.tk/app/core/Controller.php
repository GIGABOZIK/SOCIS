<?php

namespace app\core;

abstract class Controller {

    public $routeParams;
    public $view;
    public $model;
    public $acl;

    public function __construct($routeParams) {
        $this->routeParams = $routeParams;

        //` Инициализация данных о сессии
        $this->initSession();

        //` Проверка доступности страницы
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }

        //` Загрузка Отображения
        $this->view = new View($this->routeParams);
        // $this->before();

        //` Загрузка Модели
        $this->model = $this->loadModel($this->routeParams['controller']);

    }

    public function loadModel($controllerName) {
        // $modelClassPath = 'app\\models\\' . ucfirst($controllerName) . 'Model';
        $modelClassPath = 'app\\models\\' . ucfirst($this->routeParams['controller']) . 'Model';
        if (class_exists($modelClassPath)) {
            return new $modelClassPath;
        }
    }

    public function checkAcl() {
        $this->acl = require 'app/acl/' . $this->routeParams['controller'] . 'ACL.php';

        //` v1
        // if ($this->isAcl('all')) {
        //     return true;
        // }
        // if (isset($_SESSION['authorized']['id']) and $this->isAcl('authorized')) {
        //     return true;
        // }
        // if (!isset($_SESSION['authorized']['id']) and $this->isAcl('guest')) {
        //     return true;
        // }
        // if (isset($_SESSION['admin']) and $this->isAcl('admin')) {
        //     return true;
        // }
        // return false;
        // debug($aclFilePath);

        //` v2
        // return (
        //     $this->isAcl('all')
        //     or
        //     $this->isAcl('authorized') and $_SESSION['user']['role']=='authorized'
        //     or
        //     $this->isAcl('guest') and $_SESSION['user']['role']=='guest'
        //     or
        //     $this->isAcl('admin') and $_SESSION['user']['role']=='admin'
        // );

        //` v3
        return ($this->isAcl('all') or $this->isAcl($_SESSION['user']['role']));
    }

    public function isAcl($key) {
        return in_array($this->routeParams['action'], $this->acl[$key]);
    }

    public function initSession() {
        // session_destroy(); //` debug
        
        $currentTime = date("Y-m-d H:i:s");
        // $currentTime = date_create();

        //` Установить идентификатор сессии
        $_SESSION['sessid'] = (isset($_COOKIE['PHPSESSID'])) ? $_COOKIE['PHPSESSID'] : ''; // Записать идентивикатор сессии
        
        //` Информация о пользователе
        if (isset($_SESSION['user'])) {
            //> LogOut ?
            if (isset($_POST['logout'])
                or isset($_GET['logout']) && $_GET['logout'] == 1
                // or (date_diff($currentTime, $_SESSION['user']['last_visited']) > NUM)
            ) unset($_SESSION['user']);
        }
        //> Не объединять в if-else
        if (!isset($_SESSION['user'])) {
            // $uIp = $_SERVER['REMOTE_ADDR']; // ip
            // $uIp = $_SERVER['HTTP_X_REAL_IP']; // ip

            $_SESSION['user'] = [
                'id' => 0,
                'login' => 'Guest',
                'role' => 'guest',
                'ip' => get_ip_list(),
            ];
        }
        $_SESSION['user']['id'] = 999_999_999_999;

        //` История посещений
        //> Сохраняем только несколько страниц в истории посещений
        //>> последняя страница всегда в начале массива
        //>> одна и та же страница подряд не сохраняется
        $_SESSION['history']['last_visited'] = $currentTime;
        $currentURL = $_SERVER['REQUEST_URI']; // . random_int(10, 99);
        if (isset($_SESSION['history']['pages'])) {
            if ($_SESSION['history']['pages'][0] != $currentURL) {
                array_unshift($_SESSION['history']['pages'], $currentURL);
                $historyLimit = 5;
                $_SESSION['history']['pages'] = array_slice($_SESSION['history']['pages'], 0, $historyLimit);
            }
        } else $_SESSION['history']['pages'] = [$currentURL];

        //` Настройки предпочтений
        if (!isset($_SESSION['preferences'])) {
            $_SESSION['preferences'] = [
                // 'language' => 'ru',
                // 'theme' => 'light',
                // 'timezone' => 'UTC',
                // 'notifications' => true,
                // 'currency' => 'RUB',
            ];
        }
        //
    }

}