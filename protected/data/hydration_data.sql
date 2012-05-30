USE `green`;

LOCK TABLES `entity_type` WRITE;
/*!40000 ALTER TABLE `entity_type` DISABLE KEYS */;
INSERT INTO `entity_type` VALUES (1,'Multimedia'),(2,'Area'),(3,'Product'),(4,'Contact'),(5,'ProductRequirement'),(6,'Supplier'),(7,'Customer');
/*!40000 ALTER TABLE `entity_type` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (5,'en_us','english','united state'),(6,'es_ar','spanish','argentina');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `measurement_type` WRITE;
/*!40000 ALTER TABLE `measurement_type` DISABLE KEYS */;
INSERT INTO `measurement_type` VALUES (1,'volume'),(2,'weight'),(3,'linear');
/*!40000 ALTER TABLE `measurement_type` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `measurement_unit` WRITE;
/*!40000 ALTER TABLE `measurement_unit` DISABLE KEYS */;
INSERT INTO `measurement_unit` VALUES (1,'kilograms','kg',2),(2,'pounds','lb',2),(3,'cubic meter','m3',1),(4,'linear meter','ml',3),(5,'inches','in',3),(7,'cubic inch','in3',1),(8,'feet','ft',3);
/*!40000 ALTER TABLE `measurement_unit` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `measurement_unit_converter` WRITE;
/*!40000 ALTER TABLE `measurement_unit_converter` DISABLE KEYS */;
INSERT INTO `measurement_unit_converter` VALUES (1,7,3,1.6387064e-005),(2,3,3,1),(3,2,1,0.45359237),(4,1,1,1);
/*!40000 ALTER TABLE `measurement_unit_converter` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `multimedia_type` WRITE;
/*!40000 ALTER TABLE `multimedia_type` DISABLE KEYS */;
INSERT INTO `multimedia_type` VALUES (1,'Image'),(2,'Video'),(3,'PDF'),(4,'Autocad'),(5,'Word'),(6,'Excel');
/*!40000 ALTER TABLE `multimedia_type` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `price_list_type` WRITE;
/*!40000 ALTER TABLE `price_list_type` DISABLE KEYS */;
INSERT INTO `price_list_type` VALUES (1,'Compra'),(2,'Venta');
/*!40000 ALTER TABLE `price_list_type` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;


LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','admin','pmainieri@gruposmartliving.com'),('ssantoni','ssantoni','ssantoni@smartliving.com');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES ('BrandCreate',0,'Create Brands','','s:0:\"\";'),('BrandUpdate',0,'','','s:0:\"\";'),('BrandAdmin',0,'','','s:0:\"\";'),('BrandIndex',0,'','','s:0:\"\";'),('BrandView',0,'','','s:0:\"\";'),('BrandManage',1,'','','s:0:\"\";'),('Administrator',2,'','','s:0:\"\";'),('BrandDelete',0,'','','s:0:\"\";'),('SiteIndex',0,'','','s:0:\"\";'),('SiteManage',1,'','','s:0:\"\";'),('SupplierCreate',0,'','','s:0:\"\";'),('SupplierDelete',0,'','','s:0:\"\";'),('SupplierAdmin',0,'','','s:0:\"\";'),('SupplierIndex',0,'','','s:0:\"\";'),('SupplierView',0,'','','s:0:\"\";'),('SupplierMagane',1,'','','s:0:\"\";'),('ProductProductRequirement',0,'','','s:0:\"\";'),('Authorizer',2,'','','s:0:\"\";'),('ProductProductGroup',0,'','','s:0:\"\";'),('ProductCreate',0,'','','s:0:\"\";'),('SupplierUpdate',0,'','','s:0:\"\";'),('ProductManage',1,'','','s:0:\"\";'),('CategoryAdmin',0,'','','s:0:\"\";'),('CategoryCreate',0,'','','s:0:\"\";'),('CategoryUpdate',0,'','','s:0:\"\";'),('CategoryDelete',0,'','','s:0:\"\";'),('CategoryView',0,'','','s:0:\"\";'),('ProductView',0,'','','s:0:\"\";'),('ProductAdmin',0,'','','s:0:\"\";'),('CategoryIndex',0,'','','s:0:\"\";'),('ProductUpdate',0,'','','s:0:\"\";'),('CategoryManage',1,'','','s:0:\"\";'),('ProductIndex',0,'','','s:0:\"\";'),('ProductDelete',0,'','','s:0:\"\";'),('PriceListManage',1,'','','s:0:\"\";'),('PriceListIndex',0,'','','s:0:\"\";'),('PriceListAdmin',0,'','','s:0:\"\";'),('PriceListCreate',0,'','','s:0:\"\";'),('PriceListPriceListItem',0,'','','s:0:\"\";'),('NomenclatorIndex',0,'','','s:0:\"\";'),('NomenclatorView',0,'','','s:0:\"\";'),('NomenclatorAdmin',0,'','','s:0:\"\";'),('PriceListUpdate',0,'','','s:0:\"\";'),('NomenclatorDelete',0,'','','s:0:\"\";'),('PriceListDelete',0,'','','s:0:\"\";'),('NomenclatorUpdate',0,'','','s:0:\"\";'),('NomenclatorCreate',0,'','','s:0:\"\";'),('NomenclatorManage',1,'','','s:0:\"\";'),('GuildAdmin',0,'','','s:0:\"\";'),('GuildView',0,'','','s:0:\"\";'),('GuildCreate',0,'','','s:0:\"\";'),('GuildDelete',0,'','','s:0:\"\";'),('GuildUpdate',0,'','','s:0:\"\";'),('GuildIndex',0,'','','s:0:\"\";'),('GuildManage',1,'','','s:0:\"\";'),('ImporterManage',1,'','','s:0:\"\";'),('ImporterAdmin',0,'','','s:0:\"\";'),('ImporterIndex',0,'','','s:0:\"\";'),('ImporterCreate',0,'','','s:0:\"\";'),('ImporterDelete',0,'','','s:0:\"\";'),('ImporterUpdate',0,'','','s:0:\"\";'),('ProductRequirementManage',1,'','','s:0:\"\";'),('ProductRequirementIndex',0,'','','s:0:\"\";'),('ProductRequirementAdmin',0,'','','s:0:\"\";'),('ProductRequirementCreate',0,'','','s:0:\"\";'),('ProductRequirementUpdate',0,'','','s:0:\"\";'),('ProductRequirementDelete',0,'','','s:0:\"\";'),('PriceListView',0,'','','s:0:\"\";'),('ProductRequirementView',0,'','','s:0:\"\";'),('ImporterView',0,'','','s:0:\"\";'),('AreaIndex',0,'','','s:0:\"\";'),('AreaAdmin',0,'','','s:0:\"\";'),('AreaView',0,'','','s:0:\"\";'),('AreaCreate',0,'','','s:0:\"\";'),('AreaDelete',0,'','','s:0:\"\";'),('AreaUpdate',0,'','','s:0:\"\";'),('AreaManage',1,'','','s:0:\"\";'),('ReportManage',1,'','','s:0:\"\";'),('AreaCategoryArea',0,'','','s:0:\"\";'),('CostIndex',0,'','','s:0:\"\";'),('BrandCreateNew',0,'','','s:0:\"\";'),('CategoryCreateNew',0,'','','s:0:\"\";'),('NomenclatorCreateNew',0,'','','s:0:\"\";'),('SupplierCreateNew',0,'','','s:0:\"\";'),('ProductCreateDependency',0,'','','s:0:\"\";'),('ProductRequirementCreateDependency',0,'','','s:0:\"\";'),('GuildCreateNew',0,'','','s:0:\"\";'),('MultimediaPreviewImage',0,'','','s:0:\"\";'),('MultimediaPreviewImageSmall',0,'','','s:0:\"\";'),('MultimediaManage',1,'','','s:0:\"\";'),('AdministrationManage',1,'','','s:0:\"\";'),('AdministrationViewMenu',0,'','','s:0:\"\";'),('UserView',0,'','','s:0:\"\";'),('UserAdmin',0,'','','s:0:\"\";'),('UserDelete',0,'','','s:0:\"\";'),('UserCreate',0,'','','s:0:\"\";'),('UserIndex',0,'','','s:0:\"\";'),('UserUpdate',0,'','','s:0:\"\";'),('UserManage',1,'','','s:0:\"\";'),('Operator',2,'','','s:0:\"\";'),('ServiceIndex',0,'','','s:0:\"\";'),('ServiceAdmin',0,'','','s:0:\"\";'),('ServiceView',0,'','','s:0:\"\";'),('ServiceCreate',0,'','','s:0:\"\";'),('ServiceUpdate',0,'','','s:0:\"\";'),('ServiceDelete',0,'','','s:0:\"\";'),('ServiceManage',1,'','','s:0:\"\";'),('ProjectManage',1,'','','s:0:\"\";'),('ProjectIndex',0,'','','s:0:\"\";'),('ProjectView',0,'','','s:0:\"\";'),('ProjectAdmin',0,'','','s:0:\"\";'),('ProjectCreate',0,'','','s:0:\"\";'),('ProjectUpdate',0,'','','s:0:\"\";'),('ProjectDelete',0,'','','s:0:\"\";'),('ProjectProjectArea',0,'','','s:0:\"\";'),('CustomerView',0,'','','s:0:\"\";'),('CustomerAdmin',0,'','','s:0:\"\";'),('CustomerIndex',0,'','','s:0:\"\";'),('CustomerCreate',0,'','','s:0:\"\";'),('CustomerUpdate',0,'','','s:0:\"\";'),('CustomerDelete',0,'','','s:0:\"\";'),('CustomerManage',1,'','','s:0:\"\";');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;
LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES ('Administrator','admin','','s:0:\"\";'),('Authorizer','admin','','s:0:\"\";'),('Operator','ssantoni','','s:0:\"\";');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

USE `green`;

LOCK TABLES `itemchildren` WRITE;
/*!40000 ALTER TABLE `itemchildren` DISABLE KEYS */;
INSERT INTO `itemchildren` VALUES ('AdministrationManage','AdministrationViewMenu'),('Administrator','AdministrationManage'),('Administrator','AreaManage'),('Administrator','BrandManage'),('Administrator','CategoryManage'),('Administrator','GuildManage'),('Administrator','ImporterManage'),('Administrator','MultimediaManage'),('Administrator','NomenclatorManage'),('Administrator','PriceListManage'),('Administrator','ProductManage'),('Administrator','ProductRequirementManage'),('Administrator','ReportManage'),('Administrator','ServiceManage'),('Administrator','SiteManage'),('Administrator','SupplierMagane'),('Administrator','UserManage'),('AreaManage','AreaAdmin'),('AreaManage','AreaCategoryArea'),('AreaManage','AreaCreate'),('AreaManage','AreaDelete'),('AreaManage','AreaIndex'),('AreaManage','AreaUpdate'),('AreaManage','AreaView'),('BrandManage','BrandAdmin'),('BrandManage','BrandCreate'),('BrandManage','BrandCreateNew'),('BrandManage','BrandDelete'),('BrandManage','BrandIndex'),('BrandManage','BrandUpdate'),('BrandManage','BrandView'),('CategoryManage','CategoryAdmin'),('CategoryManage','CategoryCreate'),('CategoryManage','CategoryCreateNew'),('CategoryManage','CategoryDelete'),('CategoryManage','CategoryIndex'),('CategoryManage','CategoryUpdate'),('CategoryManage','CategoryView'),('CustomerManage','CustomerAdmin'),('CustomerManage','CustomerCreate'),('CustomerManage','CustomerDelete'),('CustomerManage','CustomerIndex'),('CustomerManage','CustomerUpdate'),('CustomerManage','CustomerView'),('GuildManage','GuildAdmin'),('GuildManage','GuildCreate'),('GuildManage','GuildCreateNew'),('GuildManage','GuildDelete'),('GuildManage','GuildIndex'),('GuildManage','GuildUpdate'),('GuildManage','GuildView'),('ImporterManage','ImporterAdmin'),('ImporterManage','ImporterCreate'),('ImporterManage','ImporterDelete'),('ImporterManage','ImporterIndex'),('ImporterManage','ImporterUpdate'),('ImporterManage','ImporterView'),('MultimediaManage','MultimediaPreviewImage'),('MultimediaManage','MultimediaPreviewImageSmall'),('NomenclatorManage','NomenclatorAdmin'),('NomenclatorManage','NomenclatorCreate'),('NomenclatorManage','NomenclatorCreateNew'),('NomenclatorManage','NomenclatorDelete'),('NomenclatorManage','NomenclatorIndex'),('NomenclatorManage','NomenclatorUpdate'),('NomenclatorManage','NomenclatorView'),('Operator','AreaManage'),('Operator','BrandManage'),('Operator','CategoryManage'),('Operator','CustomerManage'),('Operator','GuildManage'),('Operator','ImporterManage'),('Operator','MultimediaManage'),('Operator','NomenclatorManage'),('Operator','PriceListManage'),('Operator','ProductManage'),('Operator','ProductRequirementManage'),('Operator','ProjectManage'),('Operator','ReportManage'),('Operator','ServiceManage'),('Operator','SiteManage'),('Operator','SupplierMagane'),('PriceListManage','PriceListAdmin'),('PriceListManage','PriceListCreate'),('PriceListManage','PriceListDelete'),('PriceListManage','PriceListIndex'),('PriceListManage','PriceListPriceListItem'),('PriceListManage','PriceListUpdate'),('PriceListManage','PriceListView'),('ProductManage','ProductAdmin'),('ProductManage','ProductCreate'),('ProductManage','ProductCreateDependency'),('ProductManage','ProductDelete'),('ProductManage','ProductIndex'),('ProductManage','ProductProductGroup'),('ProductManage','ProductProductRequirement'),('ProductManage','ProductUpdate'),('ProductManage','ProductView'),('ProductRequirementManage','ProductRequirementAdmin'),('ProductRequirementManage','ProductRequirementCreate'),('ProductRequirementManage','ProductRequirementCreateDependency'),('ProductRequirementManage','ProductRequirementDelete'),('ProductRequirementManage','ProductRequirementIndex'),('ProductRequirementManage','ProductRequirementUpdate'),('ProductRequirementManage','ProductRequirementView'),('ProjectManage','ProjectAdmin'),('ProjectManage','ProjectCreate'),('ProjectManage','ProjectDelete'),('ProjectManage','ProjectIndex'),('ProjectManage','ProjectProjectArea'),('ProjectManage','ProjectUpdate'),('ProjectManage','ProjectView'),('ReportManage','CostIndex'),('ServiceManage','ServiceAdmin'),('ServiceManage','ServiceCreate'),('ServiceManage','ServiceDelete'),('ServiceManage','ServiceIndex'),('ServiceManage','ServiceUpdate'),('ServiceManage','ServiceView'),('SiteManage','SiteIndex'),('SupplierMagane','SupplierAdmin'),('SupplierMagane','SupplierCreate'),('SupplierMagane','SupplierCreateNew'),('SupplierMagane','SupplierDelete'),('SupplierMagane','SupplierIndex'),('SupplierMagane','SupplierUpdate'),('SupplierMagane','SupplierView'),('UserManage','UserAdmin'),('UserManage','UserCreate'),('UserManage','UserDelete'),('UserManage','UserIndex'),('UserManage','UserUpdate'),('UserManage','UserView');
/*!40000 ALTER TABLE `itemchildren` ENABLE KEYS */;
UNLOCK TABLES;