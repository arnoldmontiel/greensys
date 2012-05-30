
USE `green`;

LOCK TABLES `measurement_unit` WRITE;
/*!40000 ALTER TABLE `measurement_unit` DISABLE KEYS */;
INSERT INTO `measurement_unit` VALUES (1,'kilograms','kg',2),(2,'pounds','lb',2),(3,'cubic meter','m3',1),(4,'linear meter','ml',3),(5,'inches','in',3),(7,'cubic inch','in3',1),(8,'feet','ft',3);
/*!40000 ALTER TABLE `measurement_unit` ENABLE KEYS */;
UNLOCK TABLES;
