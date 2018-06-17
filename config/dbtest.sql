-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3308
-- Время создания: Июн 17 2018 г., 06:03
-- Версия сервера: 5.7.21
-- Версия PHP: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dbtest`
--
CREATE DATABASE IF NOT EXISTS `dbtest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbtest`;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id_pic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `post_id` int(20) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pics`
--

CREATE TABLE `pics` (
  `id_pic` int(11) NOT NULL,
  `source` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_login` text NOT NULL,
  `user_password` text NOT NULL,
  `email` text NOT NULL,
  `email_confirmd` smallint(6) NOT NULL,
  `user_token` text NOT NULL,
  `notific` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `email`, `email_confirmd`, `user_token`, `notific`) VALUES
(15, 'soap5', '6152e7fd77247aa5f4ceb6a8d9f14e9d3dfc1e71d69601be5779de2c217807b8f9e3361ba044deb59819a1bee314a23087946380d9ccb9dee108ce5cbdcbf415', 'soap5@i.ua', 0, '8vked6m', 'Deactivated'),
(16, 'admin', 'cfd6db2d5800215f84c2455945c233c6f8404554960771a0d444a9905edcaa3aeffa0c32b1ba34bc4156580123f540a412d7822cb07abd164607149850fcc1e6', 'antares.sheptun@gmail.com', 1, 'tvolf83', 'Deactivated'),
(17, 'qwerty', '19b130742a9f81ab1741870e850894f686cdbd5d7dc9d5803b1687a471200073e07da9a7192bc758d2c1ae1a7de77ad2ee7b999cce6077fd6f90c4db0cdc94cd', 'tqwqts@gmail.com', 1, '6elofe0', 'Deactivated'),
(18, 'dima', 'cfd6db2d5800215f84c2455945c233c6f8404554960771a0d444a9905edcaa3aeffa0c32b1ba34bc4156580123f540a412d7822cb07abd164607149850fcc1e6', 'dmitry.sheptun@gmail.com', 1, 'b08a3sa', 'Deactivated');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`post_id`,`user_id`);

--
-- Индексы таблицы `pics`
--
ALTER TABLE `pics`
  ADD PRIMARY KEY (`id_pic`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pics`
--
ALTER TABLE `pics`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
