<?php

namespace app\models;

use app\core\Model;


class AccountModel extends Model {

    public function getNow() {
        // echo '<hr>/app/models/ExampleModel :: getNow()';
        $result = $this->db->row('SELECT NOW()');
        return $result;
    }

    //# НУЖДАЕТСЯ В УЛУЧШЕНИЯХ И ОПТИМИЗАЦИИ

    //## SignUP
    public function userSignUp($var = []) {
        if (!(
                isset($var['login'])
            and isset($var['email'])
            and isset($var['password'])
        )) return ['status' => 'Error', 'message' => 'Введены не все данные!'];
        //` OK - isset

        $var['login'] = trim($var['login']);
        $var['password'] = trim($var['password']);
        if (!(
                $this->validateLogin($var['login'])
            and $this->validateEmail($var['email'])
            and $this->validatePassword($var['password'])
        )) return ['status' => 'Error', 'message' => 'Проверьте введенные данные!'];
        //` OK - validate

        if (!(
            empty($this->getUserBy(['login' => $var['login']]))
            // and empty($this->getUserBy(['email' => $var['email']]))
        )) return ['status' => 'Error', 'message' => 'Пользователь с такими данными уже существует'];
        //` OK - user dsnt exist yet
        
        $this->createNewUser([
            'login' => $var['login'],
            'email' => $var['email'],
            'password' => $this->hashPassword($var['password']),
        ]);
        //` OK - new user created

        $response = $this->getUserBy(['login' => $var['login']]);
        if (empty($response)) return ['status' => 'Error', 'message' => 'Что-то пошло не так :('];
        
        $this->updSessionUser($response);
        return ['status' => 'Success', 'message' => 'Пользователь ' . $var['login'] . ' зарегистрирован!'];
    }


    //## SignIN
    public function userSignIn($var = []) {
        if (!(
                isset($var['login'])
            and isset($var['password'])
        )) return ['status' => 'Error', 'message' => 'Введены не все данные!'];
        //` OK - isset

        $var['login'] = trim($var['login']);
        $var['password'] = $this->hashPassword(
            trim($var['password'])
        );
        $response = $this->getUserBy(['login' => $var['login']]);
        if (empty($response))
            return ['status' => 'Error', 'message' => 'Неверные данные!'];
        //` OK - user exist

        if ($response['password'] != $var['password'])
            return ['status' => 'Error', 'message' => 'Неверные данные!'];
        //` OK - validate password

        $this->updSessionUser($response);
        return ['status' => 'Success', 'message' => 'Пользователь ' . $var['login'] . ' зарегистрирован!'];
    }

    public function validateLogin($login) {
        return (
            strlen($login) > 1
            and strlen($login) < 50
        );
    }
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function validatePassword($password) {
        return (
            strlen($password) > 1
            and strlen($password) < 50
        );
    }

    private function hashPassword($password) {
        return 'hashMe' . $password;
    }



}

?>