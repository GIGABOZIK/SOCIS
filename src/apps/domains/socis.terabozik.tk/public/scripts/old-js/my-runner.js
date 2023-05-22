/*
Запускатор скриптов вощпем
*/
"use strict";
/*
const tog = new Map([
    // Основные
    ['test',            0],
    ['pageAutoReload',  0],
    ['timer404',        1],
    ['sidebarToggle',   0],
    ['headerSmooth',    1],
    ['bgInflux',        1],
    // Вспомогательные
    // ['numWord',         1],
    // ['pageReload',      1],
    // ['elemReWrite',     1],
    // Другие
    // ['textareaResizer', 1]
]);
*/
//
if (tog.get('test'))
    test();
//
//
$('document').ready(function() {
    if (tog.get('pageAutoReload'))
        pageAutoReload();
    if (tog.get('timer404'))
        timer404(39, 0);
    if (tog.get('sidebarToggle'))
        sidebarToggle();
    // Запуск после загрузки страницы
    $(window).on('scroll', function() {
        if (tog.get('headerSmooth'))
            headerSmooth();
        if (tog.get('bgInflux'))
            bgInflux();
    });
    // Другие
    // Автоматическое изменение размеров textarea
    $(document).on('input', 'textarea', function () {
        $(this).outerHeight(38).outerHeight(this.scrollHeight);
    });
});
/**/