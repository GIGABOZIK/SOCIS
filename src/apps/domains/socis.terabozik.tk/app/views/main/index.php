<!-- <h3>ГЛАВНАЯ СТРАНИЦА (app - views - main - index)</h3> -->

<?php
require_once 'app/lib/widget-banners.php';
echo generateSlider();
echo generateBanner('/public/images/svg/socis.svg');
?>

<section class="features">
    <h1>Корпоративная информационная система</h1>
    <?php
    $features = [
        [
            'image' => 'https://images.unsplash.com/photo-1572905046368-9232a9149fb4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'title' => 'Мониторинг проектов',
            'description' => 'Отслеживание состояния проектов обеспечивает прозрачность и своевременное информирование о статусе и прогрессе выполнения проектов',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1634838037553-66f5ce322212?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'title' => 'Выполнение проектов',
            'description' => 'Эффективное управление задачами и ресурсами для выполнения проектов в соответствии с требованиями заказчика.',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1535696588143-945e1379f1b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'title' => 'Ведение канбан-доски',
            'description' => 'Гибкая система управления задачами, которая помогает организовать рабочий процесс, отслеживать состояние задач и улучшать коммуникацию в команде.',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1541193658129-28529758aaf1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
            'title' => 'Управление файлами',
            'description' => 'Централизованное хранение, организация и доступ к документам и файлам проекта облегчает совместную работу и обмен информацией.',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1594175157129-8d36c241217c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
            'title' => 'Администрирование',
            'description' => 'Возможность управления пользователями, настройками системы, безопасностью и привилегиями доступа. Обеспечивет контроль и конфигурируемость системы согласно требованиям и бизнес-процессам организации.',
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

<!-- 
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
</section>
 -->

