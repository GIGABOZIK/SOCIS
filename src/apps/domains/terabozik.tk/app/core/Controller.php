<?php

namespace app\core;

abstract class Controller {

    public $routeParams;
    public $view;
    public $model;
    public $acl;

    public function __construct($routeParams) {
        $this->routeParams = $routeParams;
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->view = new View($routeParams);
        // $this->before();
        $this->model = $this->loadModel($routeParams['controller']);
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
        //& Оптимизировать код
        if ($this->isAcl('all')) {
            return true;
        }
        if (isset($_SESSION['authorized']['id']) and $this->isAcl('authorized')) {
            return true;
        }
        if (!isset($_SESSION['authorized']['id']) and $this->isAcl('guest')) {
            return true;
        }
        if (isset($_SESSION['admin']) and $this->isAcl('admin')) {
            return true;
        }
        return false;
        // debug($aclFilePath);
    }

    public function isAcl($key) {
        return in_array($this->routeParams['action'], $this->acl[$key]);
    }

}