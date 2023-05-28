<?php

//TODO - Это необходимо автоматизировать в будущем

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
    //
    //# SOCIS
    //## Главная страница
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'main' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    // 'main/index' => [
    //     'controller' => 'main',
    //     'action' => 'index',
    // ],
    // //### Контакты
    // 'contacts' => [
    //     'controller' => 'main',
    //     'action' => 'contacts',
    // ],
    // //### FAQ
    // 'faq' => [
    //     'controller' => 'main',
    //     'action' => 'faq',
    // ],
    //### Услуги
    //## Услуги
    'services' => [
        'controller' => 'services',
        'action' => 'index',
    ],
    //## Личный кабинет
    'account' => [
        'controller' => 'account',
        'action' => 'index',
    ],
    //### Страница профиля
    'account/profile' => [
        'controller' => 'account',
        'action' => 'profile',
    ],
    //### Регистрация
    'account/signup' => [
        'controller' => 'account',
        'action' => 'signup',
    ],
    //### Авторизация
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],
    //### Заказы
    'account/orders' => [
        'controller' => 'account',
        'action' => 'orders',
    ],
    //### Канбан
    'account/kanban' => [
        'controller' => 'account',
        'action' => 'kanban',
    ],
    //## 







    //# REST API - переложить на поддомен
    /**
     *  Переделать для работы с поддоменами в пределах фреймворка
     *  return [
     *      '' => [
     *          '' => [
     *              'controller' => 'main',
     *              'action' => 'index',
     *          ],
     *          'account/login' => [
     *              'controller' => 'accout',
     *              'action' => 'login',
     *          ],
     *      ],
     *      'api' => [
     *          '' => [
     *              'controller' => 'api',
     *              'action' => 'index',
     *          ],
     *      ],
     *  ]
     */
    // 'api' => [
    //     'controller' => 'api',
    //     'action' => 'index',
    // ],

    // //# Утилитки
    // 'utilities' => [
    //     'controller' => 'utilities',
    //     'action' => 'index',
    // ],

    // //## Страница быстрого запуска
    // 'utilities/quickbar' => [
    //     'controller' => 'utilities',
    //     'action' => 'quickbar',
    // ],
    // //## 
    // //% + Можно алиасы делать.. но не надо..
];

?>