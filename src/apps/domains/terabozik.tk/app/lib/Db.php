<?php

namespace app\lib;

use PDO;


class Db {

    protected $pdo;

    public function __construct() {
        $config = require 'app/config/db.php';
        // try {
            $this->pdo = new PDO('mysql:'
                . 'host=' . $config['host']
                . ';dbname=' . $config['dbname'],
                $config['user'],
                $config['password']
            );
            // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // } catch(PDOException $e) {
        //     echo 'Error: ' . $e->getMessage();
        // }
    }

    //` Выполнение SQL-запроса
    public function query($sql, $params = []) {
        // try {
            $stmt = $this->pdo->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $stmt->bindValue(':' . $key, $value);
                }
            }
            $stmt->execute();
        // } catch(PDOException $e) {
        //     echo 'Error: ' . $e->getMessage();
        //     return null;
        // }
        return $stmt;
    }

    //` Получение кортежей
    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    //` Получение атрибута
    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    /*
    & Примеры использования:
    : query('SET NAMES utf8')
    : row('SELECT `id`, `title`, `description` FROM `news`;')
    : column('SELECT `name` FROM `users` WHERE `id` = :id OR `name` = :name;', ['id' => 2, 'name' => 'John'])
    */

}

?>