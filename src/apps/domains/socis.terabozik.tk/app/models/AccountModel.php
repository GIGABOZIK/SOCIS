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
    public function createNewUser($var = []) {
        return $this->db->query('INSERT INTO `users`
            (`id`, `login`, `password`, `email`) VALUES
            (NULL, :login,  :password,  :email)'
            , $var
        );
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
        $response = $this->getUserBy(['login' => $var['login']]); //` Можно добавить вход по Email
        if (empty($response))
            return ['status' => 'Error', 'message' => 'Неверные данные!'];
        //` OK - user exist

        if (
            $response['password'] != $var['password']
            //-!password_verify($var['password'], $response['password'])
        )
            return ['status' => 'Error', 'message' => 'Неверные данные!'];
        //` OK - validate password

        $this->updSessionUser($response);
        return ['status' => 'Success', 'message' => 'Пользователь ' . $var['login'] . ' зарегистрирован!'];
    }

    public function validateLogin($login) {
        return (
            strlen($login) >= 4
            and strlen($login) <= 32
        );
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validatePassword($password) {
        return (
            strlen($password) >= 1
            and strlen($password) <= 32
        );
    }

    private function hashPassword($password) {
        $hash = hash('sha256', $password);
        // $hash = password_hash($password, );
        return $hash;
    }


    //## Orders / Projects
    public function createNewOrder($var = []) {
        if (!(
            isset($var['project-type'])
        and isset($var['project-description'])
        and isset($var['project-deadline'])
        )) return ['status' => 'Error', 'message' => 'Введены не все данные!'];
        //` OK - isset

        if (
            empty($var['project-type'])
            or empty($var['project-description'])
            or empty($var['project-deadline'])
        ) return ['status' => 'Error', 'message' => 'Введены не все данные!'];
        //` OK - not empty

        $html_text = array();
        foreach (explode(PHP_EOL, $var['project-description']) as $row) {
            $html_text[] = '<p>' . trim($row) . '</p>';
        }
        $html_text = implode(PHP_EOL, $html_text);
        //@ https://snipp.ru/php/textarea-to-paragraph
        //` OK - textarea to html paragraph by line
        if (!(
            $this->validateOrderDescription($html_text)
        )) return ['status' => 'Error', 'message' => 'Что-то пошло не так! Попробуйте сократить количество символов в описании!'];
        //` OK - validate

        $type_id = $var['project-type'];
        // $_SESSION['debug'] = $type_id;
        // if (in_array($typeId, $this->getProjectTypes())) {
        //     //
        // }
        //` OK - exist typeId

        // $var['project-deadline'] = strtotime($var['project-deadline']);
        // $_SESSION['debug'] = $var['project-deadline'];
        // return ['status' => 'DEBUG', 'message' => $_SESSION['debug']];
        //` OK - deadline to timestamp

        $this->db->query(
            'INSERT INTO `orders`
            (`id`, `title`, `description`,  `type_id`,  `user_id`, `date_deadline`) VALUES
            (NULL, :title,  :description,   :type_id,   :user_id,  :date_deadline)'
            , [
                'title' => 'New Project',
                'description' => $html_text,
                'type_id' => $type_id,
                'user_id' => $_SESSION['user']['id'],
                'date_deadline' => $var['project-deadline'],
            ]
        );
        //` OK - new order created
        return ['status' => 'Success', 'message' => 'Отправлено'];
    }

    public function validateOrderDescription($orderDescription) {
        return (
            strlen($orderDescription) >= 4
            and strlen($orderDescription) <= 1024
        );
    }

    public function getOrders($sort_sql, $userId = 0) {
        if (isset($userId)) $where_string = 'WHERE `U`.`id` = ' . $userId; else $where_string = '';
        $result = $this->db->row(
        // var_dump(
            "SELECT
                `O`.*, `T`.`title` AS `typeTitle`,
                `S`.`title` AS `statusTitle`,
                `U`.`id` AS `userId`,
                `U`.`login` AS `userLogin`
            FROM `orders` AS `O` 
                LEFT JOIN `types` AS `T` ON `O`.`type_id` = `T`.`id` 
                LEFT JOIN `status` AS `S` ON `O`.`status_id` = `S`.`id` 
                LEFT JOIN `users` AS `U` ON `O`.`user_id` = `U`.`id` 
            " . $where_string . " 
            ORDER BY {$sort_sql}");
            // , $sort_sql, $where_string);
            // -- ORDER BY {$sort_sql}");
        return $result;
    }

    public function getProjectTypes() {
        $result = $this->db->row("SELECT * FROM `types`");
        return $result;
    }

}



?>