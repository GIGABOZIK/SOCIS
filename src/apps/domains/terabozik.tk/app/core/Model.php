<?php

namespace app\core;

use app\lib\Db;


abstract class Model {

    public $db;

    public function __construct() {
        $this->db = new Db;
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

}

?>