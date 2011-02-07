-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2010 at 08:33 AM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onmccdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `pk_content` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_content_type` int(10) unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `metadata` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `fk_creator` int(10) unsigned DEFAULT NULL COMMENT 'Clave foranea de user',
  `views` int(10) unsigned DEFAULT NULL,
  `in_litter` tinyint(1) DEFAULT '0' COMMENT '0publicado 1papelera',
  PRIMARY KEY (`pk_content`),
  KEY `fk_content_type` (`fk_content_type`),
  KEY `in_litter` (`in_litter`),
  KEY `created` (`created`),
  FULLTEXT KEY `metadata` (`metadata`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contents`
--


-- --------------------------------------------------------

--
-- Table structure for table `contents_categories`
--

DROP TABLE IF EXISTS `contents_categories`;
CREATE TABLE IF NOT EXISTS `contents_categories` (
  `pk_fk_content` bigint(20) unsigned NOT NULL,
  `pk_fk_content_category` int(10) unsigned NOT NULL,
  `catName` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`pk_fk_content`,`pk_fk_content_category`),
  KEY `pk_fk_content_category` (`pk_fk_content_category`),
  KEY `catName` (`catName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `content_categories`
--

DROP TABLE IF EXISTS `content_categories`;
CREATE TABLE IF NOT EXISTS `content_categories` (
  `pk_content_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL, 
  `fk_content_category` int(10) DEFAULT '0', 
  PRIMARY KEY (`pk_content_category`),
  KEY (`pk_content_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `content_categories`
--

INSERT INTO `content_categories` (`pk_content_category`, `title`, `name`, `fk_content_category`) VALUES
(1, 'Farmacias', 'farmacia',  0 ),
(2, 'Hosteleria', 'hosteleria', 0 );

-- --------------------------------------------------------

--
-- Table structure for table `content_types`
--

DROP TABLE IF EXISTS `content_types`;
CREATE TABLE IF NOT EXISTS `content_types` (
  `pk_content_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL COMMENT 'utilizado en permalink',
  PRIMARY KEY (`pk_content_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `content_types`
--

INSERT INTO `content_types` (`pk_content_type`, `name`, `title`) VALUES
(1, 'customer', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `pk_customer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name_fiscal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cif` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telf1` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telf2` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `geo_loc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pk_customer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `customers_tracking`
--

DROP TABLE IF EXISTS `customers_trackings`;
CREATE TABLE IF NOT EXISTS `customers_trackings` (
  `pk_fk_customer` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `pk_fk_tracking` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pk_fk_customer`,`pk_fk_tracking`),
  KEY `pk_fk_tracking` (`pk_fk_tracking`),
  KEY `pk_fk_customer` (`pk_fk_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_tracking`
--

 
-- --------------------------------------------------------



--
-- Table structure for table `tracking`
--

DROP TABLE IF EXISTS `trackings`;
CREATE TABLE IF NOT EXISTS `trackings` (
  `pk_tracking` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL, 
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`pk_tracking`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tracking`
--
-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `pk_privilege` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `module` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pk_privilege`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`pk_privilege`, `name`, `description`, `module`) VALUES
(2, 'CLIENTES_USER', 'Gestion bÃ¡sica de clientes', 'CLIENTES'),
(1, 'CLIENTES_ADMIN', 'ADMINISTRACION MODULO CLIENTES', 'CLIENTES');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `pk_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `login` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `sessionexpire` tinyint(2) unsigned NOT NULL DEFAULT '15',
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fk_user_group` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`pk_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`pk_user`, `online`, `login`, `password`, `sessionexpire`, `email`, `name`, `firstname`, `lastname`, `address`, `phone`, `fk_user_group`) VALUES
(1, 0, 'macada', '2f575705daf41049194613e47027200b', 15, 'macada@openhost.es', 'David', 'Martinez', '', '', '', 5),
(3, 0, 'sandra', 'f40a37048732da05928c3d374549c832', 15, 'sandra@openhost.es', 'sandra', 'Pereira', NULL, NULL, NULL, 5),
(2, 0, 'tmk1', 'e10adc3949ba59abbe56e057f20f883e', 15, 'tmk1@hola.es', 'tmk1', 'hola', '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_content_categories`
--

DROP TABLE IF EXISTS `users_content_categories`;
CREATE TABLE IF NOT EXISTS `users_content_categories` (
  `pk_fk_user` int(10) unsigned NOT NULL,
  `pk_fk_content_category` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pk_fk_user`,`pk_fk_content_category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_content_categories`
--

INSERT INTO `users_content_categories` (`pk_fk_user`, `pk_fk_content_category`) VALUES


(2, 1),
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `pk_user_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pk_user_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`pk_user_group`, `name`) VALUES
(5, 'Administrador'),
(1, 'admin_tmk'),
(2, 'tmk');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups_privileges`
--

DROP TABLE IF EXISTS `user_groups_privileges`;
CREATE TABLE IF NOT EXISTS `user_groups_privileges` (
  `pk_fk_user_group` int(10) unsigned NOT NULL,
  `pk_fk_privilege` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pk_fk_user_group`,`pk_fk_privilege`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_groups_privileges`
--

INSERT INTO `user_groups_privileges` (`pk_fk_user_group`, `pk_fk_privilege`) VALUES
(5, 1),
(5, 2),
(2, 2),
(1, 1);
