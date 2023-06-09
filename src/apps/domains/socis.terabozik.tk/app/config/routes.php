<?php

//TODO - Это необходимо автоматизировать в будущем

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
    //## 

];

?>