<?php
//% kek
function redirect($url) {
    header('location: ' . $url);
    exit;
}
if (isset($_GET['rr'])) {
    redirect('https://youtu.be/dQw4w9WgXcQ?autoplay=true');
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERABOZIK</title>
</head>

<body draggable="true">

    <?php
        include '../terabozik/temp_info.php';
    ?>

    <pre>

















































    </pre>

    <h1>ABOBA</h1>

    <?php
        $addr = $_SERVER['HTTP_HOST'];
        $addr = '';
        foreach (['smth', 'buffer', 'livehtml', 'live'] as $key => $value) {
            echo '<a href="' . $addr . '/' . $value . '">' . $value . "</a><br>";
        }
        echo "<h1>END</h1>";
    ?>

</body>
</html>