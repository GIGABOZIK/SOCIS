<?php

// printArray($_SESSION['user']);

extract($_SESSION['user']);
?>

<section class="account profile">
    <!-- <h2>Профиль</h2> -->
    <h1><?php switch($role_name) {
        case 'authorized': $type = 'Клиент'; break;
        case 'admin': $type = 'Администратор'; break;
        default: $type = 'Гость';
    }
    echo $type . ' ' . $login;
    ?></h1>
    <p>Логин: <?php echo $login; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Дата регистрации: <?php echo $signup_date; ?></p>
    
    <!-- <p>Тип: <?php echo $role_name; ?></p> -->
</section>

<hr><section class="account orders">
    <h2>Список заказов</h2>
    <?php
        if (!$hasOrders) echo '<p>Заказов нет</p>';
        // else echo '<div><iframe src="/account/orders">Список заказов</iframe></div>';
        else require_once "orders.php";
    ?>
</section>


<hr><section class="new-order">
    <h2>Оформите новый заказ</h2>
    <form class="account" action="/account/orders" method="POST">
        <!-- <input type="hidden" name="id" value="<?php echo $id; ?>"> -->
        <!-- <input type="hidden" name="login" value="<?php echo $login; ?>"> -->

        <label for="project-type">Тип проекта:</label>
        <select id="project-type" name="project-type" required>
            <option value="">Выберите тип проекта</option>
            <?php foreach ($projectTypes as $type) {
                echo '<option value="' . $type['id'] . '">' . $type['title'] . '</option>';
            } ?>
        </select>

        <label for="project-deadline">Дедлайн:</label>
        <!-- <input type="date" id="project-deadline" name="project-deadline" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", time()+86400*365*5); ?>" required> -->
        <input type="date" id="project-deadline" name="project-deadline" placeholder="DD-MM-YYYY" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", time()+157680000); ?>" required>


        <label for="project-description" title="Введите описание вашего проекта">Описание проекта:</label>
        <textarea id="project-description" name="project-description"
            rows="10" placeholder="Введите описание вашего проекта" required></textarea>

        <button type="submit">Отправить заказ</button>
    </form>
</section>


