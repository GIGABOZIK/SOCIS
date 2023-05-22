<?php

namespace app\lib;


class User {

    private $id;
    private $login;
    private $email;
    private $password;

    public function __construct($id, $login, $email) {
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function updViaDb($id = 0, $login = 'Guest') {
        //
    }
}

?>