-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-07-2012 a las 21:48:28
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=127 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `name`, `active`) VALUES
(48, 'login', 1),
(54, 'user', 1),
(53, 'controlmodule', 1),
(46, 'default', 1),
(97, 'production', 1),
(44, 'activity', 1),
(120, 'company', 1),
(55, 'casas', 1),
(57, 'modeloejemplo', 1),
(124, 'finances', 1),
(126, 'managementtype', 1),
(100, 'suplier', 1),
(123, 'supplier', 1),
(108, 'client', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1289 ;

--
-- Volcar la base de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `permission`, `name`, `menu`, `role_id`, `resource_id`) VALUES
(62, 'index', 'index Role', 0, 2, 22),
(63, 'add', 'add Role', 0, 2, 22),
(64, 'edit', 'edit Role', 0, 2, 22),
(65, 'delete', 'delete Role', 0, 2, 22),
(66, 'index', 'index Permission', 0, 2, 23),
(67, 'add', 'add Permission', 0, 2, 23),
(68, 'edit', 'edit Permission', 0, 2, 23),
(69, 'delete', 'delete Permission', 0, 2, 23),
(70, 'index', 'index Index', 0, 2, 24),
(71, 'error', 'error Error', 0, 2, 25),
(1285, 'add', 'add Activitytype', 0, 1, 378),
(1280, 'add', 'add Productiontype', 0, 1, 377),
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
(1278, 'inlitter', 'inlitter Facturationtype', 0, 1, 376),
(58, 'backup', 'backup Controlmodule', 0, 2, 19),
(59, 'activate', 'activate Controlmodule', 0, 2, 19),
(60, 'deactivate', 'deactivate Controlmodule', 0, 2, 19),
(61, 'index', 'index Index', 0, 2, 20),
(72, 'index', 'index Resource', 0, 2, 26),
(73, 'add', 'add Resource', 2, 2, 26),
(1279, 'index', 'index Productiontype', 0, 1, 377),
(1277, 'delete', 'delete Facturationtype', 0, 1, 376),
(1105, 'inlitter', 'inlitter Userscompanies', 0, 1, 333),
(643, 'error', 'error Error', 0, 6, 210),
(636, 'select', 'select Production', 0, 6, 208),
(74, 'edit', 'edit Resource', 0, 2, 26),
(668, 'select', 'select Controlmodule', 0, 6, 19),
(1104, 'delete', 'delete Userscompanies', 0, 1, 333),
(1102, 'index', 'index Userscompanies', 0, 1, 333),
(1103, 'add', 'add Userscompanies', 0, 1, 333),
(641, 'inlitter', 'inlitter Production', 0, 3, 208),
(640, 'delete', 'delete Production', 0, 3, 208),
(630, 'index', 'index Activity', 0, 19, 207),
(631, 'add', 'add Activity', 0, 12, 207),
(632, 'edit', 'edit Activity', 0, 19, 207),
(1199, 'delete', 'delete Companiessupplier', 0, 3, 357),
(831, 'add', 'add Resource', 0, 19, 262),
(1205, 'add', 'add Productionsuppliers', 0, 1, 358),
(1114, 'delete', 'delete Company', 0, 2, 336),
(1112, 'edit', 'edit Company', 0, 3, 336),
(1109, 'select', 'select Company', 0, 6, 336),
(1220, 'add', 'add Finances', 0, 1, 360),
(1219, 'consult', 'consult Finances', 0, 1, 360),
(1218, 'select', 'select Finances', 0, 1, 360),
(1217, 'index', 'index Finances', 0, 1, 360),
(638, 'add', 'add Production', 0, 3, 208),
(634, 'inlitter', 'inlitter Activity', 0, 19, 207),
(633, 'delete', 'delete Activity', 0, 12, 207),
(1276, 'edit', 'edit Facturationtype', 0, 1, 376),
(1275, 'add', 'add Facturationtype', 0, 1, 376),
(1274, 'index', 'index Facturationtype', 0, 1, 376),
(1273, 'delete', 'delete Managementtype', 0, 1, 375),
(1272, 'edit', 'edit Managementtype', 0, 1, 375),
(1271, 'add', 'add Managementtype', 0, 1, 375),
(1270, 'select', 'select Managementtype', 0, 1, 375),
(1269, 'index', 'index Managementtype', 0, 1, 375),
(1111, 'add', 'add Company', 0, 2, 336),
(665, 'permission', 'permission Activity', 0, 12, 207),
(664, 'select', 'select Activity', 0, 6, 207),
(663, 'consult', 'consult Activity', 0, 6, 207),
(1268, 'error', 'error Error', 0, 1, 374),
(1267, 'inlitter', 'inlitter Companytype', 0, 1, 373),
(1266, 'delete', 'delete Companytype', 0, 1, 373),
(1110, 'consult', 'consult Company', 0, 6, 336),
(639, 'edit', 'edit Production', 0, 12, 208),
(637, 'consult', 'consult Production', 0, 6, 208),
(635, 'index', 'index Production', 0, 6, 208),
(629, 'inlitter', 'inlitter Permissionproduction', 0, 12, 206),
(625, 'index', 'index Permissionproduction', 0, 12, 206),
(626, 'add', 'add Permissionproduction', 0, 12, 206),
(627, 'edit', 'edit Permissionproduction', 0, 12, 206),
(628, 'delete', 'delete Permissionproduction', 0, 12, 206),
(1284, 'index', 'index Activitytype', 0, 1, 378),
(1283, 'inlitter', 'inlitter Productiontype', 0, 1, 377),
(1282, 'delete', 'delete Productiontype', 0, 1, 377),
(1196, 'index', 'index Companiessupplier', 0, 3, 357),
(1197, 'add', 'add Companiessupplier', 0, 3, 357),
(1193, 'delete', 'delete Resource', 0, 2, 356),
(1192, 'edit', 'edit Resource', 0, 3, 356),
(1191, 'add', 'add Resource', 0, 3, 356),
(75, 'delete', 'delete Resource', 0, 2, 26),
(1190, 'index', 'index Resource', 0, 3, 356),
(1189, 'error', 'error Error', 0, 3, 355),
(1185, 'index', 'index Productionssupplier', 0, 3, 353),
(1108, 'index', 'index Company', 0, 6, 336),
(1107, 'error', 'error Error', 0, 6, 335),
(1106, 'index', 'index Index', 0, 6, 334),
(829, 'delete', 'delete Usersclient', 0, 2, 261),
(828, 'edit', 'edit Usersclient', 0, 2, 261),
(826, 'index', 'index Usersclient', 0, 1, 261),
(827, 'add', 'add Usersclient', 0, 2, 261),
(825, 'error', 'error Error', 0, 6, 260),
(824, 'index', 'index Index', 0, 6, 259),
(823, 'inlitter', 'inlitter Client', 0, 3, 258),
(822, 'delete', 'delete Client', 0, 2, 258),
(821, 'edit', 'edit Client', 0, 12, 258),
(818, 'select', 'select Client', 0, 19, 258),
(819, 'consult', 'consult Client', 0, 19, 258),
(820, 'add', 'add Client', 0, 3, 258),
(817, 'index', 'index Client', 0, 19, 258),
(816, 'outlitter', 'outlitter Contact', 0, 3, 257),
(812, 'add', 'add Contact', 0, 12, 257),
(813, 'edit', 'edit Contact', 0, 12, 257),
(814, 'delete', 'delete Contact', 0, 12, 257),
(815, 'inlitter', 'inlitter Contact', 0, 12, 257),
(830, 'inlitter', 'inlitter Usersclient', 0, 1, 261),
(1198, 'edit', 'edit Companiessupplier', 0, 3, 357),
(1188, 'index', 'index Index', 0, 3, 354),
(1187, 'delete', 'delete Productionssupplier', 0, 3, 353),
(1186, 'add', 'add Productionssupplier', 0, 3, 353),
(1184, 'outlitter', 'outlitter Supplier', 0, 3, 352),
(1183, 'inlitter', 'inlitter Supplier', 0, 3, 352),
(1182, 'delete', 'delete Supplier', 0, 2, 352),
(76, 'index', 'index User', 0, 2, 27),
(77, 'add', 'add User', 0, 2, 27),
(78, 'edit', 'edit User', 0, 6, 27),
(79, 'delete', 'delete User', 0, 2, 27),
(667, 'select', 'select User', 0, 6, 27),
(1101, 'inlitter', 'inlitter Contact', 0, 3, 332),
(1181, 'edit', 'edit Supplier', 0, 3, 352),
(1180, 'add', 'add Supplier', 0, 3, 352),
(1179, 'consult', 'consult Supplier', 0, 3, 352),
(1178, 'select', 'select Supplier', 0, 3, 352),
(1177, 'index', 'index Supplier', 0, 3, 352),
(1176, 'outlitter', 'outlitter Contact', 0, 3, 351),
(1175, 'inlitter', 'inlitter Contact', 0, 3, 351),
(1174, 'delete', 'delete Contact', 0, 2, 351),
(1173, 'edit', 'edit Contact', 0, 3, 351),
(1172, 'add', 'add Contact', 0, 3, 351),
(945, 'edit', 'edit Resource', 0, 19, 262),
(946, 'delete', 'delete Resource', 0, 1, 262),
(1100, 'delete', 'delete Contact', 0, 2, 332),
(1099, 'edit', 'edit Contact', 0, 12, 332),
(1098, 'add', 'add Contact', 0, 12, 332),
(1097, 'index', 'index Contact', 0, 6, 332),
(1115, 'inlitter', 'inlitter Company', 0, 3, 336),
(1116, 'outlitter', 'outlitter Company', 0, 3, 336),
(1195, 'outlitter', 'outlitter Resource', 0, 3, 356),
(1194, 'inlitter', 'inlitter Resource', 0, 3, 356),
(1200, 'inlitter', 'inlitter Companiessupplier', 0, 3, 357),
(1201, 'select', 'select Productionssuplier', 0, 19, 353),
(1202, 'consult', 'consult Productionssuplier', 0, 19, 353),
(1203, 'getdata', 'getdata Resource', 0, 19, 262),
(1204, 'getdataresource', 'getdataresource Resource', 0, 19, 262),
(1206, 'index', 'index Productionsuppliers', 0, 1, 358),
(1207, 'delete', 'delete Productionsuppliers', 0, 12, 358),
(1208, 'consult', 'consult Productionsuppliers', 0, 19, 358),
(1209, 'select', 'select Productionsuppliers', 0, 1, 358),
(1210, 'inlitter', 'inlitter Productionsuppliers', 0, 12, 358),
(1211, 'outlitter', 'outlitter Productionsuppliers', 0, 1, 206),
(1212, 'edit', 'edit Productionsuppliers', 0, 12, 358),
(1213, 'editresourcesupplier', 'editresourcesupplier Resource', 0, 19, 262),
(1214, 'addresourcesupplier', 'addresourcesupplier Resource', 0, 19, 262),
(1215, 'add', 'add Contactresource', 0, 19, 359),
(1216, 'edit', 'edit Contactresource', 0, 19, 359),
(1221, 'edit', 'edit Finances', 0, 1, 360),
(1222, 'delete', 'delete Finances', 0, 1, 360),
(1223, 'index', 'index Index', 0, 1, 361),
(1224, 'error', 'error Error', 0, 1, 362),
(1281, 'edit', 'edit Productiontype', 0, 1, 377),
(1265, 'edit', 'edit Companytype', 0, 1, 373),
(1264, 'add', 'add Companytype', 0, 1, 373),
(1263, 'index', 'index Companytype', 0, 1, 373),
(1262, 'index', 'index Index', 0, 1, 372),
(1261, 'inlitter', 'inlitter Resourcetype', 0, 1, 371),
(1260, 'delete', 'delete Resourcetype', 0, 1, 371),
(1259, 'edit', 'edit Resourcetype', 0, 1, 371),
(1258, 'add', 'add Resourcetype', 0, 1, 371),
(1257, 'index', 'index Resourcetype', 0, 1, 371),
(1286, 'edit', 'edit Activitytype', 0, 1, 378),
(1287, 'delete', 'delete Activitytype', 0, 1, 378),
(1288, 'inlitter', 'inlitter Activitytype', 0, 1, 378);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=379 ;

--
-- Volcar la base de datos para la tabla `acl_resources`
--

INSERT INTO `acl_resources` (`id`, `resource`, `name_r`, `module_id`) VALUES
(23, 'user:permission', 'UserPermission', 54),
(24, 'user:index', 'UserIndex', 54),
(25, 'user:error', 'UserError', 54),
(357, 'supplier:companiessupplier', 'SupplierCompaniessupplier', 123),
(11, 'default:index', 'DefaultIndex', 46),
(12, 'default:error', 'DefaultError', 46),
(19, 'controlmodule:controlmodule', 'ControlmoduleControlmodule', 53),
(15, 'login:index', 'LoginIndex', 48),
(16, 'login:error', 'LoginError', 48),
(20, 'controlmodule:index', 'ControlmoduleIndex', 53),
(21, 'controlmodule:error', 'ControlmoduleError', 53),
(26, 'user:resource', 'UserResource', 54),
(358, 'production:productionsuppliers', 'ProductionProductionsuppliers', 97),
(336, 'company:company', 'CompanyCompany', 120),
(334, 'company:index', 'CompanyIndex', 120),
(210, 'production:error', 'ProductionError', 97),
(209, 'production:index', 'ProductionIndex', 97),
(262, 'production:resource', 'ProductionResource', 97),
(361, 'finances:index', 'FinancesIndex', 124),
(360, 'finances:finances', 'FinancesFinances', 124),
(206, 'production:permissionproduction', 'ProductionPermissionproduction', 97),
(335, 'company:error', 'CompanyError', 120),
(207, 'production:activity', 'ProductionActivity', 97),
(208, 'production:production', 'ProductionProduction', 97),
(377, 'managementtype:productiontype', 'ManagementtypeProductiontype', 126),
(376, 'managementtype:facturationtype', 'ManagementtypeFacturationtype', 126),
(375, 'managementtype:managementtype', 'ManagementtypeManagementtype', 126),
(373, 'managementtype:companytype', 'ManagementtypeCompanytype', 126),
(374, 'managementtype:error', 'ManagementtypeError', 126),
(333, 'company:userscompanies', 'CompanyUserscompanies', 120),
(261, 'client:usersclient', 'ClientUsersclient', 108),
(260, 'client:error', 'ClientError', 108),
(259, 'client:index', 'ClientIndex', 108),
(258, 'client:client', 'ClientClient', 108),
(257, 'client:contact', 'ClientContact', 108),
(356, 'supplier:resource', 'SupplierResource', 123),
(353, 'supplier:productionssupplier', 'SupplierProductionssupplier', 123),
(22, 'user:role', 'UserRole', 54),
(27, 'user:user', 'UserUser', 54),
(354, 'supplier:index', 'SupplierIndex', 123),
(355, 'supplier:error', 'SupplierError', 123),
(352, 'supplier:supplier', 'SupplierSupplier', 123),
(351, 'supplier:contact', 'SupplierContact', 123),
(332, 'company:contact', 'CompanyContact', 120),
(359, 'production:contactresource', 'ProductionContactresource', 97),
(362, 'finances:error', 'FinancesError', 124),
(372, 'managementtype:index', 'ManagementtypeIndex', 126),
(371, 'managementtype:resourcetype', 'ManagementtypeResourcetype', 126),
(378, 'managementtype:activitytype', 'ManagementtypeActivitytype', 126);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=54 ;

--
-- Volcar la base de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`id`, `name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`, `role_id`) VALUES
(4, 'Roi Implementador', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-21 18:09:31', 'roigd@gmail.com', '123', '22', '12', '4343434', 1),
(43, 'Pablo pontino', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'pablopontino@secogal.com', '0', '33', '3', '3', 19),
(44, 'celso', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'celso@gmail.com', '0', 'celso@gmail.com', 'celso@gmail.com', 'celso@gmail.com', 12),
(42, 'juan carlos', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'jc@secogal.com', '232', '2', '2', '2', 3),
(46, 'ogando', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'ogi@gmail.com', 'Encargado de personal', '3', 'o', '3', 12),
(47, 'milocho', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'milocho@fankani.com', 'Gerente', 'w', 'w', 'w', 17),
(48, 'Blanco', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'blanco@nalgures.com', 'gerente', 'w', '1', 'w', 3),
(49, 'ReixA', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'reixa@nalgures.com', 'Encargado de produccion', '2', '2', '2', 12),
(50, 'xurxo', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'xurxo@fankany.com', 'Encargado de produccion', '2', '22333', '2', 18),
(51, 'avelino', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2022-11-11 00:00:00', 'avelino@secogal.com', 'Encargado de seguridad', '2', '2', '2', 19),
(52, 'Agustin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2023-11-11 00:00:00', 'agustin@elemental.com', '212', '2', '2', '2', 3),
(53, 'roi Secogal', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'roigrande@secogal.com', '1', 'W', 'W', 'W', 12);

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
(4, 7),
(4, 8),
(4, 9),
(4, 23),
(42, 1),
(42, 6),
(43, 1),
(43, 3),
(43, 5),
(44, 2),
(46, 2),
(47, 3),
(48, 4),
(49, 4),
(50, 3),
(51, 1),
(52, 5),
(53, 1);

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
  `contact_own_company_id` int(11) NOT NULL DEFAULT '0',
  `contact_client_company_id` int(11) NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcar la base de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `name`, `productions_id`, `activity_types_id`, `status_id`, `contact_own_company_id`, `contact_client_company_id`, `date_start`, `date_end`, `observation`, `in_litter`) VALUES
(1, 'Montar escenario Festigal', 1, 26, 26, 7, 5, '0001-00-00 00:00:00', '0000-00-00 00:00:02', '332323', '0'),
(2, 'Seguridad camping', 4, 27, 26, 7, 6, '0001-00-00 00:00:00', '0000-00-00 00:00:02', 'pulseras rojas validan el camping', '0'),
(3, 'Comida artistas', 4, 28, 26, 8, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '23', '0'),
(4, 'Escenario', 2, 26, 26, 10, 11, '2012-05-11 07:00:00', '2012-05-11 12:00:00', 'ramon litoria', '0'),
(5, 'iluminacion', 2, 26, 26, 10, 11, '2012-05-11 12:00:00', '2012-05-11 15:00:00', 'sonorde', '0'),
(6, 'Montaje Extructura', 2, 26, 27, 10, 6, '2012-05-11 07:00:00', '2012-05-11 21:00:00', 'vallado escenario, vallado camerinos, vallado barras', '0'),
(7, 'Acreditar', 2, 1, 27, 7, 11, '2012-05-11 08:00:00', '2012-05-12 02:00:00', 'acreditar', '0'),
(8, 'reunion presupuesto', 14, 1, 26, 4, 0, '0001-00-00 00:00:00', '0000-00-00 00:00:02', 'd', '0'),
(9, 'wwww', 14, 26, 26, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', '0'),
(10, '4444º', 14, 26, 26, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', '0'),
(11, 'Camareros', 2, 26, 29, 13, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '333', '0'),
(12, 'bajo', 12, 27, 28, 2, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '454', '0'),
(13, 'rerwerew', 2, 28, 28, 13, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', '0'),
(14, '42323', 3, 26, 26, 15, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_types`
--

CREATE TABLE IF NOT EXISTS `activity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

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
(1, 'generica'),
(33, 'alquiler materal construccion'),
(34, 'venta de material de construccion');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcar la base de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `fiscal_name`, `company_types_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`, `in_litter`) VALUES
(12, 'last', 'last', 26, 'last@last.com', 'last', 'last', 'last', 'last', 'last', 'last', 'last', '0'),
(2, 'make ilusion', 'make ilusion', 26, 'makeilusion@make ilusion.com', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', '0'),
(3, 'Fankany', 'Funkany SA', 32, 'funkuny@gmail.com', 'w', '32002', 'Allariz', 'España', '1223', '33333', '323', '0'),
(4, 'Nalgures', 'nalgures sa', 26, 'nalgures@nalgures.com', '2', '2', '2', '2', '22', '2', '2', '0'),
(5, 'Elemental', 'Elemental S.A.', 31, 'Elemental@Elemental.com', 'O', '32333', 'Cali', 'Colonia', '3232323', '23', '32323232', '0'),
(19, 'aqui', 'rere1', 29, 'w@2.com', 'w', 'w', 'w', 'w', 'e', 'w', 'ewqeqw', '0'),
(17, 'mmmmmmmmmmmmmmmmmm', 'z', 29, '', '', '', '', '', '', '', '', '0'),
(18, 'dfsdsfsdfsd', '', 29, '', '', '', '', '', '', '', '', '0'),
(16, 'zzzzzzzzzzzzz', '', 29, '', '', '', '', '', '', '', '', '0'),
(15, 'fefefef', '', 29, '', '', '', '', '', '', '', '', '0'),
(20, 'sdsadsads', 'dsadsadsa', 29, '', '', '', '', '', 'dasdsa', '', '', '0'),
(21, 'eqwewq', 'w', 29, 'wwww@2.com', 'w', 'w', 'w', 'w', 'w', 'ww', 'ww', '0'),
(22, 'cine barcelona', 'cine barcelona S.A.', 26, '', '', '', '', '', '', '', '', '0'),
(23, 'Ayutamiento ortigueira', 'w', 29, 'wroigd@gmail.com', 'wewd', 'w', 'w', 'w', '222', '222', 'ww', '0'),
(24, 'bonberos', 'bonberos sa', 28, 'w@2.com', 'eeee', 'efdsfsdf', 'eeee', 'efsdfsdfsd', 'w33', 'w3º3º3º', 'efsdfsd', '0'),
(25, 'basureros', 'w', 29, 'w@2.com', 'w', 'w', 'ww', 'w', 'w', 'w', 'werwr', '0'),
(26, '334343', '4', 29, 'erwefdf@fdfd.es', '4', 'w', 'w', 'w', '4', '4', 'w', '0'),
(27, 'sdsadad', 'w', 29, 'wroigd@gmail.com', 'w', 'w', 'ww', 'w', 'w', 'w', 'w', '0'),
(28, 'Lito electricista', 'Lito electricista S.A.', 31, 'lito@electricista.com', '3', '3', '3', '3', '3', '3', '3', '0'),
(29, 'de todo', 'www', 29, 'ssw@ss2.com', 'w', 'w', 'w', 'ww', 'w', 'w', 'hola gola', '0'),
(30, 'cacac', 'cacac', 29, 'ssw@ss2.com', 'w', 'w', 'w', 'w', 'w', 'w', 'wdsdsddsaaaaaaaaaaaaa', '0'),
(31, 'repartidores colombia', 'asaaedweqwe', 31, 'ssw@ss2.com', 's', 's', 's', 's', 'sass', 's', 's333', '0'),
(32, 'wwwwwww', 'w', 29, 'www@2.com', 'w', 'w', 'w', 'w', 'w', 'w', 'w', '0'),
(33, 'last', 'last', 29, 'last@last.com', 'last', 'last', 'last', 'last', 'last', 'last', 'last', '0'),
(34, 'ggegege', 'fdfdsf', 29, 'sadasd@fd.ee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', '0'),
(1, 'Secogal', 'Secogal SA', 31, 'Secogal@Secogal.com', 'Secogal', 'Secogal', 'Secogal', 'Secogal', 'Secogal', 'Secogal', 'Secogal', '0'),
(35, 'w', 'e', 29, 'aaae@fs.es', 'w', 'w', 'w', 'w', 'w', 'w', 'w', '0'),
(36, 'Agustin Calderon', 'ws', 28, 'ssw@ss2.com', 'escolapiosffassss', 'e', 'e', 'e', 's', 'e', '', '0'),
(37, 'Catering Ourense', 'Catering Ourense S.A.', 29, 'Cateringourense@secogal.com', 'Ourense', '32002a', 'Ourense', 'Spain', '212', '222', 'catering para backstagez', '0'),
(38, 'Catering Ourense', 'Catering Ourense S.A.', 29, 'Cateringourense@secogal.com', 'Ourense', '32002a', 'Ourense', 'Spain', '212', '222', 'catering para backstagez', '0'),
(39, 'Mulas', 'Mulas S.a', 27, 'Mulas@mulas.com', '3', '33', '3', '3', '343', '3', '3', '0'),
(40, 'limpiadores coruña', 'limpiadores coruña', 32, 'limpiadorescorunha@limpieza.com', '3', '3', '3', '3', '3', '3', 'limpiadores coruña', '0'),
(41, 'adios', 'adios', 29, 'adios@adios.com', '2', '2', '2', '2', 'adios', '222', 'adios', '0'),
(42, 'Transporte VipA', 'trasnporte vip S.A.', 31, 'vip@tranporte.com', 'w', 'w', 'w', 'w', 'xx3434555555dss', 'ww', 'trasnporte vipa', '0');

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

INSERT INTO `companies_has_suppliers` (`companies_id`, `suppliers_id`) VALUES
(1, 0),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_types`
--

CREATE TABLE IF NOT EXISTS `company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `company_types`
--

INSERT INTO `company_types` (`id`, `name`) VALUES
(26, 'Producciones Audiovisuales'),
(27, 'Conciertos y festivales'),
(28, 'Seguridad'),
(29, 'Catering'),
(30, 'Teatro'),
(31, 'Consultora informatica'),
(32, 'mudanzas');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `acl_users_id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`, `in_litter`) VALUES
(15, 42, 'juan carlos', '22d', 'jc@secogal.com', '0', '232', 1, '0'),
(2, 44, 'celso', 'weqwe', 'celso@gmail.com', '0', 'celso@gmail.com', 1, '0'),
(4, 46, 'ogando', '', 'ogi@gmail.com', '0', 'Encargado de personal', 2, '0'),
(5, 49, 'ReixA', '', 'reixa@nalgures.com', '0', 'Encargado de produccion', 4, '0'),
(6, 50, 'xurxo', 'dsdd', 'xurxo@fankany.com', '0', 'Encargado de produccion', 3, '0'),
(7, 51, 'avelino', '', 'avelino@secogal.com', '0', 'Encargado de seguridad', 1, '0'),
(8, 0, 'Elvira', '3333', 'elvira@secogal.com', '2323232', 'ayudante de gerencia', 1, '0'),
(9, 52, 'Agustin', '', 'agustin@elemental.com', '0', '212', 5, '0'),
(10, 53, 'roi Secogal', '', 'roigrande@secogal.com', '0', '1', 1, '0'),
(11, 0, 'Mil ocho', '3', '1008@festicultores.com', '232', '3', 3, '0'),
(17, 0, 'rre', 'w', 'w@2.com', 'ww', 'w', 0, '0'),
(13, 43, 'Pablo', 'rdrfdsfsdfdsf', 'pablopontino@secogal.com', '534544554', 'ewe', 1, '0'),
(20, 43, 'Pablo pontino', '', 'pablopontino@secogal.com', '0', '0', 3, '0'),
(26, 0, 'gfgfd', 'w', 'wroigd@gmail.com', 'w', 'w', 1, '0'),
(0, 0, 'Desconocido', '', '0', '0', NULL, 0, '0'),
(27, 0, 'Pedro', 'dss3', 'pedro@secogal.com', '23232323', '3dsad', 23, '0'),
(28, 0, 'bonbero torero', '3', 'bonberotorero@bonbero.com', '232323', 'jefe de bonberos toreros', 24, '0'),
(29, 0, 'vaquilla torero', '23', 'vaquilla@gmail.com', '23', '2', 24, '0'),
(30, 0, 'Lito electricista', 'e', '3w@2.com', 'e', 'e', 28, '0'),
(31, 0, 'dfsfds', 'd', 'd@fdf.com', 'd', 'd', 35, '0'),
(32, 0, 'de', 'w', 'q@d.cd', 'w3', 'w', 19, '0'),
(33, 0, 'pedro basurero', '2', 'basurero@basurero.com', '321212', '2', 25, '0'),
(34, 0, '43242', 'e', '432@ses.es', 'e', 'e', 23, '0'),
(35, 0, 'quiosquero ortigueira', '', '', '', '', 23, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturation_types`
--

CREATE TABLE IF NOT EXISTS `facturation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=36 ;

--
-- Volcar la base de datos para la tabla `facturation_types`
--

INSERT INTO `facturation_types` (`id`, `name`) VALUES
(32, 'Horas'),
(33, 'Jornada'),
(34, 'Media Jornada'),
(35, 'Produccion');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=80 ;

--
-- Volcar la base de datos para la tabla `permission_production`
--

INSERT INTO `permission_production` (`id`, `acl_users_id`, `productions_id`, `acl_roles_id`) VALUES
(65, 4, 4, 1),
(62, 50, 4, 18),
(55, 4, 1, 1),
(57, 4, 2, 1),
(67, 4, 6, 19),
(66, 52, 6, 3),
(60, 47, 4, 17),
(63, 4, 5, 1),
(59, 42, 4, 3),
(64, 51, 1, 12),
(50, 4, 3, 12),
(58, 42, 1, 3),
(61, 47, 2, 18),
(68, 42, 2, 3),
(69, 53, 2, 12),
(70, 43, 2, 19),
(71, 4, 7, 1),
(72, 4, 8, 1),
(73, 4, 9, 1),
(74, 4, 10, 1),
(75, 4, 11, 1),
(76, 4, 12, 1),
(77, 4, 13, 1),
(78, 4, 14, 1),
(79, 42, 3, 3);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcar la base de datos para la tabla `productions`
--

INSERT INTO `productions` (`id`, `name`, `production_types_id`, `client_companies_id`, `status_id`, `direction`, `date_start`, `date_end`, `observation`, `budget`, `in_litter`) VALUES
(1, 'Festigal', 27, 4, 25, 'santiago', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', 3, '0'),
(2, 'Resentidos 2012', 27, 3, 25, '2', '2012-05-11 07:00:00', '2012-05-12 06:00:00', '2', 2, '0'),
(3, 'Fiestas de pontevedra', 27, 4, 25, 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'w', 0, '0'),
(4, 'Reperkusion 2012', 28, 3, 25, 'benposta', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', 0, '0'),
(5, 'Reperkusion 2011', 28, 3, 25, 'wa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a', 0, '0'),
(6, 'reparacion oficina', 27, 1, 25, 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ww', 0, '0'),
(14, 'Alberto Ortigueira', 31, 22, 25, 'barcelona', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e333', 0, '0'),
(13, 'r', 30, 19, 25, 'e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', 0, '0'),
(12, 'Diseño Orquestor', 30, 5, 25, 'e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'werwr', 0, '0');

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

INSERT INTO `productions_has_suppliers` (`productions_id`, `suppliers_id`) VALUES
(1, 4),
(1, 6),
(1, 7),
(1, 20),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(3, 5),
(4, 6),
(4, 7),
(12, 4),
(12, 6),
(12, 16),
(12, 17),
(12, 18),
(12, 19);

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
  `description` varchar(2500) DEFAULT NULL,
  `direction` varchar(500) DEFAULT NULL,
  `num_resources` int(11) DEFAULT NULL,
  `num_resources_used` varchar(45) DEFAULT NULL,
  `in_litter` binary(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_resource_resources_types1` (`resources_types_id`),
  KEY `fk_resource_companies1` (`companies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Volcar la base de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `resources_types_id`, `companies_id`, `name`, `description`, `direction`, `num_resources`, `num_resources_used`, `in_litter`) VALUES
(24, 1, 1, 'pedro', '2', 'Santiago', 2, NULL, '0'),
(25, 2, 1, 'coche jc', 'mercedes de 2010', 'Ourense', 1, NULL, '0'),
(26, 3, 23, 'Alberto Ortigueira', 'Empresa de auxiliares de eventosa', 'ourense', 9, NULL, '0'),
(27, 1, 24, 'name erw', 'erw', 'erw', 0, NULL, '0'),
(34, 3, 23, 'bar ortigueira', 'bar /camerino', '121', 1, NULL, '0'),
(29, 1, 25, 'roi basurero', 'bas', '', 3, NULL, '0'),
(30, 2, 25, 'camion basura', '', '', 2, NULL, '0'),
(31, 0, 0, '22', NULL, NULL, NULL, NULL, '0'),
(32, 0, 0, '33', NULL, NULL, NULL, NULL, '0'),
(33, 3, 24, 'wkjhfdsfkjsh', 'fdksjhfds', 'fkjedhsjkh', 0, NULL, '0'),
(37, 2, 28, '3', '3', '3', 3, NULL, '0'),
(36, 3, 35, 'w', 'w', 'w', 0, NULL, '0'),
(38, 1, 23, 'rewrwer', 'w', 'ww', 0, NULL, '0'),
(39, 2, 23, 'w', 'w', 'w', 0, NULL, '0'),
(40, 2, 23, 'w', '', '', 0, NULL, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources_activities`
--

CREATE TABLE IF NOT EXISTS `resources_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resource_id` int(11) NOT NULL DEFAULT '0',
  `activities_id` int(11) NOT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `unbilled_hours` int(11) NOT NULL DEFAULT '0',
  `contacts_id` int(11) NOT NULL,
  `facturation_types_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resources_types_copy1_resource1` (`resource_id`),
  KEY `fk_resources_types_copy1_activities1` (`activities_id`),
  KEY `fk_resources_activities_contacts1` (`contacts_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Volcar la base de datos para la tabla `resources_activities`
--

INSERT INTO `resources_activities` (`id`, `name`, `resource_id`, `activities_id`, `observation`, `unbilled_hours`, `contacts_id`, `facturation_types_id`, `price`) VALUES
(26, 'amigos pedro', 24, 11, '22333', 3, 2, 0, 0),
(28, 'coche basurero2', 25, 11, 'ewew', 1, 2, 0, 0),
(35, 'ww', 24, 1, '2w2', 2, 15, 35, 22),
(30, 'ewe', 24, 11, '2', 2, 15, 0, 0),
(31, 'Bonbero Ortigueira', 33, 13, '222', 2, 29, 0, 0),
(32, '333', 0, 13, '333', 333, 30, 0, 0),
(33, '333', 0, 13, '3', 3, 30, 0, 0),
(34, 'redrfsdkj', 24, 1, '332323', 22, 15, 35, 60),
(36, 'w', 24, 1, 'w', 0, 15, 34, 22),
(37, 'e', 0, 0, NULL, 0, 0, 0, 0),
(38, 'gfsdgdfaaa', 0, 0, NULL, 0, 0, 0, 0),
(39, 'Manuel', 25, 1, '2', 2, 7, 32, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource_types`
--

CREATE TABLE IF NOT EXISTS `resource_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `resource_types`
--

INSERT INTO `resource_types` (`id`, `name`) VALUES
(1, 'Personal'),
(2, 'Vehiculos'),
(3, 'Infraestructura');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `companies_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_providers_companies1` (`companies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `description`, `companies_id`) VALUES
(3, 'ww', 1),
(4, 'ww', 23),
(5, 'w', 24),
(6, 'werwr', 25),
(7, '3', 28),
(8, 'hola gola', 29),
(9, 'wdsdsddsaaaaaaaaaaaaa', 30),
(10, 's', 31),
(11, 'w', 32),
(12, 'last', 33),
(13, 'd', 34),
(14, 'w', 35),
(15, 'catering para backstagez', 37),
(16, 'catering para backstagez', 38),
(17, '3', 39),
(18, 'limpiadores coruña', 40),
(19, 'adios', 41),
(20, 'trasnporte vip', 42);

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

INSERT INTO `suppliers_has_activity_types` (`suppliers_id`, `activity_types_id`) VALUES
(31, 1),
(8, 26),
(10, 26),
(11, 26),
(12, 26),
(14, 26),
(17, 26),
(19, 26),
(20, 26),
(32, 26),
(3, 27),
(4, 27),
(7, 27),
(8, 27),
(11, 27),
(12, 27),
(13, 27),
(14, 27),
(17, 27),
(19, 27),
(30, 27),
(3, 28),
(4, 28),
(6, 28),
(10, 28),
(12, 28),
(13, 28),
(14, 28),
(20, 28),
(30, 28),
(32, 28),
(3, 29),
(4, 29),
(6, 29),
(7, 29),
(11, 29),
(12, 29),
(13, 29),
(19, 29),
(31, 29),
(6, 31),
(10, 31),
(11, 31),
(12, 31),
(14, 31),
(18, 31),
(32, 31),
(18, 32),
(31, 33);
