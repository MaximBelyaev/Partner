-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 24 2015 г., 11:26
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

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
-- Структура таблицы `landings`
--

DROP TABLE IF EXISTS `landings`;
CREATE TABLE IF NOT EXISTS `landings` (
  `land_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vip` varchar(250) NOT NULL,
  `extended` varchar(250) NOT NULL,
  `standard` varchar(250) NOT NULL,
  `click_pay` varchar(255) NOT NULL,
  `sort_order` varchar(15) NOT NULL,
  PRIMARY KEY (`land_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(255) NOT NULL,
  `text` varchar(4095) NOT NULL,
  `land_id` int(15) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`),
  UNIQUE KEY `news_id` (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news_views`
--

DROP TABLE IF EXISTS `news_views`;
CREATE TABLE IF NOT EXISTS `news_views` (
  `news_views_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`news_views_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `theme` int(2) NOT NULL,
  `text` varchar(4095) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_new` tinyint(1) NOT NULL,
  `stated_id` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `user_id` (`user_id`),
  KEY `stated_id` (`stated_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Структура таблицы `profit`
--

DROP TABLE IF EXISTS `profit`;
CREATE TABLE IF NOT EXISTS `profit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profit` decimal(8,0) DEFAULT '0',
  `full_profit` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

-- --------------------------------------------------------

--
-- Структура таблицы `promobanns`
--

DROP TABLE IF EXISTS `promobanns`;
CREATE TABLE IF NOT EXISTS `promobanns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `code` text CHARACTER SET latin1 NOT NULL,
  `land_id` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Структура таблицы `promovideo`
--

DROP TABLE IF EXISTS `promovideo`;
CREATE TABLE IF NOT EXISTS `promovideo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(4096) CHARACTER SET latin1 NOT NULL,
  `land_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Структура таблицы `referrals`
--

DROP TABLE IF EXISTS `referrals`;
CREATE TABLE IF NOT EXISTS `referrals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `site` varchar(150) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `tz` tinyint(1) DEFAULT NULL,
  `request_type` varchar(150) DEFAULT NULL,
  `requests` varchar(255) DEFAULT NULL,
  `user_from` varchar(255) DEFAULT NULL,
  `money` decimal(8,0) DEFAULT '0',
  `status` varchar(255) DEFAULT 'Ждет обработки',
  `user_id` int(11) DEFAULT NULL,
  `land_id` int(11) NOT NULL,
  `recreate_interval` varchar(255) NOT NULL,
  `recreate_date` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `promo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=223 ;

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT '',
  `click_pay` tinyint(1) NOT NULL,
  `land_id` int(255) NOT NULL,
  `partner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15477 ;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL,
  `value` varchar(4095) NOT NULL,
  `header` varchar(128) NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `setting_id` (`setting_id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;


INSERT INTO `settings` (`setting_id`, `type`, `name`, `status`, `value`, `header`) VALUES
(1, '', 'click_pay', '1', '4', 'Цена за переход'),
(11, 'pay_service', 'qiwi', '1', '', 'QIWI'),
(12, 'pay_service', 'webmoney', '1', '', 'WebMoney'),
(13, 'pay_service', 'yandex_money', '0', '', 'Яндекс Деньги'),
(14, 'pay_service', 'paypal', '0', '', 'PayPal'),
(15, '', 'fixed_pay', '0', '650', 'Фиксированная оплата'),
(16, '', 'vip', '0', '20', 'VIP'),
(17, '', 'extended', '0', '17', 'Расширенный'),
(18, '', 'standard', '0', '15', 'Cтандартный'),
(19, 'contacts', 'vk', '1', 'http://vk.com', 'ВК'),
(20, 'contacts', 'email', '1', 'somemail@mail.com', 'Почта'),
(21, 'contacts', 'skype', '1', 'someskype', 'Скайп'),
(22, '', 'landing_link', '1', 'somelink', 'Ссылка'),
(23, 'land', 'main_header', '1', 'ПАРТНЕРСКАЯ ПРОГРАММА\r\nПАВЛУЦКОГО АЛЕКСАНДРА', 'Основной заголовок'),
(24, 'land', 'main_bg', '1', '/img/main_bg.jpg', 'Главный фон'),
(25, 'land', 'main_bg_repeat', '1', 'no-repeat', 'Повторение главного фона'),
(26, 'contacts', 'phone', '1', 'somephone', 'Телефон');


-- --------------------------------------------------------

--
-- Структура таблицы `stateds`
--

DROP TABLE IF EXISTS `stateds`;
CREATE TABLE IF NOT EXISTS `stateds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `money` decimal(8,0) NOT NULL,
  `status` varchar(50) DEFAULT 'Ожидает оплату',
  `pay_type` varchar(50) NOT NULL,
  `requisites` varchar(50) NOT NULL,
  `description` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24103 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
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
  `use_fixed_pay` int(1) NOT NULL,
  `fixed_pay` int(11) NOT NULL,
  `promo_code` varchar(128) NOT NULL,
  `unc_site` varchar(255) NOT NULL,
  `land_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=190 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_landings`
--

DROP TABLE IF EXISTS `users_landings`;
CREATE TABLE IF NOT EXISTS `users_landings` (
  `users_landings_id` int(11) NOT NULL AUTO_INCREMENT,
  `land_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`users_landings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Структура таблицы `versions`
--

DROP TABLE IF EXISTS `versions`;
CREATE TABLE IF NOT EXISTS `versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
