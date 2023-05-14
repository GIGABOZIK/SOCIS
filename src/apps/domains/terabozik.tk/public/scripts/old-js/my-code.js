/*
Скрипты вощпем
*/
"use strict";
//
//
/* Вспомогательные */
// Склонение слов после числа
function numWord(value, words, showNum = true) {
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
// Перезагрузка страницы
function pageReload() {
    location.reload();
}
// Изменить содержание элемента
function elemReWrite(elem = '.popup', content = 'Стандартное уведомление') {
    jQuery(elem).html(content);
}
//
/* Основные */
// Тест чего-нибудь
function test() {
    let a1 = 555;
    alert(a1);
}
// Периодическая перезагрузка страницы
function pageAutoReload() {
    setTimeout(pageReload, 3000);
}
// Таймер обратного отсчета до переадресации на 404
function timer404(from, to) {
    let current = from;
    let timer = setInterval(function() {
        elemReWrite('#timer-404',
            numWord(current, ['секунда', 'секунды', 'секунд'])
        );
        if (current == to) {
            clearInterval(timer);
            elemReWrite('#timer-404',
                'ПРЯМО СЕЙЧАС ;)'
            );
        }
        if (from > to) current--;
        else current++;
    }, 1000);
}
// Кноп04ка боковой панели
function sidebarToggle() {
    let sbtn = document.getElementById('sidebar-toggle');
    let sbar = document.getElementById('sidebar');
    let sund = document.getElementById('sidebar-under');
    sbtn.addEventListener('click', function() {
        sbtn.classList.toggle('active');
        sbar.classList.toggle('active');
        sund.classList.toggle('active');
    });
    sund.addEventListener('click', function() {
        sbtn.classList.toggle('active');
        sbar.classList.toggle('active');
        sund.classList.toggle('active');
    });
}
// Плавное появление фона шапки
function headerSmooth() {
    let pYOffs = window.pageYOffset;
    // console.log(pYOffs + ' - headerSmooth - pYOffs');
    if (pYOffs < 1) $('#header-back').css(
        { 'opacity' : 0 });
    else if (pYOffs < 200) $('#header-back').css(
        { 'opacity' : (pYOffs / 200) });/**/
    else $('#header-back').css(
        { 'opacity' : 1.0 });
}
// Эффект наложения на заднем фоне
function bgInflux() {
    let pYOffs = window.pageYOffset;
    // console.log(pYOffs + ' - bgInflux - pYOffs');
    if (pYOffs < 555) {
        $('#b-img').css(
            { 'top' : (pYOffs * 0.6) + 'px' });
        $('#b-title').css(
            { 'top' : 'calc(60% + ' + (pYOffs * 0.45) + 'px)' }
        );
    }
}
//