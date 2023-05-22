<?php

// printArray($_SESSION['user']);

extract($_SESSION['user']);
?>


<section>
    <h2>Профиль</h2>
    <p>Логин: <?php echo $login; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Дата регистрации: <?php echo $signup_date; ?></p>
    <!-- <p>Тип: <?php echo $role_name=='authorized' ? 'usual' : $role_name; ?></p> -->
    <p>Тип: <?php echo $role_name; ?></p>
</section>