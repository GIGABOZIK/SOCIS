
<form class="account" action="/account/signup" method="POST">
    <label for="login" title="Введите ваш уникальный логин">Логин:</label>
    <input type="text" id="login" name="login" placeholder="Введите Логин" maxlength="32" required>

    <label for="email" title="Введите ваш Email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Введите Email" maxlength="64" required>

    <label for="password" title="Придумайте надежный пароль">Пароль:</label>
    <input type="password" id="password" name="password" placeholder="Введите Пароль" maxlength="32" required>

    <button type="submit">Зарегистрироваться</button>

    <p>Уже есть аккаунт? <a href="/account/login">Авторизоваться</a></p>
</form>

