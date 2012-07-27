CREATE DATABASE  IF NOT EXISTS `green` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `green`;
-- MySQL dump 10.13  Distrib 5.5.22, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: green
-- ------------------------------------------------------
-- Server version	5.5.22-0ubuntu1

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
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES ('SupplierMagane',1,'','','s:0:\"\";'),('SupplierIndex',0,'','','s:0:\"\";'),('SupplierView',0,'','','s:0:\"\";'),('SupplierAdmin',0,'','','s:0:\"\";'),('SupplierDelete',0,'','','s:0:\"\";'),('SupplierCreate',0,'','','s:0:\"\";'),('SiteIndex',0,'','','s:0:\"\";'),('SiteManage',1,'','','s:0:\"\";'),('BrandDelete',0,'','','s:0:\"\";'),('Administrator',2,'','','s:0:\"\";'),('BrandManage',1,'','','s:0:\"\";'),('BrandView',0,'','','s:0:\"\";'),('BrandIndex',0,'','','s:0:\"\";'),('BrandAdmin',0,'','','s:0:\"\";'),('BrandUpdate',0,'','','s:0:\"\";'),('BrandCreate',0,'Create Brands','','s:0:\"\";'),('ProductProductRequirement',0,'','','s:0:\"\";'),('Authorizer',2,'','','s:0:\"\";'),('ProductProductGroup',0,'','','s:0:\"\";'),('ProductCreate',0,'','','s:0:\"\";'),('SupplierUpdate',0,'','','s:0:\"\";'),('ProductManage',1,'','','s:0:\"\";'),('CategoryAdmin',0,'','','s:0:\"\";'),('CategoryCreate',0,'','','s:0:\"\";'),('CategoryUpdate',0,'','','s:0:\"\";'),('CategoryDelete',0,'','','s:0:\"\";'),
('CategoryView',0,'','','s:0:\"\";'),('ProductView',0,'','','s:0:\"\";'),('ProductAdmin',0,'','','s:0:\"\";'),('CategoryIndex',0,'','','s:0:\"\";'),('ProductUpdate',0,'','','s:0:\"\";'),('CategoryManage',1,'','','s:0:\"\";'),('ProductIndex',0,'','','s:0:\"\";'),('ProductDelete',0,'','','s:0:\"\";'),('PriceListManage',1,'','','s:0:\"\";'),('PriceListIndex',0,'','','s:0:\"\";'),('PriceListAdmin',0,'','','s:0:\"\";'),('PriceListCreate',0,'','','s:0:\"\";'),('PriceListPriceListItem',0,'','','s:0:\"\";'),('NomenclatorIndex',0,'','','s:0:\"\";'),('NomenclatorView',0,'','','s:0:\"\";'),('NomenclatorAdmin',0,'','','s:0:\"\";'),('PriceListUpdate',0,'','','s:0:\"\";'),('NomenclatorDelete',0,'','','s:0:\"\";'),('PriceListDelete',0,'','','s:0:\"\";'),('NomenclatorUpdate',0,'','','s:0:\"\";'),('NomenclatorCreate',0,'','','s:0:\"\";'),('NomenclatorManage',1,'','','s:0:\"\";'),('GuildAdmin',0,'','','s:0:\"\";'),('GuildView',0,'','','s:0:\"\";'),('GuildCreate',0,'','','s:0:\"\";'),('GuildDelete',0,'','','s:0:\"\";'),('
GuildUpdate',0,'','','s:0:\"\";'),('GuildIndex',0,'','','s:0:\"\";'),('GuildManage',1,'','','s:0:\"\";'),('ImporterManage',1,'','','s:0:\"\";'),('ImporterAdmin',0,'','','s:0:\"\";'),('ImporterIndex',0,'','','s:0:\"\";'),('ImporterCreate',0,'','','s:0:\"\";'),('ImporterDelete',0,'','','s:0:\"\";'),('ImporterUpdate',0,'','','s:0:\"\";'),('ProductRequirementManage',1,'','','s:0:\"\";'),('ProductRequirementIndex',0,'','','s:0:\"\";'),('ProductRequirementAdmin',0,'','','s:0:\"\";'),('ProductRequirementCreate',0,'','','s:0:\"\";'),('ProductRequirementUpdate',0,'','','s:0:\"\";'),('ProductRequirementDelete',0,'','','s:0:\"\";'),('PriceListView',0,'','','s:0:\"\";'),('ProductRequirementView',0,'','','s:0:\"\";'),('ImporterView',0,'','','s:0:\"\";'),('AreaIndex',0,'','','s:0:\"\";'),('AreaAdmin',0,'','','s:0:\"\";'),('AreaView',0,'','','s:0:\"\";'),('AreaCreate',0,'','','s:0:\"\";'),('AreaDelete',0,'','','s:0:\"\";'),('AreaUpdate',0,'','','s:0:\"\";'),('AreaManage',1,'','','s:0:\"\";'),('ReportManage',1,'','','s:0:\"\
";'),('AreaCategoryArea',0,'','','s:0:\"\";'),('CostIndex',0,'','','s:0:\"\";'),('BrandCreateNew',0,'','','s:0:\"\";'),('CategoryCreateNew',0,'','','s:0:\"\";'),('NomenclatorCreateNew',0,'','','s:0:\"\";'),('SupplierCreateNew',0,'','','s:0:\"\";'),('ProductCreateDependency',0,'','','s:0:\"\";'),('ProductRequirementCreateDependency',0,'','','s:0:\"\";'),('GuildCreateNew',0,'','','s:0:\"\";'),('MultimediaPreviewImage',0,'','','s:0:\"\";'),('MultimediaPreviewImageSmall',0,'','','s:0:\"\";'),('MultimediaManage',1,'','','s:0:\"\";'),('AdministrationManage',1,'','','s:0:\"\";'),('AdministrationViewMenu',0,'','','s:0:\"\";'),('UserView',0,'','','s:0:\"\";'),('UserAdmin',0,'','','s:0:\"\";'),('UserDelete',0,'','','s:0:\"\";'),('UserCreate',0,'','','s:0:\"\";'),('UserIndex',0,'','','s:0:\"\";'),('UserUpdate',0,'','','s:0:\"\";'),('UserManage',1,'','','s:0:\"\";'),('Operator',2,'','','s:0:\"\";'),('ServiceIndex',0,'','','s:0:\"\";'),('ServiceAdmin',0,'','','s:0:\"\";'),('ServiceView',0,'','','s:0:\"\";'),('
ServiceCreate',0,'','','s:0:\"\";'),('ServiceUpdate',0,'','','s:0:\"\";'),('ServiceDelete',0,'','','s:0:\"\";'),('ServiceManage',1,'','','s:0:\"\";'),('ProjectManage',1,'','','s:0:\"\";'),('ProjectIndex',0,'','','s:0:\"\";'),('ProjectView',0,'','','s:0:\"\";'),('ProjectAdmin',0,'','','s:0:\"\";'),('ProjectCreate',0,'','','s:0:\"\";'),('ProjectUpdate',0,'','','s:0:\"\";'),('ProjectDelete',0,'','','s:0:\"\";'),('ProjectProjectArea',0,'','','s:0:\"\";'),('CustomerView',0,'','','s:0:\"\";'),('CustomerAdmin',0,'','','s:0:\"\";'),('CustomerIndex',0,'','','s:0:\"\";'),('CustomerCreate',0,'','','s:0:\"\";'),('CustomerUpdate',0,'','','s:0:\"\";'),('CustomerDelete',0,'','','s:0:\"\";'),('CustomerManage',1,'','','s:0:\"\";'),('ProductRequirementUpdateMultimedia',0,'','','s:0:\"\";'),('SubCategoryManage',1,'','','s:0:\"\";'),('SubCategoryIndex',0,'','','s:0:\"\";'),('SubCategoryView',0,'','','s:0:\"\";'),('SubCategoryCreate',0,'','','s:0:\"\";'),('SubCategoryDelete',0,'','','s:0:\"\";'),('SubCategoryUpdate',0,'','','s:0:
\"\";'),('SubCategoryAdmin',0,'','','s:0:\"\";'),('ProductUpdateMultimedia',0,'','','s:0:\"\";'),('MovementTypeManage',1,'','','s:0:\"\";'),('MovementTypeIndex',0,'','','s:0:\"\";'),('MovementTypeView',0,'','','s:0:\"\";'),('MovementTypeCreate',0,'','','s:0:\"\";'),('MovementTypeUpdate',0,'','','s:0:\"\";'),('MovementTypeDelete',0,'','','s:0:\"\";'),('StockManage',1,'','','s:0:\"\";'),('StockIndex',0,'','','s:0:\"\";'),('StockView',0,'','','s:0:\"\";'),('StockCreate',0,'','','s:0:\"\";'),('StockUpdate',0,'','','s:0:\"\";'),('StockDelete',0,'','','s:0:\"\";'),('StockAdmin',0,'','','s:0:\"\";'),('MovementTypeAdmin',0,'','','s:0:\"\";'),('StockMoveStock',0,'','','s:0:\"\";'),('StockSummaryIndex',0,'','','s:0:\"\";'),('BudgetStateManage',1,'','','s:0:\"\";'),('BudgetStateIndex',0,'','','s:0:\"\";'),('BudgetStateView',0,'','','s:0:\"\";'),('BudgetStateAdmin',0,'','','s:0:\"\";'),('BudgetStateCreate',0,'','','s:0:\"\";'),('BudgetStateUpdate',0,'','','s:0:\"\";'),('BudgetStateDelete',0,'','','s:0:\"\";'),('
BudgetManage',1,'','','s:0:\"\";'),('BudgetIndex',0,'','','s:0:\"\";'),('BudgetView',0,'','','s:0:\"\";'),('BudgetAdmin',0,'','','s:0:\"\";'),('BudgetCreate',0,'','','s:0:\"\";'),('BudgetUpdate',0,'','','s:0:\"\";'),('BudgetDelete',0,'','','s:0:\"\";'),('BudgetItemManage',1,'','','s:0:\"\";'),('BudgetItemIndex',0,'','','s:0:\"\";'),('BudgetItemView',0,'','','s:0:\"\";'),('BudgetItemAdmin',0,'','','s:0:\"\";'),('BudgetItemCreate',0,'','','s:0:\"\";'),('BudgetItemUpdate',0,'','','s:0:\"\";'),('BudgetItemDelete',0,'','','s:0:\"\";'),('BudgetAddItem',0,'','','s:0:\"\";'),('AreaProductArea',0,'','','s:0:\"\";'),('BudgetAdminAllVersion',0,'','','s:0:\"\";'),('BudgetViewVersion',0,'','','s:0:\"\";'),('PurchaseOrderManage',1,'','','s:0:\"\";'),('PurchaseOrderAdmin',0,'','','s:0:\"\";'),('PurchaseOrderIndex',0,'','','s:0:\"\";'),('PurchaseOrderView',0,'','','s:0:\"\";'),('PurchaseOrderUpdate',0,'','','s:0:\"\";'),('PurchaseOrderCreate',0,'','','s:0:\"\";'),('PurchaseOrderDelete',0,'','','s:0:\"\";'),('
PurchaseOrderAssign',0,'','','s:0:\"\";');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-08  9:50:07
