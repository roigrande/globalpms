-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-04-2011 a las 13:18:50
-- Versión del servidor: 5.1.50
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blocked_ips`
--

DROP TABLE IF EXISTS `blocked_ips`;
CREATE TABLE IF NOT EXISTS `blocked_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_UNIQUE` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Volcar la base de datos para la tabla `blocked_ips`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `languages`
--

INSERT INTO `languages` (`id`, `language`) VALUES
(1, 'Castellano'),
(2, 'English'),
(3, 'Dutch');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `likes` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `likes`) VALUES
(1, 'Cinema'),
(2, 'Music'),
(3, 'Sports'),
(4, 'Travel'),
(5, 'Dance');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`id`, `province`) VALUES
(1, 'Galicia'),
(2, 'Catalunya'),
(3, 'aragon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postalcode` varchar(8) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `firm` varchar(255) NOT NULL,
  `lastupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `provinces_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_provinces` (`provinces_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `postalcode`, `city`, `description`, `image`, `gender`, `firm`, `lastupdate`, `provinces_id`) VALUES
(24, 'kkk', 'kkk', '5150d2104c8cd974b27fad3f25ec4e8098bb7bbe', 'kkk', 'kkk', 'kkk', 'kkk', 'a	', NULL, 1, '5731b9cffe8239d8550b25bfaf0cd1d9', NULL, 3),
(25, 'hhhass', 'hhh', 'effdb5f96a28acd2eb19dcb15d8f43af762bd0ae', 'hhh', 'hhh', 'hhh', 'hhh', '	', NULL, 1, '6759dd054851edb8b72273b6da43dd3e', '2011-04-05 12:56:00', 3),
(23, 'lok', 'lok', '4ff56a8aa9d094a3389dc52a083713e8e13f8daf', 'lok', 'lok', 'lok', 'lok', 'lok\r\ncon í', 'foto-mosaik-edda_1.jpg', 2, '3a6acb489cac18ee76618c3991fe2ed0', NULL, 3),
(21, 'agustiname', 'agustincl@gmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', '12345', '123456', '15000', 'Santiago', 'Descrip	', 'wow.jpg', 2, '4dfc1cf40c4db7ec549c31565d40d9f5', '2011-04-05 11:02:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_has_languages`
--

DROP TABLE IF EXISTS `users_has_languages`;
CREATE TABLE IF NOT EXISTS `users_has_languages` (
  `users_id` int(4) NOT NULL,
  `languages_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`languages_id`),
  KEY `fk_users_has_languages_languages1` (`languages_id`),
  KEY `fk_users_has_languages_users1` (`users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `users_has_languages`
--

INSERT INTO `users_has_languages` (`users_id`, `languages_id`) VALUES
(21, 1),
(21, 2),
(23, 2),
(24, 2),
(25, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_has_likes`
--

DROP TABLE IF EXISTS `users_has_likes`;
CREATE TABLE IF NOT EXISTS `users_has_likes` (
  `users_id` int(4) NOT NULL,
  `likes_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`likes_id`),
  KEY `fk_users_has_likes_likes1` (`likes_id`),
  KEY `fk_users_has_likes_users1` (`users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `users_has_likes`
--

INSERT INTO `users_has_likes` (`users_id`, `likes_id`) VALUES
(21, 1),
(21, 3),
(21, 5),
(23, 1),
(23, 3),
(23, 5),
(24, 1),
(25, 1);
