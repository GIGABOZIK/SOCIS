// Скрипты крч
"use strict"; // Строгий режим
$("document").ready(function() {
    // Настройка
    let actSetMainScroll = setCfg("actSetMainScroll");
    let actPageAutoReload = setCfg("actPageAutoReload");
    let actHeaderSmooth = setCfg("actHeaderSmooth");
    let actSidebarToggle = setCfg("actSidebarToggle");
    let actBgParallax = setCfg("actBgParallax");
    let actEl404Timer = setCfg("actEl404Timer");
    // Основные блоки
    let elHeader = document.getElementById("header"); // Получить шапку
    let elSideTog = document.getElementById("h-side-tog"); // Получить переключатель сайдбара
    let elSidebar = document.getElementById("sidebar"); // Получить сайдбар
    let elMain = document.getElementById("main"); // Получить main
    let elMHeader = document.getElementById("m-header"); // Получить m-header
    let el404Timer = document.getElementById("el-404-timer"); // Получить таймер 404
    // Выполнение
    if (actSetMainScroll) { // Восстановить прокрутку main . сделать так, чтобы это выполнялось через php с проверкой текущей страницы
        if (getCookie("mainYOffs") !== null) elMain.scrollTop = getCookie("mainYOffs");
    }
    if (actPageAutoReload) { // Периодическая перезагрузка страницы
        setTimeout(function() { location.reload() }, 3000);
    }
    if (actSidebarToggle) { // Переключалка сайдбара
        elSideTog.addEventListener("click", function() {
            elSideTog.classList.toggle('active');
            elSidebar.classList.toggle('active');
        });
    }
    if (actEl404Timer) { // Таймер обратного отсчета на странице 404
        buildTimer(el404Timer, 39, 0);
    }
    // Другое:
    // Выполнить при прокрутке main
    elMain.addEventListener("scroll", function() {
        let mainYOffs = elMain.scrollTop; // Позиция прокрутки main
        // setCookie("mainYOffs", mainYOffs); // Записать позицию прокрутки main в куки
        // console.log(mainYOffs); // Вывод позиции в консоль
        // Выполнение
        if (actHeaderSmooth) { // Плавное появление фона шапки
            let opaHVal = 0.98;
            if (mainYOffs < 2) opaHVal = 0;
            else if (mainYOffs < 200) opaHVal = mainYOffs / 200;
            elHeader.style.setProperty("--O__header-before", opaHVal);
        }
        if (actBgParallax) { // Эффект параллакса для m-header
            if (mainYOffs < 555) {
                let MTImg = (mainYOffs * 0.9) + "px"; // 0.6
                let MTTitle = (mainYOffs * 1.05) + "px"; // 0.45
                elMHeader.style.setProperty("--M-t__m-h-img", MTImg);
                elMHeader.style.setProperty("--M-t__m-h-title-box", MTTitle);
            }
        }
    });
    // Выполнить при уходе со страницы
    window.onpagehide = function() {
        let mainYOffs = elMain.scrollTop; // Позиция прокрутки main
        setCookie("mainYOffs", mainYOffs); // Записать позицию прокрутки main в куки
    };
});
// Вспомогательные функции
function numWord(value, words, showNum = true) { // Склонение слов после числительного
    let num = value % 100;
    if (num > 19)
        num %= 10;
    let out = '';
    if (showNum)
        out = value + ' ';
    switch (num) {
        case 1:  out += words[0]; break;
        case 2:
        case 3:
        case 4:  out += words[1]; break;
        default: out += words[2]; break;
    }
    // console.log(out + ' - numWord - out');
    return out;
}
function buildTimer(elem, from, to) { // Таймер
    let curT = from;
    let timer = setInterval(function() {
        console.log(curT);
        elem.innerHTML = numWord(curT, ["секунда", "секунды", "секунд"]);
        if (curT == to) {
            clearInterval(timer);
            elem.innerHTML = "ПРЯМО СЕЙЧАС ;)";
        }
        else curT--;
    }, 1000);
}
function getCookie(name) { // Получить значение куки по имени name
    // возвращает куки с указанным name,
    // или undefined, если ничего не найдено
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
function setCookie(name, value, options = {}) { // Устанавливает куки с именем name и значением value, с настройкой path=/ по умолчанию (можно изменить, чтобы добавить другие значения по умолчанию):
    options = {
        path: '/',
        // при необходимости добавьте другие значения по умолчанию
        //...options
    };
    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }
    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }
    document.cookie = updatedCookie;
    // Пример использования: setCookie('user', 'John', {secure: true, 'max-age': 3600});
}
function scrollUp() { // Срабатывает при переходе на новую страницу (вызов через php)
    let elMain = document.getElementById("main"); // Получить main
    elMain.scrollTop = 0;
}