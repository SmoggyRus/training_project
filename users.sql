-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 29 2025 г., 16:53
-- Версия сервера: 5.7.39
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT 'Новый пользователь',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `job_title` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'danger',
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `vk` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`, `job_title`, `status`, `image`, `phone`, `address`, `vk`, `telegram`, `instagram`) VALUES
(12, 'user1@mail.ru', '$2y$10$8HYhluYw6P02feiOyH9RYO8gqJo8Nr8hAjcoVqPgwb/qPucrWX8Z2', 'Руслан', 'admin', 'PHP недоDeveloper', 'danger', 'avatar-r.jpg', '+7(903)088-85-79', 'г.Челябинск', 'https://vk.com/johnywolf28', 'https://t.me/evillnel', 'https://instagram.com'),
(14, 'admin@example.com', '$2y$10$Padc6jT4a.p0hVL0CHim7eIXxIpqodblq6zgII9Y4uT6vv.4bpWr6', 'Администратор', 'admin', 'Администратор', 'danger', '679a0aca45d09.png', '88005553535', 'г.Челябинск', 'vk.com/admin', 'tg.me/admin', 'instagram.com/admin'),
(19, 'admin2@example.com', '$2y$10$UDR.5.a0FBZ2/s8s7Eig1.784M13R7YVB5GD.Ibla2OxjdT2d671K', 'Администратор 2', 'admin', 'ШИШКИН ЛЕС', 'danger', '679772e1bc6f9.png', '+7 (913) 500-29-30', 'г. Москва', 'https://vk.com/tuda-suda', 'https://tg.me/tuda-suda', 'https://instagram.com/tuda-suda '),
(26, 'user2@mail.ru', '$2y$10$bOFnDbXafxxz/b4MoJVeNu012SYbXtivWTX3QLQqq/AOCGOKAPqxq', 'Второй пользователь', 'user', 'StepLine', 'success', '679a3207d2273.png', '88055532323', 'Москва', 'vk.com', 'tg.me/', 'insta');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
