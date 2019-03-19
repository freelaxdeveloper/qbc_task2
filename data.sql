-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 19 2019 г., 11:13
-- Версия сервера: 5.7.22-0ubuntu0.17.10.1
-- Версия PHP: 5.6.36-1+ubuntu17.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `qbc_task`
--

--
-- Дамп данных таблицы `manuals`
--

INSERT INTO `manuals` (`id`, `type`, `label`, `user_id`, `type_field`, `position`) VALUES
(1, 'moyi_foto', 'Имя кота', 1, 'text', 1),
(3, 'moyi_foto', 'Опишите кота', 1, 'textarea', 3),
(4, 'moyi_foto', 'Домашние питомцы', 1, 'select', 4),
(7, 'moyi_foto', 'Порода', 1, 'text', 9),
(8, 'moyi_foto', 'Select', 1, 'select', 10),
(9, 'testoviy_spravochnik', 'Для теста', 1, 'text', 3),
(11, 'moyi_foto', 'Фото кота', 1, 'file', 2);

--
-- Дамп данных таблицы `manual_options`
--

INSERT INTO `manual_options` (`id`, `manual_id`, `label`) VALUES
(1, 4, 'Кот'),
(2, 4, 'Пёс'),
(3, 4, 'Бобр'),
(4, 8, 'Поле 1'),
(5, 8, 'Поле 2'),
(6, 8, 'Поле 3');

--
-- Дамп данных таблицы `manual_types`
--

INSERT INTO `manual_types` (`id`, `title`, `type_key`, `type`) VALUES
(1, 'Тестовый справочник', 'testoviy_spravochnik', 'people'),
(2, 'Фото', 'moyi_foto', 'people');

--
-- Дамп данных таблицы `manual_values`
--

INSERT INTO `manual_values` (`id`, `user_id`, `manual_id`, `value`) VALUES
(39, 1, 1, 'Имя кота'),
(40, 1, 4, 'Кот'),
(41, 1, 8, 'Поле 1');

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `info`) VALUES
(1, 'Test', 'sdfsdfsdf', 'Info Info Info Info Info '),
(2, 'Admin', 'sdfcsd%$dfgdfgdfg', 'Aaaaaaaaaaaaaaaaaaaaaaaaaa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
