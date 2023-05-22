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
	<link rel="icon" type="image/x-icon" href="./favicon.ico">
    <title><?php echo $titlePage . " · " . $titleBrand; ?></title>
    <!-- style -->
    <?php $addVersion = '?v=' . time(); ?>
    <link rel="stylesheet" href="/public/styles/commonStyles.css<?php echo $addVersion; ?>">
    <!-- <link rel="stylesheet" href="/public/styles/<?php echo $this->routeParams['controller'] . '.css' . $addVersion; ?>"> -->

    <script src="/public/scripts/jquery-3.6.3.min.js"></script>
    <script src="/public/scripts/form.js"></script>
</head>
<body>

    <?php if (0)
    { ?>
            <link rel="stylesheet" href="/public/styles/debug.css<?php echo $addVersion; ?>">
            <float style="position:fixed; right:0; bottom:0; padding: 5px">
                <p><?php printArray($_SESSION['user'], 'DEBUG -> USER'); ?></p>
                <!-- <p><?php printArray($_SESSION); ?></p> -->
                <!-- <p><a href="?logout=1">logout</a></p>
                <p><a href="?user=1">user1</a></p>
                <p><a href="?user=2">user2</a></p> -->
            </float>
        <?php
    } ?>


    <!-- <aside class="page-sidebar active0">
        <nav>sidebar-navigation (later)</nav>
    </aside> -->

    <header>
        <!-- header -->
        <div class="wrapper-1">
            <div class="header-cont">
                <!-- <span id="sb-toggle" class="sb-toggle">sb-toggler</span> -->

                <a class="logo-link" href="/">
                    <img src="/public/images/logo_c.png" alt="logo" draggable=false>
                    <span><?php echo $titleBrand; ?></span>
                </a>

                <nav class="navigation">
                    <?php
                    // var_dump($this->routeParams);
                    $h_nav_links = [
                        'main'      => ['/',                'Главная'],
                        'services'  => ['/services',        'Услуги'],
                        'faq'       => ['/faq',             'FAQ'],
                        'contacts'  => ['/contacts',        'Контакты'],
                        'account'   => ['/account',         'Личный кабинет'],
                        // 'orders'    => ['/account/orders',  'Заказы'],
                        
                    ];
                    if ($_SESSION['user']['id'] > 0) array_push($h_nav_links, ['/?logout=1', 'Выйти']);
                    foreach ($h_nav_links as $controller => $array) {
                        $out = '<a class="h-nav-link';
                        if ($this->routeParams['controller'] == $controller) {
                            $out .= ' current';
                        }
                        $out .= '" href="' . $array[0] . '">' . $array[1] . '</a>';
                        echo $out;
                    }
                    ?>
                </nav>

                <!-- <span class="account">account</span> -->
            </div>

            <!-- <div><?php echo 'Вы здесь > ' . $this->routeParams['controller'] . ' > ' . $this->routeParams['action']; ?></div> -->
        </div>
    </header>

    <main>
        <!-- content -->
        <div class="wrapper-1">
            <div class="main-cont">
                <?php
                    echo $content;
                    // require $viewFilePath;
                ?>
            </div>
        </div>
    </main>

    <footer>footer
        <div class="wrapper-1">
            <div class="footer-cont">
                <section>
                    <h2>Контакты</h2>
                    <hr>
                    <p>Город, улица</p>
                    <p>Телефон</p>
                    <p>Email</p>
                </section>
                <section>
                    <h2>Часы работы</h2>
                    <hr>
                    <p>Понедельник-Пятница</p>
                    <p>9:00 - 19:00</p>
                </section>
                <section>
                    <h2>Feedback</h2>
                    <hr>
                    <form action="">fb-form</form>
                </section>
                <section>
                    <h2>Мы в соцсетях</h2>
                    <hr>
                    <span>1</span>
                    <span>2</span>
                    <span>3</span>
                </section>
            </div>
        </div>
        <!-- <p class="a-center">Все права защищены &copy; 2023</p> -->
    </footer>

    <!-- <h1>app - views - layouts - default</h1><br>
    <h2>content:</h2><br> -->

    <!-- <div style="width: env(safe-area-inset-bottom);"></div> -->
    
    <!-- scripts -->
    <script>
        let actPageAutoReload = 0;
        let pageAutoReloadTimeSec = 5;
        // let pageAutoReloadTimeSec = 1;
        if (actPageAutoReload) {
            setTimeout(function() { location.reload() }, 1000 * pageAutoReloadTimeSec);
        }
    </script>
    <!-- <script src="./js/script.js"></script> -->
</body>
</html>
