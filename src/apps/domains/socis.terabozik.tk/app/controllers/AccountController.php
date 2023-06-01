<?php

namespace app\controllers;

use app\core\Controller;


class AccountController extends Controller {

    public function adminAction() {
        $_SESSION['user']['id'] = 1;
        printArray($_SESSION['user']); exit;
    }

    public function kanbanAction() {
        $this->view->render('KanBan');
    }


    public function indexAction() {
        switch ($_SESSION['user']['role_name']) {
            case 'guest':
                $this->view->redirect('/account/login');
                // $this->view->redirect('/account/signup');
            break;
            default:
                $this->view->redirect('/account/profile');
        }
    }

    public function signupAction() {
        if (!empty($_POST)) {
            $response = $this->model->userSignUp($_POST);
            if ($response['status'] == 'Success') {
                $this->view->location('/account?action=signup');
            } else $this->view->message($response['status'], $response['message']);
        }
        $this->view->render('Регистрация');
    }

    public function loginAction() {
        if (!empty($_POST)) {
            $response = $this->model->userSignIn($_POST);
            if ($response['status'] == 'Success') {
                $this->view->location('/account?action=auth');
                // $this->view->message('Отлично!', 'Авторизован');
            } else $this->view->message($response['status'], $response['message']);
        }
        $this->view->render('Авторизация');
    }

    public function profileAction() {
        $projectTypes = $this->model->getProjectTypes();
        $hasOrders = !empty($this->model->getOrders('`id`', $userId = $_SESSION['user']['id'], $queryType = $_SESSION['user']['role_name']));
        $this->view->render($titlePage = 'Профиль', $titleBrand = 'SOCIS', $vars = [
            'hasOrders' => $hasOrders,
            'projectTypes' => $projectTypes,
            'orderList' => $this->generateOrderList()
        ]);
    }


    //### ORDERS
    public function ordersAction() {
        if (!empty($_POST)) {
            $response = $this->model->createNewOrder($_POST);
            if ($response['status'] == 'Success') {
                $this->view->location('/account?action=createdOrder');
                // $this->view->message('Отлично!', 'Авторизован');
            } else $this->view->message($response['status'], $response['message']);
        }

        // $this->view->redirect('/account/profile?orders=1');
        $this->view->layout = 'widget';
        $this->view->render($titlePage = 'Заказы', $titleBrand = 'SOCIS', $vars = ['orderList' => $this->generateOrderList()]);
    }

    public function generateOrderList() {
        /* Все варианты сортировки */
        $sort_list = array(
            'id_asc'   => '`id`',
            'id_desc'  => '`id` DESC',
            'title_asc'   => '`title`',
            'title_desc'  => '`title` DESC',
            'typeTitle_asc'   => '`typeTitle`',
            'typeTitle_desc'  => '`typeTitle` DESC',
            'description_asc'   => '`description`',
            'description_desc'  => '`description` DESC',
            'statusTitle_asc'   => '`statusTitle`',
            'statusTitle_desc'  => '`statusTitle` DESC',
            'date_created_asc'   => '`date_created`',
            'date_created_desc'  => '`date_created` DESC',
            'date_deadline_asc'   => '`date_deadline`',
            'date_deadline_desc'  => '`date_deadline` DESC',
            'userLogin_asc'   => '`userLogin`',
            'userLogin_desc'  => '`userLogin` DESC',
        );

        /* Проверка GET-переменной */
        $sort = @$_GET['sort'];
        if (array_key_exists($sort, $sort_list)) {
            $sort_sql = $sort_list[$sort];
        } else {
            $sort_sql = reset($sort_list);
        }

        /* Запрос в БД */
        $orderList = $this->model->getOrders($sort_sql, $userId = $_SESSION['user']['id'], $queryType = $_SESSION['user']['role_name']);
        return $orderList;
    }

}

?>