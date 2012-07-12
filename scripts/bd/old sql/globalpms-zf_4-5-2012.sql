-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-05-2012 a las 20:03:17
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=670 ;

--
-- Volcar la base de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `permission`, `name`, `menu`, `role_id`, `resource_id`) VALUES
(75, 'delete', 'delete Resource', 0, 2, 26),
(74, 'edit', 'edit Resource', 0, 2, 26),
(73, 'add', 'add Resource', 2, 2, 26),
(72, 'index', 'index Resource', 0, 2, 26),
(71, 'error', 'error Error', 0, 2, 25),
(70, 'index', 'index Index', 0, 2, 24),
(69, 'delete', 'delete Permission', 0, 2, 23),
(68, 'edit', 'edit Permission', 0, 2, 23),
(67, 'add', 'add Permission', 0, 2, 23),
(66, 'index', 'index Permission', 0, 2, 23),
(65, 'delete', 'delete Role', 0, 2, 22),
(64, 'edit', 'edit Role', 0, 2, 22),
(63, 'add', 'add Role', 0, 2, 22),
(62, 'index', 'index Role', 0, 2, 22),
(642, 'index', 'index Index', 0, 6, 209),
(28, 'index', 'index Index', 0, 1, 11),
(29, 'changelanguage', 'changelanguage Index', 0, 1, 11),
(30, 'error', 'error Error', 0, 1, 12),
(57, 'uninstall', 'uninstall Controlmodule', 0, 2, 19),
(56, 'install', 'install Controlmodule', 0, 2, 19),
(55, 'delete', 'delete Controlmodule', 0, 2, 19),
(54, 'edit', 'edit Controlmodule', 0, 2, 19),
(53, 'add', 'add Controlmodule', 0, 2, 19),
(52, 'index', 'index Controlmodule', 0, 2, 19),
(40, 'index', 'index Index', 0, 6, 15),
(41, 'logout', 'logout Index', 0, 6, 15),
(42, 'error', 'error Error', 0, 6, 16),
(43, 'denied', 'denied Error', 0, 6, 16),
(44, 'unactive', 'unactive Error', 0, 6, 16),
(45, 'uninstall', 'uninstall Error', 0, 6, 16),
(46, 'notfound', 'notfound Error', 0, 6, 16),
(58, 'backup', 'backup Controlmodule', 0, 2, 19),
(59, 'activate', 'activate Controlmodule', 0, 2, 19),
(60, 'deactivate', 'deactivate Controlmodule', 0, 2, 19),
(61, 'index', 'index Index', 0, 2, 20),
(76, 'index', 'index User', 0, 2, 27),
(77, 'add', 'add User', 0, 2, 27),
(78, 'edit', 'edit User', 0, 6, 27),
(79, 'delete', 'delete User', 0, 2, 27),
(666, 'select', 'select Company', 0, 6, 185),
(643, 'error', 'error Error', 0, 6, 210),
(636, 'select', 'select Production', 0, 6, 208),
(669, 'consult', 'consult Company', 0, 6, 185),
(667, 'select', 'select User', 0, 6, 27),
(668, 'select', 'select Controlmodule', 0, 6, 19),
(550, 'inlitter', 'inlitter Company', 0, 3, 185),
(549, 'delete', 'delete Company', 0, 2, 185),
(548, 'edit', 'edit Company', 0, 3, 185),
(547, 'add', 'add Company', 0, 3, 185),
(546, 'index', 'index Company', 0, 6, 185),
(641, 'inlitter', 'inlitter Production', 0, 3, 208),
(640, 'delete', 'delete Production', 0, 3, 208),
(630, 'index', 'index Activity', 0, 19, 207),
(631, 'add', 'add Activity', 0, 12, 207),
(632, 'edit', 'edit Activity', 0, 19, 207),
(540, 'index', 'index Owncompany', 0, 3, 182),
(541, 'add', 'add Owncompany', 0, 3, 182),
(542, 'edit', 'edit Owncompany', 0, 3, 182),
(543, 'delete', 'delete Owncompany', 0, 3, 182),
(544, 'index', 'index Index', 0, 12, 183),
(539, 'inlitter', 'inlitter Contact', 0, 12, 181),
(538, 'delete', 'delete Contact', 0, 3, 181),
(537, 'edit', 'edit Contact', 0, 12, 181),
(536, 'add', 'add Contact', 0, 12, 181),
(535, 'index', 'index Contact', 0, 19, 181),
(365, 'index', 'index Finances', 0, 1, 123),
(366, 'add', 'add Finances', 0, 1, 123),
(367, 'edit', 'edit Finances', 0, 1, 123),
(368, 'delete', 'delete Finances', 0, 1, 123),
(369, 'index', 'index Index', 0, 1, 124),
(370, 'error', 'error Error', 0, 1, 125),
(638, 'add', 'add Production', 0, 3, 208),
(634, 'inlitter', 'inlitter Activity', 0, 19, 207),
(633, 'delete', 'delete Activity', 0, 12, 207),
(661, 'edit', 'edit Activitytype', 0, 2, 216),
(662, 'delete', 'delete Activitytype', 0, 2, 216),
(660, 'add', 'add Activitytype', 0, 2, 216),
(659, 'index', 'index Activitytype', 0, 2, 216),
(658, 'delete', 'delete Managementtype', 0, 2, 215),
(657, 'edit', 'edit Managementtype', 0, 2, 215),
(656, 'add', 'add Managementtype', 0, 2, 215),
(655, 'index', 'index Managementtype', 0, 2, 215),
(652, 'delete', 'delete Companytype', 0, 2, 213),
(653, 'inlitter', 'inlitter Companytype', 0, 2, 213),
(654, 'error', 'error Error', 0, 2, 214),
(651, 'edit', 'edit Companytype', 0, 2, 213),
(650, 'add', 'add Companytype', 0, 2, 213),
(649, 'index', 'index Companytype', 0, 2, 213),
(648, 'index', 'index Index', 0, 2, 212),
(545, 'error', 'error Error', 0, 6, 184),
(665, 'permission', 'permission Activity', 0, 12, 207),
(664, 'select', 'select Activity', 0, 6, 207),
(663, 'consult', 'consult Activity', 0, 6, 207),
(647, 'delete', 'delete Resourcetype', 0, 2, 211),
(646, 'edit', 'edit Resourcetype', 0, 2, 211),
(645, 'add', 'add Resourcetype', 0, 2, 211),
(644, 'index', 'index Resourcetype', 0, 2, 211),
(551, 'outlitter', 'outlitter Company', 0, 3, 185),
(639, 'edit', 'edit Production', 0, 12, 208),
(637, 'consult', 'consult Production', 0, 6, 208),
(635, 'index', 'index Production', 0, 6, 208),
(629, 'inlitter', 'inlitter Permissionproduction', 0, 12, 206),
(625, 'index', 'index Permissionproduction', 0, 12, 206),
(626, 'add', 'add Permissionproduction', 0, 12, 206),
(627, 'edit', 'edit Permissionproduction', 0, 12, 206),
(628, 'delete', 'delete Permissionproduction', 0, 12, 206);

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
(11, 'default:index', 'DefaultIndex', 46),
(12, 'default:error', 'DefaultError', 46),
(19, 'controlmodule:controlmodule', 'ControlmoduleControlmodule', 53),
(15, 'login:index', 'LoginIndex', 48),
(16, 'login:error', 'LoginError', 48),
(20, 'controlmodule:index', 'ControlmoduleIndex', 53),
(21, 'controlmodule:error', 'ControlmoduleError', 53),
(27, 'user:user', 'UserUser', 54),
(185, 'company:company', 'CompanyCompany', 92),
(184, 'company:error', 'CompanyError', 92),
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
(2, 'Admintrator', '3', 'index'),
(18, 'Encargado cliente', '6', 'index'),
(6, 'public', '', 'index'),
(12, 'Encargado Producion', '19', 'index'),
(3, 'Gerente', '17,12', 'index'),
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
  `status` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `person_id` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `validation_code` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `phone` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_users_acl_roles1` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=53 ;

--
-- Volcar la base de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`id`, `name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`, `role_id`) VALUES
(4, 'Roi Implementador', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-21 18:09:31', 'roigd@gmail.com', '123', '22', '12', '4343434', 1),
(43, 'Pablo pontino', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'pablopontino@secogal.com', '0', '33', '3', '3', 19),
(44, 'celso', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'celso@gmail.com', '0', 'celso@gmail.com', 'celso@gmail.com', 'celso@gmail.com', 12),
(42, 'juan carlos', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'jc@secogal.com', '0', '2', '2', '2', 3),
(46, 'ogando', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'ogi@gmail.com', 'Encargado de personal', '3', 'o', '3', 12),
(47, 'milocho', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'milocho@fankani.com', 'Gerente', 'w', 'w', 'w', 17),
(48, 'Blanco', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'blanco@nalgures.com', 'gerente', 'w', '1', 'w', 3),
(49, 'ReixA', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'reixa@nalgures.com', 'Encargado de produccion', '2', '2', '2', 12),
(50, 'xurxo', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'xurxo@fankany.com', 'Encargado de produccion', '2', '22', '2', 18),
(51, 'avelino', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2022-11-11 00:00:00', 'avelino@secogal.com', 'Encargado de seguridad', '2', '2', '2', 19),
(52, 'Agustin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2023-11-11 00:00:00', 'agustin@elemental.com', '212', '2', '2', '2', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_users_has_companies`
--

CREATE TABLE IF NOT EXISTS `acl_users_has_companies` (
  `acl_users_id` int(11) NOT NULL,
  `companies_id` int(11) NOT NULL,
  PRIMARY KEY (`acl_users_id`,`companies_id`),
  KEY `fk_acl_users_has_companies_companies1` (`companies_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcar la base de datos para la tabla `acl_users_has_companies`
--

INSERT INTO `acl_users_has_companies` (`acl_users_id`, `companies_id`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(42, 1),
(44, 2),
(46, 2),
(47, 3),
(48, 4),
(49, 4),
(50, 3),
(51, 1),
(52, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `productions_id` int(11) NOT NULL,
  `activity_types_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `contact_own_company_id` int(11) NOT NULL,
  `contact_client_company_id` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `observation` varchar(2500) DEFAULT NULL,
  `in_litter` binary(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_acl_activities_acl_productions1` (`productions_id`),
  KEY `fk_activities_activity_types1` (`activity_types_id`),
  KEY `fk_activities_status1` (`status_id`),
  KEY `fk_activities_contacts3` (`contact_own_company_id`),
  KEY `fk_activities_contacts1` (`contact_client_company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `name`, `productions_id`, `activity_types_id`, `status_id`, `contact_own_company_id`, `contact_client_company_id`, `date_start`, `date_end`, `observation`, `in_litter`) VALUES
(1, 'Montar escenario Festigal', 1, 26, 26, 7, 5, '0001-00-00 00:00:00', '0000-00-00 00:00:02', '332323', '0'),
(2, 'Seguridad camping', 4, 27, 26, 7, 6, '0001-00-00 00:00:00', '0000-00-00 00:00:02', 'pulseras rojas validan el camping', '0'),
(3, 'Comida artistas', 4, 28, 26, 8, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '23', '0');

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
  `in_litter` binary(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_acl_company_acl_type_company1` (`company_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `fiscal_name`, `company_types_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`, `in_litter`) VALUES
(1, 'Secogal', 'Secogal SA', 1, 'Secogal@Secogal.com', 'Secogal', 'Secogal', 'Secogal', 'Secogal', 'Secogal', 'Secogal', 'Secogal', '\0'),
(2, 'make ilusion', 'make ilusion', 1, 'makeilusion@make ilusion.com', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', '\0'),
(3, 'Fankany', 'Funkany SA', 26, 'funkuny@gmail.com', 'w', '32002', 'Allariz', 'España', '12233ff', 'w', '323', '0'),
(4, 'Nalgures', 'nalgures sa', 26, 'nalgures@nalgures.com', '2', '2', '2', '2', '22', '2', '2', '0'),
(5, 'Elemental', 'Elemental S.A.', 31, 'Elemental@Elemental.com', 'O', '32333', 'Cali', 'Colonia', '3232323', '23', '32323232', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies_has_productions`
--

CREATE TABLE IF NOT EXISTS `companies_has_productions` (
  `companies_id` int(11) NOT NULL,
  `productions_id` int(11) NOT NULL,
  PRIMARY KEY (`companies_id`,`productions_id`),
  KEY `fk_companies_has_productions_productions1` (`productions_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `companies_has_productions`
--

INSERT INTO `companies_has_productions` (`companies_id`, `productions_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies_has_suppliers`
--

CREATE TABLE IF NOT EXISTS `companies_has_suppliers` (
  `companies_id` int(11) NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  PRIMARY KEY (`companies_id`,`suppliers_id`),
  KEY `fk_companies_has_suppliers_suppliers1` (`suppliers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `companies_has_suppliers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_types`
--

CREATE TABLE IF NOT EXISTS `company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `company_types`
--

INSERT INTO `company_types` (`id`, `name`) VALUES
(26, 'Producciones audiovisuales'),
(27, 'Conciertos y festivales'),
(28, 'Seguridad'),
(29, 'Catering'),
(30, 'Teatro'),
(31, 'Consultora informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acl_users_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `direction` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '0',
  `telephone` varchar(250) NOT NULL DEFAULT '0',
  `status` varchar(45) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `in_litter` binary(1) DEFAULT '0',
  PRIMARY KEY (`id`,`acl_users_id`),
  KEY `fk_acl_contacts_acl_company1` (`company_id`),
  KEY `fk_contacts_acl_users1` (`acl_users_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `acl_users_id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`, `in_litter`) VALUES
(1, 42, 'juan carlos', '', 'jc@secogal.com', '0', 'Gerente', 1, '0'),
(2, 44, 'celso', '', 'celso@gmail.com', '0', 'celso@gmail.com', 1, '0'),
(4, 46, 'ogando', '', 'ogi@gmail.com', '0', 'Encargado de personal', 2, '0'),
(5, 49, 'ReixA', '', 'reixa@nalgures.com', '0', 'Encargado de produccion', 4, '0'),
(6, 50, 'xurxo', '', 'xurxo@fankany.com', '0', 'Encargado de produccion', 3, '0'),
(7, 51, 'avelino', '', 'avelino@secogal.com', '0', 'Encargado de seguridad', 1, '0'),
(8, 0, 'Elvira', '3333', 'elvira@secogal.com', '2323232', 'ayudante de gerencia', 1, '0'),
(9, 52, 'Agustin', '', 'agustin@elemental.com', '0', '212', 5, '0');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=66 ;

--
-- Volcar la base de datos para la tabla `permission_production`
--

INSERT INTO `permission_production` (`id`, `acl_users_id`, `productions_id`, `acl_roles_id`) VALUES
(65, 4, 4, 1),
(62, 50, 4, 18),
(55, 4, 1, 1),
(57, 4, 2, 1),
(60, 47, 4, 17),
(63, 4, 5, 1),
(59, 42, 4, 3),
(64, 51, 1, 19),
(50, 4, 3, 1),
(58, 42, 1, 3),
(61, 47, 2, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productions`
--

CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `production_types_id` int(11) NOT NULL,
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
  KEY `fk_productions_companies2` (`client_companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `productions`
--

INSERT INTO `productions` (`id`, `name`, `production_types_id`, `client_companies_id`, `status_id`, `direction`, `date_start`, `date_end`, `observation`, `budget`, `in_litter`) VALUES
(1, 'Festigal', 27, 4, 25, 'santiago', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', 3, '0'),
(2, 'Resentidos 2012', 27, 3, 25, '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', 2, '0'),
(3, 'Fiestas de pontevedra', 27, 4, 25, 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', 0, '0'),
(4, 'Reperkusion 2012', 28, 3, 25, 'benposta', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', 0, '0'),
(5, 'Reperkusion 2011', 28, 3, 25, 'wa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a', 0, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productions_has_suppliers`
--

CREATE TABLE IF NOT EXISTS `productions_has_suppliers` (
  `productions_id` int(11) NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  PRIMARY KEY (`productions_id`,`suppliers_id`),
  KEY `fk_productions_has_suppliers_suppliers1` (`suppliers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `productions_has_suppliers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `production_types`
--

CREATE TABLE IF NOT EXISTS `production_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `resource_type` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
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
  `observation` varchar(255) DEFAULT NULL,
  `unbilled_hours` int(11) DEFAULT NULL,
  `contacts_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resources_types_copy1_resource1` (`resource_id`),
  KEY `fk_resources_types_copy1_activities1` (`activities_id`),
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  UNIQUE KEY `name` (`name`),
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL,
  `description` text,
  `companies_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_providers_companies1` (`companies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `suppliers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers_has_activity_types`
--

CREATE TABLE IF NOT EXISTS `suppliers_has_activity_types` (
  `suppliers_id` int(11) NOT NULL,
  `activity_types_id` int(11) NOT NULL,
  PRIMARY KEY (`suppliers_id`,`activity_types_id`),
  KEY `fk_suppliers_has_activity_types_activity_types1` (`activity_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `suppliers_has_activity_types`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `fk_providers_companies1` FOREIGN KEY (`companies_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `suppliers_has_activity_types`
--
ALTER TABLE `suppliers_has_activity_types`
  ADD CONSTRAINT `fk_suppliers_has_activity_types_activity_types1` FOREIGN KEY (`activity_types_id`) REFERENCES `activity_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_suppliers_has_activity_types_suppliers1` FOREIGN KEY (`suppliers_id`) REFERENCES `suppliers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
