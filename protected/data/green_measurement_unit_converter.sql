CREATE DATABASE  IF NOT EXISTS `green` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `green`;
-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: arnold-pc    Database: green
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
-- Dumping data for table `measurement_unit_converter`
--

LOCK TABLES `measurement_unit_converter` WRITE;
/*!40000 ALTER TABLE `measurement_unit_converter` DISABLE KEYS */;
INSERT INTO `measurement_unit_converter` VALUES (1,7,3,1.6387064e-005),(2,3,3,1),(3,2,1,0.45359237),(4,1,1,1);
/*!40000 ALTER TABLE `measurement_unit_converter` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-02-28  9:04:41
