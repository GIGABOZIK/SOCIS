-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Июн 09 2023 г., 15:08
-- Версия сервера: 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- Версия PHP: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tera`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `type_id` int(11) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `date_deadline` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `title`, `type_id`, `description`, `date_created`, `status_id`, `user_id`, `date_deadline`) VALUES
(8, 'Nice website', 1, '<p>Красиво сделайте</p>', '2023-05-28 17:57:17', 2, 30, '2023-06-30 00:00:00'),
(11, 'Cats', 1, '<p>Сайт с котиками</p>', '2023-05-28 19:41:23', 4, 31, '2023-06-23 00:00:00'),
(14, 'MobileApp', 2, '<p>Описание для проекта мобильного приложения</p>', '2023-06-01 19:01:05', 4, 33, '2023-08-23 00:00:00'),
(15, 'Project0015', 1, '<p>Наша компания ищет надежного партнера для разработки нашего нового веб-приложения. Наш проект представляет собой платформу для онлайн-торговли, которая объединяет продавцов и покупателей. Мы ищем разработчиков с опытом веб-разработки, знаниями HTML, CSS, JavaScript и баз данных. Нам важна надежность, безопасность данных и интуитивно понятный интерфейс. Мы готовы предоставить подробные требования и дизайн-макеты для работы. Мы рассчитываем на профессиональное сотрудничество и качественную разработку нашего проекта.</p>', '2023-06-01 20:21:22', 1, 33, '2023-11-11 00:00:00'),
(16, 'testProject', 3, '<p>test project description</p>\n<p>by admin 11@a.a</p>', '2023-06-01 20:23:50', 2, 28, '2023-06-25 00:00:00'),
(17, 'New Project', 1, '<p>сайт с котиками</p>', '2023-06-01 21:38:34', 5, 31, '2023-11-11 00:00:00'),
(18, 'Super Project', 2, '<p>Разработать приложение для Гос Услуг Электростали.</p>', '2023-06-02 13:04:37', 4, 34, '2023-07-03 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(16) NOT NULL DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'authorized'),
(2, 'admin'),
(4, 'client'),
(5, 'worker');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`) VALUES
(1, 'New'),
(2, 'In Progress'),
(3, 'Cancelled'),
(4, 'Completed'),
(5, 'Archived');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `title`) VALUES
(1, 'Веб-разработка'),
(2, 'Мобильная разработка'),
(3, 'Облачные решения'),
(4, 'ИТ-консалтинг');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `signup_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `role_id`, `signup_date`) VALUES
(28, '11', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', '11@a.a', 2, '2023-05-22 17:12:15'),
(30, '1234', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'abc@mail.ru', 2, '2023-05-28 08:03:45'),
(32, 'BestManager', '8e66ec0f082965920ccc93ca5a00ecad4b07133dff480d18117ae81761fc3339', 'bestmanager@socis.terabozik.tk', 2, '2023-02-23 20:22:02'),
(33, 'user', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 'user@user.mail', 1, '2023-06-01 18:57:04'),
(34, '23user', '8e66ec0f082965920ccc93ca5a00ecad4b07133dff480d18117ae81761fc3339', '23user@user.mail', 1, '2023-06-02 13:04:09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
