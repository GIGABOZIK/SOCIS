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
	<link rel="icon" type="image/x-icon" href="/favicon.ico">
    <title><?php echo $titlePage . " · " . $titleBrand; ?></title>

    <!-- STYLES -->

    <link rel="stylesheet" href="/public/styles/commonStyles.css">

    <!-- <?php $addVersion = '?v=' . time(); ?> -->
    <!-- <link rel="stylesheet" href="/public/styles/commonStyles.css<?php echo $addVersion; ?>"> -->

    <!-- <link rel="stylesheet" href="/public/styles/<?php echo $this->routeParams['controller'] . '.css' . $addVersion; ?>"> -->

    <!-- SCRIPTS -->
    <script src="/public/scripts/jquery-3.6.3.min.js"></script>
    <script src="/public/scripts/form.js"></script>
</head>
<body>

    <?php if (0)
    { ?>
            <link rel="stylesheet" href="/public/styles/debug.css<?php echo $addVersion; ?>">
            <float style="position:fixed; right:0; bottom:0; padding: 5px">
                <!-- <p><?php printArray($_SESSION['user'], 'DEBUG -> USER'); ?></p> -->
                <p><?php printArray($_SESSION); ?></p>
                <!-- <p><a href="?logout=1">logout</a></p>
                <p><a href="?user=1">user1</a></p>
                <p><a href="?user=2">user2</a></p> -->
            </float>
            <script>
                let actPageAutoReload = 1;
                let pageAutoReloadTimeSec = 5;
                if (actPageAutoReload) {
                    setTimeout(function() { location.reload() }, 1000 * pageAutoReloadTimeSec);
                }
            </script>
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
                <!-- <div class="breadcrumbs"><?php echo 'Вы здесь > '
                    . '<a href="/' . $this->routeParams['controller'] . '">' . $this->routeParams['controller'] . '</a>' . ' > '
                    . '<a href="/' . $this->routeParams['controller'] . '/' . $this->routeParams['action'] . '">' . $this->routeParams['action'] . '</a>'
                    ; ?></div> -->

                <nav class="navigation">
                    <?php
                    // var_dump($this->routeParams);
                    $h_nav_links = [
                        'main'      => ['/',                'Главная'],
                        'services'  => ['/services',        'Услуги'],
                        'account'   => ['/account',         'Личный кабинет'],
                        
                    ];
                    if ($_SESSION['user']['role_name']=='admin') array_push($h_nav_links, ['http://foreverfunface.tplinkdns.com:8880/" target="_blank', 'KanBan']);
                    if ($_SESSION['user']['role_name']=='admin') array_push($h_nav_links, ['http://foreverfunface.tplinkdns.com:3001/" target="_blank', 'Мониторинг']);
                    if ($_SESSION['user']['role_name']=='admin') array_push($h_nav_links, ['http://176.15.255.161:8001/" target="_blank', 'PMA']);
                    // if ($_SESSION['user']['role_name']=='admin') array_push($h_nav_links, ['/phpmyadmin" target="_blank', 'PMA']);
                    // if ($_SESSION['user']['role_name']=='admin') array_push($h_nav_links, ['/account/kanban', 'KanBan2']);
                    if ($_SESSION['user']['id'] > 0) array_push($h_nav_links, ['/account/orders', 'Заказы']);
                    if ($_SESSION['user']['id'] > 0) array_push($h_nav_links, ['/?logout=1', 'Выйти']);
                    foreach ($h_nav_links as $page => $array) {
                        $out = '<a class="h-nav-link';
                        if (
                            $this->routeParams['controller'] == $page
                            // or $this->routeParams['action'] == $page
                        ) {
                            $out .= ' current';
                        }
                        $out .= '" href="' . $array[0] . '">' . $array[1] . '</a>';
                        echo $out;
                    }
                    ?>
                </nav>

                <!-- <span class="account">account</span> -->
            </div>
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

    <footer>
        <!-- footer -->
        <div class="wrapper-1">
            <div class="footer-cont">
                <section class="contacts">
                    <h2>Контакты</h2>
                    <hr>
                    <p>Город, улица</p>
                    <p><a href="tel:(987)6543210">Телефон: (987) 654-32-10</a></p>
                    <p><a href="mailto:inbox@socis">Email: inbox@socis</a></p>
                </section>
                <section class="schedule">
                    <h2>Часы работы</h2>
                    <hr>
                    <p>Понедельник-Пятница</p>
                    <p>9:00 - 19:00</p>
                </section>
                <!-- <section>
                    <h2>Feedback</h2>
                    <hr>
                    <form action="#">
                        <textarea name="feedback" rows="3" cols="40"></textarea>
                        <br><button type="submit">Отправить</button>
                    </form>
                </section> -->
                <section class="socials">
                    <h2>Мы в соцсетях</h2>
                    <hr>
                    <div>
                        <?php
                        foreach ([
                            // 'Email'     => ['href' => 'mailto:socis@mail',                  'image' => '/public/images/svg/socials-email.svg'],
                            'GitHub'    => ['href' => 'https://github.com/GIGABOZIK/SOCIS', 'image' => '/public/images/svg/socials-github.svg'],
                            'VKontakte' => ['href' => '#VK',                                'image' => '/public/images/svg/socials-vk.svg'],
                            'Telegram'  => ['href' => '#TG',                                'image' => '/public/images/svg/socials-telegram.svg'],
                            'YouTube'   => ['href' => '#YT',                                'image' => '/public/images/svg/socials-youtube.svg'],
                        ] as $key => $value) {
                            echo '<a href="' . $value['href'] . '">'
                            . '<img src="' . $value['image'] . '" alt="' . $key. '">'
                            . '</a>'; 
                        }
                        ?>
                    </div>
                </section>
                </div>
            </div>
        </div>
        <!-- <p class="a-center">Все права защищены &copy; 2023</p> -->
    </footer>

    <!-- <h1>app - views - layouts - default</h1><br>
    <h2>content:</h2><br> -->

    <!-- <div style="width: env(safe-area-inset-bottom);"></div> -->
    
    <!-- scripts -->
    <!-- <script src="./js/script.js"></script> -->
</body>
</html>
