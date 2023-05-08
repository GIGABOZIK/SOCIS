<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERABOZIK - BUFFER</title>
    <meta name="robots" content="noindex, nofollow">

    <style type="text/css">
        * {
            text-align: center;
            margin: 10;
            font-family: Verdana, Arial, sans-serif;
            font-size: 16px;
        }
        textarea {
            height: 50%;
            min-height: 500px;
            min-width: 10%;
            max-width: 95%;
            width: 720px;
            border: solid;
            border-width: 2px;
            text-align: left;
            overflow: auto;
        }
    </style>
</head>

<body>

    <div>
        <h2>Текст сюда</h2>
    <div>

    <?php
        // configuration
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            if (isset($_GET['name'])) {
                $name = $_GET['name'];
            } else $name = 'guest';
        }
        $maxlength = 1000000;
        // $maxlength = 100;
        switch ($name) {
            case 'ggbzk':
                $url = './?name=' . $name;
                $file = './buffer_ggbzk.txt';
                break;
            case 'share':
                $url = './?name=' . $name;
                $file = './buffer_share.txt';
                break;
            default:
                $url = '.';
                $file = './buffer_guest.txt';
                break;
        }

        // check if form has been submitted
        if (isset($_POST['text']))
        {
            // save the text contents
            $text = $_POST['text'];
            if (strlen($text) > ($maxlength + 15 * 3))
                $text = substr($text, 0, $maxlength) . '...' . '(а нефиг такой большой текст пихать фывхъыфвхъыфвх)';
            file_put_contents($file, $text);

            // redirect to form again
            header(sprintf('Location: %s', $url));
            printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
            exit();
        }

        // read the textfile
        $text = file_get_contents($file);
    ?>

    <!-- HTML form -->
    <form action="" method="post">
        <textarea name="text" maxlength="<?php echo $maxlength; ?>"><?php echo htmlspecialchars($text); ?></textarea>
        <br>
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="submit" />
        <input type="reset" />
    </form>

</body>
</html>
