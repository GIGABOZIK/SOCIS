<?php

namespace app\lib;

use PDO;


class Db {

    protected $dbLink;

    public function __construct() {
        $config = require 'app/config/db.php';
        $this->dbLink = new PDO('mysql:'
            . 'host=' . $config['host']
            . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['password']
        );
        // debug($this->db);
    }

    //` Выполнение запроса
    public function query($sql, $params = []) {
        $stmt = $this->dbLink->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
        }
        $stmt->execute();
        return $stmt;
        // $query = $this->dbLink->query($sql);
        // return $query;
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

    //> Примеры:
    //: query('SET NAMES utf8')
    //: row('SELECT id, title, description FROM news;')
    //: column('SELECT name FROM users WHERE id = :id OR name = :name;', ['id' => 2, 'name' => 'John'])
    //
    //

}

?>