FAQ


<style>
.slider {
    position: relative;
    width: 100%;
    height: 400px; /* Укажите высоту слайдера */
    overflow: hidden;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slide.active {
    opacity: 1;
}

.caption {
    position: absolute;
    bottom: 20px;
    left: 20px;
    color: #fff;
}

.caption h2 {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
}

.caption p {
    font-size: 16px;
    margin: 10px 0 0;
}

</style>

<div class="slider">
    <div class="slide">
        <img src="https://images.unsplash.com/photo-1542451542907-6cf80ff362d6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1521&q=80" alt="Slide 1">
        <div class="caption">
            <h2>Slide 1 Title</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </div>
    <div class="slide">
        <img src="https://images.unsplash.com/photo-1542397284385-6010376c5337?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Slide 2">
        <div class="caption">
            <h2>Slide 2 Title</h2>
            <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
    <div class="slide">
        <img src="https://images.unsplash.com/photo-1542332213-9b5a5a3fad35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Slide 3">
        <div class="caption">
            <h2>Slide 3 Title</h2>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
</div>
<!-- Добавьте следующий код в HTML для кнопок "Следующий слайд" и "Предыдущий слайд" -->
<button id="prevBtn">Предыдущий слайд</button>
<button id="nextBtn">Следующий слайд</button>

<script>
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

// Обработчик события клика на кнопку "Следующий слайд"
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

// Обработчик события клика на кнопку "Предыдущий слайд"
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
</script>
