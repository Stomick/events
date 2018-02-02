-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 02 2018 г., 23:17
-- Версия сервера: 5.7.21-0ubuntu0.16.04.1
-- Версия PHP: 5.6.33-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `events`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(25) COLLATE utf8_bin NOT NULL,
  `urlimg` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `title`, `description`, `name`, `urlimg`) VALUES
(1, NULL, NULL, 'Дети', 'img/category/deti.jpg'),
(2, NULL, NULL, 'Игры', 'img/category/igri.jpg'),
(3, NULL, NULL, 'Кинон', 'img/category/kino.jpg'),
(4, NULL, NULL, 'Концерты и Выступления', 'img/category/koncerti_i_vistupleniya.jpg'),
(5, NULL, NULL, 'Культура и искуство', 'img/category/kultura_i_isskustvo.jpg'),
(6, NULL, NULL, 'Мода и стиль', 'img/category/moda_i_stil.jpg'),
(7, NULL, NULL, 'Музика', 'img/category/muzika.jpg'),
(8, NULL, NULL, 'Наука', 'img/category/nauka.jpg'),
(9, NULL, NULL, 'Обучение', 'img/category/obuchenie.jpg'),
(10, NULL, NULL, 'Приключения и туризм', 'img/category/priklucheniya_i_turizm.jpg'),
(11, NULL, NULL, 'Прогулки', 'img/category/progulki.jpg'),
(12, NULL, NULL, 'Работа и бизнес', 'img/category/rabota_i_biznes.jpg'),
(13, NULL, NULL, 'Спорт', 'img/category/sport.jpg'),
(14, NULL, NULL, 'Танци', 'img/category/tanci.jpg'),
(15, NULL, NULL, 'Технологии', 'img/category/tehnologii.jpg'),
(16, NULL, NULL, 'Творчество', 'img/category/tvorchestvo.jpg'),
(17, NULL, NULL, 'Вечеринки и встречи', 'img/category/vecherinki_i_vstrechi.jpg'),
(18, NULL, NULL, 'Здоровье', 'img/category/zdorovie.jpg'),
(19, NULL, NULL, 'Животные', 'img/category/zhivotnie.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_bin NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1517486298),
('m180131_124022_create_user_table', 1517486301),
('m180201_162020_create_category', 1517560805),
('m180202_083625_create_user_to_category', 1517561126);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `surename` varchar(255) COLLATE utf8_bin NOT NULL,
  `birthday` datetime NOT NULL,
  `gender` varchar(25) COLLATE utf8_bin NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_bin NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_bin NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `username`, `surename`, `birthday`, `gender`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(13, 'andrey', 'Юрьевич', '2018-02-07 00:00:00', 'мужской', 'eR5Acij7-DSUo1rLegRTtk9DFCVnOLya', '$2y$13$XXvvwOy0FGBlkIasTQfS.uLn5cwItnmwHH5gk4q1iK7mCamgTlWZC', NULL, 'ag.stomick@gmail.com', 10, 1517581478, 1517581478),
(14, 'dfg', 'Юрьевич', '2018-02-08 00:00:00', 'мужской', '4cWo1J360zyc0f5EzFKUpmql2O91lgFw', '$2y$13$Pt1wAzWopd2l8UoAWJYRfuvuvlHAo6ERWnNExRR.wKDOJuTVZoXnm', NULL, 'info@skvader.net', 10, 1517583858, 1517583858),
(15, 'Timophiy', 'Buytov', '2018-02-04 00:00:00', 'мужской', 'Sz3XyUSWw78ZYAWQTASRFr0fvtd0zb6F', '$2y$13$V0lKApxtv4F4uSd3V4hF3.MhChCl6zRF2OxsCbsSdU9WbYU4kNOB2', NULL, 'neskazhu@mail.ru', 10, 1517584052, 1517584052);

-- --------------------------------------------------------

--
-- Структура таблицы `user_to_category`
--

CREATE TABLE `user_to_category` (
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `user_to_category`
--
ALTER TABLE `user_to_category`
  ADD PRIMARY KEY (`user_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_to_category`
--
ALTER TABLE `user_to_category`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
