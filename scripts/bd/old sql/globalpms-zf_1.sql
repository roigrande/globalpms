-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2011 a las 19:10:35
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
-- Estructura de tabla para la tabla `acl_modules`
--

CREATE TABLE IF NOT EXISTS `acl_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=63 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `name`, `active`) VALUES
(49, 'album', 1),
(48, 'login', 1),
(54, 'user', 1),
(53, 'controlmodule', 1),
(46, 'default', 1),
(62, 'production', 1),
(44, 'activity', 1),
(61, 'company', 1),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=160 ;

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
(153, 'delete', 'delete Client', 0, 1, 56),
(152, 'edit', 'edit Client', 0, 1, 56),
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
(143, 'add', 'add Company', 0, 1, 54),
(142, 'index', 'index Company', 0, 1, 54),
(141, 'error', 'error Error', 0, 1, 53),
(139, 'delete', 'delete Client', 0, 1, 51),
(92, 'index', 'index Modeloejemplo', 0, 1, 34),
(93, 'add', 'add Modeloejemplo', 0, 1, 34),
(94, 'edit', 'edit Modeloejemplo', 0, 1, 34),
(95, 'delete', 'delete Modeloejemplo', 0, 1, 34),
(96, 'index', 'index Index', 0, 1, 35),
(97, 'error', 'error Error', 0, 1, 36),
(140, 'index', 'index Index', 0, 1, 52),
(138, 'edit', 'edit Client', 0, 1, 51),
(137, 'add', 'add Client', 0, 1, 51),
(135, 'delete', 'delete Contact', 0, 1, 50),
(136, 'index', 'index Client', 0, 1, 51),
(134, 'edit', 'edit Contact', 0, 1, 50),
(133, 'add', 'add Contact', 0, 1, 50),
(132, 'index', 'index Contact', 0, 1, 50),
(151, 'add', 'add Client', 0, 1, 56),
(150, 'index', 'index Client', 0, 1, 56),
(149, 'delete', 'delete Activity', 0, 1, 55),
(148, 'edit', 'edit Activity', 0, 1, 55),
(147, 'add', 'add Activity', 0, 1, 55),
(146, 'index', 'index Activity', 0, 1, 55),
(144, 'edit', 'edit Company', 0, 1, 54),
(145, 'delete', 'delete Company', 0, 1, 54),
(154, 'index', 'index Production', 0, 1, 57),
(155, 'add', 'add Production', 0, 1, 57),
(156, 'edit', 'edit Production', 0, 1, 57),
(157, 'delete', 'delete Production', 0, 1, 57),
(158, 'index', 'index Index', 0, 1, 58),
(159, 'error', 'error Error', 0, 1, 59);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=60 ;

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
(57, 'production:production', 'ProductionProduction', 62),
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
(54, 'company:company', 'CompanyCompany', 61),
(53, 'company:error', 'CompanyError', 61),
(52, 'company:index', 'CompanyIndex', 61),
(34, 'modeloejemplo:modeloejemplo', 'ModeloejemploModeloejemplo', 57),
(35, 'modeloejemplo:index', 'ModeloejemploIndex', 57),
(36, 'modeloejemplo:error', 'ModeloejemploError', 57),
(51, 'company:client', 'CompanyClient', 61),
(50, 'company:contact', 'CompanyContact', 61),
(56, 'production:client', 'ProductionClient', 62),
(55, 'production:activity', 'ProductionActivity', 62),
(58, 'production:index', 'ProductionIndex', 62),
(59, 'production:error', 'ProductionError', 62);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`id`, `name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`, `role_id`) VALUES
(16, 'Agustin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'agustin@secogal.com', 1, '2', '2', '64646446', 1),
(4, 'Roi', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-21 18:09:31', 'roigd@gmail.com', 1, '2', '1', '4343434', 1),
(14, 'GerenteUser', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-27 19:27:14', 'GerenteUser@secogal.com', 1, '1', '1', '12121', 1),
(10, 'Guest', '', '2011-09-06 22:17:16', '0', 0, '0', '0', '0', 6),
(15, 'Juan Carlos', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2015-08-11 00:00:00', 'jc@secogal.com', 0, '1', '1', '6565656565', 2),
(13, 'userpublic', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2010-07-11 00:00:00', 'userpublic@secogal.com', 1, '1', '1', '6565656565', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productions_id` int(11) NOT NULL,
  `activity_types_id` int(11) NOT NULL,
  `client` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `client_resp_name` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `client_resp_phone` varchar(45) CHARACTER SET ucs2 DEFAULT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `responsible` varchar(250) CHARACTER SET ucs2 NOT NULL DEFAULT '0',
  `responsible_phone` int(11) NOT NULL,
  `observation` varchar(2500) CHARACTER SET ucs2 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_activities_acl_productions1` (`productions_id`),
  KEY `fk_activities_activity_types1` (`activity_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `productions_id`, `activity_types_id`, `client`, `client_resp_name`, `client_resp_phone`, `date_start`, `date_end`, `responsible`, `responsible_phone`, `observation`) VALUES
(24, 24, 26, '', '24', '', '2011-01-01 00:00:00', '2011-12-16 02:00:00', 'ccsdfs', 44433455, 'fdsfs'),
(25, 24, 27, '', '28', '', '2011-01-01 00:00:03', '2011-01-02 00:00:04', 'fdsf', 444334, 'ew'),
(26, 27, 27, NULL, '27', '', '2011-01-01 00:00:04', '2011-01-02 00:00:22', '', 0, 'gf'),
(27, 27, 26, NULL, '27', '', '2011-01-01 00:00:04', '2011-01-02 00:00:22', '', 0, 'dfsdf'),
(28, 27, 27, NULL, '27', '', '2011-01-01 00:00:04', '2011-01-02 00:00:22', 'Roi Grande Deza', 0, 'sdss'),
(29, 24, 29, NULL, '28', '333', '2011-01-01 00:00:03', '2011-01-02 00:00:04', 'Roi Grande Deza', 646469602, 'montaje, desmontaje y seguridad'),
(30, 24, 26, NULL, '28', '333', '2011-01-01 00:00:03', '2011-01-02 00:00:04', 'Roi Grande Deza', 646469602, 'montaje, desmontaje y seguridad'),
(31, 26, 26, '28', '0', '322323232', '2011-01-01 00:00:00', '2011-12-16 02:00:00', 'Roi Grande Deza', 646469602, 'montaje, desmontaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_types`
--

CREATE TABLE IF NOT EXISTS `activity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `activity_types`
--

INSERT INTO `activity_types` (`id`, `name`) VALUES
(26, 'Carga y Descarga'),
(27, 'Seguridad'),
(28, 'Catering'),
(29, 'Running');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companies_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_clients_acl_companies1` (`companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `companies_id`) VALUES
(1, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `fiscal_name` varchar(45) DEFAULT NULL,
  `company_types_id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direction` varchar(250) NOT NULL,
  `postal_code` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `observation` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_company_acl_type_company1` (`company_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcar la base de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `fiscal_name`, `company_types_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`) VALUES
(24, 'Secogal', 'Secogal S. L.', 27, 'roi@secogal.com', 'Pereiro de aguair', '32002', 'Ourense', 'España', '646469702', '646469702', 'montaje, desmontaje y seguridad'),
(25, 'Litoria', 'Litoria S. A.', 26, 'litoria@litoria.com', 'universidad 2', '32002', 'Ourense', 'España', '646469702', '5543534534', 'Infraextructura'),
(26, 'Goyanes', 'Produciones goyanes S.L.', 27, 'goyanes@goyanes.es', 'camino tras castelo', '32002', 'Santiago', 'Spain', '545454545454', '43434343434', 'fdsdpfosdfosd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_types`
--

CREATE TABLE IF NOT EXISTS `company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `company_types`
--

INSERT INTO `company_types` (`id`, `name`) VALUES
(26, 'Producciones audiovisuales'),
(27, 'Conciertos y festivales'),
(28, 'Seguridad'),
(29, 'Catering');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `direction` varchar(250) NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `telephone` varchar(250) NOT NULL DEFAULT '0',
  `status` varchar(45) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_contacts_acl_company1` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`) VALUES
(24, 'Roi Grande Deza', '', 'roigd@gmail.com', '0', 'Encargado de personal', 24),
(25, 'Ana camaño', 'Ourense ananan', 'ana@litoria.com', '0', 'Gestora', 25),
(3, 'Ramon', 'noriega varela', 'Ramon@litoria.es', '4545454', 'Gerente general', 25),
(27, 'Javier sines', 'santiago', 'javier@goyanes.es', '654545454', 'Jefe', 26),
(28, 'aleman', 'santiago', 'aleman@goyanes.com', '654545454', 'Encargado de personal', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productions`
--

CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `direction` varchar(250) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `observation` varchar(250) DEFAULT NULL,
  `budget` int(11) NOT NULL DEFAULT '0',
  `in_litter` binary(0) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `clients_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `production_types_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_productions_acl_productions1` (`parent_id`),
  KEY `fk_acl_productions_acl_clients1` (`clients_id`),
  KEY `fk_productions_status1` (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `productions`
--

INSERT INTO `productions` (`id`, `name`, `direction`, `date_start`, `date_end`, `observation`, `budget`, `in_litter`, `parent_id`, `clients_id`, `status_id`, `production_types_id`) VALUES
(24, 'San Froilan', 'Lugo', '2000-00-00 00:00:00', '2200-00-00 00:00:00', 'montaje, desmontaje y seguridad', 3000, NULL, 0, 25, 28, 27),
(25, 'Meeting Rualcaba', 'Pabellon deportivo Ourense', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 4000, NULL, 0, 26, 26, 26),
(26, 'Ortigueira', 'Ortigueira', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 40000, NULL, 0, 24, 26, 28),
(27, 'Monforte', 'escolapios', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'Infraextructura', 6000, NULL, 0, 24, 26, 27),
(28, 'fresh weekend', 'cerceda', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 4000, NULL, 0, 26, 26, 28),
(29, 'Meeting Lugo 2011_2', 'Meeting', '2011-01-15 07:00:00', '2011-12-16 02:00:00', 'segundo metting lugar a decidir', 1000, NULL, 0, 25, 26, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `production_types`
--

CREATE TABLE IF NOT EXISTS `production_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `resource_type` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `production_types`
--

INSERT INTO `production_types` (`id`, `name`, `resource_type`) VALUES
(26, 'Obra de teatro', 1),
(27, 'Concierto', 1),
(28, 'Festival de musica', 1),
(29, 'Festival de cine', 1),
(30, 'Exposicion', 1),
(31, 'Fiesta privada', 1),
(32, 'Otros', 1),
(33, 'Meeting', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`),
  KEY `fk_status_status1` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`, `parent_id`) VALUES
(26, 'Presupuestado', 27),
(27, 'Confirmado', 28),
(28, 'trabajando', 29),
(29, 'terminado', 30),
(30, 'Facturado', 31),
(31, 'Cobrado', 0);
