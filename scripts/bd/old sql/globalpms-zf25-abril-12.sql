-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-04-2012 a las 18:59:06
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=99 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `name`, `active`) VALUES
(49, 'album', 1),
(48, 'login', 1),
(54, 'user', 1),
(53, 'controlmodule', 1),
(46, 'default', 1),
(97, 'production', 1),
(44, 'activity', 1),
(92, 'company', 1),
(55, 'casas', 1),
(57, 'modeloejemplo', 1),
(80, 'finances', 1),
(98, 'managementtype', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=666 ;

--
-- Volcar la base de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `permission`, `name`, `menu`, `role_id`, `resource_id`) VALUES
(75, 'delete', 'delete Resource', 0, 1, 26),
(74, 'edit', 'edit Resource', 0, 1, 26),
(73, 'add', 'add Resource', 0, 1, 26),
(72, 'index', 'index Resource', 0, 1, 26),
(71, 'error', 'error Error', 0, 2, 25),
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
(642, 'index', 'index Index', 0, 6, 209),
(28, 'index', 'index Index', 0, 1, 11),
(29, 'changelanguage', 'changelanguage Index', 0, 1, 11),
(30, 'error', 'error Error', 0, 1, 12),
(57, 'uninstall', 'uninstall Controlmodule', 0, 1, 19),
(56, 'install', 'install Controlmodule', 0, 1, 19),
(55, 'delete', 'delete Controlmodule', 0, 1, 19),
(54, 'edit', 'edit Controlmodule', 0, 1, 19),
(53, 'add', 'add Controlmodule', 0, 1, 19),
(52, 'index', 'index Controlmodule', 0, 2, 19),
(40, 'index', 'index Index', 0, 6, 15),
(41, 'logout', 'logout Index', 0, 6, 15),
(42, 'error', 'error Error', 0, 6, 16),
(43, 'denied', 'denied Error', 0, 6, 16),
(44, 'unactive', 'unactive Error', 0, 6, 16),
(45, 'uninstall', 'uninstall Error', 0, 6, 16),
(46, 'notfound', 'notfound Error', 0, 6, 16),
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
(643, 'error', 'error Error', 0, 1, 210),
(636, 'select', 'select Production', 0, 6, 208),
(92, 'index', 'index Modeloejemplo', 0, 1, 34),
(93, 'add', 'add Modeloejemplo', 0, 1, 34),
(94, 'edit', 'edit Modeloejemplo', 0, 1, 34),
(95, 'delete', 'delete Modeloejemplo', 0, 1, 34),
(96, 'index', 'index Index', 0, 1, 35),
(97, 'error', 'error Error', 0, 1, 36),
(550, 'inlitter', 'inlitter Company', 0, 1, 185),
(549, 'delete', 'delete Company', 0, 1, 185),
(548, 'edit', 'edit Company', 0, 1, 185),
(547, 'add', 'add Company', 0, 1, 185),
(546, 'index', 'index Company', 0, 6, 185),
(641, 'inlitter', 'inlitter Production', 0, 19, 208),
(640, 'delete', 'delete Production', 0, 19, 208),
(630, 'index', 'index Activity', 0, 19, 207),
(631, 'add', 'add Activity', 0, 12, 207),
(632, 'edit', 'edit Activity', 0, 18, 207),
(540, 'index', 'index Owncompany', 0, 6, 182),
(541, 'add', 'add Owncompany', 0, 1, 182),
(542, 'edit', 'edit Owncompany', 0, 1, 182),
(543, 'delete', 'delete Owncompany', 0, 1, 182),
(544, 'index', 'index Index', 0, 1, 183),
(539, 'inlitter', 'inlitter Contact', 0, 1, 181),
(538, 'delete', 'delete Contact', 0, 1, 181),
(537, 'edit', 'edit Contact', 0, 1, 181),
(536, 'add', 'add Contact', 0, 1, 181),
(535, 'index', 'index Contact', 0, 1, 181),
(365, 'index', 'index Finances', 0, 1, 123),
(366, 'add', 'add Finances', 0, 1, 123),
(367, 'edit', 'edit Finances', 0, 1, 123),
(368, 'delete', 'delete Finances', 0, 1, 123),
(369, 'index', 'index Index', 0, 1, 124),
(370, 'error', 'error Error', 0, 1, 125),
(638, 'add', 'add Production', 0, 16, 208),
(634, 'inlitter', 'inlitter Activity', 0, 19, 207),
(633, 'delete', 'delete Activity', 0, 19, 207),
(661, 'edit', 'edit Activitytype', 0, 1, 216),
(662, 'delete', 'delete Activitytype', 0, 1, 216),
(660, 'add', 'add Activitytype', 0, 1, 216),
(659, 'index', 'index Activitytype', 0, 1, 216),
(658, 'delete', 'delete Managementtype', 0, 1, 215),
(657, 'edit', 'edit Managementtype', 0, 1, 215),
(656, 'add', 'add Managementtype', 0, 1, 215),
(655, 'index', 'index Managementtype', 0, 1, 215),
(652, 'delete', 'delete Companytype', 0, 1, 213),
(653, 'inlitter', 'inlitter Companytype', 0, 1, 213),
(654, 'error', 'error Error', 0, 1, 214),
(651, 'edit', 'edit Companytype', 0, 1, 213),
(650, 'add', 'add Companytype', 0, 1, 213),
(649, 'index', 'index Companytype', 0, 1, 213),
(648, 'index', 'index Index', 0, 1, 212),
(545, 'error', 'error Error', 0, 1, 184),
(665, 'permission', 'permission Activity', 0, 12, 207),
(664, 'select', 'select Activity', 0, 6, 207),
(663, 'consult', 'consult Activity', 0, 6, 207),
(647, 'delete', 'delete Resourcetype', 0, 1, 211),
(646, 'edit', 'edit Resourcetype', 0, 1, 211),
(645, 'add', 'add Resourcetype', 0, 1, 211),
(644, 'index', 'index Resourcetype', 0, 1, 211),
(551, 'outlitter', 'outlitter Company', 0, 1, 185),
(639, 'edit', 'edit Production', 0, 19, 208),
(637, 'consult', 'consult Production', 0, 6, 208),
(635, 'index', 'index Production', 0, 6, 208),
(629, 'inlitter', 'inlitter Permissionproduction', 0, 19, 206),
(625, 'index', 'index Permissionproduction', 0, 19, 206),
(626, 'add', 'add Permissionproduction', 0, 19, 206),
(627, 'edit', 'edit Permissionproduction', 0, 19, 206),
(628, 'delete', 'delete Permissionproduction', 0, 19, 206);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=217 ;

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
(185, 'company:company', 'CompanyCompany', 92),
(184, 'company:error', 'CompanyError', 92),
(34, 'modeloejemplo:modeloejemplo', 'ModeloejemploModeloejemplo', 57),
(35, 'modeloejemplo:index', 'ModeloejemploIndex', 57),
(36, 'modeloejemplo:error', 'ModeloejemploError', 57),
(183, 'company:index', 'CompanyIndex', 92),
(210, 'production:error', 'ProductionError', 97),
(209, 'production:index', 'ProductionIndex', 97),
(182, 'company:owncompany', 'CompanyOwncompany', 92),
(123, 'finances:finances', 'FinancesFinances', 80),
(124, 'finances:index', 'FinancesIndex', 80),
(125, 'finances:error', 'FinancesError', 80),
(206, 'production:permissionproduction', 'ProductionPermissionproduction', 97),
(181, 'company:contact', 'CompanyContact', 92),
(207, 'production:activity', 'ProductionActivity', 97),
(208, 'production:production', 'ProductionProduction', 97),
(216, 'managementtype:activitytype', 'ManagementtypeActivitytype', 98),
(215, 'managementtype:managementtype', 'ManagementtypeManagementtype', 98),
(214, 'managementtype:error', 'ManagementtypeError', 98),
(213, 'managementtype:companytype', 'ManagementtypeCompanytype', 98),
(212, 'managementtype:index', 'ManagementtypeIndex', 98),
(211, 'managementtype:resourcetype', 'ManagementtypeResourcetype', 98);

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
  `contacts_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_users_acl_roles1` (`role_id`),
  KEY `fk_acl_users_contacts1` (`contacts_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`id`, `name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`, `role_id`, `contacts_id`) VALUES
(16, 'Agustin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'agustin@secogal.com', 1, '2', '2', '64646446', 1, 17),
(4, 'Roi', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-21 18:09:31', 'roigd@gmail.com', 1, '2', '1', '4343434', 1, 1),
(27, 'srlsmpieza', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'srlimpieza@limpeiezabarcelona.com', 1, '2', '2', '2', 17, 65),
(10, 'Guest', '', '2011-09-06 22:17:16', '0', 0, '0', '0', '0', 6, 0),
(15, 'Juan Carlos', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2015-08-11 00:00:00', 'jc@secogal.com', 0, '1', '1', '6565656565', 2, 15),
(26, 'Mil ocho', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'milocho@funkani.com', 0, '1', '1', '606832626', 1, 64),
(24, 'Edu', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'edudeza@hotmail.es', 0, '3', '3', '606832626', 12, 18),
(25, 'kaxia', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'kasia@gmail.com', 0, 'w', 'w', 'w', 1, 63),
(28, 'xurxo', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'xurxo2@fankany.com', 0, '2', '2', '606832626', 18, 66),
(29, 'Natalia', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'natalia@orquestor.com', 0, '1', '1', '64646446', 19, 67);

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
  `contact_client_company_id` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `observation` varchar(2500) DEFAULT NULL,
  `in_litter` binary(1) DEFAULT '0',
  `users_activity_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_activities_acl_productions1` (`productions_id`),
  KEY `fk_activities_activity_types1` (`activity_types_id`),
  KEY `fk_activities_status1` (`status_id`),
  KEY `fk_activities_contacts3` (`contact_own_company_id`),
  KEY `fk_activities_contacts1` (`contact_client_company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Volcar la base de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `productions_id`, `activity_types_id`, `status_id`, `contact_own_company_id`, `contact_client_company_id`, `date_start`, `date_end`, `observation`, `in_litter`, `users_activity_id`) VALUES
(25, 1, 26, 26, 17, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', '0', NULL),
(27, 1, 32, 29, 17, 1, '0000-00-00 00:00:00', '0010-00-00 00:00:00', '2', '0', NULL),
(28, 3, 26, 26, 1, 64, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', '0', NULL),
(29, 24, 26, 26, 17, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', '0', NULL),
(30, 24, 26, 26, 17, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', '0', NULL),
(31, 25, 26, 26, 1, 67, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '0', NULL),
(32, 25, 29, 26, 1, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '0', NULL),
(33, 25, 26, 26, 15, 67, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '0', NULL),
(34, 3, 26, 27, 15, 66, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', '0', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_types`
--

CREATE TABLE IF NOT EXISTS `activity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Volcar la base de datos para la tabla `activity_types`
--

INSERT INTO `activity_types` (`id`, `name`) VALUES
(26, 'Carga y Descargas'),
(27, 'Seguridad'),
(28, 'Catering'),
(29, 'Running'),
(31, 'Limpieza'),
(32, 'Plan de seguridad'),
(1, 'generica');

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
  `activity_types_id` varchar(250) DEFAULT '1',
  `in_litter` binary(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_acl_company_acl_type_company1` (`company_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Volcar la base de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `fiscal_name`, `company_types_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`, `activity_types_id`, `in_litter`) VALUES
(63, 'FreeLance', 'FreeLance S.A.', 26, 'freelance@freelance.com', 'freelance', 'freelance', 'freelance', 'freelance', 'freelance', 'freelance', 'freelance', '1', '0'),
(62, 'Funkany', 'Funkany SA', 27, 'funkuny@gmail.com', 'ddOurense angfdsfdsfdsdd', '23232', 'Ourense', 'Ourense', '656565656', '54534543534', 'fdsjlkfpsdjlkf', '26,28', '0'),
(61, 'extras Barcelona', 'extras Barcelona sa', 30, 'extras@extrasbarcelona.com', 'barcelona', '32002a', 'barcelona', 'Españaa', '981323232', '981323232', 'montaje, desmontaje y seguridad', '26', '0'),
(54, 'Secogal', 'Secogal S. L.', 26, 'secogal@secogal.com', 'camino tras castelo', '32002a', 'Ourense', 'Españaa', '646469702a', '5543534534a', 'd', '1', '0'),
(55, 'Compañia agustin', 'asdadas', 26, 'aAlberto@ortiguiera.com', 'a', 'd', 'd', 'd', 'adsadas', 'adsadsad', 'd', '29', '0'),
(56, 'fdsfds', 'dfsfsdf', 26, 'xulio.xxl@gmail.es', 'aa', 's', 's', 's', 'sdasd', 'sadasd', 'sdss', 'Array', '1'),
(57, 'de luz', 'sdad', 26, 'Alberto@ortiguiera.com', 'd3233', 'd', 'd', 'd', 'd', 'd', 'd', '27,29,31', '1'),
(58, 'Limpieza Barcelona', 'dsfsdf', 26, 'fffana@litoria.com', '323fff', '32002', '3', '3', 'fdsfsd', '343', '3', '31,32,1', '1'),
(60, 'especialistas barcelona', 'fdsf', 26, 'Ramon@litoria.es', 'kjk', 'jkl', 'jkl', 'jkljkl', 'dsfdsf', 'kljj', 'jkl', '1', '1'),
(53, 'Ayutamiento barcelona', 'Ayutamiento barcelona2', 26, 'AyutamientoBarcelona@bar.com', 'barcelona fd', '32322', 'barcelona', 'Españaa', '678787878', '5543534534a', 'catering para backstagez', '26,29', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_types`
--

CREATE TABLE IF NOT EXISTS `company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

--
-- Volcar la base de datos para la tabla `company_types`
--

INSERT INTO `company_types` (`id`, `name`) VALUES
(26, 'Producciones audiovisuales'),
(27, 'Conciertos y festivales'),
(28, 'Seguridad'),
(29, 'Catering'),
(30, 'Teatro');

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
  `in_litter` binary(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_contacts_acl_company1` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`, `in_litter`) VALUES
(1, 'Roi Grande Deza', 'Pabellon deportivo Lug', 'roigd@gmail.com', '646464645', 'Encargado', 54, '0'),
(11, 'fsdf', 'fdfdsf', 'fxulio.xxl@gmail.co', 'fdfdds', 'dddireccion fgf', 53, '1'),
(12, 'Alberto Ortigueira', 'Pabellon deportivo Lugogg', 'xulio.aaxxl@gmail.com', 'xx3434555555dss', 'Encargado de personale', 53, '0'),
(65, 'srlsmpieza', '', 'srlimpieza@limpeiezabarcelona.com', '0', '1', 58, '0'),
(9, 'erewrwe', 'rtrtrtsdfdsf', 'erwwefdf@fdfd.es', 'xx3434555555dss', 'Encargado de personaler', 53, '1'),
(64, 'Mil ocho', '', 'milocho@funkani.com', '0', 'Gerente', 62, '0'),
(14, 'xurxo', 'allariz', 'xurxo@fankany.com', '545454545', 'gerente', 62, '0'),
(15, 'Juan Carlos villalon', 'Pereiro de aguair', 'jc@secogal.com', 'xx3434555555dss', 'Gerente', 54, '0'),
(16, 'Señor Extra', 'barcelona', 'srextras@extrasbarcelona.com', '4343434343', 'Encargado de personal', 61, '0'),
(17, 'Agustin', 'barcelona', 'agustin@cine.com', '4343434343', 'Gerente', 55, '0'),
(18, 'Edu', '', 'edudeza@hotmail.es', '0', 'pailan', 63, '0'),
(63, 'kaxia', '', 'kasia@gmail.com', '0', 'Encargado de personaler', 63, '0'),
(66, 'xurxo', '', 'xurxo2@fankany.com', '0', 'Encargado de personaler', 62, '0'),
(67, 'Natalia', '', 'natalia@orquestor.com', '0', 'encargade de actividades', 55, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `own_companies`
--

CREATE TABLE IF NOT EXISTS `own_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(64) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_contacts_acl_company1` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `own_companies`
--

INSERT INTO `own_companies` (`id`, `description`, `company_id`) VALUES
(1, 'Empresa de auxiliares de eventosa', 54),
(2, 'd', 55),
(3, 's', 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_production`
--

CREATE TABLE IF NOT EXISTS `permission_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acl_users_id` int(11) NOT NULL,
  `productions_id` int(11) NOT NULL,
  `acl_roles_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_roles_copy1_acl_users1` (`acl_users_id`),
  KEY `fk_acl_roles_copy1_productions1` (`productions_id`),
  KEY `fk_acl_roles_copy1_acl_roles1` (`acl_roles_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=38 ;

--
-- Volcar la base de datos para la tabla `permission_production`
--

INSERT INTO `permission_production` (`id`, `acl_users_id`, `productions_id`, `acl_roles_id`) VALUES
(18, 4, 1, 2),
(19, 16, 1, 18),
(20, 4, 3, 1),
(21, 16, 3, 2),
(22, 4, 8, 1),
(35, 28, 3, 19),
(36, 4, 25, 1),
(26, 27, 8, 6),
(34, 15, 1, 19),
(32, 4, 24, 2),
(33, 16, 24, 12),
(37, 29, 25, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productions`
--

CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `production_types_id` int(11) NOT NULL,
  `own_companies_id` int(11) NOT NULL,
  `client_companies_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `direction` varchar(250) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `observation` varchar(250) DEFAULT NULL,
  `budget` int(11) NOT NULL DEFAULT '0',
  `in_litter` binary(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_productions_status1` (`status_id`),
  KEY `fk_productions_production_types1` (`production_types_id`),
  KEY `fk_productions_companies1` (`own_companies_id`),
  KEY `fk_productions_companies2` (`client_companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcar la base de datos para la tabla `productions`
--

INSERT INTO `productions` (`id`, `name`, `production_types_id`, `own_companies_id`, `client_companies_id`, `status_id`, `direction`, `date_start`, `date_end`, `observation`, `budget`, `in_litter`) VALUES
(1, 'Ortigueiraa', 28, 55, 54, 26, 'wewd', '2012-04-10 23:12:21', '2012-04-25 23:12:25', 'e333', 2222222, '0'),
(3, 'pelicula agustin', 27, 54, 62, 26, 'barcelona', '2012-04-10 00:00:03', '2012-01-02 00:00:00', 'catering para backstagez', 15000, '0'),
(4, 'Resentidos12', 27, 54, 62, 26, 'barcelona', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sdfdsfds', 0, '0'),
(7, 'Reperkusion 012', 27, 54, 58, 26, 'madrid', '2012-05-10 00:00:03', '2011-01-02 00:00:04', 'hablar con mil ocho', 15000, '0'),
(8, 'Limpeza de plaza cataluña', 27, 54, 58, 26, 'plaza cataluña', '2012-05-10 00:00:03', '2011-01-02 00:00:00', 'montaje, desmontaje y seguridad', 40000, '0'),
(9, 'dsadsa', 27, 54, 62, 26, 'dfsadsa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1ddddee', 44444444, '0'),
(24, 'Alberto Ortigueira', 27, 55, 55, 26, 'wa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', 0, '0'),
(25, 'Fucking Europe', 26, 54, 55, 26, 'barcelona', '2012-05-10 00:00:03', '2011-01-02 00:00:22', 'cuidado con agustin', 20000, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `production_types`
--
 
CREATE TABLE IF NOT EXISTS `production_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `resource_type` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`) 
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
(31, 'Fiesta privada', 1);

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
  `in_litter` binary(1) DEFAULT '0',
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
  `contacts_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
 
  KEY `fk_resources_types_copy1_resource1` (`resource_id`),
  KEY `fk_resources_types_copy1_activities1` (`activities_id`),
  KEY `fk_resources_activity_types1` (`activity_types_id`),
  KEY `fk_resources_activities_contacts1` (`contacts_id`)
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
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Volcar la base de datos para la tabla `resources_types`
--

INSERT INTO `resources_types` (`id`, `name`) VALUES
(26, 'Runner'),
(27, 'limpiador'),
(28, 'extra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
 
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
