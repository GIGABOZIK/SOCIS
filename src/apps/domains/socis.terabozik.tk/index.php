<?php

date_default_timezone_set('Europe/Moscow');

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

?>
