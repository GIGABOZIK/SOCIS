<!-- <h3>ГЛАВНАЯ СТРАНИЦА (app - views - main - index)</h3> -->

<style>
.banner {
    margin: 5px auto;
    height: 200px;
    background-image: url(/public/images/svg/socis.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
}


.container {
    /* max-width: 800px; */
    margin: 0 auto;
    /* background-color: #fff; */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

p {
    margin-bottom: 10px;
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

.feature-content {
    flex: 1;
}
</style>


<section class="banner"></section>

<div class="container">
    <h1>Корпоративная информационная система (temp)</h1>
    
    <?php
    foreach ([
        "https://images.unsplash.com/photo-1634838037553-66f5ce322212?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
        "https://images.unsplash.com/photo-1594175157129-8d36c241217c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80",
        "https://images.unsplash.com/photo-1535696588143-945e1379f1b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
        "https://images.unsplash.com/photo-1572905046368-9232a9149fb4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80",
        "https://images.unsplash.com/photo-1541193658129-28529758aaf1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80",
    ] as $key => $src) {
        ?>
        <span class="feature">
            <img src=" <?php echo $src; ?>"
                alt="Feature Image <?php echo $key; ?>">
            <div class="feature-content">
                <h2>Функция <?php echo $key; ?></h2>
                <p>Описание функции <?php echo $key; ?></p>
            </div>
        </span>
        <?php
    }
    ?>
</div>



<!-- 
<section>banner
    <span>1</span>
    <span>2</span>
    <span>3</span>
</section> -->

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


