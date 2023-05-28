<?php

namespace app\core;

use app\lib\Db;


abstract class Model {

    public $db;

    public function __construct() {
        $this->db = new Db;
        //
        $this->updSessionUser($_SESSION['user']);
        // unset($_SESSION);
    }

    public function getVersionDB() {
        // echo '<hr>/app/core/Model :: getVersionDB()';
        //
        // $query = $pdo->query('SHOW VARIABLES like "version"');
        // $row = $query->fetch();
        // echo 'MySQL version:' . $row['Value'];
        //
        // $this->db->query('UPDATE news SET title="Новость 2 ABOBA" WHERE id=2');
        // $data = $this->db->column('SELECT `name` FROM `users` WHERE `id`=2;');
        // $data = $this->db->row('SELECT * FROM `users`;');
        // $data = $this->db->column('SELECT `name` FROM `users` WHERE `id` = :id', $params);
        $data = $this->db->row('SHOW VARIABLES like "version"');
        // debug($data);
        return $data;
    }

    public function getUserBy($var = []) {
        foreach ($var as $key => $value) {
            $row = $this->db->row(
                'SELECT `users`.*, `roles`.`role_name`
                FROM `users`
                    LEFT JOIN `roles` ON `roles`.`id` = `users`.`role_id`
                WHERE `users`.`'. $key .'`=:'. $key . ';'
                , $var);
            if (!empty($row)) return $row[0];
            // return $row;
        }
        return [];
        // return $this->db->row('SELECT * FROM `user` WHERE `id` = :id', $var);
    }

    public function updSessionUser($var = []) {
        //` Upd data
        if (isset($var['id'])) {
            if ($var['id'] > 0) {
                $updUser = $this->getUserBy(['id' => $var['id']]);
            } else {
                return [];
                $updUser = [
                    'id' => 0,
                    'login' => 'Guest',
                    'role_name' => 'guest',
                ];
            }
        } else
        if (isset($var['login'])) {
            $updUser = $this->getUserBy(['login' => $var['login']]);
        } else
        if (isset($var['email'])) {
            $updUser = $this->getUserBy(['email' => $var['email']]);
        }
        if (empty($updUser)) return [];
        // $updUser = $this->model->getUsersBy(['id' => 1]);
        foreach($updUser as $key => $value) {
            if (!in_array($key,[
                'password', 'role_id'
            ]))
                $_SESSION['user'][$key] = $value;
        }
        return true;
    }

}

?>