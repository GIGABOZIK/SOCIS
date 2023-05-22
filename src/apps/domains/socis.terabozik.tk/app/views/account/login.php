<!-- <h3>АВТОРИЗАЦИЯ (app - views - account - login)</h3> -->

<form class="account" action="/account/login" method="POST">
    <label for="login" title="Введите ваш логин">Логин:</label>
    <input type="text" id="login" name="login" placeholder="Введите Логин" required>

    <label for="password" title="Введите ваш пароль">Пароль:</label>
    <input type="password" id="password" name="password" placeholder="Введите Пароль" required>

    <button type="submit">Авторизоваться</button>

    <p>Нет аккаунта? <a href="/account/signup">Зарегистрироваться</a></p>
</form>
