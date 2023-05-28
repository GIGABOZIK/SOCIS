<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover"> -->
	<!-- <meta name="author" content=""> -->
	<!-- <meta name="copyright" content=""> -->
	<!-- <meta name="keywords" content=""> -->

    <!-- TITLE -->
    <?php
        $titleBrand = 'SOCIS';
    ?>
	<link rel="icon" type="image/x-icon" href="./favicon.ico">
    <title><?php echo $titlePage . " · " . $titleBrand; ?></title>

    <!-- STYLES -->
    <?php $addVersion = '?v=' . time(); ?>
    <link rel="stylesheet" href="/public/styles/commonStyles.css<?php echo $addVersion; ?>">
    <!-- <link rel="stylesheet" href="/public/styles/<?php echo $this->routeParams['controller'] . '.css' . $addVersion; ?>"> -->

    <!-- SCRIPTS -->
    <!-- <script src="/public/scripts/jquery-3.6.3.min.js"></script>
    <script src="/public/scripts/form.js"></script> -->
</head>
<body>
    <?php echo $content; ?>
</body>
</html>