<?php

namespace app\core;

class Router {

    protected $routes = [];
    protected $routeParams = [];

    public function __construct() {
        $routesArr = require 'app/config/routes.php';
        foreach ($routesArr as $key => $val) {
            $this->addRoute($key, $val); //& $key='route'; $val=['controller'=>'*', 'action'=>'*']
        }
        // debug($routesArr);
    }

    public function addRoute($route, $routeParams) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $routeParams;
    }

    public function match() {
        $url = parse_url($_SERVER['REQUEST_URI'])['path']; //` Убрать часть GET
        // echo($url);
        $url = trim($url, '/'); //? удаляет лишние '/' в начале и в конце строки
        //
        //
        // $url = trim($_SERVER['REQUEST_URI'], '/'); //? удаляет лишние '/' в начале и в конце строки
        // echo parse_url($_SERVER['REQUEST_URI']);
        // printArray(parse_url($_SERVER['REQUEST_URI']));
        // $url = parse_url($url)['path']; //` Убрать часть GET
        foreach ($this->routes as $route => $routeParams) {
            // if (preg_match($route, $url)) {
            if (preg_match($route, $url, $matches)) {
                //? что-то с $matches будет еще
                // printArray($matches);
                $this->routeParams = $routeParams; //? В свойство записываются только конкретные параметры
                return true;
            }
        }
        return false;
    }

    public function run() {
        if ($this->match()) {
            $classControlPath = 'app\\controllers\\' . ucfirst($this->routeParams['controller']) . 'Controller'; //? Имя класса-обработчика
            if (class_exists($classControlPath)) {
                $paramAction = $this->routeParams['action'] . 'Action'; //? Имя метода в обработчике
                if (method_exists($classControlPath, $paramAction)) {
                    $ctrl = new $classControlPath($this->routeParams);
                    $ctrl->$paramAction(); //? Выполнение выбранного метода
        //!
                    return;
                } else echo 'wrong action';
            } else echo 'wrong controller';
        } else echo 'wrong route';
        View::errorCode(404);
        //!
                // } else View::errorCode(404);
            // } else View::errorCode(404);
        // } else View::errorCode(404);
        //!
        //         } else echo 'Не найдено действие: ' . $action;
        //     } else echo 'Не найден обработчик: ' . $path;
        // } else echo 'Не найден маршрут';
        // echo 'start';
    }

}

?>