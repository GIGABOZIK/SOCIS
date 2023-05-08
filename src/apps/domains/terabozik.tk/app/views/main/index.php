<h3>ГЛАВНАЯ СТРАНИЦА (app - views - main - index)</h3>
<?php


// echo 'Имя: ' . $name . '<br>Возраст: ' . $age;

// debug($array);
?>

<?php foreach ($news as $val): ?>

    <h3><?php echo $val['title'] ?></h3>
    <p><?php echo $val['description'] ?></p>
    <hr>

<?php endforeach; ?>

<?php

// debug($news);

?>