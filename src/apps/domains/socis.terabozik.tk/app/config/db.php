<?php

//` Данные для подключения к БД

return [
    'host' => 'db',
    'dbname' => getenv('MYSQL_DATABASE'),
    'user' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
];

?>