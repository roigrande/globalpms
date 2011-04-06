-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-04-2011 a las 12:48:16
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
-- Estructura de tabla para la tabla `users`
--

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
