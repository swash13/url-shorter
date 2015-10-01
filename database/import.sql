-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 01 2015 г., 23:20
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `url-shorter`
--

-- --------------------------------------------------------

--
-- Структура таблицы `browser_url`
--

CREATE TABLE IF NOT EXISTS `browser_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `browser` varchar(100) NOT NULL,
  `id_url` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `browser_url`
--

INSERT INTO `browser_url` (`id`, `browser`, `id_url`, `counter`) VALUES
(1, 'Chrome 45.0.2454.101', 14, 2),
(2, 'Chrome 45.0.2454.101', 15, 1),
(3, 'Chrome 45.0.2454.101', 18, 1),
(4, 'Chrome 45.0.2454.101', 19, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `country_url`
--

CREATE TABLE IF NOT EXISTS `country_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(100) NOT NULL,
  `id_url` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `country_url`
--

INSERT INTO `country_url` (`id`, `country_name`, `id_url`, `counter`) VALUES
(1, 'Ukraine', 13, 2),
(2, 'Undefined', 13, 3),
(3, 'Undefined', 14, 4),
(4, 'China', 14, 1),
(5, 'Undefined', 15, 1),
(6, 'Undefined', 18, 1),
(7, 'Undefined', 19, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin` varchar(255) NOT NULL,
  `short` varchar(8) NOT NULL,
  `date_add` datetime NOT NULL,
  `dieable` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `url`
--

INSERT INTO `url` (`id`, `origin`, `short`, `date_add`, `dieable`) VALUES
(14, 'http://recens.ru/php/detect_user_browser.html', 'zwZXn3CS', '2015-10-01 20:41:17', b'0'),
(15, 'http://google.com.ua', 'KdiQzrHn', '2015-10-01 22:09:23', b'0'),
(16, 'https://www.google.com.ua/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=%D0%BA%D0%B0%D0%BA%20%D0%BF%D0%B8%D1%81%D0%B0%D1%82%D1%8C%20readme.md', 'DzY5ksk1', '2015-10-01 22:16:27', b'0'),
(17, 'http://bigcinema.tv/series/univer-serial.html', 'Vv0E6qJL', '2015-10-01 22:28:59', b'1'),
(18, 'https://www.google.com.ua/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=%D0%BA%D0%B0%D0%BA%20%D0%BF%D0%B8%D1%81%D0%B0%D1%82%D1%8C%20readme.md', 'iCXwu_3t', '2015-10-01 22:38:32', b'1'),
(19, 'http://bigcinema.tv/series/univer-serial.html', '123123', '2015-10-01 22:55:24', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
