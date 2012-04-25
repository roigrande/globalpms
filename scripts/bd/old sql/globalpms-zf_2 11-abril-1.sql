-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-04-2012 a las 18:16:19
-- Versión del servidor: 5.1.62
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=82 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `name`, `active`) VALUES
(49, 'album', 1),
(48, 'login', 1),
(54, 'user', 1),
(53, 'controlmodule', 1),
(46, 'default', 1),
(81, 'production', 1),
(44, 'activity', 1),
(79, 'company', 1),
(55, 'casas', 1),
(57, 'modeloejemplo', 1),
(80, 'finances', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=381 ;

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
(377, 'edit', 'edit Production', 0, 1, 127),
(376, 'add', 'add Production', 0, 1, 127),
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
(350, 'index', 'index Index', 0, 1, 119),
(351, 'error', 'error Error', 0, 1, 120),
(92, 'index', 'index Modeloejemplo', 0, 1, 34),
(93, 'add', 'add Modeloejemplo', 0, 1, 34),
(94, 'edit', 'edit Modeloejemplo', 0, 1, 34),
(95, 'delete', 'delete Modeloejemplo', 0, 1, 34),
(96, 'index', 'index Index', 0, 1, 35),
(97, 'error', 'error Error', 0, 1, 36),
(358, 'saludoajax2', 'saludoajax2 Contactajax', 0, 1, 122),
(359, 'listadoajax', 'listadoajax Contactajax', 0, 1, 122),
(362, 'editajax', 'editajax Contactajax', 0, 1, 122),
(361, 'addajax', 'addajax Contactajax', 0, 1, 122),
(360, 'add', 'add Contactajax', 0, 1, 122),
(375, 'index', 'index Production', 0, 1, 127),
(374, 'delete', 'delete Activity', 0, 1, 126),
(373, 'edit', 'edit Activity', 0, 1, 126),
(372, 'add', 'add Activity', 0, 1, 126),
(357, 'saludoajax', 'saludoajax Contactajax', 0, 1, 122),
(380, 'error', 'error Error', 0, 1, 129),
(379, 'index', 'index Index', 0, 1, 128),
(378, 'delete', 'delete Production', 0, 1, 127),
(371, 'index', 'index Activity', 0, 1, 126),
(356, 'index', 'index Contactajax', 0, 1, 122),
(355, 'delete', 'delete Company', 0, 1, 121),
(354, 'edit', 'edit Company', 0, 1, 121),
(353, 'add', 'add Company', 0, 1, 121),
(352, 'index', 'index Company', 0, 1, 121),
(349, 'delete', 'delete Contact', 0, 1, 118),
(348, 'confirm', 'confirm Contact', 0, 1, 118),
(346, 'add', 'add Contact', 0, 1, 118),
(347, 'edit', 'edit Contact', 0, 1, 118),
(344, 'index', 'index Contact', 0, 1, 118),
(345, 'editajax', 'editajax Contact', 0, 1, 118),
(363, 'edit', 'edit Contactajax', 0, 1, 122),
(364, 'delete', 'delete Contactajax', 0, 1, 122),
(365, 'index', 'index Finances', 0, 1, 123),
(366, 'add', 'add Finances', 0, 1, 123),
(367, 'edit', 'edit Finances', 0, 1, 123),
(368, 'delete', 'delete Finances', 0, 1, 123),
(369, 'index', 'index Index', 0, 1, 124),
(370, 'error', 'error Error', 0, 1, 125);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=130 ;

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
(128, 'production:index', 'ProductionIndex', 81),
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
(122, 'company:contactajax', 'CompanyContactajax', 79),
(121, 'company:company', 'CompanyCompany', 79),
(34, 'modeloejemplo:modeloejemplo', 'ModeloejemploModeloejemplo', 57),
(35, 'modeloejemplo:index', 'ModeloejemploIndex', 57),
(36, 'modeloejemplo:error', 'ModeloejemploError', 57),
(120, 'company:error', 'CompanyError', 79),
(119, 'company:index', 'CompanyIndex', 79),
(127, 'production:production', 'ProductionProduction', 81),
(126, 'production:activity', 'ProductionActivity', 81),
(118, 'company:contact', 'CompanyContact', 79),
(123, 'finances:finances', 'FinancesFinances', 80),
(124, 'finances:index', 'FinancesIndex', 80),
(125, 'finances:error', 'FinancesError', 80),
(129, 'production:error', 'ProductionError', 81);

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
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `person_id` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `validation_code` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `phone` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_users_acl_roles1` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

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
  `status_id` int(11) NOT NULL,
  `contact_own_company_id` int(11) NOT NULL,
  `contact_company_client_id` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `observation` varchar(2500) DEFAULT NULL,
  `in_litter` binary(0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`date_end`),
  KEY `fk_acl_activities_acl_productions1` (`productions_id`),
  KEY `fk_activities_activity_types1` (`activity_types_id`),
  KEY `fk_activities_status1` (`status_id`),
  KEY `fk_activities_contacts3` (`contact_own_company_id`),
  KEY `fk_activities_contacts1` (`contact_company_client_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcar la base de datos para la tabla `activities`
--


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
  `activity_types_id` varchar(250) DEFAULT NULL,
  `in_litter` binary(0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_company_acl_type_company1` (`company_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `fiscal_name`, `company_types_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`, `activity_types_id`, `in_litter`) VALUES
(24, 'Secogal', 'Secogal S. L.', 27, 'roi@secogal.com', 'Pereiro de aguaira', '32002', 'Ourense', 'España', '646469702', '646469702', 'montaje, desmontaje y seguridad catering', NULL, NULL),
(25, 'Litoria', 'Litoria S. A.', 27, 'litoria@litoria.com', 'universidad', '32002', 'Ourense', 'España', '646469702', '5543534534', 'Infraextructura', NULL, NULL),
(26, 'Goyanes', 'Produciones goyanes S.L.', 27, 'goyanes@goyanes.es', 'camino tras castelo', '32002', 'Santiago', 'Spain', '545454545454', '43434343434', 'fdsdpfosdfosd', NULL, NULL),
(27, 'Festicultores', 'Festicultores S.A.', 27, 'admin@festicultores.com', 'santiago avernida lugo', '32005', 'Santiago de compostela', 'Spain', '64646464644', '64646464644', 'Grupos musicales', NULL, NULL),
(28, 'XXL', 'XXL SA', 27, 'xxl@xxl.com', '32', '32002', 'Lugo', 'Lugod', '3232', '32', 'montaje, desmontaje y seguridadfff', NULL, NULL),
(29, 'Ayuntamiento de ortigueira', 'Ayutamiento de ortigueira', 28, 'ortigueira@gmail.com', 'Ortigueira', '32005', 'Ortigueira', 'España', '678787878', '678787878', 'catering para backstagez', NULL, NULL);

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
  `resources_activities_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_contacts_acl_company1` (`company_id`),
  KEY `fk_contacts_resources_activities1` (`resources_activities_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`, `resources_activities_id`) VALUES
(24, 'Roi Grande Deza', '323', 'roigd@gmail.com', '33333422dd', 'Encargado de personal', 24, 0),
(25, 'Ana camaño', 'ddOurense angfdsfdsfds', 'fffana@litoria.com', 'xx3434555555', 'hhhh', 25, 0),
(3, 'Ramonttt', 'noriega fffsdsaddddddd', 'Ramon@litoria.es', '4545454dttreteddddd', 'rrGerente ddsadaaaffaaaaaaaa', 25, 0),
(27, 'Javier sines', 'rtrtrtsdfdsf', 'javier@goyanes.es', '654545454', 'Jefee33', 26, 0),
(28, 'aleman', 'santiago', 'aleman@goyanes.com', '654545454', 'Encargado de personal', 26, 0),
(29, 'mil ocho', 'santiago avernida lugo', 'milocho@gmail.com', '646464645', 'Gerente', 27, 0),
(30, 'Xulio', 'Pabellon deportivo Lugoff', 'xulio.xxl@gmail.com', 'ff', 'GEncargado de personalerGGffffdd', 28, 0),
(31, 'Paula', 'camino tras cas', 'Paula@litoria.es', '43434343', 'Encargado de personal', 25, 0),
(35, 'Alberto Ortigueira2', 'Ortigueira2', 'Alberto@ortiguiera.com', '4343434343', 'Responsable festival', 29, 0),
(37, 'Juan Carlos villalon', 'escolapiosffassssdsds', 'jc@secogal.com', '678787878fff', 'Gerente de la empresadd', 24, 0),
(38, 'hijo aleman', '32322323', 'hijoaleman@gmail.com', '4343434343', 'auxiliar', 26, 0),
(39, 'Alberto Ortigueira', 'ortiigueira', 'Albe3rto@ortiguiera.com', '4343434343', 'ñ', 26, 0),
(40, 'Alberto Ortigueira', '1111111111', 'r1igd@gmail.com', '4343434343', 'ñ', 26, 0),
(41, 'Alberto Ortigueira', '1111111111', 'ro1212igd@gmail.com', '4343434343', 'ñ', 26, 0),
(42, '3', '123', 'r11oigd@gmail.com', '1', '1', 26, 0),
(43, '2121', 'ortiigueira', '1@gmail.com', '678787878', 'Responsable festival', 26, 0),
(44, 'Alberto Ortigueira', '1111111111', 'Albe1rto@ortiguiera.com', '4343434343', 'ñ', 27, 0),
(46, 'tacho', 'ortiigueira', 'tacho@gmail.com', '43434343', 'Responsable festivalddfff', 28, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `own_companies`
--

CREATE TABLE IF NOT EXISTS `own_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desctiption` varchar(64) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_contacts_acl_company1` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcar la base de datos para la tabla `own_companies`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productions`
--

CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `production_types_id` int(11) NOT NULL,
  `companies_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `direction` varchar(250) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `observation` varchar(250) DEFAULT NULL,
  `budget` int(11) NOT NULL DEFAULT '0',
  `in_litter` binary(0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productions_status1` (`status_id`),
  KEY `fk_productions_production_types1` (`production_types_id`),
  KEY `fk_productions_companies1` (`companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Volcar la base de datos para la tabla `productions`
--

INSERT INTO `productions` (`id`, `name`, `production_types_id`, `companies_id`, `status_id`, `direction`, `date_start`, `date_end`, `observation`, `budget`, `in_litter`) VALUES
(26, 'Ortigueira', 28, 26, 28, 'Ortigueira', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 40000, NULL),
(28, 'fresh weekend', 28, 25, 26, 'cerceda', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 4000, NULL),
(29, 'Meeting Lugo 2011_2', 33, 25, 26, 'Meeting', '2011-01-15 07:00:00', '2011-12-16 02:00:00', 'segundo metting lugar a decidir', 1000, NULL),
(30, 'Reperkusion 012', 28, 26, 26, 'Allariz entrada de la carretera', '2012-05-10 00:00:03', '2012-05-21 00:00:00', 'montaje, desmontaje , seguridad, produccion tecnica', 200000, NULL),
(32, 'pelicula agustin', 29, 24, 26, 'barcelona fd', '2012-05-10 00:00:03', '2012-07-02 00:00:00', 'rekrñewirpowe', 500000, NULL),
(33, 'Festival de cine gallego', 32, 28, 31, 'camino tras castelo', '2012-05-10 00:00:03', '2011-01-02 00:00:00', 'Carga del material', 2500, NULL),
(35, 'Festival de cine gallego 2', 29, 27, 26, '32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', 43434, NULL),
(36, 'Resentidos12', 27, 24, 26, 'expourense', '2012-05-10 00:00:03', '2012-05-21 00:00:00', 'montaje, desmontaje , seguridad, produccion tecnica', 5000, NULL),
(39, 'Resentidos', 27, 24, 26, 'expourense', '2012-05-10 00:00:03', '2011-12-16 02:00:00', 'Concierto de un dia', 1500, NULL),
(40, 'Alberto Ortigueira', 27, 24, 26, 'ortiigueira', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', 0, NULL),
(41, 'aaaaaaaaaaa', 27, 27, 26, 'Allariz entrada de la carretera', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a', 0, NULL),
(42, 'aaaaaaaaaaa', 27, 24, 26, 'Allariz entrada de la carretera', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a', 0, NULL),
(43, 'Ayuntamiento de ortigueira', 27, 0, 26, 'ortiigueira', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 0, NULL),
(62, 'Alberto Ortigueira', 27, 24, 26, '123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '132', 123, NULL),
(50, 'Reperkusion 012', 27, 25, 26, '342', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3434', 33, NULL);

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
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resources_types_id` int(11) NOT NULL,
  `companies_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `desctiption` varchar(2500) DEFAULT NULL,
  `direction` int(11) DEFAULT NULL,
  `num_recources` int(11) DEFAULT NULL,
  `num_resources_used` varchar(45) DEFAULT NULL,
  `in_litter` binary(0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resource_resources_types1` (`resources_types_id`),
  KEY `fk_resource_companies1` (`companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcar la base de datos para la tabla `resources`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources_activities`
--

CREATE TABLE IF NOT EXISTS `resources_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `activities_id` int(11) NOT NULL,
  `activity_types_id` int(11) NOT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `unbilled_hours` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`),
  KEY `fk_resources_types_copy1_resource1` (`resource_id`),
  KEY `fk_resources_types_copy1_activities1` (`activities_id`),
  KEY `fk_resources_activity_types1` (`activity_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcar la base de datos para la tabla `resources_activities`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources_types`
--

CREATE TABLE IF NOT EXISTS `resources_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcar la base de datos para la tabla `resources_types`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

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
