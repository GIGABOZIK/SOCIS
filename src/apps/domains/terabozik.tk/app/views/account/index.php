<?php

// // Заголовок страницы
// $title = 'Мой личный блог';

// // Описание страницы
// $description = 'Добро пожаловать на мой личный блог. Здесь я делюсь своими мыслями и идеями.';

// // Список последних статей
// $articles = [
//     [
//         'title' => 'Новые приключения',
//         'date' => '2023-05-01',
//         'content' => 'Сегодня я расскажу вам о своих новых увлекательных приключениях.',
//     ],
//     [
//         'title' => 'Впечатления от путешествия',
//         'date' => '2023-04-15',
//         'content' => 'Я вернулся из незабываемого путешествия, и сегодня поделюсь с вами своими впечатлениями.',
//     ],
//     // Добавьте другие статьи в список
// ];

// // Генерация HTML-кода главной страницы
// // generateHtmlTag($tag, $attributes = [], $content = '', $isSelfClosing = false)
// $html = ''
//     . generateHtmlTag('html', [], '
//         ' . generateHtmlTag('head', [], '
//             ' . generateHtmlTag('title', [], $title) . '
//             ' . generateHtmlTag('meta', ['name' => 'description', 'content' => $description], '', true) . '
//         ') . '
//         ' . generateHtmlTag('body', [], '
//             ' . generateHtmlTag('h1', [], $title) . '
//             ' . generateHtmlTag('p', [], $description) . '
//             ' . generateHtmlTag('h2', [], 'Последние статьи') . '
//             ' . generateHtmlTag('ul', [], '
//                 ' . array_reduce($articles, function ($carry, $article) {
//                     return $carry . generateHtmlTag('li', [], '
//                         ' . generateHtmlTag('h3', [], $article['title']) . '
//                         ' . generateHtmlTag('p', [], $article['date']) . '
//                         ' . generateHtmlTag('p', [], $article['content']) . '
//                     ');
//                 }, '') . '
//             ') . '
//         ') . '
//     ');
// // ');

// // Вывод сгенерированного HTML-кода
// echo $html;


// //` array_reduce() для сгенерированного списка последних статей. Эта функция позволяет преобразовать массив статей в HTML-код списка <ul><li>.

// // exit();


?>