-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2017 г., 17:00
-- Версия сервера: 5.6.34-log
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2smileexpo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `lft`, `rgt`, `depth`, `name`) VALUES
(1, 1, 80, 0, '1'),
(2, 2, 13, 1, '2'),
(3, 3, 6, 2, '3'),
(4, 4, 5, 3, '4'),
(5, 7, 8, 2, '5'),
(6, 9, 10, 2, '6'),
(7, 11, 12, 2, '7'),
(8, 14, 17, 1, '8'),
(9, 15, 16, 2, '9'),
(10, 18, 19, 1, '10'),
(11, 20, 21, 1, '11'),
(12, 22, 29, 1, '12'),
(13, 23, 24, 2, '13'),
(14, 25, 26, 2, '14'),
(15, 27, 28, 2, '15'),
(16, 30, 35, 1, '16'),
(17, 31, 32, 2, '17'),
(18, 33, 34, 2, '18'),
(19, 36, 37, 1, '19'),
(20, 38, 39, 1, '20'),
(21, 40, 53, 1, '21'),
(22, 41, 42, 2, '22'),
(23, 43, 52, 2, '23'),
(24, 44, 49, 3, '24'),
(25, 45, 48, 4, '25'),
(26, 46, 47, 5, '26'),
(27, 50, 51, 3, '27'),
(28, 54, 55, 1, '28'),
(29, 56, 57, 1, '29'),
(30, 58, 59, 1, '30'),
(31, 60, 61, 1, '31'),
(32, 62, 63, 1, '32'),
(33, 64, 65, 1, '33'),
(34, 66, 67, 1, '34'),
(35, 68, 69, 1, '35'),
(36, 70, 79, 1, '36'),
(37, 71, 78, 2, '37'),
(38, 72, 77, 3, '38'),
(39, 73, 74, 4, '39'),
(40, 75, 76, 4, '40');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1513873662),
('m171221_162345_menu', 1514036889);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
