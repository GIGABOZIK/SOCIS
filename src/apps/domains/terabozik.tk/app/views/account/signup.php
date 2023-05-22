<!-- <h3>РЕГИСТРАЦИЯ (app - views - account - signup)</h3> -->

<form class="account" action="/account/signup" method="POST">
    <label for="login" title="Введите ваш уникальный логин">Логин:</label>
    <input type="text" id="login" name="login" placeholder="Введите Логин" required>

    <label for="email" title="Введите ваш Email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Введите Email" required>

    <label for="password" title="Придумайте надежный пароль">Пароль:</label>
    <input type="password" id="password" name="password" placeholder="Введите Пароль" required>

    <button type="submit">Зарегистрироваться</button>

    <p>Уже есть аккаунт? <a href="/account/login">Авторизоваться</a></p>
</form>

