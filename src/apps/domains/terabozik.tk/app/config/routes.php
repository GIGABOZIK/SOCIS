<?php

/*
# Для каждого маршрута необходимо создать:
> Запись самого маршрута в этом файле (указать controller и action)
    @ /config/routes.php
    > Обработчик (контроллер) (может быть один для нескольких маршрутов) (файл-класс)
        @ /controllers/`Controller`Controller.php
    > Поведение (действие) в указанном контроллере (метод класса)
        @ `Controller`Controller/`action`Action()
> Корректный список прав доступа с указанием каждого созданного поведения (return [])
    @ /acl/`controller`ACL.php
> Отображение (отправляемый html фрагмент в <body>)
    @ /views/`controller`/`action'.php
> чота еще
*/
return [
    //# EXAMPLE
    'example' => [
        'controller' => 'example',
        'action' => 'index',
    ],
    'example/exampleAction' => [
        'controller' => 'example',
        'action' => 'test',
    ],
    //



    //# Главная страница
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    //# REST API
    'api' => [
        'controller' => 'api',
        'action' => 'index',
    ],

    //# Утилитки
    'utilities' => [
        'controller' => 'utilities',
        'action' => 'index',
    ],

    //## Страница быстрого запуска (список сайтов)
    'utilities/quickbar' => [
        'controller' => 'utilities',
        'action' => 'quickbar',
    ],
    //## 

    //# Пасхалки
    'easter' => [
        'controller' => 'easter',
        'action' => 'index',
    ],
    //## 

    //# Страница профиля
    'account' => [
        'controller' => 'account',
        'action' => 'index',
    ],
    //## Регистрация
    'account/signup' => [
        'controller' => 'account',
        'action' => 'signup',
    ],
    //## Авторизация
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    //# чота еще
    'news/show' => [
        'controller' => 'news',
        'action' => 'show',
    ],
    //% + Можно алиасы делать.. но не надо..
];

?>