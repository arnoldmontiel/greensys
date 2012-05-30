
USE `green`;

LOCK TABLES `entity_type` WRITE;
/*!40000 ALTER TABLE `entity_type` DISABLE KEYS */;
INSERT INTO `entity_type` VALUES (1,'Multimedia'),(2,'Area'),(3,'Product'),(4,'Contact'),(5,'ProductRequirement'),(6,'Supplier'),(7,'Customer');
/*!40000 ALTER TABLE `entity_type` ENABLE KEYS */;
UNLOCK TABLES;

