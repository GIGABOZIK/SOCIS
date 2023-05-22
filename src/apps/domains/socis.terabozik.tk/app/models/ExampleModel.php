<?php

namespace app\models;

use app\core\Model;


class ExampleModel extends Model {

    public function getNow() {
        // echo '<hr>/app/models/ExampleModel :: getNow()';
        $result = $this->db->row('SELECT NOW()');
        return $result;
    }

}

?>