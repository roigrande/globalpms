-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-03-2012 a las 21:00:01
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=71 ;

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
(70, 'company', 1),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=217 ;

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
(76, 'index', 'index User', 0, 6, 27),
(77, 'add', 'add User', 0, 6, 27),
(78, 'edit', 'edit User', 0, 6, 27),
(79, 'delete', 'delete User', 0, 6, 27),
(80, 'index', 'index Casas', 0, 1, 28),
(81, 'add', 'add Casas', 0, 1, 28),
(82, 'edit', 'edit Casas', 0, 1, 28),
(83, 'delete', 'delete Casas', 0, 1, 28),
(84, 'index', 'index Index', 0, 1, 29),
(85, 'error', 'error Error', 0, 1, 30),
(216, 'delete', 'delete Company', 0, 1, 82),
(215, 'edit', 'edit Company', 0, 1, 82),
(211, 'index', 'index Index', 0, 1, 80),
(92, 'index', 'index Modeloejemplo', 0, 1, 34),
(93, 'add', 'add Modeloejemplo', 0, 1, 34),
(94, 'edit', 'edit Modeloejemplo', 0, 1, 34),
(95, 'delete', 'delete Modeloejemplo', 0, 1, 34),
(96, 'index', 'index Index', 0, 1, 35),
(97, 'error', 'error Error', 0, 1, 36),
(213, 'index', 'index Company', 0, 1, 82),
(208, 'editajax', 'editajax Contact', 0, 1, 79),
(209, 'edit', 'edit Contact', 0, 1, 79),
(210, 'delete', 'delete Contact', 0, 1, 79),
(207, 'addajax', 'addajax Contact', 0, 1, 79),
(206, 'add', 'add Contact', 0, 1, 79),
(151, 'add', 'add Client', 0, 1, 56),
(150, 'index', 'index Client', 0, 1, 56),
(149, 'delete', 'delete Activity', 0, 1, 55),
(148, 'edit', 'edit Activity', 0, 1, 55),
(147, 'add', 'add Activity', 0, 1, 55),
(146, 'index', 'index Activity', 0, 1, 55),
(212, 'error', 'error Error', 0, 1, 81),
(154, 'index', 'index Production', 0, 1, 57),
(155, 'add', 'add Production', 0, 1, 57),
(156, 'edit', 'edit Production', 0, 1, 57),
(157, 'delete', 'delete Production', 0, 1, 57),
(158, 'index', 'index Index', 0, 1, 58),
(159, 'error', 'error Error', 0, 1, 59),
(214, 'add', 'add Company', 0, 1, 82),
(205, 'index', 'index Contact', 0, 1, 79);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=83 ;

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
(82, 'company:company', 'CompanyCompany', 70),
(81, 'company:error', 'CompanyError', 70),
(34, 'modeloejemplo:modeloejemplo', 'ModeloejemploModeloejemplo', 57),
(35, 'modeloejemplo:index', 'ModeloejemploIndex', 57),
(36, 'modeloejemplo:error', 'ModeloejemploError', 57),
(80, 'company:index', 'CompanyIndex', 70),
(79, 'company:contact', 'CompanyContact', 70),
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
  `contract_company_id` int(11) DEFAULT NULL,
  `client_resp_id` int(11) NOT NULL DEFAULT '0',
  `contract_resp_id` int(11) DEFAULT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `responsible_id` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `observation` varchar(2500) CHARACTER SET utf8 NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_activities_acl_productions1` (`productions_id`),
  KEY `fk_activities_activity_types1` (`activity_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=52 ;

--
-- Volcar la base de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `productions_id`, `activity_types_id`, `contract_company_id`, `client_resp_id`, `contract_resp_id`, `date_start`, `date_end`, `responsible_id`, `observation`, `status_id`) VALUES
(47, 30, 26, 24, 24, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '321313', '232323', 26),
(26, 27, 27, 0, 27, 25, '2011-01-01 00:00:04', '2011-01-02 00:00:22', '1rerwe333', 'gf', 27),
(27, 27, 26, 25, 27, 322323232, '2011-01-01 00:00:04', '2011-01-02 00:00:22', 'Roi Grande Deza2', 'dfsdf', 27),
(28, 27, 27, 25, 27, 0, '2011-01-01 00:00:04', '2011-01-02 00:00:22', 'Roi Grande Deza', 'sdss', 27),
(37, 32, 27, 28, 35, 38, '2000-00-00 00:00:00', '0000-00-00 00:00:00', '24', '3434', 27),
(43, 25, 29, 29, 35, 44445, '2012-05-10 00:00:03', '2011-12-16 02:00:00', 'david domarco', 'catering para backstage', 31),
(50, 32, 27, 29, 31, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '37', 'catering para backstagez', 26),
(51, 32, 26, 24, 24, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '24', '87', 26);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `fiscal_name`, `company_types_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`) VALUES
(24, 'Secogal', 'Secogal S. L.', 27, 'roi@secogal.com', 'Pereiro de aguair', '32002', 'Ourense', 'España', '646469702', '646469702', 'montaje, desmontaje y seguridad catering'),
(25, 'Litoria', 'Litoria S. A.', 26, 'litoria@litoria.com', 'universidad 2', '32002', 'Ourense', 'España', '646469702', '5543534534', 'Infraextructura'),
(26, 'Goyanes', 'Produciones goyanes S.L.', 27, 'goyanes@goyanes.es', 'camino tras castelo', '32002', 'Santiago', 'Spain', '545454545454', '43434343434', 'fdsdpfosdfosd'),
(27, 'Festicultores', 'Festicultores S.A.', 27, 'admin@festicultores.com', 'santiago avernida lugo', '32005', 'Santiago de compostela', 'Spain', '64646464644', '64646464644', 'Grupos musicales'),
(28, 'XXL', 'XXL SA', 27, 'xxl@xxl.com', '32', '32002', 'Lugo', 'Lugo', '3232', '32', 'montaje, desmontaje y seguridad'),
(29, 'Ayuntamiento de ortigueira', 'Ayutamiento de ortigueira', 28, 'ortigueira@gmail.com', 'Ortigueira', '32005', 'Ortigueira', 'España', '678787878', '678787878', 'catering para backstagez');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`) VALUES
(24, 'Roi Grande Deza', '323', 'roigd@gmail.com', '0', 'Encargado de personal', 24),
(25, 'Ana camaño', 'Ourense ananan', 'ana@litoria.com', '33333422', 'Gestoraaaaaaaaaaaaaaaa', 25),
(3, 'Ramon', 'noriega varela', 'Ramon@litoria.es', '4545454', 'Gerente general', 25),
(27, 'Javier sines', 'santiago', 'javier@goyanes.es', '654545454', 'Jefee33', 26),
(28, 'aleman', 'santiago', 'aleman@goyanes.com', '654545454', 'Encargado de personal', 26),
(29, 'mil ocho', 'santiago avernida lugo', 'milocho@gmail.com', '646464645', 'Gerente', 27),
(30, 'Xulio', 'Pabellon deportivo Lugo', 'xulio.xxl@gmail.com', '43434343', 'Encargado de personal', 28),
(31, 'Paula', 'camino tras castelo', 'Paula@litoria.es', '43434343', 'Encargado de personal', 25),
(35, 'Alberto Ortigueira2', 'Ortigueira2', 'Alberto@ortiguiera.com', '4343434343', 'Responsable festival', 29),
(37, 'Juan Carlos villalon', 'escolapios', 'jc@secogal.com', '678787878', 'Gerente de la empresa', 24),
(38, 'hijo aleman', '32322323', 'hijoaleman@gmail.com', '4343434343', 'auxiliar', 26),
(39, 'Alberto Ortigueira', 'ortiigueira', 'Albe3rto@ortiguiera.com', '4343434343', 'ñ', 26),
(40, 'Alberto Ortigueira', '1111111111', 'r1igd@gmail.com', '4343434343', 'ñ', 26),
(41, 'Alberto Ortigueira', '1111111111', 'ro1212igd@gmail.com', '4343434343', 'ñ', 26),
(42, '3', '123', 'r11oigd@gmail.com', '1', '1', 26),
(43, '2121', 'ortiigueira', '1@gmail.com', '678787878', 'Responsable festival', 26),
(44, 'Alberto Ortigueira', '1111111111', 'Albe1rto@ortiguiera.com', '4343434343', 'ñ', 27),
(46, 'tacho', 'ortiigueira', 'tacho@gmail.com', '43434343', 'Responsable festival', 28);

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
  `status_id` int(11) NOT NULL,
  `production_types_id` int(11) NOT NULL,
  `companies_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productions_status1` (`status_id`),
  KEY `fk_productions_production_types1` (`production_types_id`),
  KEY `fk_productions_companies1` (`companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Volcar la base de datos para la tabla `productions`
--

INSERT INTO `productions` (`id`, `name`, `direction`, `date_start`, `date_end`, `observation`, `budget`, `in_litter`, `status_id`, `production_types_id`, `companies_id`) VALUES
(26, 'Ortigueira', 'Ortigueira', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 40000, NULL, 26, 28, 26),
(28, 'fresh weekend', 'cerceda', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 4000, NULL, 26, 28, 25),
(29, 'Meeting Lugo 2011_2', 'Meeting', '2011-01-15 07:00:00', '2011-12-16 02:00:00', 'segundo metting lugar a decidir', 1000, NULL, 26, 33, 25),
(30, 'Reperkusion 012', 'Allariz entrada de la carretera', '2012-05-10 00:00:03', '2012-05-21 00:00:00', 'montaje, desmontaje , seguridad, produccion tecnica', 200000, NULL, 26, 28, 26),
(32, 'pelicula agustin', 'barcelona fd', '2012-05-10 00:00:03', '2012-07-02 00:00:00', 'rekrñewirpowe', 5000, NULL, 26, 29, 24),
(33, 'Festival de cine gallego', 'camino tras castelo', '2012-05-10 00:00:03', '2011-01-02 00:00:00', 'Carga del material', 2500, NULL, 31, 32, 28),
(35, 'Festival de cine gallego 2', '32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', 43434, NULL, 26, 29, 27),
(36, 'Resentidos12', 'expourense', '2012-05-10 00:00:03', '2012-05-21 00:00:00', 'montaje, desmontaje , seguridad, produccion tecnica', 5000, NULL, 26, 27, 0),
(39, 'Resentidos', 'expourense', '2012-05-10 00:00:03', '2011-12-16 02:00:00', 'Concierto de un dia', 1500, NULL, 26, 27, 24),
(40, 'Alberto Ortigueira', 'ortiigueira', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', 0, NULL, 26, 27, 24),
(41, 'aaaaaaaaaaa', 'Allariz entrada de la carretera', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a', 0, NULL, 26, 27, 24),
(42, 'aaaaaaaaaaa', 'Allariz entrada de la carretera', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a', 0, NULL, 26, 27, 24),
(43, 'Ayuntamiento de ortigueira', 'ortiigueira', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 0, NULL, 26, 27, 24),
(62, 'Alberto Ortigueira', '123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '132', 123, NULL, 26, 27, 24),
(50, 'Reperkusion 012', '342', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3434', 33, NULL, 26, 27, 24);

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
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `status` binary(1) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `date_buy` date DEFAULT NULL,
  `last_use` date DEFAULT NULL,
  `metadata` varchar(450) DEFAULT NULL,
  `desctiption` varchar(2500) DEFAULT NULL,
  `resourcecol` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcar la base de datos para la tabla `resource`
--


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
(28, 'Iniciado', 29),
(29, 'Finalizado', 30),
(30, 'Facturado', 31),
(31, 'Cobrado', 0),
(25, 'Presupuestando', 26);
