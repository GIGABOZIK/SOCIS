<?php


function generateBanner($image = 'src', $alt = 'Banner-Image'
    // , $margin = '5px auto', $height = '200px'
) {
    $html = '<section class="banner border-gradient">';
    $html .= '<img src="' . $image . '" alt="'. $alt . '">';
    $html .= '</section>';
    // $html .= '
    // <style>
    // .banner img {
    //     display: block;
    //     margin: 3px auto;
    // }
    // </style>';
    return $html;
}


function generateSlider(
    $images = [
        'https://images.unsplash.com/photo-1542451542907-6cf80ff362d6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1521&q=80',
        'https://images.unsplash.com/photo-1542397284385-6010376c5337?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80',
        'https://images.unsplash.com/photo-1542332213-9b5a5a3fad35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
    ],
    $showControls = true
    ) {
    $html = '<section class="slider">';
        //` Slides
        $html .= '<div class="slides">';
        foreach ($images as $image) {
            $html .= '<span class="slide">';
                $html .= '<img src="' . $image . '" alt="Slider-Image">';
                // $html .= '<div class="caption">';
                //     $html .= '<h2>Slide Title</h2>';
                //     $html .= '<p>Sample Text</p>';
                // $html .= '</div>';
            $html .= '</span>';
        }
        $html .= '</div>';
        //` Controls
        if ($showControls) {
            $html .= '<div class="controls">';
                $html .= '<button id="prevBtn">Предыдущий</button>';
                $html .= '<button id="nextBtn">Следующий</button>';
            $html .= '</div>';
        }
    $html .= '</section>';
    //
    $addVersion = '?v=' . time();
    // $html .= '<style rel="stylesheet" href="/public/styles/widget-slider.css'. $addVersion . '"></style>';
    $html .= "<script>
        // Получаем все слайды и сохраняем их в переменную
        var slides = document.querySelectorAll('.slide');
        
        // Устанавливаем индекс текущего слайда
        var currentSlide = 0;
        
        // Функция для переключения слайдов
        function showSlide(index) {
            // Скрываем все слайды
            for (var i = 0; i < slides.length; i++) {
                slides[i].classList.remove('active');
            }
        
            // Показываем выбранный слайд
            slides[index].classList.add('active');
        }
        
        // Показываем первый слайд при загрузке страницы
        showSlide(currentSlide);
        
        // Обработчик события клика на кнопку 'Следующий слайд'
        document.getElementById('nextBtn').addEventListener('click', function() {
            // Увеличиваем индекс текущего слайда
            currentSlide++;
        
            // Если достигнут конец слайдов, переключаемся на первый слайд
            if (currentSlide === slides.length) {
                currentSlide = 0;
            }
        
            // Показываем текущий слайд
            showSlide(currentSlide);
        });
        
        // Обработчик события клика на кнопку 'Предыдущий слайд'
        document.getElementById('prevBtn').addEventListener('click', function() {
            // Уменьшаем индекс текущего слайда
            currentSlide--;
        
            // Если достигнуто начало слайдов, переключаемся на последний слайд
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }
        
            // Показываем текущий слайд
            showSlide(currentSlide);
        });
    </script>";
    return $html;
}

?>