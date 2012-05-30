
USE `green`;

LOCK TABLES `price_list_type` WRITE;
/*!40000 ALTER TABLE `price_list_type` DISABLE KEYS */;
INSERT INTO `price_list_type` VALUES (1,'Compra'),(2,'Venta');
/*!40000 ALTER TABLE `price_list_type` ENABLE KEYS */;
UNLOCK TABLES;
