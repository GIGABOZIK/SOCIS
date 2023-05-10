<?php

// //? Установка конфигурации
// define('APP_PATH', __DIR__ . '/app/');
// define('CONTROLLER_PATH', APP_PATH . 'controllers/');
// define('MODEL_PATH', APP_PATH . 'models/');
// define('VIEW_PATH', APP_PATH . 'views/');

// Подключение дополнительных функций
require_once 'app/lib/dev.php';
// require_once APP_PATH . '/lib/dev.php';

// use app\core\Router;

//? Функция автозагрузки классов
spl_autoload_register(function($class) {
    // Получаем путь к файлу из имени класса
    $path = str_replace('\\', '/', $class.'.php');
    // Если в текущей папке есть такой файл, то выполняем код из него
    if (file_exists($path)) require_once $path;
});

use app\core\Router;

//? Запуск приложения
session_start();
$router = new Router;
$router->run();

/*
& Схема фреймворка (потом дополнительно подписать все нумерованным списком)
! index.php
# $router = new Router (app/core/Router.php)
    > app/config/routes.php (файл return [])
    >> addRoute(.,.) : $$routes[] - Все маршруты
# $router->run()
    > match() : $$routeParams[] - Параметры запрошенного маршрута
    >> exists - app/controllers/`Controller`Controller (файл-класс Обработчика)
    >>> exists `action`Action (Метод Обработчика)
        > (если что-либо из предыдущего не существует, то View::errorCode(404))
            > http_response_code(`code`)
            > exists-require 'app/views/errors/`code`.php
        >> иначе:
    ## $ctrl = new `Controller`Controller($$routeParams) (app/controllers/`Controller`Controller.php)
        > checkACL()
            > app/acl/`controller`ACL.php (файл return [])
            >> $ctrl->isACL(.)
        ### $$view = new View($$routeParams) (app/core/View.php)
            > $$viewPath = `controller`/`action`               (не сам файл чот) !!!!!!! мб исправить
        ### $$model = loadModel(`controller`) // new `Controller`Model
            > exists - app/models/`Controller`Model (файл-класс Модели)
            >> return new `Controller`Model
                > $$db = new Db (app/lib/Db.php)
    ## $ctrl->`action`Action()
        > любые действия:
            >> $$view->path = 'ctrl/action'
            >> $$view->layout = 'custom'
            >> $$view->redirect('url')
            >> Для ajax:
            >>> $$view->location('/controller/action')
            >>> $$view->message('status', 'message')
            ### $$model->getSmth() (любая функция получения чего-либо из БД)
                > return $result
        > $vars = [можно использовать $result]
        ### $$view->render('Заголовок', $vars)
            > extract($vars)
            > exists $viewFilePath = app/views/`controller`/`action`.php (файл Отображения)
            >> $content = буффер $viewFilePath
            >>> require 'app/views/layouts/`$$layout`.php - Вывод шаблона (+$content)
# Всякое дополнительное что-то
    > Вывод инфы для отладки (только test)
    > Чота еще
*/

//% kek
// require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/GCore.php';
// $gc = new GCore('MAIN');
// $gc
echo '<hr>';
include 'temp_info.php';

?>
