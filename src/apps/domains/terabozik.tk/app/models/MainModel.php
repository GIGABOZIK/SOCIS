<?php

namespace app\models;

use app\core\Model;


class MainModel extends Model {

    public function getSmth() {
        // $this->db->query('UPDATE news SET title="Новость 2 ABOBA" WHERE id=2');
        $result = $this->db->row('SELECT `title`, `description` FROM `news`');
        return $result;
    }

}

?>