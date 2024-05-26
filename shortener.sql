-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Время создания: Май 26 2024 г., 23:04
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shortener`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sh_links`
--

CREATE TABLE `sh_links` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `link_original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link_shortener` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sh_links`
--

INSERT INTO `sh_links` (`id`, `user_id`, `link_original`, `link_shortener`, `date`) VALUES
(58, NULL, 'https://webref.ru/dev/json-tutorial/json-with-javascript', '8Caiw', 1692661013),
(61, NULL, 'https://www.youtube.com/watch?v=t0vXnVVoFPA', 'A6h2kBO', 1692750556);

-- --------------------------------------------------------

--
-- Структура таблицы `sh_users`
--

CREATE TABLE `sh_users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sh_users`
--

INSERT INTO `sh_users` (`id`, `name`, `login`, `password`) VALUES
(1, 'Марья Ивановна', 'mary', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Борис Петрович', 'boris', '46d045ff5190f6ea93739da6c0aa19bc');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sh_links`
--
ALTER TABLE `sh_links`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sh_users`
--
ALTER TABLE `sh_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sh_links`
--
ALTER TABLE `sh_links`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `sh_users`
--
ALTER TABLE `sh_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
