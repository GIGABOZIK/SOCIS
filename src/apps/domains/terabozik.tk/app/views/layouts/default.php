<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover"> -->
    <title><?php echo $title; ?></title>
    <!--  -->
    <?php $addVersion = '?v=' . time(); ?>
    <link rel="stylesheet" href="/public/styles/commonStyles.css<?php echo $addVersion; ?>">
    <link rel="stylesheet" href="/public/styles/debug.css<?php echo $addVersion; ?>">
    <!--  -->
    <style>
        <?php
            // $commonStyles = file_get_contents('https://terabozik.tk/public/styles/commonStyles.css');
            // echo $commonStyles;
        ?>
    </style>
    <!--  -->
    <script src="/public/scripts/jquery-3.6.3.min.js"></script>
    <script src="/public/scripts/form.js"></script>
</head>
<body class="page-body">
    <aside class="page-sidebar">sidebar
        <div>navigation
        </div>
    </aside>
    <header class="page-header">header
        <!-- <span>sb-toggler</span> -->
        <span class="logo">logo</span>
        <span class="navigation">navigation</span>
        <span class="account">account</span>
    </header>
    <main class="page-main">main
        <?php
            echo $content;
            // require $viewFilePath;
        ?>
    </main>
    <footer class="page-footer">footer
        <div>contact/feedback -form</div>
        <div>other contacts</div>
    </footer>

    <!-- <h1>app - views - layouts - default</h1><br>
    <h2>content:</h2><br> -->

    <!-- <div style="width: env(safe-area-inset-bottom);"></div> -->
</body>
</html>
