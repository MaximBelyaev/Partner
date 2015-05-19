-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 14 2015 г., 10:57
-- Версия сервера: 5.5.37-log
-- Версия PHP: 5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `partner`
--

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `code` text NOT NULL,
  `video_link` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Структура таблицы `landings`
--

CREATE TABLE IF NOT EXISTS `landings` (
  `land_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`land_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(255) NOT NULL,
  `text` varchar(4095) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`),
  UNIQUE KEY `news_id` (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news_views`
--

CREATE TABLE IF NOT EXISTS `news_views` (
  `news_views_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`news_views_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stated_id` int(11) NOT NULL,
  `theme` int(2) NOT NULL,
  `text` varchar(4095) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_new` tinyint(1) NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `user_id` (`user_id`),
  KEY `stated_id` (`stated_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `profit`
--

CREATE TABLE IF NOT EXISTS `profit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profit` decimal(8,2) DEFAULT '0.00',
  `full_profit` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

-- --------------------------------------------------------

--
-- Структура таблицы `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `land_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `site` varchar(150) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `tz` tinyint(1) DEFAULT NULL,
  `request_type` varchar(150) DEFAULT NULL,
  `requests` varchar(255) DEFAULT NULL,
  `user_from` varchar(255) DEFAULT NULL,
  `money` decimal(8,2) DEFAULT '0.00',
  `status` varchar(255) DEFAULT 'Ждет обработки',
  `recreate_interval` varchar(255) NOT NULL,
  `recreate_date` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `promo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT '',
  `click_pay` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15475 ;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `status` varchar(4095) NOT NULL,
  `value` varchar(4095) NOT NULL,
  `header` varchar(128) NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `setting_id` (`setting_id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;



--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`setting_id`, `name`, `status`, `value`, `header`) VALUES
(1, 'click_pay', '1', '2', 'Цена за переход'),
(2, 'exception_sites', '0', 'http://vk.com https://www.google.com.ua http://www.yandex.ua https://www.google.com.ru http://www.yandex.ru http://www.rambler.ru/', 'Запрещенные к закреплению сайты'),
(11, 'qiwi', '1', '', 'QIWI'),
(12, 'webmoney', '1', '', 'WebMoney'),
(13, 'yandex_money', '1', '', 'Яндекс Деньги'),
(14, 'paypal', '1', '', 'PayPal'),
(15, 'fixed_pay', '0', '650', 'Фиксированная оплата'),
(16, 'vip', '', '20%', 'VIP'),
(17, 'extended', '', '17%', 'Расширенный'),
(18, 'standard', '', '15%', 'Cтандартный'),
(19, 'vk', '1', 'http://vk.com/im?media=&sel=300550399', 'ВК'),
(20, 'email', '1', 'somemail', 'Почта'),
(21, 'skype', '1', 'someskype2', 'Скайп'),
(22, 'landing_link', '1', 'somelink', 'Ссылка');


-- --------------------------------------------------------

--
-- Структура таблицы `stateds`
--

CREATE TABLE IF NOT EXISTS `stateds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `money` decimal(8,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Ожидает оплату',
  `pay_type` varchar(50) NOT NULL,
  `requisites` varchar(50) NOT NULL,
  `description` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT 'user',
  `username` varchar(150) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `birth_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `country` varchar(150) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `verification` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `telephone` varchar(50) DEFAULT NULL,
  `skype` varchar(128) NOT NULL,
  `use_click_pay` tinyint(1) NOT NULL,
  `click_pay` int(11) NOT NULL,
  `promo_code` varchar(128) NOT NULL,
  `promo_video` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
