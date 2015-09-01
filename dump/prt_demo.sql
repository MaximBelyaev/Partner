-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 25 2015 г., 13:14
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `prt_demo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `landings`
--

DROP TABLE IF EXISTS `landings`;
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
  `sort_order` varchar(15) NOT NULL,
  PRIMARY KEY (`land_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `landings`
--

INSERT INTO `landings` (`land_id`, `link`, `name`, `vip`, `extended`, `standard`, `use_click_pay`, `use_fixed_pay`, `click_pay`, `fixed_pay`, `icon`, `sort_order`) VALUES
(1, 'http://iwatchtestland.com', 'iwatchtestland', '', '', '', 0, 0, 0, 0, '', '1'),
(2, 'http://gglasstestland.com', 'gglasstestland', '', '', '', 0, 1, 255, 300, '', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`news_id`, `header`, `text`, `land_id`, `date`) VALUES
(1, 'Социометрический план размещения: гипотеза и теории', '<p style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; background-color: rgb(255, 255, 255);">Как предсказывают футурологи селекция бренда уравновешивает медиамикс, используя опыт предыдущих кампаний. Мониторинг активности упорядочивает конструктивный product placement. Практика однозначно показывает, что рекламное сообщество уравновешивает коллективный контент.</p><p style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; background-color: rgb(255, 255, 255);">Ценовая стратегия, в рамках сегодняшних воззрений, изоморфна времени. Экспертиза выполненного проекта ускоряет конвергентный рекламный блок. Медиапланирование не критично. Стратегический маркетинг основан на опыте. Опрос масштабирует типичный рейтинг. PR слабо обуславливает план размещения.</p>', 1, '2025-08-20 12:00:00'),
(2, 'Из ряда вон выходящий маркетинг: предпосылки и развитие', '<p style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; background-color: rgb(255, 255, 255);">Несмотря на сложности, медиапланирование транслирует повседневный медиамикс, не считаясь с затратами. Позиционирование на рынке, следовательно, концентрирует баинг и селлинг. Размещение уравновешивает межличностный процесс стратегического планирования. Искусство медиапланирования амбивалентно. Наряду с этим, емкость рынка парадоксально отталкивает потребительский показ баннера.</p><p style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; background-color: rgb(255, 255, 255);">Узнавание бренда концентрирует институциональный рейтинг. Формат события экономит медиамикс. Несмотря на сложности, емкость рынка искажает бюджет на размещение, используя опыт предыдущих кампаний.</p>', 0, '2025-08-20 12:00:00'),
(3, 'Комплексный пул лояльных изданий в XXI веке', '<p style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; background-color: rgb(255, 255, 255);">Повышение жизненных стандартов развивает охват аудитории, работая над проектом. Емкость рынка откровенна. Жизненный цикл продукции специфицирует межличностный традиционный канал. Продуктовый ассортимент реально восстанавливает медиаплан.</p><p style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; background-color: rgb(255, 255, 255);">Сегментация рынка методически синхронизирует конструктивный рекламный блок. Медиапланирование концентрирует продукт, отвоевывая свою долю рынка. Представляется логичным, что структура рынка определяет формирование имиджа. Диктат потребителя без оглядки на авторитеты определяет обществвенный пул лояльных изданий. В соответствии с законом Ципфа, лидерство в продажах порождает социометрический анализ зарубежного опыта.</p>', 0, '2025-08-20 12:00:00'),
(4, 'Почему правомочен пак-шот?', '<p>К тому же выставочный стенд концентрирует потребительский анализ рыночных цен. В соответствии с законом Ципфа, бизнес-стратегия по-прежнему востребована. VIP-мероприятие, следовательно, притягивает из ряда вон выходящий продукт.</p><p>Потребительский рынок директивно стабилизирует стиль менеджмента. Контекстная реклама индуцирует фирменный рекламоноситель, повышая конкуренцию. Баннерная реклама, как следует из вышесказанного, отражает эксклюзивный целевой сегмент рынка. Согласно ставшей уже классической работе Филипа Котлера, перераспределение бюджета переворачивает контент.</p><p><img src="/uploads/news/text/91d5b524093c2a127270d76bd30baf66.png"><span></span><br></p>', 0, '2015-08-25 06:27:56');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `theme`, `text`, `date`, `is_new`, `stated_id`) VALUES
(1, 10, 1, '', '2015-08-25 08:44:05', 1, 1),
(2, 5, 1, '', '2015-08-25 08:44:52', 1, 2),
(3, 5, 1, '', '2015-08-25 08:45:08', 1, 3),
(4, 8, 1, '', '2015-08-25 08:46:05', 1, 4),
(5, 8, 1, '', '2015-08-25 08:46:17', 1, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `profit`
--

INSERT INTO `profit` (`id`, `user_id`, `profit`, `full_profit`) VALUES
(1, 1, '1500', '1500'),
(2, 2, '0', '0'),
(3, 3, '0', '0'),
(4, 4, '0', '0'),
(5, 5, '1500', '2000'),
(6, 6, '0', '0'),
(7, 7, '0', '0'),
(8, 8, '800', '1000'),
(9, 9, '0', '0'),
(10, 10, '4400', '4500');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `promobanns`
--

INSERT INTO `promobanns` (`id`, `type`, `name`, `image`, `width`, `height`, `code`, `land_id`) VALUES
(1, 'gif', 'iWatch', '1225-iWatch-iOS-400x250.jpg', 400, 250, '', 0),
(2, 'gif', 'Google Glass', '4253-google-glass-380x250.jpg', 380, 250, '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `promovideo`
--

INSERT INTO `promovideo` (`id`, `link`, `land_id`, `banner_id`) VALUES
(1, 'https://www.youtube.com/watch?v=5Muob6v9czE', 1, 0);

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
  `status` varchar(255) DEFAULT 'Заявка',
  `user_id` int(11) DEFAULT NULL,
  `land_id` int(11) NOT NULL,
  `recreate_interval` varchar(255) NOT NULL,
  `recreate_date` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `promo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `referrals`
--

INSERT INTO `referrals` (`id`, `email`, `site`, `region`, `tz`, `request_type`, `requests`, `user_from`, `money`, `status`, `user_id`, `land_id`, `recreate_interval`, `recreate_date`, `date`, `promo`) VALUES
(1, 'myreferral@gmail.lil', 'myreferral.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 1, 1, '', '', '2015-06-21 06:47:01', NULL),
(2, 'mycoolreferral@gmail.lil', 'mycoolreferral.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 2, 1, '', '', '2015-05-24 06:47:01', NULL),
(3, 'li@gmail.lil', 'li.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 3, 1, '', '', '2015-07-31 06:47:01', NULL),
(4, 'likethis@gmail.lil', 'likethis.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 1, 1, '', '', '2015-04-13 03:47:01', NULL),
(5, 'howareyou@gmail.lil', 'howareyou.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 2, 1, '', '', '2015-08-10 03:47:01', NULL),
(6, 'kakdela@gmail.lil', 'kakdela.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 3, 1, '', '', '2015-03-09 04:47:01', NULL),
(7, 'chtotam@gmail.lil', 'chtotam.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 5, 1, '', '', '2015-05-25 03:47:01', NULL),
(8, 'sobachka@gmail.lil', 'sobachka.lil', NULL, NULL, NULL, NULL, NULL, '2000', 'Оплачено', 5, 1, '', '', '2015-07-05 03:47:01', NULL),
(9, 'hochu-est@gmail.lil', 'hochu-est.lil', NULL, NULL, NULL, NULL, NULL, '1000', 'Оплачено', 8, 1, '', '', '2015-06-17 03:47:01', NULL),
(10, 'milaha@gmail.lil', 'milaha.lil', NULL, NULL, NULL, NULL, NULL, '0', 'Заявка', 6, 1, '', '', '2015-08-25 03:47:01', NULL),
(11, 'gaz@gmail.lil', 'gaz.lil', NULL, NULL, NULL, NULL, NULL, '4500', 'Оплачено', 10, 1, '', '', '2015-06-14 03:47:01', NULL),
(12, 'novosti@gmail.lil', 'novosti.lil', NULL, NULL, NULL, NULL, NULL, '1500', 'Оплачено', 1, 1, '', '', '2015-04-01 03:47:01', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=167 ;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `ip`, `date`, `click_pay`, `land_id`, `partner_id`) VALUES
(1, '127.0.0.1', '2015-07-27', 0, 1, 2),
(2, '178.219.88.21', '2015-07-18', 0, 1, 2),
(3, '95.46.126.222', '2015-03-18', 0, 1, 2),
(4, '178.219.88.21', '2015-02-8', 0, 1, 1),
(5, '178.219.88.21', '2015-05-7', 0, 1, 1),
(6, '95.46.126.222', '2015-03-17', 0, 2, 0),
(7, '95.46.124.83', '2015-01-20', 0, 1, 0),
(8, '95.46.126.92', '2015-02-20', 0, 1, 0),
(9, '95.46.127.98', '2015-07-17', 0, 2, 0),
(10, '185.4.43.88', '2015-01-18', 0, 2, 0),
(11, '185.4.43.88', '2015-07-8', 0, 2, 0),
(12, '95.46.125.241', '2015-07-13', 0, 1, 0),
(13, '78.26.133.3', '2015-05-24', 0, 2, 0),
(14, '78.26.133.3', '2015-01-29', 0, 2, 0),
(15, '195.91.169.129', '2015-06-13', 0, 1, 0),
(16, '195.91.169.129', '2015-01-26', 0, 2, 0),
(17, '195.91.169.129', '2015-03-1', 0, 2, 0),
(18, '95.27.67.157', '2015-02-14', 0, 2, 0),
(19, '79.165.63.231', '2015-08-11', 0, 1, 0),
(20, '66.249.89.24', '2015-07-18', 0, 1, 0),
(21, '92.255.167.55', '2015-02-27', 0, 2, 0),
(22, '92.242.35.54', '2015-01-17', 0, 2, 0),
(23, '95.220.24.128', '2015-05-12', 0, 2, 0),
(24, '95.220.24.128', '2015-02-9', 0, 1, 0),
(25, '109.197.8.85', '2015-02-21', 0, 1, 0),
(26, '74.112.131.244', '2015-03-29', 0, 1, 0),
(27, '74.112.131.243', '2015-03-10', 0, 2, 0),
(28, '77.37.134.37', '2015-07-10', 0, 2, 0),
(29, '195.208.32.237', '2015-08-28', 0, 2, 0),
(30, '188.186.40.85', '2015-06-19', 0, 1, 0),
(31, '91.201.226.212', '2015-02-25', 0, 1, 0),
(32, '194.126.181.56', '2015-06-24', 0, 1, 0),
(33, '92.248.184.133', '2015-08-14', 0, 2, 0),
(34, '92.248.184.133', '2015-04-20', 0, 1, 0),
(35, '46.175.64.34', '2015-02-14', 0, 1, 0),
(36, '92.248.184.133', '2015-08-13', 0, 1, 0),
(37, '185.4.43.88', '2015-03-28', 0, 1, 0),
(38, '188.186.40.85', '2015-07-21', 0, 2, 0),
(39, '213.141.128.150', '2015-07-29', 0, 2, 0),
(40, '5.255.253.43', '2015-04-10', 0, 1, 0),
(41, '185.4.43.88', '2015-03-5', 0, 1, 1),
(42, '185.4.43.88', '2015-01-25', 0, 2, 1),
(43, '94.28.41.54', '2015-01-16', 0, 2, 0),
(44, '77.45.235.33', '2015-05-11', 0, 1, 0),
(45, '89.189.159.81', '2015-01-7', 0, 1, 0),
(46, '193.238.38.85', '2015-07-12', 0, 2, 0),
(47, '193.238.38.85', '2015-05-13', 0, 1, 0),
(48, '193.238.38.85', '2015-05-24', 0, 1, 0),
(49, '199.16.156.125', '2015-01-27', 0, 1, 0),
(50, '199.16.156.124', '2015-04-10', 0, 1, 0),
(51, '91.79.171.194', '2015-03-25', 0, 1, 0),
(52, '31.13.144.48', '2015-01-21', 0, 2, 0),
(53, '46.237.22.85', '2015-04-28', 0, 2, 0),
(54, '212.28.80.127', '2015-04-13', 0, 2, 0),
(55, '91.203.166.194', '2015-07-20', 0, 2, 0),
(56, '31.31.107.72', '2015-08-28', 0, 1, 0),
(57, '77.37.134.37', '2015-05-11', 0, 1, 0),
(58, '31.13.144.48', '2015-07-7', 0, 1, 0),
(59, '5.255.253.43', '2015-05-4', 0, 1, 0),
(60, '95.81.253.177', '2015-07-2', 0, 1, 0),
(61, '178.208.158.138', '2015-05-24', 0, 1, 0),
(62, '85.26.233.230', '2015-02-13', 0, 2, 0),
(63, '66.249.64.53', '2015-05-19', 0, 2, 0),
(64, '93.125.109.136', '2015-04-9', 0, 2, 0),
(65, '93.125.109.136', '2015-01-15', 0, 1, 0),
(66, '46.61.242.88', '2015-03-2', 0, 2, 0),
(67, '128.204.17.226', '2015-03-9', 0, 1, 0),
(68, '66.249.89.24', '2015-04-21', 0, 1, 0),
(69, '62.105.150.58', '2015-01-28', 0, 1, 0),
(70, '95.27.67.157', '2015-05-3', 0, 1, 0),
(71, '95.27.67.157', '2015-06-2', 0, 2, 0),
(72, '192.168.5.88', '2015-03-10', 0, 2, 0),
(73, '86.57.192.197', '2015-05-8', 0, 2, 0),
(74, '185.20.4.143', '2015-03-24', 0, 1, 0),
(75, '199.16.156.126', '2015-02-5', 0, 2, 0),
(76, '23.96.208.137', '2015-04-12', 0, 2, 0),
(77, '23.96.208.137', '2015-07-4', 0, 2, 0),
(78, '188.162.166.177', '2015-07-10', 0, 2, 0),
(79, '5.255.253.43', '2015-06-1', 0, 2, 0),
(80, '195.222.162.66', '2015-06-10', 0, 1, 0),
(81, '109.251.224.90', '2015-05-22', 0, 1, 0),
(82, '109.251.224.90', '2015-08-22', 0, 2, 0),
(83, '109.251.224.90', '2015-06-17', 0, 1, 0),
(84, '109.251.224.90', '2015-05-26', 0, 2, 0),
(85, '109.251.224.90', '2015-06-11', 0, 1, 0),
(86, '109.251.224.90', '2015-04-29', 0, 1, 0),
(87, '109.251.224.90', '2015-05-27', 0, 1, 0),
(88, '109.251.224.90', '2015-07-16', 0, 2, 0),
(89, '109.251.224.90', '2015-02-27', 0, 1, 0),
(90, '109.251.224.90', '2015-03-14', 0, 1, 0),
(91, '109.251.224.90', '2015-04-4', 0, 1, 0),
(92, '109.251.224.90', '2015-02-4', 0, 2, 0),
(93, '109.251.224.90', '2015-03-10', 0, 1, 0),
(94, '109.251.224.90', '2015-04-18', 0, 1, 0),
(95, '109.251.224.90', '2015-04-10', 0, 1, 0),
(96, '178.124.206.190', '2015-04-30', 0, 2, 0),
(97, '109.197.8.85', '2015-07-2', 0, 1, 0),
(98, '178.219.88.21', '2015-06-24', 0, 1, 0),
(99, '92.112.224.82', '2015-05-21', 0, 2, 0),
(100, '217.10.47.109', '2015-05-27', 0, 2, 0),
(101, '92.112.224.82', '2015-06-2', 0, 1, 1),
(102, '109.124.213.175', '2015-07-16', 0, 1, 0),
(103, '127.0.0.1', '2015-07-13', 0, 2, 0),
(104, '127.0.0.1', '2015-06-16', 0, 2, 0),
(105, '66.249.64.53', '2015-03-24', 0, 2, 0),
(106, '2.93.211.200', '2015-02-20', 0, 2, 0),
(107, '199.16.156.124', '2015-05-29', 0, 1, 0),
(108, '217.118.79.40', '2015-01-13', 0, 2, 0),
(109, '176.104.29.162', '2015-07-28', 0, 2, 0),
(110, '94.143.246.34', '2015-03-11', 0, 2, 0),
(111, '193.201.89.144', '2015-02-12', 0, 2, 0),
(112, '178.46.98.207', '2015-05-19', 0, 1, 0),
(113, '109.197.8.85', '2015-05-24', 0, 2, 0),
(114, '77.66.229.224', '2015-03-13', 0, 2, 0),
(115, '85.175.251.87', '2015-07-14', 0, 1, 0),
(116, '66.249.64.45', '2015-04-21', 0, 1, 0),
(117, '79.165.63.231', '2015-03-12', 0, 2, 0),
(118, '83.220.239.144', '2015-01-27', 0, 1, 0),
(119, '199.16.156.125', '2015-04-12', 0, 1, 0),
(120, '46.39.230.104', '2015-06-10', 0, 1, 0),
(121, '86.57.196.198', '2015-04-7', 0, 1, 0),
(122, '37.115.32.136', '2015-07-14', 0, 2, 0),
(123, '5.255.253.43', '2015-07-24', 0, 2, 0),
(124, '66.102.6.33', '2015-05-4', 0, 2, 0),
(125, '66.249.83.217', '2015-01-27', 0, 1, 0),
(126, '5.255.253.43', '2015-03-1', 0, 2, 0),
(127, '89.169.89.126', '2015-01-4', 0, 2, 0),
(128, '95.158.38.204', '2015-05-7', 0, 1, 0),
(129, '217.19.208.108', '2015-04-22', 0, 1, 0),
(130, '193.201.89.144', '2015-02-27', 0, 1, 0),
(131, '176.121.192.75', '2015-07-16', 0, 1, 0),
(132, '5.255.253.43', '2015-02-27', 0, 1, 0),
(133, '86.120.197.150', '2015-02-12', 0, 1, 0),
(134, '199.16.156.126', '2015-02-25', 0, 2, 0),
(135, '5.255.253.43', '2015-05-5', 0, 2, 0),
(136, '5.255.253.43', '2015-02-11', 0, 1, 0),
(137, '79.165.63.231', '2015-02-2', 0, 2, 0),
(138, '128.68.145.61', '2015-05-17', 0, 1, 0),
(139, '5.255.253.43', '2015-03-14', 0, 1, 0),
(140, '176.51.196.49', '2015-05-16', 0, 2, 0),
(141, '5.255.253.43', '2015-07-16', 0, 1, 0),
(142, '199.16.156.124', '2015-02-11', 0, 2, 0),
(143, '185.20.4.220', '2015-02-21', 0, 1, 0),
(144, '94.142.140.227', '2015-02-12', 0, 1, 0),
(145, '94.142.140.227', '2015-05-19', 0, 1, 0),
(146, '199.16.156.125', '2015-04-9', 0, 2, 0),
(147, '72.14.179.62', '2015-02-20', 0, 1, 0),
(148, '178.187.252.234', '2015-01-9', 0, 1, 0),
(149, '5.255.253.43', '2015-02-4', 0, 2, 0),
(150, '5.255.253.43', '2015-08-12', 0, 2, 0),
(151, '199.16.156.124', '2015-02-13', 0, 1, 0),
(152, '23.29.122.195', '2015-07-22', 0, 1, 0),
(153, '54.178.202.242', '2015-03-1', 0, 2, 0),
(154, '178.45.46.4', '2015-03-18', 0, 1, 0),
(155, '54.227.185.189', '2015-01-9', 0, 1, 0),
(156, '37.187.162.183', '2015-03-23', 0, 1, 0),
(157, '46.4.79.135', '2015-07-22', 0, 2, 0),
(158, '46.4.79.135', '2015-03-9', 0, 1, 0),
(159, '188.16.56.115', '2015-04-18', 0, 2, 0),
(160, '54.91.57.186', '2015-04-14', 0, 1, 0),
(161, '146.148.41.113', '2015-01-19', 0, 1, 0),
(162, '54.91.57.186', '2015-02-20', 0, 2, 0),
(163, '89.169.89.126', '2015-08-25', 0, 1, 0),
(164, '74.6.254.138', '2015-02-18', 0, 2, 0),
(165, '89.185.8.120', '2015-03-24', 0, 1, 0),
(166, '77.120.236.43', '2015-02-29', 0, 1, 0);

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

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`setting_id`, `type`, `name`, `status`, `value`, `header`) VALUES
(1, '', 'click_pay', '1', '4', 'Цена за переход'),
(2, '', 'exception_sites', '0', 'http://vk.com https://www.google.com.ua http://www.yandex.ua https://www.google.com.ru http://www.yandex.ru http://www.rambler.ru/', 'Запрещенные к закреплению сайты'),
(11, 'pay_service', 'qiwi', '1', '', 'QIWI'),
(12, 'pay_service', 'webmoney', '1', '', 'WebMoney'),
(13, 'pay_service', 'yandex_money', '0', '', 'Яндекс Деньги'),
(14, 'pay_service', 'paypal', '0', '', 'PayPal'),
(15, '', 'fixed_pay', '0', '650', 'Фиксированная оплата'),
(16, '', 'vip', '0', '20', 'VIP'),
(17, '', 'extended', '0', '17', 'Расширенный'),
(18, '', 'standard', '0', '15', 'Cтандартный'),
(19, 'contacts', 'vk', '1', 'http://vk.com', 'ВК'),
(20, 'contacts', 'email', '1', 'somemail@mail.ge', 'Почта'),
(21, 'contacts', 'skype', '1', 'someskype', 'Скайп'),
(22, '', 'landing_link', '1', 'somelink2', 'Ссылка'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `stateds`
--

INSERT INTO `stateds` (`id`, `user_id`, `money`, `status`, `pay_type`, `requisites`, `description`, `date`) VALUES
(1, 10, '100', 'Ожидает оплату', 'qiwi', '12345656', '', '2015-08-25 08:44:05'),
(2, 5, '200', 'Ожидает оплату', 'yandex_money', '56780923', '', '2015-08-25 08:44:52'),
(3, 5, '300', 'Ожидает оплату', 'qiwi', '123456789', '', '2015-08-25 08:45:08'),
(4, 8, '100', 'Ожидает оплату', 'webmoney', 'R30582956', '', '2015-08-25 08:46:05'),
(5, 8, '100', 'Ожидает оплату', 'paypal', '32456334', '', '2015-08-25 08:46:17');

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
  `reg_date` timestamp NULL DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `role`, `username`, `name`, `password`, `site`, `reg_date`, `birth_date`, `status`, `sex`, `country`, `region`, `city`, `avatar`, `verification`, `active`, `telephone`, `skype`, `use_click_pay`, `click_pay`, `use_fixed_pay`, `fixed_pay`, `promo_code`, `unc_site`) VALUES
(1, 'admin', 'admin', '', '1111', '', '2015-08-17 14:34:09', '0000-00-00', '', 1, '', '', '', 'default-user-icon-profile.png', '545e676b9ebd0', 1, '', '', 0, 0, 0, 0, 'PROMO_1', ''),
(2, 'user', 'zachary.fowler@example.com', '', '1111', '', '2015-06-19 15:34:35', '0000-00-00', '', 0, '', '', 'Ксю', '', NULL, 0, '', '', 1, 0, 0, 0, 'PROMO_2', ''),
(3, 'user', 'caitlin.watkins@example.com', '', '1111', '', '2014-12-04 10:56:00', '0000-00-00', '', 0, '', '', '', '', NULL, 0, '', '', 0, 0, 0, 0, 'PROMO_3', ''),
(4, 'user', 'ethan.allen@example.com', NULL, '1111', '', '2015-03-23 16:28:38', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', 1, 0, 0, 0, 'PROMO_4', ''),
(5, 'user', 'anna.vidal@example.com', '', '1111', '', '2015-08-20 16:00:00', '0000-00-00', '', 0, '', '', '', '', NULL, 0, '', '', 0, 0, 0, 0, 'PROMO_5', ''),
(6, 'user', 'edgar.duval@example.com', NULL, '1111', '', '2014-12-05 04:42:06', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', 0, 0, 0, 0, 'PROMO_6', ''),
(7, 'user', 'hooijdonk@example.com', NULL, '1111', '', '2014-12-10 06:13:25', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', 0, 0, 0, 0, 'PROMO_7', ''),
(8, 'user', 'burg@example.com', NULL, '1111', '', '2014-12-10 17:10:06', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', 0, 0, 0, 0, 'PROMO_8', ''),
(9, 'user', 'matilda.wuollet@example.com', '', '1111', '', '2014-12-12 13:18:21', '0000-00-00', '', 0, '', '', '', '', NULL, 0, '', '', 0, 0, 0, 0, 'PROMO_9', ''),
(10, 'user', 'remedios.herrera@example.com', '', '1111', '', '2015-03-09 14:36:32', '0000-00-00', '', 0, '', '', 'Смоленск', '', NULL, 0, '', '', 0, 0, 0, 0, 'PROMO_10', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users_landings`
--

INSERT INTO `users_landings` (`users_landings_id`, `land_id`, `user_id`) VALUES
(1, 2, 1),
(2, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `versions`
--

INSERT INTO `versions` (`id`, `version`, `date`) VALUES
(1, '2.0', '2015-08-05 13:09:41');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
