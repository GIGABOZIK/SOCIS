<?php

return [
    'all' => [
        'index',
    ],
    'authorized' => [
        'profile',
        'orders',
    ],
    'guest' => [
        'signup',
        'login',
        'restore',
    ],
    'admin' => [
        'profile',
        'admin',
    ],
];

?>