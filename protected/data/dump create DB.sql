-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: green
-- ------------------------------------------------------
-- Server version	5.1.33-community

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `green`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `green` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `green`;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `main` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `area_project`
--

DROP TABLE IF EXISTS `area_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_project` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_area` int(11) NOT NULL,
  `Id_project` int(11) NOT NULL,
  `centralized` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Id`,`Id_area`,`Id_project`),
  KEY `fk_area_project_id_area` (`Id_area`),
  KEY `fk_area_project_id_project` (`Id_project`),
  CONSTRAINT `fk_area_project_id_area` FOREIGN KEY (`Id_area`) REFERENCES `area` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_area_project_id_project` FOREIGN KEY (`Id_project`) REFERENCES `project` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `budget`
--

DROP TABLE IF EXISTS `budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budget` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_project` int(11) NOT NULL,
  `Id_price_list` int(11) NOT NULL,
  `version_number` int(11) NOT NULL,
  `percent_discount` decimal(10,0) DEFAULT NULL,
  `date_creation` timestamp NULL DEFAULT NULL,
  `budget_state_id` int(11) NOT NULL,
  `date_inicialization` timestamp NULL DEFAULT NULL,
  `date_finalization` timestamp NULL DEFAULT NULL,
  `date_estimated_inicialization` timestamp NULL DEFAULT NULL,
  `date_estimated_finalization` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`,`version_number`),
  KEY `fk_budget_Id_project_project1` (`Id_project`),
  KEY `fk_budget_Id_price_list_price_list1` (`Id_price_list`),
  KEY `fk_budget_budget_state1` (`budget_state_id`),
  CONSTRAINT `fk_budget_budget_state1` FOREIGN KEY (`budget_state_id`) REFERENCES `budget_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_budget_Id_price_list_price_list1` FOREIGN KEY (`Id_price_list`) REFERENCES `price_list` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_budget_Id_project_project1` FOREIGN KEY (`Id_project`) REFERENCES `project` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `budget_item`
--

DROP TABLE IF EXISTS `budget_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budget_item` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_product` int(11) NOT NULL,
  `budget_Id` int(11) NOT NULL,
  `budget_version_number` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `Id_budget_item` int(11) DEFAULT NULL COMMENT 'Cuando este campo esta en null, significa q ese item es un rector. Lo que quiere decir es q todos los item q tenga en este campo el id del rector, tendran q ser sumarizados sus costos en dicho rector',
  PRIMARY KEY (`Id`),
  KEY `fk_budget_item_Id_product_product1` (`Id_product`),
  KEY `fk_budget_item_budget1` (`budget_Id`,`budget_version_number`),
  KEY `fk_budget_item_budget_item1` (`Id_budget_item`),
  CONSTRAINT `fk_budget_item_budget1` FOREIGN KEY (`budget_Id`, `budget_version_number`) REFERENCES `budget` (`Id`, `version_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_budget_item_budget_item1` FOREIGN KEY (`Id_budget_item`) REFERENCES `budget_item` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_budget_item_Id_product_product1` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `budget_state`
--

DROP TABLE IF EXISTS `budget_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budget_state` (
  `Id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category_area`
--

DROP TABLE IF EXISTS `category_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_area` (
  `Id_category` int(11) NOT NULL,
  `Id_area` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_category`,`Id_area`),
  KEY `fk_category_area_area1` (`Id_area`),
  KEY `fk_category_area_category1` (`Id_category`),
  CONSTRAINT `fk_category_area_area1` FOREIGN KEY (`Id_area`) REFERENCES `area` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_category_area_category1` FOREIGN KEY (`Id_category`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category_group`
--

DROP TABLE IF EXISTS `category_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_group` (
  `Id_category_parent` int(11) NOT NULL,
  `Id_category_child` int(11) NOT NULL,
  PRIMARY KEY (`Id_category_parent`,`Id_category_child`),
  KEY `fk_category_group_id_category_child` (`Id_category_child`),
  KEY `fk_category_group_id_category_parent` (`Id_category_parent`),
  CONSTRAINT `fk_category_group_id_category_child` FOREIGN KEY (`Id_category_child`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_category_group_id_category_parent` FOREIGN KEY (`Id_category_parent`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category_sub_category`
--

DROP TABLE IF EXISTS `category_sub_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_sub_category` (
  `Id_category` int(11) NOT NULL,
  `Id_sub_category` int(11) NOT NULL,
  PRIMARY KEY (`Id_category`,`Id_sub_category`),
  KEY `fk_category_sub_category_sub_category1` (`Id_sub_category`),
  KEY `fk_category_sub_category_category1` (`Id_category`),
  CONSTRAINT `fk_category_sub_category_category1` FOREIGN KEY (`Id_category`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_category_sub_category_sub_category1` FOREIGN KEY (`Id_sub_category`) REFERENCES `sub_category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `telephone_1` varchar(45) DEFAULT NULL,
  `telephone_2` varchar(45) DEFAULT NULL,
  `telephone_3` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contact_brand`
--

DROP TABLE IF EXISTS `contact_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_brand` (
  `Id_contact` int(11) NOT NULL,
  `Id_brand` int(11) NOT NULL,
  PRIMARY KEY (`Id_contact`,`Id_brand`),
  KEY `fk_contact_brand_Id_brand_brand1` (`Id_brand`),
  KEY `fk_contact_brand_id_contact_contact1` (`Id_contact`),
  CONSTRAINT `fk_contact_brand_Id_brand_brand1` FOREIGN KEY (`Id_brand`) REFERENCES `brand` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_contact_brand_id_contact_contact1` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `cost`
--

DROP TABLE IF EXISTS `cost`;
/*!50001 DROP VIEW IF EXISTS `cost`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cost` (
  `Id_priceListItem` int(11),
  `Id_priceList` int(11),
  `Id_product` int(11),
  `Id_importer` int(11),
  `code` varchar(45),
  `weight` float,
  `cost_air` double,
  `volume` double,
  `cost_maritime` double,
  `msrp` decimal(10,2),
  `dealer_cost` decimal(10,2),
  `profit_rate` decimal(10,2),
  `cost_maritime_final` double,
  `cost_air_final` double
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_person` int(11) NOT NULL,
  `Id_contact` int(11) NOT NULL COMMENT 'This fk add main contact info to customer entitiy',
  PRIMARY KEY (`Id`),
  KEY `fk_customer_person1` (`Id_person`),
  KEY `fk_customer_contact1` (`Id_contact`),
  CONSTRAINT `fk_customer_contact1` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_person1` FOREIGN KEY (`Id_person`) REFERENCES `person` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customer_contact`
--

DROP TABLE IF EXISTS `customer_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_contact` (
  `Id_customer` int(11) NOT NULL,
  `Id_contact` int(11) NOT NULL,
  PRIMARY KEY (`Id_customer`,`Id_contact`),
  KEY `fk_customer_contact_contact1` (`Id_contact`),
  KEY `fk_customer_contact_customer1` (`Id_customer`),
  CONSTRAINT `fk_customer_contact_contact1` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_contact_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `entity_type`
--

DROP TABLE IF EXISTS `entity_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guild`
--

DROP TABLE IF EXISTS `guild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guild` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hyperlink`
--

DROP TABLE IF EXISTS `hyperlink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hyperlink` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `Id_entity_type` int(11) NOT NULL,
  `Id_product` int(11) DEFAULT NULL,
  `Id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_hyperlink_entity_type1` (`Id_entity_type`),
  KEY `fk_hyperlink_product1` (`Id_product`),
  KEY `fk_hyperlink_contact1` (`Id_contact`),
  CONSTRAINT `fk_hyperlink_contact1` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hyperlink_entity_type1` FOREIGN KEY (`Id_entity_type`) REFERENCES `entity_type` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hyperlink_product1` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `importer`
--

DROP TABLE IF EXISTS `importer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `importer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_contact` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_importer_contact1` (`Id_contact`),
  CONSTRAINT `fk_importer_contact1` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `itemchildren`
--

DROP TABLE IF EXISTS `itemchildren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemchildren` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(5) NOT NULL DEFAULT 'en_us',
  `language` varchar(45) NOT NULL,
  `region` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `lang_UNIQUE` (`lang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement_type`
--

DROP TABLE IF EXISTS `measurement_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measurement_type` (
  `Id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement_unit`
--

DROP TABLE IF EXISTS `measurement_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measurement_unit` (
  `Id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `short_description` varchar(10) DEFAULT NULL,
  `Id_measurement_type` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_measurement_unit_measurement_type1` (`Id_measurement_type`),
  CONSTRAINT `fk_measurement_unit_measurement_type1` FOREIGN KEY (`Id_measurement_type`) REFERENCES `measurement_type` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `measurement_unit_converter`
--

DROP TABLE IF EXISTS `measurement_unit_converter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measurement_unit_converter` (
  `Id` int(11) NOT NULL,
  `Id_measurement_from` int(11) NOT NULL,
  `Id_measurement_to` int(11) NOT NULL,
  `factor` double DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_measurement_unit_converter_measurement_unit1` (`Id_measurement_from`),
  KEY `fk_measurement_unit_converter_measurement_unit2` (`Id_measurement_to`),
  CONSTRAINT `fk_measurement_unit_converter_measurement_unit1` FOREIGN KEY (`Id_measurement_from`) REFERENCES `measurement_unit` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_measurement_unit_converter_measurement_unit2` FOREIGN KEY (`Id_measurement_to`) REFERENCES `measurement_unit` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `multimedia`
--

DROP TABLE IF EXISTS `multimedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multimedia` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `description` text,
  `file_name_small` varchar(255) DEFAULT NULL,
  `size_small` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT '0',
  `width` int(11) DEFAULT '0',
  `height_small` int(11) DEFAULT '0',
  `width_small` int(11) DEFAULT '0',
  `Id_multimedia_type` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_multimedia_multimedia_type1` (`Id_multimedia_type`),
  CONSTRAINT `fk_multimedia_multimedia_type1` FOREIGN KEY (`Id_multimedia_type`) REFERENCES `multimedia_type` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `multimedia_type`
--

DROP TABLE IF EXISTS `multimedia_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multimedia_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nomenclator`
--

DROP TABLE IF EXISTS `nomenclator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nomenclator` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `note` text,
  `creation_date` timestamp NULL DEFAULT NULL,
  `Id_entity_type` int(11) NOT NULL,
  `Id_product_requirement_product_requirement_product_item` int(11) DEFAULT NULL,
  `Id_product_item_product_requirement_product_item` int(11) DEFAULT NULL,
  `budget_Id` int(11) DEFAULT NULL,
  `budget_version_number` int(11) DEFAULT NULL,
  `Id_tracking` int(11) DEFAULT NULL,
  `Id_product` int(11) DEFAULT NULL,
  `Id_product_requirement` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_note_id_entity_type_entity_type1` (`Id_entity_type`),
  KEY `fk_note_id_product_requirement_product_requirement_product_it1` (`Id_product_requirement_product_requirement_product_item`,`Id_product_item_product_requirement_product_item`),
  KEY `fk_note_budget1` (`budget_Id`,`budget_version_number`),
  KEY `fk_note_tracking1` (`Id_tracking`),
  KEY `fk_note_product1` (`Id_product`),
  KEY `fk_note_product_requirement1` (`Id_product_requirement`),
  CONSTRAINT `fk_note_budget1` FOREIGN KEY (`budget_Id`, `budget_version_number`) REFERENCES `budget` (`Id`, `version_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_note_id_entity_type_entity_type1` FOREIGN KEY (`Id_entity_type`) REFERENCES `entity_type` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_note_id_product_requirement_product_requirement_product_it1` FOREIGN KEY (`Id_product_requirement_product_requirement_product_item`, `Id_product_item_product_requirement_product_item`) REFERENCES `product_requirement_product_item` (`Id_product_requirement`, `Id_product_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_note_product1` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_note_product_requirement1` FOREIGN KEY (`Id_product_requirement`) REFERENCES `product_requirement` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_note_tracking1` FOREIGN KEY (`Id_tracking`) REFERENCES `tracking` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `uid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `price_list`
--

DROP TABLE IF EXISTS `price_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_list` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp NULL DEFAULT NULL,
  `date_validity` date DEFAULT NULL,
  `validity` tinyint(1) DEFAULT NULL,
  `Id_supplier` int(11) DEFAULT NULL,
  `Id_price_list_type` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_price_list_Id_supplier_supplier1` (`Id_supplier`),
  KEY `fk_price_list_id_price_list_type_price_list_type1` (`Id_price_list_type`),
  CONSTRAINT `fk_price_list_id_price_list_type_price_list_type1` FOREIGN KEY (`Id_price_list_type`) REFERENCES `price_list_type` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_price_list_Id_supplier_supplier1` FOREIGN KEY (`Id_supplier`) REFERENCES `supplier` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `price_list_item`
--

DROP TABLE IF EXISTS `price_list_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_list_item` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_product` int(11) NOT NULL,
  `Id_price_list` int(11) NOT NULL,
  `msrp` decimal(10,2) DEFAULT '0.00',
  `dealer_cost` decimal(10,2) DEFAULT '0.00',
  `profit_rate` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`Id`),
  KEY `fk_price_list_item_Id_price_list_price_list1` (`Id_price_list`),
  KEY `fk_price_list_item_id_product` (`Id_product`),
  CONSTRAINT `fk_price_list_item_Id_price_list_price_list1` FOREIGN KEY (`Id_price_list`) REFERENCES `price_list` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_price_list_item_id_product` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `price_list_type`
--

DROP TABLE IF EXISTS `price_list_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_list_type` (
  `Id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_brand` int(11) NOT NULL,
  `Id_category` int(11) NOT NULL,
  `Id_nomenclator` int(11) NOT NULL,
  `description_customer` varchar(255) DEFAULT NULL,
  `description_supplier` varchar(255) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `code_supplier` varchar(45) DEFAULT NULL,
  `discontinued` tinyint(1) DEFAULT NULL,
  `length` float DEFAULT '0',
  `width` float DEFAULT '0',
  `height` float DEFAULT '0',
  `weight` float DEFAULT '0',
  `profit_rate` decimal(10,2) DEFAULT '0.00',
  `msrp` decimal(10,2) DEFAULT '0.00',
  `time_instalation` time DEFAULT NULL,
  `hide` tinyint(1) DEFAULT NULL COMMENT 'se usa en true cuando el producto no se debe o quiere mostrar a la hora de generar un presupuesto.\nEl costo de estos productos sera sumarizado en el costo de su rector',
  `Id_supplier` int(11) NOT NULL,
  `dealer_cost` decimal(10,2) DEFAULT '0.00',
  `Id_measurement_unit_linear` int(11) NOT NULL,
  `Id_measurement_unit_weight` int(11) NOT NULL,
  `color` varchar(45) DEFAULT NULL,
  `Id_sub_category` int(11) NOT NULL,
  `other` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_product_Id_category_category1` (`Id_category`),
  KEY `fk_product_Id_nomenclator_nomenclator1` (`Id_nomenclator`),
  KEY `fk_product_supplier1` (`Id_supplier`),
  KEY `fk_product_id_brand` (`Id_brand`),
  KEY `fk_product_measurement_unit2` (`Id_measurement_unit_weight`),
  KEY `fk_product_measurement_unit1` (`Id_measurement_unit_linear`),
  KEY `fk_product_sub_category1` (`Id_sub_category`),
  CONSTRAINT `fk_product_id_brand` FOREIGN KEY (`Id_brand`) REFERENCES `brand` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_Id_category_category1` FOREIGN KEY (`Id_category`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_Id_nomenclator_nomenclator1` FOREIGN KEY (`Id_nomenclator`) REFERENCES `nomenclator` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_measurement_unit1` FOREIGN KEY (`Id_measurement_unit_linear`) REFERENCES `measurement_unit` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_measurement_unit2` FOREIGN KEY (`Id_measurement_unit_weight`) REFERENCES `measurement_unit` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_sub_category1` FOREIGN KEY (`Id_sub_category`) REFERENCES `sub_category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_supplier1` FOREIGN KEY (`Id_supplier`) REFERENCES `supplier` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_area`
--

DROP TABLE IF EXISTS `product_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_area` (
  `Id_area` int(11) NOT NULL,
  `Id_product` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_area`,`Id_product`),
  KEY `fk_product_area_id_product` (`Id_product`),
  KEY `fk_product_area_id_area` (`Id_area`),
  CONSTRAINT `fk_product_area_id_area` FOREIGN KEY (`Id_area`) REFERENCES `area` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_area_id_product` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `Id_product` int(11) NOT NULL,
  `Id_category` int(11) NOT NULL,
  PRIMARY KEY (`Id_product`,`Id_category`),
  KEY `fk_product_category_id_category` (`Id_category`),
  KEY `fk_product_category_id_product` (`Id_product`),
  CONSTRAINT `fk_product_category_id_category` FOREIGN KEY (`Id_category`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_category_id_product` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_group`
--

DROP TABLE IF EXISTS `product_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_group` (
  `Id_product_parent` int(11) NOT NULL,
  `Id_product_child` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_product_parent`,`Id_product_child`),
  KEY `fk_product_group_id_product_child` (`Id_product_child`),
  KEY `fk_product_group_id_product_parent` (`Id_product_parent`),
  CONSTRAINT `fk_product_group_id_product_child` FOREIGN KEY (`Id_product_child`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_group_id_product_parent` FOREIGN KEY (`Id_product_parent`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_item`
--

DROP TABLE IF EXISTS `product_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_item` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_product` int(11) NOT NULL,
  `real_shipping_cost` decimal(10,0) DEFAULT NULL,
  `Id_purchase_order_item` int(11) NOT NULL,
  `Id_budget_item` int(11) NOT NULL,
  `Id_project` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_product_item_Id_product_product1` (`Id_product`),
  KEY `fk_product_item_Id_purchase_order_item_purchase_order_item1` (`Id_purchase_order_item`),
  KEY `fk_product_item_Id_budget_item_budget_item1` (`Id_budget_item`),
  KEY `fk_product_item_Id_project_project1` (`Id_project`),
  CONSTRAINT `fk_product_item_Id_budget_item_budget_item1` FOREIGN KEY (`Id_budget_item`) REFERENCES `budget_item` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_item_Id_product_product1` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_item_Id_project_project1` FOREIGN KEY (`Id_project`) REFERENCES `project` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_item_Id_purchase_order_item_purchase_order_item1` FOREIGN KEY (`Id_purchase_order_item`) REFERENCES `purchase_order_item` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_multimedia`
--

DROP TABLE IF EXISTS `product_multimedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_multimedia` (
  `Id_product` int(11) NOT NULL,
  `Id_multimedia` int(11) NOT NULL,
  PRIMARY KEY (`Id_product`,`Id_multimedia`),
  KEY `fk_product_multimedia_multimedia1` (`Id_multimedia`),
  KEY `fk_product_multimedia_product1` (`Id_product`),
  CONSTRAINT `fk_product_multimedia_multimedia1` FOREIGN KEY (`Id_multimedia`) REFERENCES `multimedia` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_multimedia_product1` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_requirement`
--

DROP TABLE IF EXISTS `product_requirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_requirement` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `internal` tinyint(1) NOT NULL,
  `description_short` varchar(255) DEFAULT NULL,
  `Id_guild` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_product_requirement_id_guild_guild1` (`Id_guild`),
  CONSTRAINT `fk_product_requirement_id_guild_guild1` FOREIGN KEY (`Id_guild`) REFERENCES `guild` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_requirement_multimedia`
--

DROP TABLE IF EXISTS `product_requirement_multimedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_requirement_multimedia` (
  `Id_product_requirement` int(11) NOT NULL,
  `Id_multimedia` int(11) NOT NULL,
  PRIMARY KEY (`Id_product_requirement`,`Id_multimedia`),
  KEY `fk_product_requirement_multimedia_multimedia1` (`Id_multimedia`),
  KEY `fk_product_requirement_multimedia_product_requirement1` (`Id_product_requirement`),
  CONSTRAINT `fk_product_requirement_multimedia_multimedia1` FOREIGN KEY (`Id_multimedia`) REFERENCES `multimedia` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_requirement_multimedia_product_requirement1` FOREIGN KEY (`Id_product_requirement`) REFERENCES `product_requirement` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_requirement_product`
--

DROP TABLE IF EXISTS `product_requirement_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_requirement_product` (
  `Id_product_requirement` int(11) NOT NULL,
  `Id_product` int(11) NOT NULL,
  PRIMARY KEY (`Id_product_requirement`,`Id_product`),
  KEY `fk_product_requirement_product_id_product` (`Id_product`),
  KEY `fk_product_requirement_product_id_product_requirement` (`Id_product_requirement`),
  CONSTRAINT `fk_product_requirement_product_id_product` FOREIGN KEY (`Id_product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_requirement_product_id_product_requirement` FOREIGN KEY (`Id_product_requirement`) REFERENCES `product_requirement` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_requirement_product_item`
--

DROP TABLE IF EXISTS `product_requirement_product_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_requirement_product_item` (
  `Id_product_requirement` int(11) NOT NULL,
  `Id_product_item` int(11) NOT NULL,
  `accomplished` tinyint(1) DEFAULT NULL,
  `date_accomplished` timestamp NULL DEFAULT NULL,
  `date_estimated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id_product_requirement`,`Id_product_item`),
  KEY `fk_product_requirement_product_item_id_product_requirement` (`Id_product_requirement`),
  KEY `fk_product_requirement_product_item_id_product_item` (`Id_product_item`),
  CONSTRAINT `fk_product_requirement_product_item_id_product_item` FOREIGN KEY (`Id_product_item`) REFERENCES `product_item` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_requirement_product_item_id_product_requirement` FOREIGN KEY (`Id_product_requirement`) REFERENCES `product_requirement` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_customer` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_project_Id_customer_customer1` (`Id_customer`),
  CONSTRAINT `fk_project_Id_customer_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_contact`
--

DROP TABLE IF EXISTS `project_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_contact` (
  `Id_project` int(11) NOT NULL,
  `Id_contact` int(11) NOT NULL,
  PRIMARY KEY (`Id_project`,`Id_contact`),
  KEY `fk_project_contact_id_contact` (`Id_contact`),
  KEY `fk_project_contact_id_project` (`Id_project`),
  CONSTRAINT `fk_project_contact_id_contact` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_project_contact_id_project` FOREIGN KEY (`Id_project`) REFERENCES `project` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purchase_order`
--

DROP TABLE IF EXISTS `purchase_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_supplier` int(11) NOT NULL,
  `Id_shipping_parameter` int(11) NOT NULL,
  `date_creation` timestamp NULL DEFAULT NULL,
  `Id_purchase_order_state` int(11) NOT NULL,
  `Id_importer` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_purchase_order_Id_supplier_supplier1` (`Id_supplier`),
  KEY `fk_purchase_order_purchase_order_state1` (`Id_purchase_order_state`),
  KEY `fk_purchase_order_shipping_parameter1` (`Id_shipping_parameter`),
  KEY `fk_purchase_order_importer1` (`Id_importer`),
  CONSTRAINT `fk_purchase_order_Id_supplier_supplier1` FOREIGN KEY (`Id_supplier`) REFERENCES `supplier` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_order_importer1` FOREIGN KEY (`Id_importer`) REFERENCES `importer` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_order_purchase_order_state1` FOREIGN KEY (`Id_purchase_order_state`) REFERENCES `purchase_order_state` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_order_shipping_parameter1` FOREIGN KEY (`Id_shipping_parameter`) REFERENCES `shipping_parameter` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purchase_order_item`
--

DROP TABLE IF EXISTS `purchase_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order_item` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_purchase_order` int(11) NOT NULL,
  `price_with_shipping` decimal(10,0) DEFAULT NULL,
  `price_purchase` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_purchase_order_item_Id_purchase_order_purchase_order1` (`Id_purchase_order`),
  CONSTRAINT `fk_purchase_order_item_Id_purchase_order_purchase_order1` FOREIGN KEY (`Id_purchase_order`) REFERENCES `purchase_order` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purchase_order_state`
--

DROP TABLE IF EXISTS `purchase_order_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order_state` (
  `Id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_area`
--

DROP TABLE IF EXISTS `service_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_area` (
  `Id_service` int(11) NOT NULL,
  `Id_area` int(11) NOT NULL,
  PRIMARY KEY (`Id_service`,`Id_area`),
  KEY `fk_Service_area_area1` (`Id_area`),
  KEY `fk_Service_area_Service1` (`Id_service`),
  CONSTRAINT `fk_Service_area_area1` FOREIGN KEY (`Id_area`) REFERENCES `area` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Service_area_Service1` FOREIGN KEY (`Id_service`) REFERENCES `service` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_category`
--

DROP TABLE IF EXISTS `service_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_category` (
  `Id_service` int(11) NOT NULL,
  `Id_category` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_service`,`Id_category`),
  KEY `fk_Service_category_category1` (`Id_category`),
  KEY `fk_Service_category_Service1` (`Id_service`),
  CONSTRAINT `fk_Service_category_category1` FOREIGN KEY (`Id_category`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Service_category_Service1` FOREIGN KEY (`Id_service`) REFERENCES `service` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shipping_parameter`
--

DROP TABLE IF EXISTS `shipping_parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_parameter` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `Id_importer` int(11) NOT NULL,
  `Id_shipping_parameter_air` int(11) NOT NULL,
  `Id_shipping_parameter_maritime` int(11) NOT NULL,
  `current` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `fk_shipping_parameter_importer1` (`Id_importer`),
  KEY `fk_shipping_parameter_shipping_parameter_air1` (`Id_shipping_parameter_air`),
  KEY `fk_shipping_parameter_shipping_parameter_maritime1` (`Id_shipping_parameter_maritime`),
  CONSTRAINT `fk_shipping_parameter_importer1` FOREIGN KEY (`Id_importer`) REFERENCES `importer` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_shipping_parameter_shipping_parameter_air1` FOREIGN KEY (`Id_shipping_parameter_air`) REFERENCES `shipping_parameter_air` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_shipping_parameter_shipping_parameter_maritime1` FOREIGN KEY (`Id_shipping_parameter_maritime`) REFERENCES `shipping_parameter_maritime` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shipping_parameter_air`
--

DROP TABLE IF EXISTS `shipping_parameter_air`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_parameter_air` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cost_measurement_unit` double DEFAULT '0',
  `Id_measurement_unit_cost` int(11) NOT NULL,
  `weight_max` float DEFAULT '0',
  `length_max` float DEFAULT '0',
  `width_max` float DEFAULT '0',
  `height_max` float DEFAULT '0',
  `volume_max` float DEFAULT '0',
  `Id_measurement_unit_sizes_max` int(11) NOT NULL,
  `days` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_shipping_parameter_air_measurement_unit1` (`Id_measurement_unit_cost`),
  KEY `fk_shipping_parameter_air_measurement_unit2` (`Id_measurement_unit_sizes_max`),
  CONSTRAINT `fk_shipping_parameter_air_measurement_unit1` FOREIGN KEY (`Id_measurement_unit_cost`) REFERENCES `measurement_unit` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_shipping_parameter_air_measurement_unit2` FOREIGN KEY (`Id_measurement_unit_sizes_max`) REFERENCES `measurement_unit` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shipping_parameter_maritime`
--

DROP TABLE IF EXISTS `shipping_parameter_maritime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_parameter_maritime` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cost_measurement_unit` double DEFAULT '0',
  `Id_measurement_unit_cost` int(11) NOT NULL,
  `days` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_shipping_parameter_maritime_measurement_unit1` (`Id_measurement_unit_cost`),
  CONSTRAINT `fk_shipping_parameter_maritime_measurement_unit1` FOREIGN KEY (`Id_measurement_unit_cost`) REFERENCES `measurement_unit` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(45) DEFAULT NULL,
  `Id_contact` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_supplier_contact1` (`Id_contact`),
  CONSTRAINT `fk_supplier_contact1` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `supplier_contact`
--

DROP TABLE IF EXISTS `supplier_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_contact` (
  `Id_supplier` int(11) NOT NULL,
  `Id_contact` int(11) NOT NULL,
  PRIMARY KEY (`Id_supplier`,`Id_contact`),
  KEY `fk_supplier_contact_Id_supplier_supplier1` (`Id_supplier`),
  KEY `fk_supplier_contact_id_contact_contact1` (`Id_contact`),
  CONSTRAINT `fk_supplier_contact_id_contact_contact1` FOREIGN KEY (`Id_contact`) REFERENCES `contact` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_supplier_contact_Id_supplier_supplier1` FOREIGN KEY (`Id_supplier`) REFERENCES `supplier` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tracking`
--

DROP TABLE IF EXISTS `tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracking` (
  `Id` int(11) NOT NULL,
  `date_movement` timestamp NULL DEFAULT NULL,
  `Id_budget` int(11) DEFAULT NULL,
  `version_number_budget` int(11) DEFAULT NULL,
  `Id_project` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_tracking_budget1` (`Id_budget`,`version_number_budget`),
  KEY `fk_tracking_project1` (`Id_project`),
  CONSTRAINT `fk_tracking_budget1` FOREIGN KEY (`Id_budget`, `version_number_budget`) REFERENCES `budget` (`Id`, `version_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tracking_project1` FOREIGN KEY (`Id_project`) REFERENCES `project` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tracking_item`
--

DROP TABLE IF EXISTS `tracking_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracking_item` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_product_item` int(11) NOT NULL,
  `Id_tracking` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_tracking_item_Id_product_item_product_item1` (`Id_product_item`),
  KEY `fk_tracking_item_tracking1` (`Id_tracking`),
  CONSTRAINT `fk_tracking_item_Id_product_item_product_item1` FOREIGN KEY (`Id_product_item`) REFERENCES `product_item` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tracking_item_tracking1` FOREIGN KEY (`Id_tracking`) REFERENCES `tracking` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Current Database: `green`
--

USE `green`;

--
-- Final view structure for view `cost`
--

/*!50001 DROP TABLE IF EXISTS `cost`*/;
/*!50001 DROP VIEW IF EXISTS `cost`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cost` AS select `pli`.`Id` AS `Id_priceListItem`,`pl`.`Id` AS `Id_priceList`,`p`.`Id` AS `Id_product`,`i`.`Id` AS `Id_importer`,`p`.`code` AS `code`,`p`.`weight` AS `weight`,(`spa`.`cost_measurement_unit` * `p`.`weight`) AS `cost_air`,((`p`.`length` * `p`.`height`) * `p`.`width`) AS `volume`,(((`spm`.`cost_measurement_unit` * `p`.`length`) * `p`.`height`) * `p`.`width`) AS `cost_maritime`,`p`.`msrp` AS `msrp`,`p`.`dealer_cost` AS `dealer_cost`,`p`.`profit_rate` AS `profit_rate`,(case when ((`p`.`dealer_cost` > 0) and ((((`spm`.`cost_measurement_unit` * `p`.`length`) * `p`.`height`) * `p`.`width`) > 0)) then (`p`.`dealer_cost` + (((`spm`.`cost_measurement_unit` * `p`.`length`) * `p`.`height`) * `p`.`width`)) when ((`p`.`msrp` > 0) and ((((`spm`.`cost_measurement_unit` * `p`.`length`) * `p`.`height`) * `p`.`width`) > 0)) then (`p`.`msrp` + (((`spm`.`cost_measurement_unit` * `p`.`length`) * `p`.`height`) * `p`.`width`)) else 0 end) AS `cost_maritime_final`,(case when ((`p`.`dealer_cost` > 0) and ((`spa`.`cost_measurement_unit` * `p`.`weight`) > 0)) then (`p`.`dealer_cost` + (`spa`.`cost_measurement_unit` * `p`.`weight`)) when ((`p`.`msrp` > 0) and ((`spa`.`cost_measurement_unit` * `p`.`weight`) > 0)) then (`p`.`msrp` + (`spa`.`cost_measurement_unit` * `p`.`weight`)) else 0 end) AS `cost_air_final` from (((`price_list_item` `pli` left join `price_list` `pl` on((`pli`.`Id_price_list` = `pl`.`Id`))) left join `product` `p` on((`pli`.`Id_product` = `p`.`Id`))) join (((`importer` `i` left join `shipping_parameter` `sp` on((`i`.`Id` = `sp`.`Id_importer`))) left join `shipping_parameter_air` `spa` on((`spa`.`Id` = `sp`.`Id_shipping_parameter_air`))) left join `shipping_parameter_maritime` `spm` on((`spm`.`Id` = `sp`.`Id_shipping_parameter_maritime`)))) where (`sp`.`current` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-30 11:45:37
