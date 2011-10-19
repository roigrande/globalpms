-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-09-2011 a las 13:31:56
-- Versión del servidor: 5.1.49
-- Versión de PHP: 5.2.17

--
-- Demo1-29-sep
--
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `globalpms-zf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_modules`
--

CREATE TABLE IF NOT EXISTS `acl_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`),
  UNIQUE KEY `module_name_2` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `name`, `active`) VALUES
(27, 'login', 1),
(25, 'controlmodule', 1),
(36, 'user', 1),
(21, 'default', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_permissions`
--

CREATE TABLE IF NOT EXISTS `acl_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(64) CHARACTER SET latin1 NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `menu` int(2) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_permissions_acl_roles1` (`role_id`),
  KEY `fk_acl_permissions_acl_resources1` (`resource_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=351 ;

--
-- Volcar la base de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `permission`, `name`, `menu`, `role_id`, `resource_id`) VALUES
(337, 'delete', 'delete Role', 0, 1, 82),
(332, 'activate', 'activate Module', 0, 1, 81),
(333, 'deactivate', 'deactivate Module', 0, 1, 81),
(331, 'backup', 'backup Module', 0, 1, 81),
(330, 'desinstall', 'desinstall Module', 0, 1, 81),
(96, 'deactivate', 'deactivate Index', 0, 1, 23),
(95, 'activate', 'activate Index', 0, 1, 23),
(94, 'backup', 'backup Index', 0, 1, 23),
(93, 'desinstall', 'desinstall Index', 0, 1, 23),
(92, 'install', 'install Index', 0, 1, 23),
(91, 'delete', 'delete Index', 0, 1, 23),
(90, 'edit', 'edit Index', 0, 1, 23),
(89, 'add', 'add Index', 0, 1, 23),
(88, 'index', 'index Index', 0, 1, 23),
(28, 'error', 'error Error', 0, 1, 8),
(27, 'changelanguage', 'changelanguage Index', 0, 1, 7),
(26, 'index', 'index Index', 0, 1, 7),
(350, 'delete', 'delete Resource', 0, 1, 86),
(349, 'edit', 'edit Resource', 0, 1, 86),
(347, 'index', 'index Resource', 0, 1, 86),
(348, 'add', 'add Resource', 0, 1, 86),
(346, 'error', 'error Error', 0, 1, 85),
(345, 'delete', 'delete Index', 0, 1, 84),
(344, 'edit', 'edit Index', 0, 1, 84),
(343, 'add', 'add Index', 0, 1, 84),
(342, 'index', 'index Index', 0, 1, 84),
(341, 'delete', 'delete Permission', 0, 1, 83),
(340, 'edit', 'edit Permission', 0, 1, 83),
(338, 'index', 'index Permission', 0, 1, 83),
(339, 'add', 'add Permission', 0, 1, 83),
(336, 'edit', 'edit Role', 0, 1, 82),
(335, 'add', 'add Role', 0, 1, 82),
(334, 'index', 'index Role', 0, 1, 82),
(329, 'install', 'install Module', 0, 1, 81),
(328, 'delete', 'delete Module', 0, 1, 81),
(327, 'edit', 'edit Module', 0, 1, 81),
(122, 'index', 'index Index', 0, 1, 31),
(123, 'logout', 'logout Index', 0, 6, 31),
(124, 'error', 'error Error', 0, 1, 32),
(125, 'denied', 'denied Error', 0, 1, 32),
(326, 'index', 'index Module', 0, 1, 81);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_resources`
--

CREATE TABLE IF NOT EXISTS `acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource` varchar(64) CHARACTER SET latin1 NOT NULL,
  `name_r` varchar(250) CHARACTER SET latin1 NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource` (`resource`),
  KEY `fk_acl_resources_acl_modules1` (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=87 ;

--
-- Volcar la base de datos para la tabla `acl_resources`
--

INSERT INTO `acl_resources` (`id`, `resource`, `name_r`, `module_id`) VALUES
(23, 'controlmodule:index', 'ControlmoduleIndex', 25),
(8, 'default:error', 'DefaultError', 21),
(7, 'default:index', 'DefaultIndex', 21),
(24, 'controlmodule:error', 'ControlmoduleError', 25),
(85, 'user:error', 'UserError', 36),
(86, 'user:resource', 'UserResource', 36),
(83, 'user:permission', 'UserPermission', 36),
(84, 'user:index', 'UserIndex', 36),
(82, 'user:role', 'UserRole', 36),
(31, 'login:index', 'LoginIndex', 27),
(32, 'login:error', 'LoginError', 27),
(81, 'user:module', 'UserModule', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_roles`
--

CREATE TABLE IF NOT EXISTS `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `role_parent` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `prefered_uri` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `acl_roles`
--

INSERT INTO `acl_roles` (`id`, `name`, `role_parent`, `prefered_uri`) VALUES
(1, 'implementor', '2', 'index'),
(2, 'Admintrator', '16,17', 'index'),
(18, 'Encargado cliente', '6', 'index'),
(6, 'public', '', 'index'),
(12, 'Encargado Producion', '19', 'index'),
(16, 'Gerente', '12', 'index'),
(17, 'Administrador financiero cliente', '18', 'index'),
(19, 'Encargado Actividad', '6', 'index');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_users`
--

CREATE TABLE IF NOT EXISTS `acl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `person_id` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `validation_code` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `phone` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_users_acl_roles1` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Volcar la base de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`id`, `name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`, `role_id`) VALUES
(4, 'Roi', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-21 18:09:31', 'roigd@gmail.com', 1, '2', '1', '4343434', 1),
(14, 'GerenteUser', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-27 19:27:14', 'GerenteUser@secogal.com', 1, '1', '1', '12121', 1),
(10, 'Guest', '', '2011-09-06 22:17:16', '0', 0, '0', '0', '0', 6),
(15, 'Juan Carlos', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2015-08-11 00:00:00', 'jc@secogal.com', 0, '1', '1', '6565656565', 2),
(13, 'userpublic', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2010-07-11 00:00:00', 'userpublic@secogal.com', 1, '1', '1', '6565656565', 6);
