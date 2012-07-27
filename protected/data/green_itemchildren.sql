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
-- Dumping data for table `itemchildren`
--

LOCK TABLES `itemchildren` WRITE;
/*!40000 ALTER TABLE `itemchildren` DISABLE KEYS */;
INSERT INTO `itemchildren` VALUES ('AdministrationManage','AdministrationViewMenu'),('Administrator','AdministrationManage'),('Administrator','AreaManage'),('Administrator','BrandManage'),('Administrator','BudgetItemManage'),('Administrator','BudgetManage'),('Administrator','BudgetStateManage'),('Administrator','CategoryManage'),('Administrator','CustomerManage'),('Administrator','GuildManage'),('Administrator','ImporterManage'),('Administrator','MovementTypeManage'),('Administrator','MultimediaManage'),('Administrator','NomenclatorManage'),('Administrator','PriceListManage'),('Administrator','ProductManage'),('Administrator','ProductRequirementManage'),('Administrator','ProjectManage'),('Administrator','PurchaseOrderManage'),('Administrator','ReportManage'),('Administrator','ServiceManage'),('Administrator','SiteManage'),('Administrator','StockManage'),('Administrator','SubCategoryManage'),('Administrator','SupplierMagane'),('Administrator','UserManage'),('AreaManage','AreaAdmin'),('AreaManage','
AreaCategoryArea'),('AreaManage','AreaCreate'),('AreaManage','AreaDelete'),('AreaManage','AreaIndex'),('AreaManage','AreaProductArea'),('AreaManage','AreaUpdate'),('AreaManage','AreaView'),('BrandManage','BrandAdmin'),('BrandManage','BrandCreate'),('BrandManage','BrandCreateNew'),('BrandManage','BrandDelete'),('BrandManage','BrandIndex'),('BrandManage','BrandUpdate'),('BrandManage','BrandView'),('BudgetItemManage','BudgetItemAdmin'),('BudgetItemManage','BudgetItemCreate'),('BudgetItemManage','BudgetItemDelete'),('BudgetItemManage','BudgetItemIndex'),('BudgetItemManage','BudgetItemUpdate'),('BudgetItemManage','BudgetItemView'),('BudgetManage','BudgetAddItem'),('BudgetManage','BudgetAdmin'),('BudgetManage','BudgetAdminAllVersion'),('BudgetManage','BudgetCreate'),('BudgetManage','BudgetDelete'),('BudgetManage','BudgetIndex'),('BudgetManage','BudgetUpdate'),('BudgetManage','BudgetView'),('BudgetManage','BudgetViewVersion'),('BudgetStateManage','BudgetStateAdmin'),('BudgetStateManage','BudgetStateCreate'),('
BudgetStateManage','BudgetStateDelete'),('BudgetStateManage','BudgetStateIndex'),('BudgetStateManage','BudgetStateUpdate'),('BudgetStateManage','BudgetStateView'),('CategoryManage','CategoryAdmin'),('CategoryManage','CategoryCreate'),('CategoryManage','CategoryCreateNew'),('CategoryManage','CategoryDelete'),('CategoryManage','CategoryIndex'),('CategoryManage','CategoryUpdate'),('CategoryManage','CategoryView'),('CustomerManage','CustomerAdmin'),('CustomerManage','CustomerCreate'),('CustomerManage','CustomerDelete'),('CustomerManage','CustomerIndex'),('CustomerManage','CustomerUpdate'),('CustomerManage','CustomerView'),('GuildManage','GuildAdmin'),('GuildManage','GuildCreate'),('GuildManage','GuildCreateNew'),('GuildManage','GuildDelete'),('GuildManage','GuildIndex'),('GuildManage','GuildUpdate'),('GuildManage','GuildView'),('ImporterManage','ImporterAdmin'),('ImporterManage','ImporterCreate'),('ImporterManage','ImporterDelete'),('ImporterManage','ImporterIndex'),('ImporterManage','ImporterUpdate'),('
ImporterManage','ImporterView'),('MovementTypeManage','MovementTypeAdmin'),('MovementTypeManage','MovementTypeCreate'),('MovementTypeManage','MovementTypeDelete'),('MovementTypeManage','MovementTypeIndex'),('MovementTypeManage','MovementTypeUpdate'),('MovementTypeManage','MovementTypeView'),('MultimediaManage','MultimediaPreviewImage'),('MultimediaManage','MultimediaPreviewImageSmall'),('NomenclatorManage','NomenclatorAdmin'),('NomenclatorManage','NomenclatorCreate'),('NomenclatorManage','NomenclatorCreateNew'),('NomenclatorManage','NomenclatorDelete'),('NomenclatorManage','NomenclatorIndex'),('NomenclatorManage','NomenclatorUpdate'),('NomenclatorManage','NomenclatorView'),('Operator','AreaManage'),('Operator','BrandManage'),('Operator','BudgetItemManage'),('Operator','BudgetManage'),('Operator','BudgetStateManage'),('Operator','CategoryManage'),('Operator','CustomerManage'),('Operator','GuildManage'),('Operator','ImporterManage'),('Operator','MovementTypeManage'),('Operator','MultimediaManage'),('Operator','
NomenclatorManage'),('Operator','PriceListManage'),('Operator','ProductManage'),('Operator','ProductRequirementManage'),('Operator','ProjectManage'),('Operator','PurchaseOrderManage'),('Operator','ReportManage'),('Operator','ServiceManage'),('Operator','SiteManage'),('Operator','StockManage'),('Operator','SubCategoryManage'),('Operator','SupplierMagane'),('PriceListManage','PriceListAdmin'),('PriceListManage','PriceListCreate'),('PriceListManage','PriceListDelete'),('PriceListManage','PriceListIndex'),('PriceListManage','PriceListPriceListItem'),('PriceListManage','PriceListUpdate'),('PriceListManage','PriceListView'),('ProductManage','ProductAdmin'),('ProductManage','ProductCreate'),('ProductManage','ProductCreateDependency'),('ProductManage','ProductDelete'),('ProductManage','ProductIndex'),('ProductManage','ProductProductGroup'),('ProductManage','ProductProductRequirement'),('ProductManage','ProductUpdate'),('ProductManage','ProductUpdateMultimedia'),('ProductManage','ProductView'),('
ProductRequirementManage','ProductRequirementAdmin'),('ProductRequirementManage','ProductRequirementCreate'),('ProductRequirementManage','ProductRequirementCreateDependency'),('ProductRequirementManage','ProductRequirementDelete'),('ProductRequirementManage','ProductRequirementIndex'),('ProductRequirementManage','ProductRequirementUpdate'),('ProductRequirementManage','ProductRequirementUpdateMultimedia'),('ProductRequirementManage','ProductRequirementView'),('ProjectManage','ProjectAdmin'),('ProjectManage','ProjectCreate'),('ProjectManage','ProjectDelete'),('ProjectManage','ProjectIndex'),('ProjectManage','ProjectProjectArea'),('ProjectManage','ProjectUpdate'),('ProjectManage','ProjectView'),('PurchaseOrderManage','PurchaseOrderAdmin'),('PurchaseOrderManage','PurchaseOrderAssign'),('PurchaseOrderManage','PurchaseOrderCreate'),('PurchaseOrderManage','PurchaseOrderDelete'),('PurchaseOrderManage','PurchaseOrderIndex'),('PurchaseOrderManage','PurchaseOrderUpdate'),('PurchaseOrderManage','PurchaseOrderView'),('
ReportManage','CostIndex'),('ReportManage','StockSummaryIndex'),('ServiceManage','ServiceAdmin'),('ServiceManage','ServiceCreate'),('ServiceManage','ServiceDelete'),('ServiceManage','ServiceIndex'),('ServiceManage','ServiceUpdate'),('ServiceManage','ServiceView'),('SiteManage','SiteIndex'),('StockManage','StockAdmin'),('StockManage','StockCreate'),('StockManage','StockDelete'),('StockManage','StockIndex'),('StockManage','StockMoveStock'),('StockManage','StockUpdate'),('StockManage','StockView'),('SubCategoryMagane','SubCategoryAdmin'),('SubCategoryMagane','SubCategoryCreate'),('SubCategoryMagane','SubCategoryDelete'),('SubCategoryMagane','SubCategoryIndex'),('SubCategoryMagane','SubCategoryUpdate'),('SubCategoryMagane','SubCategoryView'),('SupplierMagane','SupplierAdmin'),('SupplierMagane','SupplierCreate'),('SupplierMagane','SupplierCreateNew'),('SupplierMagane','SupplierDelete'),('SupplierMagane','SupplierIndex'),('SupplierMagane','SupplierUpdate'),('SupplierMagane','SupplierView'),('UserManage','UserAdmin'
),('UserManage','UserCreate'),('UserManage','UserDelete'),('UserManage','UserIndex'),('UserManage','UserUpdate'),('UserManage','UserView');
/*!40000 ALTER TABLE `itemchildren` ENABLE KEYS */;
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
