-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-01-2013 a las 18:59:03
-- Versión del servidor: 5.1.62
-- Versión de PHP: 5.3.14

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=128 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `name`, `active`) VALUES
(44, 'activity', 1),
(46, 'default', 1),
(48, 'login', 1),
(53, 'controlmodule', 1),
(54, 'user', 1),
(55, 'casas', 1),
(57, 'modeloejemplo', 1),
(97, 'production', 1),
(100, 'suplier', 1),
(108, 'client', 1),
(120, 'company', 1),
(123, 'supplier', 1),
(126, 'managementtype', 1),
(127, 'finances', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1313 ;

--
-- Volcar la base de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `permission`, `name`, `menu`, `role_id`, `resource_id`) VALUES
(28, 'index', 'index Index', 0, 1, 11),
(29, 'changelanguage', 'changelanguage Index', 0, 1, 11),
(30, 'error', 'error Error', 0, 1, 12),
(40, 'index', 'index Index', 0, 6, 15),
(41, 'logout', 'logout Index', 0, 6, 15),
(42, 'error', 'error Error', 0, 6, 16),
(43, 'denied', 'denied Error', 0, 6, 16),
(44, 'unactive', 'unactive Error', 0, 6, 16),
(45, 'uninstall', 'uninstall Error', 0, 6, 16),
(46, 'notfound', 'notfound Error', 0, 6, 16),
(52, 'index', 'index Controlmodule', 0, 2, 19),
(53, 'add', 'add Controlmodule', 0, 2, 19),
(54, 'edit', 'edit Controlmodule', 0, 2, 19),
(55, 'delete', 'delete Controlmodule', 0, 2, 19),
(56, 'install', 'install Controlmodule', 0, 2, 19),
(57, 'uninstall', 'uninstall Controlmodule', 0, 2, 19),
(58, 'backup', 'backup Controlmodule', 0, 2, 19),
(59, 'activate', 'activate Controlmodule', 0, 2, 19),
(60, 'deactivate', 'deactivate Controlmodule', 0, 2, 19),
(61, 'index', 'index Index', 0, 2, 20),
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
(72, 'index', 'index Resource', 0, 2, 26),
(73, 'add', 'add Resource', 2, 2, 26),
(74, 'edit', 'edit Resource', 0, 2, 26),
(75, 'delete', 'delete Resource', 0, 2, 26),
(76, 'index', 'index User', 0, 2, 27),
(77, 'add', 'add User', 0, 2, 27),
(78, 'edit', 'edit User', 0, 6, 27),
(79, 'delete', 'delete User', 0, 2, 27),
(625, 'index', 'index Permissionproduction', 0, 12, 206),
(626, 'add', 'add Permissionproduction', 0, 12, 206),
(627, 'edit', 'edit Permissionproduction', 0, 12, 206),
(628, 'delete', 'delete Permissionproduction', 0, 12, 206),
(629, 'inlitter', 'inlitter Permissionproduction', 0, 12, 206),
(630, 'index', 'index Activity', 0, 19, 207),
(631, 'add', 'add Activity', 0, 12, 207),
(632, 'edit', 'edit Activity', 0, 19, 207),
(633, 'delete', 'delete Activity', 0, 12, 207),
(634, 'inlitter', 'inlitter Activity', 0, 19, 207),
(635, 'index', 'index Production', 0, 6, 208),
(636, 'select', 'select Production', 0, 6, 208),
(637, 'consult', 'consult Production', 0, 6, 208),
(638, 'add', 'add Production', 0, 3, 208),
(639, 'edit', 'edit Production', 0, 12, 208),
(640, 'delete', 'delete Production', 0, 3, 208),
(641, 'inlitter', 'inlitter Production', 0, 3, 208),
(642, 'index', 'index Index', 0, 6, 209),
(643, 'error', 'error Error', 0, 6, 210),
(663, 'consult', 'consult Activity', 0, 6, 207),
(664, 'select', 'select Activity', 0, 6, 207),
(665, 'permission', 'permission Activity', 0, 12, 207),
(667, 'select', 'select User', 0, 6, 27),
(668, 'select', 'select Controlmodule', 0, 6, 19),
(812, 'add', 'add Contact', 0, 12, 257),
(813, 'edit', 'edit Contact', 0, 12, 257),
(814, 'delete', 'delete Contact', 0, 12, 257),
(815, 'inlitter', 'inlitter Contact', 0, 12, 257),
(816, 'outlitter', 'outlitter Contact', 0, 3, 257),
(817, 'index', 'index Client', 0, 19, 258),
(818, 'select', 'select Client', 0, 19, 258),
(819, 'consult', 'consult Client', 0, 19, 258),
(820, 'add', 'add Client', 0, 3, 258),
(821, 'edit', 'edit Client', 0, 12, 258),
(822, 'delete', 'delete Client', 0, 2, 258),
(823, 'inlitter', 'inlitter Client', 0, 3, 258),
(824, 'index', 'index Index', 0, 6, 259),
(825, 'error', 'error Error', 0, 6, 260),
(826, 'index', 'index Usersclient', 0, 1, 261),
(827, 'add', 'add Usersclient', 0, 2, 261),
(828, 'edit', 'edit Usersclient', 0, 2, 261),
(829, 'delete', 'delete Usersclient', 0, 2, 261),
(830, 'inlitter', 'inlitter Usersclient', 0, 1, 261),
(831, 'add', 'add Resource', 0, 19, 262),
(945, 'edit', 'edit Resource', 0, 19, 262),
(946, 'delete', 'delete Resource', 0, 1, 262),
(1097, 'index', 'index Contact', 0, 6, 332),
(1098, 'add', 'add Contact', 0, 12, 332),
(1099, 'edit', 'edit Contact', 0, 12, 332),
(1100, 'delete', 'delete Contact', 0, 2, 332),
(1101, 'inlitter', 'inlitter Contact', 0, 3, 332),
(1102, 'index', 'index Userscompanies', 0, 1, 333),
(1103, 'add', 'add Userscompanies', 0, 1, 333),
(1104, 'delete', 'delete Userscompanies', 0, 1, 333),
(1105, 'inlitter', 'inlitter Userscompanies', 0, 1, 333),
(1106, 'index', 'index Index', 0, 6, 334),
(1107, 'error', 'error Error', 0, 6, 335),
(1108, 'index', 'index Company', 0, 6, 336),
(1109, 'select', 'select Company', 0, 6, 336),
(1110, 'consult', 'consult Company', 0, 6, 336),
(1111, 'add', 'add Company', 0, 2, 336),
(1112, 'edit', 'edit Company', 0, 3, 336),
(1114, 'delete', 'delete Company', 0, 2, 336),
(1115, 'inlitter', 'inlitter Company', 0, 3, 336),
(1116, 'outlitter', 'outlitter Company', 0, 3, 336),
(1172, 'add', 'add Contact', 0, 3, 351),
(1173, 'edit', 'edit Contact', 0, 3, 351),
(1174, 'delete', 'delete Contact', 0, 2, 351),
(1175, 'inlitter', 'inlitter Contact', 0, 3, 351),
(1176, 'outlitter', 'outlitter Contact', 0, 3, 351),
(1177, 'index', 'index Supplier', 0, 3, 352),
(1178, 'select', 'select Supplier', 0, 3, 352),
(1179, 'consult', 'consult Supplier', 0, 3, 352),
(1180, 'add', 'add Supplier', 0, 3, 352),
(1181, 'edit', 'edit Supplier', 0, 3, 352),
(1182, 'delete', 'delete Supplier', 0, 2, 352),
(1183, 'inlitter', 'inlitter Supplier', 0, 3, 352),
(1184, 'outlitter', 'outlitter Supplier', 0, 3, 352),
(1185, 'index', 'index Productionssupplier', 0, 3, 353),
(1186, 'add', 'add Productionssupplier', 0, 3, 353),
(1187, 'delete', 'delete Productionssupplier', 0, 3, 353),
(1188, 'index', 'index Index', 0, 3, 354),
(1189, 'error', 'error Error', 0, 3, 355),
(1190, 'index', 'index Resource', 0, 3, 356),
(1191, 'add', 'add Resource', 0, 3, 356),
(1192, 'edit', 'edit Resource', 0, 3, 356),
(1193, 'delete', 'delete Resource', 0, 2, 356),
(1194, 'inlitter', 'inlitter Resource', 0, 3, 356),
(1195, 'outlitter', 'outlitter Resource', 0, 3, 356),
(1196, 'index', 'index Companiessupplier', 0, 3, 357),
(1197, 'add', 'add Companiessupplier', 0, 3, 357),
(1198, 'edit', 'edit Companiessupplier', 0, 3, 357),
(1199, 'delete', 'delete Companiessupplier', 0, 3, 357),
(1200, 'inlitter', 'inlitter Companiessupplier', 0, 3, 357),
(1201, 'select', 'select Productionssuplier', 0, 19, 353),
(1202, 'consult', 'consult Productionssuplier', 0, 19, 353),
(1203, 'getdata', 'getdata Resource', 0, 19, 262),
(1204, 'getdataresource', 'getdataresource Resource', 0, 19, 262),
(1205, 'add', 'add Productionsuppliers', 0, 1, 358),
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
(1257, 'index', 'index Resourcetype', 0, 1, 371),
(1258, 'add', 'add Resourcetype', 0, 1, 371),
(1259, 'edit', 'edit Resourcetype', 0, 1, 371),
(1260, 'delete', 'delete Resourcetype', 0, 1, 371),
(1261, 'inlitter', 'inlitter Resourcetype', 0, 1, 371),
(1262, 'index', 'index Index', 0, 1, 372),
(1263, 'index', 'index Companytype', 0, 1, 373),
(1264, 'add', 'add Companytype', 0, 1, 373),
(1265, 'edit', 'edit Companytype', 0, 1, 373),
(1266, 'delete', 'delete Companytype', 0, 1, 373),
(1267, 'inlitter', 'inlitter Companytype', 0, 1, 373),
(1268, 'error', 'error Error', 0, 1, 374),
(1269, 'index', 'index Managementtype', 0, 1, 375),
(1270, 'select', 'select Managementtype', 0, 1, 375),
(1271, 'add', 'add Managementtype', 0, 1, 375),
(1272, 'edit', 'edit Managementtype', 0, 1, 375),
(1273, 'delete', 'delete Managementtype', 0, 1, 375),
(1274, 'index', 'index Facturationtype', 0, 1, 376),
(1275, 'add', 'add Facturationtype', 0, 1, 376),
(1276, 'edit', 'edit Facturationtype', 0, 1, 376),
(1277, 'delete', 'delete Facturationtype', 0, 1, 376),
(1278, 'inlitter', 'inlitter Facturationtype', 0, 1, 376),
(1279, 'index', 'index Productiontype', 0, 1, 377),
(1280, 'add', 'add Productiontype', 0, 1, 377),
(1281, 'edit', 'edit Productiontype', 0, 1, 377),
(1282, 'delete', 'delete Productiontype', 0, 1, 377),
(1283, 'inlitter', 'inlitter Productiontype', 0, 1, 377),
(1284, 'index', 'index Activitytype', 0, 1, 378),
(1285, 'add', 'add Activitytype', 0, 1, 378),
(1286, 'edit', 'edit Activitytype', 0, 1, 378),
(1287, 'delete', 'delete Activitytype', 0, 1, 378),
(1288, 'inlitter', 'inlitter Activitytype', 0, 1, 378),
(1289, 'index', 'index Finances', 0, 1, 379),
(1290, 'select', 'select Finances', 0, 1, 379),
(1291, 'consult', 'consult Finances', 0, 1, 379),
(1292, 'addreceipt', 'addreceipt Finances', 0, 1, 379),
(1293, 'addFacturationAjax', 'addFacturationAjax Finances', 0, 1, 379),
(1294, 'add', 'add Finances', 0, 1, 379),
(1295, 'edit', 'edit Finances', 0, 1, 379),
(1296, 'delete', 'delete Finances', 0, 1, 379),
(1297, 'index', 'index Receipts', 0, 1, 380),
(1298, 'add', 'add Receipts', 0, 1, 380),
(1299, 'edit', 'edit Receipts', 0, 1, 380),
(1300, 'delete', 'delete Receipts', 0, 1, 380),
(1301, 'inlitter', 'inlitter Receipts', 0, 1, 380),
(1302, 'index', 'index Index', 0, 1, 381),
(1303, 'error', 'error Error', 0, 1, 382),
(1304, 'index', 'index Resource_activity_has_receipt', 0, 1, 383),
(1305, 'add', 'add Resource_activity_has_receipt', 0, 1, 383),
(1306, 'edit', 'edit Resource_activity_has_receipt', 0, 1, 383),
(1307, 'delete', 'delete Resource_activity_has_receipt', 0, 1, 383),
(1308, 'inlitter', 'inlitter Resource_activity_has_receipt', 0, 1, 383),
(1309, 'deletereceipt ', 'deletereceipt Finances', 0, 1, 379),
(1310, 'add', 'add Invoices', 0, 1, 384),
(1311, 'index', 'index   Invoices', 0, 1, 384),
(1312, 'consult', 'consult Invoices', 0, 1, 384);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=385 ;

--
-- Volcar la base de datos para la tabla `acl_resources`
--

INSERT INTO `acl_resources` (`id`, `resource`, `name_r`, `module_id`) VALUES
(11, 'default:index', 'DefaultIndex', 46),
(12, 'default:error', 'DefaultError', 46),
(15, 'login:index', 'LoginIndex', 48),
(16, 'login:error', 'LoginError', 48),
(19, 'controlmodule:controlmodule', 'ControlmoduleControlmodule', 53),
(20, 'controlmodule:index', 'ControlmoduleIndex', 53),
(21, 'controlmodule:error', 'ControlmoduleError', 53),
(22, 'user:role', 'UserRole', 54),
(23, 'user:permission', 'UserPermission', 54),
(24, 'user:index', 'UserIndex', 54),
(25, 'user:error', 'UserError', 54),
(26, 'user:resource', 'UserResource', 54),
(27, 'user:user', 'UserUser', 54),
(206, 'production:permissionproduction', 'ProductionPermissionproduction', 97),
(207, 'production:activity', 'ProductionActivity', 97),
(208, 'production:production', 'ProductionProduction', 97),
(209, 'production:index', 'ProductionIndex', 97),
(210, 'production:error', 'ProductionError', 97),
(257, 'client:contact', 'ClientContact', 108),
(258, 'client:client', 'ClientClient', 108),
(259, 'client:index', 'ClientIndex', 108),
(260, 'client:error', 'ClientError', 108),
(261, 'client:usersclient', 'ClientUsersclient', 108),
(262, 'production:resource', 'ProductionResource', 97),
(332, 'company:contact', 'CompanyContact', 120),
(333, 'company:userscompanies', 'CompanyUserscompanies', 120),
(334, 'company:index', 'CompanyIndex', 120),
(335, 'company:error', 'CompanyError', 120),
(336, 'company:company', 'CompanyCompany', 120),
(351, 'supplier:contact', 'SupplierContact', 123),
(352, 'supplier:supplier', 'SupplierSupplier', 123),
(353, 'supplier:productionssupplier', 'SupplierProductionssupplier', 123),
(354, 'supplier:index', 'SupplierIndex', 123),
(355, 'supplier:error', 'SupplierError', 123),
(356, 'supplier:resource', 'SupplierResource', 123),
(357, 'supplier:companiessupplier', 'SupplierCompaniessupplier', 123),
(358, 'production:productionsuppliers', 'ProductionProductionsuppliers', 97),
(359, 'production:contactresource', 'ProductionContactresource', 97),
(371, 'managementtype:resourcetype', 'ManagementtypeResourcetype', 126),
(372, 'managementtype:index', 'ManagementtypeIndex', 126),
(373, 'managementtype:companytype', 'ManagementtypeCompanytype', 126),
(374, 'managementtype:error', 'ManagementtypeError', 126),
(375, 'managementtype:managementtype', 'ManagementtypeManagementtype', 126),
(376, 'managementtype:facturationtype', 'ManagementtypeFacturationtype', 126),
(377, 'managementtype:productiontype', 'ManagementtypeProductiontype', 126),
(378, 'managementtype:activitytype', 'ManagementtypeActivitytype', 126),
(379, 'finances:finances', 'FinancesFinances', 127),
(380, 'finances:receipts', 'FinancesReceipts', 127),
(381, 'finances:index', 'FinancesIndex', 127),
(382, 'finances:error', 'FinancesError', 127),
(383, 'finances:resource_activity_has_receipt', 'FinancesResource_activity_has_receipt', 127),
(384, 'finances:invoices', 'FinancesInvoices  invoices', 127);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `acl_roles`
--

INSERT INTO `acl_roles` (`id`, `name`, `role_parent`, `prefered_uri`) VALUES
(1, 'implementor', '2', 'index'),
(2, 'Admintrator', '3', 'index'),
(3, 'Gerente', '17,12', 'index'),
(6, 'public', '', 'index'),
(12, 'Encargado Producion', '19', 'index'),
(17, 'Administrador financiero cliente', '18', 'index'),
(18, 'Encargado cliente', '6', 'index'),
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
  `status` varchar(50) NOT NULL DEFAULT '0',
  `person_id` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `validation_code` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `phone` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_users_acl_roles1` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Volcar la base de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`id`, `name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`, `role_id`) VALUES
(4, 'Roi Implementador', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2011-09-21 18:09:31', 'roigd@gmail.com', '123', '22', '12', '4343434', 1),
(42, 'juan carlos', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'jc@secogal.com', '232', '2', '2', '2', 3),
(43, 'Pablo pontino', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2015-04-12 00:00:00', 'pablopontino@secogal.com', '0', '33', '3', '3', 19),
(44, 'celso', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0000-00-00 00:00:00', 'celso@gmail.com', '0', 'celso@gmail.com', 'celso@gmail.com', 'celso@gmail.com', 12),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcar la base de datos para la tabla `acl_users_has_companies`
--

INSERT INTO `acl_users_has_companies` (`acl_users_id`, `companies_id`) VALUES
(4, 1),
(42, 1),
(43, 1),
(51, 1),
(53, 1),
(4, 2),
(44, 2),
(46, 2),
(4, 3),
(43, 3),
(47, 3),
(50, 3),
(4, 4),
(48, 4),
(49, 4),
(4, 5),
(43, 5),
(52, 5),
(42, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 23);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
(14, '42323', 3, 26, 26, 15, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '0'),
(15, 'cambio2', 15, 27, 28, 7, 37, '2011-01-01 00:00:00', '2011-01-01 05:00:00', 'concierto de grandes musicos', '0'),
(16, '3232', 15, 29, 26, 15, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_types`
--

CREATE TABLE IF NOT EXISTS `activity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Volcar la base de datos para la tabla `activity_types`
--

INSERT INTO `activity_types` (`id`, `name`) VALUES
(33, 'alquiler materal construccion'),
(26, 'Carga y Descargas'),
(28, 'Catering'),
(1, 'generica'),
(31, 'Limpieza'),
(32, 'Plan de seguridad'),
(29, 'Running'),
(27, 'Seguridad'),
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
  `cif` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_company_acl_type_company1` (`company_types_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Volcar la base de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `fiscal_name`, `company_types_id`, `email`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `observation`, `in_litter`, `cif`) VALUES
(12, 'last', 'last', 26, 'last@last.com', 'last', 'last', 'last', 'last', 'last', 'last', 'last', '0', ''),
(2, 'make ilusion', 'make ilusion', 26, 'makeilusion@make ilusion.com', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', 'make ilusion', '0', ''),
(3, 'Fankany', 'Funkany SA', 32, 'funkuny@gmail.com', 'w', '32002', 'Allariz', 'España', '1223', '33333', '323', '0', '3232444'),
(4, 'Nalgures', 'nalgures sa', 26, 'nalgures@nalgures.com', '2', '2', '2', '2', '22', '2', '2', '0', ''),
(5, 'Elemental', 'Elemental S.A.', 31, 'Elemental@Elemental.com', 'O', '32333', 'Cali', 'Colonia', '3232323', '23', '32323232', '0', ''),
(19, 'aqui', 'rere1', 29, 'w@2.com', 'w', 'w', 'w', 'w', 'e', 'w', 'ewqeqw', '0', ''),
(17, 'mmmmmmmmmmmmmmmmmm', 'z', 29, '', '', '', '', '', '', '', '', '0', ''),
(18, 'dfsdsfsdfsd', '', 29, '', '', '', '', '', '', '', '', '0', ''),
(16, 'zzzzzzzzzzzzz', '', 29, '', '', '', '', '', '', '', '', '0', ''),
(15, 'fefefef', '', 29, '', '', '', '', '', '', '', '', '0', ''),
(20, 'sdsadsads', 'dsadsadsa', 29, '', '', '', '', '', 'dasdsa', '', '', '0', ''),
(21, 'eqwewq', 'w', 29, 'wwww@2.com', 'w', 'w', 'w', 'w', 'w', 'ww', 'ww', '0', ''),
(22, 'cine barcelona', 'cine barcelona S.A.', 26, '', '', '', '', '', '', '', '', '0', ''),
(23, 'Ayutamiento ortigueira', 'w', 29, 'wroigd@gmail.com', 'wewd', 'w', 'w', 'w', '222', '222', 'ww', '0', ''),
(24, 'bonberos', 'bonberos sa', 28, 'w@2.com', 'eeee', 'efdsfsdf', 'eeee', 'efsdfsdfsd', 'w33', 'w3º3º3º', 'efsdfsd', '0', ''),
(25, 'basureros', 'w', 29, 'w@2.com', 'w', 'w', 'ww', 'w', 'w', 'w', 'werwr', '0', ''),
(26, '334343', '4', 29, 'erwefdf@fdfd.es', '4', 'w', 'w', 'w', '4', '4', 'w', '0', ''),
(27, 'sdsadad', 'w', 29, 'wroigd@gmail.com', 'w', 'w', 'ww', 'w', 'w', 'w', 'w', '0', ''),
(28, 'Lito electricista', 'Lito electricista S.A.', 31, 'lito@electricista.com', '3', '3', '3', '3', '3', '3', '3', '0', ''),
(29, 'de todo', 'www', 29, 'ssw@ss2.com', 'w', 'w', 'w', 'ww', 'w', 'w', 'hola gola', '0', ''),
(30, 'cacac', 'cacac', 29, 'ssw@ss2.com', 'w', 'w', 'w', 'w', 'w', 'w', 'wdsdsddsaaaaaaaaaaaaa', '0', ''),
(31, 'repartidores colombia', 'asaaedweqwe', 31, 'ssw@ss2.com', 's', 's', 's', 's', 'sass', 's', 's333', '0', ''),
(32, 'wwwwwww', 'w', 29, 'www@2.com', 'w', 'w', 'w', 'w', 'w', 'w', 'w', '0', ''),
(33, 'last', 'last', 29, 'last@last.com', 'last', 'last', 'last', 'last', 'last', 'last', 'last', '0', ''),
(34, 'ggegege', 'fdfdsf', 29, 'sadasd@fd.ee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', '0', ''),
(1, 'Secogal', 'Secogal SA', 31, 'Secogal@Secogal.com', 'direccion secogal', '32002', 'Ourense', 'Ourense', '545454545', 'fax', 'rrioepriwoep', '0', '3333'),
(35, 'w', 'e', 29, 'aaae@fs.es', 'w', 'w', 'w', 'w', 'w', 'w', 'w', '0', ''),
(36, 'Agustin Calderon', 'ws', 28, 'ssw@ss2.com', 'escolapiosffassss', 'e', 'e', 'e', 's', 'e', '', '0', ''),
(37, 'Catering Ourense', 'Catering Ourense S.A.', 29, 'Cateringourense@secogal.com', 'Ourense', '32002a', 'Ourense', 'Spain', '212', '222', 'catering para backstagez', '0', ''),
(38, 'Catering Ourense', 'Catering Ourense S.A.', 29, 'Cateringourense@secogal.com', 'Ourense', '32002a', 'Ourense', 'Spain', '212', '222', 'catering para backstagez', '0', ''),
(39, 'Mulas', 'Mulas S.a', 27, 'Mulas@mulas.com', '3', '33', '3', '3', '343', '3', '3', '0', ''),
(40, 'limpiadores coruña', 'limpiadores coruña', 32, 'limpiadorescorunha@limpieza.com', '3', '3', '3', '3', '3', '3', 'limpiadores coruña', '0', ''),
(41, 'adios', 'adios', 29, 'adios@adios.com', '2', '2', '2', '2', 'adios', '222', 'adios', '0', ''),
(42, 'Transporte VipA', 'trasnporte vip S.A.', 31, 'vip@tranporte.com', 'w', 'w', 'w', 'w', 'xx3434555555dss', 'ww', 'trasnporte vipa', '0', ''),
(43, 'musica alternativa', 'musica alternativa s.a.', 28, 'alternativa@musica.com', 'calle musica', '32002', 'musica', 'music country', '2292929292', '9292929229', '20202020', '0', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies_has_productions`
--

CREATE TABLE IF NOT EXISTS `companies_has_productions` (
  `companies_id` int(11) NOT NULL,
  `productions_id` int(11) NOT NULL,
  PRIMARY KEY (`companies_id`,`productions_id`),
  KEY `fk_companies_has_productions_productions1` (`productions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `companies_has_productions`
--

INSERT INTO `companies_has_productions` (`companies_id`, `productions_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(4, 5),
(1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies_has_suppliers`
--

CREATE TABLE IF NOT EXISTS `companies_has_suppliers` (
  `companies_id` int(11) NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  PRIMARY KEY (`companies_id`,`suppliers_id`),
  KEY `fk_companies_has_suppliers_suppliers1` (`suppliers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_types`
--

CREATE TABLE IF NOT EXISTS `company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `acl_users_id`, `name`, `direction`, `email`, `telephone`, `status`, `company_id`, `in_litter`) VALUES
(0, 0, 'Desconocido', '', '0', '0', NULL, 0, '0'),
(2, 44, 'celso', 'weqwe', 'celso@gmail.com', '0', 'celso@gmail.com', 1, '0'),
(4, 46, 'ogando', '', 'ogi@gmail.com', '0', 'Encargado de personal', 2, '0'),
(5, 49, 'ReixA', '', 'reixa@nalgures.com', '0', 'Encargado de produccion', 4, '0'),
(6, 50, 'xurxo', 'dsdd', 'xurxo@fankany.com', '0', 'Encargado de produccion', 3, '0'),
(7, 51, 'avelino', '', 'avelino@secogal.com', '0', 'Encargado de seguridad', 1, '0'),
(8, 0, 'Elvira', '3333', 'elvira@secogal.com', '2323232', 'ayudante de gerencia', 1, '0'),
(9, 52, 'Agustin', '', 'agustin@elemental.com', '0', '212', 5, '0'),
(10, 53, 'roi Secogal', '', 'roigrande@secogal.com', '0', '1', 1, '0'),
(11, 0, 'Mil ocho', '3', '1008@festicultores.com', '232', '3', 3, '0'),
(13, 43, 'Pablo', 'rdrfdsfsdfdsf', 'pablopontino@secogal.com', '534544554', 'ewe', 1, '0'),
(15, 42, 'juan carlos', '22d', 'jc@secogal.com', '0', '232', 1, '0'),
(17, 0, 'rre', 'w', 'w@2.com', 'ww', 'w', 0, '0'),
(20, 43, 'Pablo pontino', '', 'pablopontino@secogal.com', '0', '0', 3, '0'),
(26, 0, 'gfgfd', 'w', 'wroigd@gmail.com', 'w', 'w', 1, '0'),
(27, 0, 'Pedro', 'dss3', 'pedro@secogal.com', '23232323', '3dsad', 23, '0'),
(28, 0, 'bonbero torero', '3', 'bonberotorero@bonbero.com', '232323', 'jefe de bonberos toreros', 24, '0'),
(29, 0, 'vaquilla torero', '23', 'vaquilla@gmail.com', '23', '2', 24, '0'),
(30, 0, 'Lito electricista', 'e', '3w@2.com', 'e', 'e', 28, '0'),
(31, 0, 'dfsfds', 'd', 'd@fdf.com', 'd', 'd', 35, '0'),
(32, 0, 'de', 'w', 'q@d.cd', 'w3', 'w', 19, '0'),
(33, 0, 'pedro basurero', '2', 'basurero@basurero.com', '321212', '2', 25, '0'),
(34, 0, '43242', 'e', '432@ses.es', 'e', 'e', 23, '0'),
(35, 0, 'quiosquero ortigueira', '', '', '', '', 23, '0'),
(36, 0, 'rewrwe', 'e', 'erwefdf@fdfd.es', 'e', 'e', 40, '0'),
(37, 0, 'musico alternativo', '3', 'musico@alternativo.com', '2323', '3', 43, '0'),
(38, 0, 'Paris', 'casa de mulas', 'paris@mulas.com', '123434', '2', 39, '0'),
(39, 0, 'amigo mulas', '323232', 'mulas@mulas.com', '49343049309', '3232', 39, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturation_types`
--

CREATE TABLE IF NOT EXISTS `facturation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `facturation_types`
--

INSERT INTO `facturation_types` (`id`, `name`) VALUES
(33, 'Actividad'),
(32, 'Horas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` int(11) NOT NULL,
  `invoices_status_id` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_receipt1` (`receipt_id`),
  KEY `fk_invoice_invoices_status1` (`invoices_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `invoice`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices_status`
--

CREATE TABLE IF NOT EXISTS `invoices_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `invoices_status`
--

INSERT INTO `invoices_status` (`id`, `name`) VALUES
(3, 'Anulada'),
(1, 'Entregada'),
(2, 'Facturada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva_types`
--

CREATE TABLE IF NOT EXISTS `iva_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `iva_types`
--

INSERT INTO `iva_types` (`id`, `name`) VALUES
(4, '1'),
(1, '16'),
(2, '21'),
(3, '8');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=84 ;

--
-- Volcar la base de datos para la tabla `permission_production`
--

INSERT INTO `permission_production` (`id`, `acl_users_id`, `productions_id`, `acl_roles_id`) VALUES
(50, 4, 3, 12),
(55, 4, 1, 1),
(57, 4, 2, 1),
(58, 42, 1, 12),
(59, 42, 4, 3),
(60, 47, 4, 17),
(61, 47, 2, 18),
(62, 50, 4, 18),
(63, 4, 5, 1),
(64, 51, 1, 12),
(65, 4, 4, 1),
(66, 52, 6, 3),
(67, 4, 6, 19),
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
(79, 42, 3, 3),
(80, 4, 15, 1),
(81, 51, 15, 12),
(82, 42, 15, 3),
(83, 43, 15, 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

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
(12, 'Diseño Orquestor', 30, 5, 25, 'e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'werwr', 0, '0'),
(13, 'r', 30, 19, 25, 'e', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e', 0, '0'),
(14, 'Alberto Ortigueira', 31, 22, 25, 'barcelona', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'e333', 0, '0'),
(15, 'concierto barcelona', 27, 43, 25, 'calle musica', '0001-00-00 00:00:00', '0000-00-00 00:00:02', 'concierto de grandes musicos', 20000, '0');

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
(1, 3),
(1, 4),
(1, 6),
(1, 7),
(1, 17),
(1, 20),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(3, 5),
(4, 6),
(4, 7),
(4, 17),
(12, 4),
(12, 6),
(12, 16),
(12, 17),
(12, 18),
(12, 19),
(15, 7),
(15, 16);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

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
-- Estructura de tabla para la tabla `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productions_id` int(11) NOT NULL,
  `production_name` varchar(250) NOT NULL,
  `client_name` varchar(250) NOT NULL DEFAULT '0',
  `fiscal_name` varchar(250) NOT NULL,
  `observation` varchar(250) DEFAULT NULL,
  `direction` varchar(250) DEFAULT NULL,
  `postal_code` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `cif` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoices_productions1` (`productions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `receipts`
--

INSERT INTO `receipts` (`id`, `productions_id`, `production_name`, `client_name`, `fiscal_name`, `observation`, `direction`, `postal_code`, `city`, `country`, `telephone`, `fax`, `cif`) VALUES
(1, 15, 'musica alternativa', 'concierto barcelona', 'musica alternativa s.a.', '20202020', 'calle musica', '32002', 'musica', 'music country', '2292929292', '9292929229', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companies_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(2500) DEFAULT NULL,
  `direction` int(11) DEFAULT NULL,
  `num_resources` int(11) DEFAULT '0',
  `num_resources_used` int(11) DEFAULT '0',
  `in_litter` binary(1) DEFAULT '0',
  `resources_types_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resource_companies1` (`companies_id`),
  KEY `fk_resources_resources_types1` (`resources_types_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Volcar la base de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `companies_id`, `name`, `description`, `direction`, `num_resources`, `num_resources_used`, `in_litter`, `resources_types_id`) VALUES
(24, 1, 'pedro', 'skdlakdlñ', 0, 3, 1, '0', 1),
(25, 1, 'coche jc', 'lñklñk', 0, 2222, 1111, '0', 2),
(26, 23, 'Alberto Ortigueira', '324', 0, 2, 1, '0', 3),
(27, 24, 'name erw', 'dssad', 0, 22, 2, '0', 1),
(29, 25, 'roi basurero', '212121fdsfsdfsd', 0, 2, 1, '0', 1),
(30, 25, 'camion basura', 'dsasdsadasdsa', 0, 2, 2, '0', 2),
(31, 0, '22', '232323', 0, 2323, 22, '0', 0),
(32, 0, '33', 'dsadsad', 0, 2, 2, '0', 0),
(33, 24, 'conductor coche', 'fdsfsdfdsfdsfdsf', 0, 22, 1, '0', 3),
(34, 23, 'bar ortigueira', 'dfdsfdccccc', 121, 23, 21, '0', 3),
(36, 35, 'w', 'dsdsaxx dsdas sa', 0, 1, 1, '0', 3),
(37, 28, 'Cableado electrico', 'dcsadsadasdsa', 3, 111, 1, '0', 2),
(38, 23, 'rewrwer', 'dsadsadsadsad', 0, 3, 0, '0', 1),
(39, 23, 'w', 'eweqwewqewq', 0, 1, 0, '0', 2),
(40, 23, 'w', '4343434', 0, 32, 2, '0', 2),
(41, 24, 'manuel bonbero', 'fdsfdsfdsf', 0, 2, 1, '1', 1),
(42, 28, 'hijo de lito', 'dfdsfsdfsdfdsf', 0, 3, 2, '0', 2),
(43, 39, 'jefe mula', 'fdsfdsfdsf', 0, 2, 1, '0', 1),
(44, 39, 'camarote mulas', 'fsdfdsfdsfds', 0, 12, 1, '0', 3),
(45, 28, 'ropas', 'ropa termica', 0, 333, 0, '0', 5),
(46, 28, 'cochecito electrico', 'un cochecito muy bonito', 0, 3, 0, '0', 4);

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
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resources_types_copy1_resource1` (`resource_id`),
  KEY `fk_resources_types_copy1_activities1` (`activities_id`),
  KEY `fk_resources_activities_contacts1` (`contacts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Volcar la base de datos para la tabla `resources_activities`
--

INSERT INTO `resources_activities` (`id`, `name`, `resource_id`, `activities_id`, `observation`, `unbilled_hours`, `contacts_id`, `quantity`, `price`) VALUES
(26, 'amigos pedro', 24, 11, '22333', 3, 2, 13, 0),
(28, 'coche basurero2', 25, 11, 'ewew', 1, 2, 14, 0),
(30, 'ewe', 24, 11, '2', 2, 15, 21, 0),
(31, 'Bonbero Ortigueira', 33, 13, '222', 2, 29, 22, 0),
(32, '333', 0, 13, '333', 333, 30, 25, 0),
(33, '333', 0, 13, '3', 3, 30, 5, 0),
(34, 'redrfsdkj', 24, 1, '332323', 22, 15, 5, 0),
(35, 'ww', 24, 1, '2w2', 2, 15, 5, 0),
(36, 'w', 24, 1, 'w', 0, 15, 5, 0),
(37, 'e', 0, 0, NULL, 0, 0, 2, 0),
(38, 'gfsdgdfaaa', 0, 0, NULL, 0, 0, 3, 0),
(39, 'Manuel', 25, 1, '2', 2, 7, 1, 0),
(40, 'wadsdsa3333', 37, 15, 'concierto de grandes musicos', 2, 30, 2, 0),
(41, 'pedro', 24, 16, '3', 3, 15, 44, 0),
(42, 'personal recogida basura', 24, 3, 'recoger basuras', 1, 8, 122, 0),
(43, 'coche recogida de basura', 25, 3, 'camion de recogida de basura', 5, 8, 1, 0),
(44, 'lugar para guardar material', 44, 2, 'necesitamos un sitio', 0, 39, 1, 0),
(45, 'ayuda electrica', 42, 16, '333', 44, 30, 1, 22),
(46, 'www', 46, 15, '333', 3, 30, 1, 333),
(47, 'el hijo del lito', 42, 15, '1', 1, 30, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources_types`
--

CREATE TABLE IF NOT EXISTS `resources_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `iva_types_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fk_resources_types_iva_types1` (`iva_types_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `resources_types`
--

INSERT INTO `resources_types` (`id`, `name`, `iva_types_id`) VALUES
(1, 'Extructura', 3),
(2, 'Material de montaje', 3),
(3, 'personal', 1),
(4, 'Trasnporte', 2),
(5, 'consumibles', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource_activity_has_receipt`
--

CREATE TABLE IF NOT EXISTS `resource_activity_has_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iva_type` varchar(45) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `facturation_types_id` int(11) NOT NULL,
  `resources_activities_id` int(11) NOT NULL,
  `receipts_id` int(11) NOT NULL,
  `final_price` int(11) DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_acquittance_iva_types1` (`iva_type`),
  KEY `fk_acquittance_facturation_types1` (`facturation_types_id`),
  KEY `fk_acquittance_resources_activities1` (`resources_activities_id`),
  KEY `fk_resoirce_activity_has_receipt_receipt1` (`receipts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcar la base de datos para la tabla `resource_activity_has_receipt`
--

INSERT INTO `resource_activity_has_receipt` (`id`, `iva_type`, `price`, `facturation_types_id`, `resources_activities_id`, `receipts_id`, `final_price`, `quantity`) VALUES
(17, '8', '200', 32, 45, 1, -8800, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`, `parent_id`) VALUES
(25, 'Presupuestando', 26),
(26, 'Presupuestado', 27),
(27, 'Confirmado', 28),
(28, 'Iniciado', 29),
(29, 'Finalizado', 30),
(30, 'Facturado', 31),
(31, 'Cobrado', 0);

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

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `acl_permissions`
--
ALTER TABLE `acl_permissions`
  ADD CONSTRAINT `fk_acl_permissions_acl_resources1` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acl_permissions_acl_roles1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `acl_resources`
--
ALTER TABLE `acl_resources`
  ADD CONSTRAINT `fk_acl_resources_acl_modules1` FOREIGN KEY (`module_id`) REFERENCES `acl_modules` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `acl_users`
--
ALTER TABLE `acl_users`
  ADD CONSTRAINT `fk_acl_users_acl_roles1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `acl_users_has_companies`
--
ALTER TABLE `acl_users_has_companies`
  ADD CONSTRAINT `fk_acl_users_has_companies_acl_users1` FOREIGN KEY (`acl_users_id`) REFERENCES `acl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acl_users_has_companies_companies1` FOREIGN KEY (`companies_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_acl_activities_acl_productions1` FOREIGN KEY (`productions_id`) REFERENCES `productions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activities_activity_types1` FOREIGN KEY (`activity_types_id`) REFERENCES `activity_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activities_contacts1` FOREIGN KEY (`contact_client_company_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activities_contacts3` FOREIGN KEY (`contact_own_company_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activities_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_invoices_status1` FOREIGN KEY (`invoices_status_id`) REFERENCES `invoices_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invoice_receipt1` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_ibfk_1` FOREIGN KEY (`productions_id`) REFERENCES `productions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `resources_types`
--
ALTER TABLE `resources_types`
  ADD CONSTRAINT `fk_resources_types_iva_types1` FOREIGN KEY (`iva_types_id`) REFERENCES `iva_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `resource_activity_has_receipt`
--
ALTER TABLE `resource_activity_has_receipt`
  ADD CONSTRAINT `fk_acquittance_facturation_types1` FOREIGN KEY (`facturation_types_id`) REFERENCES `facturation_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acquittance_resources_activities1` FOREIGN KEY (`resources_activities_id`) REFERENCES `resources_activities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resoirce_activity_has_receipt_receipt1` FOREIGN KEY (`receipts_id`) REFERENCES `receipts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
