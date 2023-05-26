<!-- <h3>ГЛАВНАЯ СТРАНИЦА (app - views - main - index)</h3> -->

<?php
require_once 'app/lib/widget-banners.php';
echo generateBanner('/public/images/svg/socis.svg');
?>

<style>
    .features {
        /* max-width: 800px; */
        margin: 0 auto;
        /* background-color: #fff; */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .features h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    .feature {
        display: flex;
        margin-bottom: 20px;
    }
    .feature img {
        display: block;
        object-fit: cover;
        width: 100px;
        height: 100px;
        margin-right: 20px;
    }
    .feature div {
        flex: 1;
    }
    .feature div p {
        margin-bottom: 10px;
    }
</style>




<section class="features">
    <h1>Корпоративная информационная система</h1>
    <?php
    $features = [
        [
            'image' => 'https://images.unsplash.com/photo-1634838037553-66f5ce322212?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'title' => 'Функция',
            'description' => 'Описание функции',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1594175157129-8d36c241217c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
            'title' => 'Функция',
            'description' => 'Описание функции',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1535696588143-945e1379f1b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'title' => 'Функция',
            'description' => 'Описание функции',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1535696588143-945e1379f1b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'title' => 'Функция',
            'description' => 'Описание функции',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1541193658129-28529758aaf1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
            'title' => 'Функция',
            'description' => 'Описание функции',
        ],
    ];

    foreach ($features as $key => $feature) {
        ?>
        <span class="feature">
            <img src=" <?php echo $feature['image']; ?>"
                alt="Feature-Image <?php echo $key . ' ' . $feature['title']; ?>">
            <div>
                <h2><?php echo $feature['title']; ?></h2>
                <p><?php echo $feature['description']; ?></p>
            </div>
        </span>
        <?php
    }
    ?>
</section>

<section>overview
    <span>1</span>
    <span>2</span>
</section>

<section>examples
    <div>
        <span>1</span>
        <span>2</span>
        <span>3</span>
    </div>
    <div>
        <span>4</span>
        <span>5</span>
        <span>6</span>
    </div>
</section>

<section>FAQ
    <!--  -->
</section>


