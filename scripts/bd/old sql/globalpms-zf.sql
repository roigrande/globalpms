-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-10-2011 a las 18:24:46
-- Versión del servidor: 5.1.49
-- Versión de PHP: 5.2.17

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
-- Estructura de tabla para la tabla `acl_clients`
--

CREATE TABLE IF NOT EXISTS `acl_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_client` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `type_client_id` int(11) NOT NULL,
  `companies_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_client_acl_type_client1` (`type_client_id`),
  KEY `fk_acl_clients_acl_companies1` (`companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `acl_clients`
--

INSERT INTO `acl_clients` (`id`, `type_client`, `type_client_id`, `companies_id`) VALUES
(24, '0', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_companies`
--

CREATE TABLE IF NOT EXISTS `acl_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `fiscal_name` varchar(45) DEFAULT NULL,
  `type_company_id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direction` varchar(250) NOT NULL,
  `postal_code` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `observation` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_company_acl_type_company1` (`type_company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcar la base de datos para la tabla `acl_companies`
--

INSERT INTO `acl_companies` (`id`, `name`, `fiscal_name`, `type_company_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`) VALUES
(24, 'Secogal', 'Secogal S. L.', 26, 'roi@secogal.com', 'Pereiro de aguair', '32002', 'Ourense', 'España', '646469702', '646469702', 'montaje, desmontaje y seguridad'),
(25, 'Litoria', 'Litoria S. A.', 26, 'litoria@litoria.com', 'universidad 2', '32002', 'Ourense', 'España', '646469702', '5543534534', 'Infraextructura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_contacts`
--

CREATE TABLE IF NOT EXISTS `acl_contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `direction` varchar(250) NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `telephone` varchar(250) NOT NULL DEFAULT '0',
  `status` varchar(45) DEFAULT NULL,
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `acl_contactscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_contacts_acl_company1` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcar la base de datos para la tabla `acl_contacts`
--

INSERT INTO `acl_contacts` (`id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`, `acl_contactscol`) VALUES
(24, 'Roi Grande Deza', '', 'roigd@gmail.com', '0', 'Encargado de personal', 26, NULL),
(25, 'Ana camaño', 'Ourense ananan', 'ana@litoria.com', '0', 'Gestora', 27, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_modules`
--

CREATE TABLE IF NOT EXISTS `acl_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=60 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `name`, `active`) VALUES
(49, 'album', 1),
(48, 'login', 1),
(54, 'user', 1),
(53, 'controlmodule', 1),
(46, 'default', 1),
(45, 'production', 1),
(44, 'activity', 1),
(59, 'company', 1),
(55, 'casas', 1),
(57, 'modeloejemplo', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=122 ;

--
-- Volcar la base de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `permission`, `name`, `menu`, `role_id`, `resource_id`) VALUES
(75, 'delete', 'delete Resource', 0, 1, 26),
(74, 'edit', 'edit Resource', 0, 1, 26),
(73, 'add', 'add Resource', 0, 1, 26),
(72, 'index', 'index Resource', 0, 1, 26),
(71, 'error', 'error Error', 0, 1, 25),
(70, 'index', 'index Index', 0, 1, 24),
(69, 'delete', 'delete Permission', 0, 1, 23),
(68, 'edit', 'edit Permission', 0, 1, 23),
(67, 'add', 'add Permission', 0, 1, 23),
(66, 'index', 'index Permission', 0, 1, 23),
(65, 'delete', 'delete Role', 0, 1, 22),
(64, 'edit', 'edit Role', 0, 1, 22),
(63, 'add', 'add Role', 0, 1, 22),
(62, 'index', 'index Role', 0, 1, 22),
(19, 'index', 'index Index', 0, 1, 7),
(20, 'add', 'add Index', 0, 1, 7),
(21, 'edit', 'edit Index', 0, 1, 7),
(22, 'delete', 'delete Index', 0, 1, 7),
(23, 'error', 'error Error', 0, 1, 8),
(24, 'index', 'index Index', 0, 1, 9),
(25, 'add', 'add Index', 0, 1, 9),
(26, 'edit', 'edit Index', 0, 1, 9),
(27, 'delete', 'delete Index', 0, 1, 9),
(28, 'index', 'index Index', 0, 1, 11),
(29, 'changelanguage', 'changelanguage Index', 0, 1, 11),
(30, 'error', 'error Error', 0, 1, 12),
(57, 'uninstall', 'uninstall Controlmodule', 0, 1, 19),
(56, 'install', 'install Controlmodule', 0, 1, 19),
(55, 'delete', 'delete Controlmodule', 0, 1, 19),
(54, 'edit', 'edit Controlmodule', 0, 1, 19),
(53, 'add', 'add Controlmodule', 0, 1, 19),
(52, 'index', 'index Controlmodule', 0, 1, 19),
(40, 'index', 'index Index', 0, 1, 15),
(41, 'logout', 'logout Index', 0, 6, 15),
(42, 'error', 'error Error', 0, 1, 16),
(43, 'denied', 'denied Error', 0, 1, 16),
(44, 'unactive', 'unactive Error', 0, 1, 16),
(45, 'uninstall', 'uninstall Error', 0, 1, 16),
(46, 'notfound', 'notfound Error', 0, 1, 16),
(47, 'index', 'index Index', 0, 1, 17),
(48, 'add', 'add Index', 0, 1, 17),
(49, 'edit', 'edit Index', 0, 1, 17),
(50, 'delete', 'delete Index', 0, 1, 17),
(51, 'error', 'error Error', 0, 1, 18),
(58, 'backup', 'backup Controlmodule', 0, 1, 19),
(59, 'activate', 'activate Controlmodule', 0, 1, 19),
(60, 'deactivate', 'deactivate Controlmodule', 0, 1, 19),
(61, 'index', 'index Index', 0, 1, 20),
(76, 'index', 'index User', 0, 1, 27),
(77, 'add', 'add User', 0, 1, 27),
(78, 'edit', 'edit User', 0, 1, 27),
(79, 'delete', 'delete User', 0, 1, 27),
(80, 'index', 'index Casas', 0, 1, 28),
(81, 'add', 'add Casas', 0, 1, 28),
(82, 'edit', 'edit Casas', 0, 1, 28),
(83, 'delete', 'delete Casas', 0, 1, 28),
(84, 'index', 'index Index', 0, 1, 29),
(85, 'error', 'error Error', 0, 1, 30),
(114, 'edit', 'edit Client', 0, 1, 42),
(113, 'add', 'add Client', 0, 1, 42),
(112, 'index', 'index Client', 0, 1, 42),
(111, 'delete', 'delete Contact', 0, 1, 41),
(92, 'index', 'index Modeloejemplo', 0, 1, 34),
(93, 'add', 'add Modeloejemplo', 0, 1, 34),
(94, 'edit', 'edit Modeloejemplo', 0, 1, 34),
(95, 'delete', 'delete Modeloejemplo', 0, 1, 34),
(96, 'index', 'index Index', 0, 1, 35),
(97, 'error', 'error Error', 0, 1, 36),
(115, 'delete', 'delete Client', 0, 1, 42),
(110, 'edit', 'edit Contact', 0, 1, 41),
(109, 'add', 'add Contact', 0, 1, 41),
(108, 'index', 'index Contact', 0, 1, 41),
(116, 'index', 'index Index', 0, 1, 43),
(117, 'error', 'error Error', 0, 1, 44),
(118, 'index', 'index Company', 0, 1, 45),
(119, 'add', 'add Company', 0, 1, 45),
(120, 'edit', 'edit Company', 0, 1, 45),
(121, 'delete', 'delete Company', 0, 1, 45);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=46 ;

--
-- Volcar la base de datos para la tabla `acl_resources`
--

INSERT INTO `acl_resources` (`id`, `resource`, `name_r`, `module_id`) VALUES
(26, 'user:resource', 'UserResource', 54),
(25, 'user:error', 'UserError', 54),
(24, 'user:index', 'UserIndex', 54),
(23, 'user:permission', 'UserPermission', 54),
(22, 'user:role', 'UserRole', 54),
(7, 'activity:index', 'ActivityIndex', 44),
(8, 'activity:error', 'ActivityError', 44),
(9, 'production:index', 'ProductionIndex', 45),
(10, 'production:error', 'ProductionError', 45),
(11, 'default:index', 'DefaultIndex', 46),
(12, 'default:error', 'DefaultError', 46),
(19, 'controlmodule:controlmodule', 'ControlmoduleControlmodule', 53),
(15, 'login:index', 'LoginIndex', 48),
(16, 'login:error', 'LoginError', 48),
(17, 'album:index', 'AlbumIndex', 49),
(18, 'album:error', 'AlbumError', 49),
(20, 'controlmodule:index', 'ControlmoduleIndex', 53),
(21, 'controlmodule:error', 'ControlmoduleError', 53),
(27, 'user:user', 'UserUser', 54),
(28, 'casas:casas', 'CasasCasas', 55),
(29, 'casas:index', 'CasasIndex', 55),
(30, 'casas:error', 'CasasError', 55),
(44, 'company:error', 'CompanyError', 59),
(43, 'company:index', 'CompanyIndex', 59),
(42, 'company:client', 'CompanyClient', 59),
(34, 'modeloejemplo:modeloejemplo', 'ModeloejemploModeloejemplo', 57),
(35, 'modeloejemplo:index', 'ModeloejemploIndex', 57),
(36, 'modeloejemplo:error', 'ModeloejemploError', 57),
(41, 'company:contact', 'CompanyContact', 59),
(45, 'company:company', 'CompanyCompany', 59);

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
-- Estructura de tabla para la tabla `acl_type_client`
--

CREATE TABLE IF NOT EXISTS `acl_type_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `acl_type_client`
--

INSERT INTO `acl_type_client` (`id`, `name`) VALUES
(26, 'Seguridad'),
(27, 'Carga y Descarga'),
(28, 'Catering'),
(29, 'Running'),
(30, 'Prevencion de riesgos laborales'),
(31, 'Plan de seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_type_company`
--

CREATE TABLE IF NOT EXISTS `acl_type_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `acl_type_company`
--

INSERT INTO `acl_type_company` (`id`, `name`) VALUES
(26, 'Producciones audiovisuales'),
(27, 'Conciertos y festivales'),
(28, 'Seguridad'),
(29, 'Catering');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_type_production`
--

CREATE TABLE IF NOT EXISTS `acl_type_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=26 ;

--
-- Volcar la base de datos para la tabla `acl_type_production`
--


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
