
USE `green`;

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (5,'en_us','english','united state'),(6,'es_ar','spanish','argentina');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;
