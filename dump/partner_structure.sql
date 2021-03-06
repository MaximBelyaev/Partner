-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 23 2015 г., 16:58
-- Версия сервера: 5.6.26
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `partner_structure`
--

-- --------------------------------------------------------

--
-- Структура таблицы `landings`
--

CREATE TABLE IF NOT EXISTS `landings` (
  `land_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vip` varchar(250) NOT NULL,
  `extended` varchar(250) NOT NULL,
  `standard` varchar(250) NOT NULL,
  `use_click_pay` tinyint(1) NOT NULL,
  `use_fixed_pay` tinyint(1) NOT NULL,
  `click_pay` int(11) NOT NULL,
  `fixed_pay` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `sort_order` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `text` varchar(4095) NOT NULL,
  `land_id` int(15) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_views`
--

CREATE TABLE IF NOT EXISTS `news_views` (
  `news_views_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `theme` int(2) NOT NULL,
  `text` varchar(4095) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_new` tinyint(1) NOT NULL,
  `stated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `percent` varchar(11) NOT NULL,
  `fixed_pay` varchar(11) NOT NULL,
  `click_pay` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `offers`
--

INSERT INTO `offers` (`id`, `name`, `percent`, `fixed_pay`, `click_pay`) VALUES
(1, 'Samplename', '20%', '400 руб.', '20 руб.'),
(2, 'Samplename', '20%', '400 руб.', '20 руб.'),
(3, 'Samplename', '20%', '400 руб.', '20 руб.');

-- --------------------------------------------------------

--
-- Структура таблицы `profit`
--

CREATE TABLE IF NOT EXISTS `profit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profit` decimal(8,0) DEFAULT '0',
  `full_profit` decimal(10,0) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `promobanns`
--

CREATE TABLE IF NOT EXISTS `promobanns` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `code` text CHARACTER SET latin1 NOT NULL,
  `land_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `promovideo`
--

CREATE TABLE IF NOT EXISTS `promovideo` (
  `id` int(11) NOT NULL,
  `link` varchar(4096) CHARACTER SET latin1 NOT NULL,
  `land_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `id` int(11) NOT NULL,
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
  `promo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT '',
  `click_pay` tinyint(1) NOT NULL,
  `land_id` int(255) NOT NULL,
  `partner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL,
  `value` varchar(4095) NOT NULL,
  `header` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`setting_id`, `type`, `name`, `status`, `value`, `header`) VALUES
(1, '', 'click_pay', '1', '4', 'Цена за переход'),
(2, '', 'exception_sites', '0', 'http://vk.com https://www.google.com.ua http://www.yandex.ua https://www.google.com.ru http://www.yandex.ru http://www.rambler.ru/', 'Запрещенные к закреплению сайты'),
(3, 'pay_service', 'qiwi', '1', '', 'QIWI'),
(4, 'pay_service', 'webmoney', '1', '', 'WebMoney'),
(5, 'pay_service', 'yandex_money', '0', '', 'Яндекс Деньги'),
(6, 'pay_service', 'paypal', '0', '', 'PayPal'),
(7, '', 'vk', '1', 'http://vk.com/im?media=&sel=300550399', 'ВК'),
(8, '', 'email', '1', 'somemail', 'Почта'),
(9, '', 'skype', '1', 'someskype2', 'Скайп'),
(10, '', 'landing_link', '1', 'somelink2', 'Ссылка'),
(11, '', 'phone', '1', '', 'Номер телефона'),
(12, '', 'currency', '', 'RUB', 'Валюта');

-- --------------------------------------------------------

--
-- Структура таблицы `stateds`
--

CREATE TABLE IF NOT EXISTS `stateds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `money` decimal(8,0) NOT NULL,
  `status` varchar(50) DEFAULT 'Ожидает оплату',
  `pay_type` varchar(50) NOT NULL,
  `requisites` varchar(50) NOT NULL,
  `description` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
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
  `promo_code` varchar(128) NOT NULL,
  `promo_video` varchar(255) NOT NULL,
  `unc_site` varchar(255) NOT NULL,
  `land_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_landings`
--

CREATE TABLE IF NOT EXISTS `users_landings` (
  `users_landings_id` int(11) NOT NULL,
  `land_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `use_click_pay` tinyint(1) NOT NULL,
  `use_fixed_pay` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `versions`
--

CREATE TABLE IF NOT EXISTS `versions` (
  `version` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `landings`
--
ALTER TABLE `landings`
  ADD PRIMARY KEY (`land_id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD UNIQUE KEY `news_id` (`news_id`);

--
-- Индексы таблицы `news_views`
--
ALTER TABLE `news_views`
  ADD PRIMARY KEY (`news_views_id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `stated_id` (`stated_id`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promobanns`
--
ALTER TABLE `promobanns`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promovideo`
--
ALTER TABLE `promovideo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`),
  ADD UNIQUE KEY `setting_id` (`setting_id`,`name`);

--
-- Индексы таблицы `stateds`
--
ALTER TABLE `stateds`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_landings`
--
ALTER TABLE `users_landings`
  ADD PRIMARY KEY (`users_landings_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `landings`
--
ALTER TABLE `landings`
  MODIFY `land_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_views`
--
ALTER TABLE `news_views`
  MODIFY `news_views_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `profit`
--
ALTER TABLE `profit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `promobanns`
--
ALTER TABLE `promobanns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `promovideo`
--
ALTER TABLE `promovideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `stateds`
--
ALTER TABLE `stateds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users_landings`
--
ALTER TABLE `users_landings`
  MODIFY `users_landings_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
