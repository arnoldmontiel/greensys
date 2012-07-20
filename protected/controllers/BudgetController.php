<?php

class BudgetController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id, $version)
	{
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
		{
			$modelBudgetItem->attributes =$_GET['BudgetItem'];
		}
		
		//seteo el presupuesto y su version
		$modelBudgetItem->Id_budget = $id;
		$modelBudgetItem->version_number = $version;
		
		
		$this->render('view',array(
			'model'=>$this->loadModel($id, $version),
			'modelBudgetItem'=>$modelBudgetItem,
		));
	}

	public function actionViewVersion($id, $version)
	{
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
		{
			$modelBudgetItem->attributes =$_GET['BudgetItem'];
		}
	
		//seteo el presupuesto y su version
		$modelBudgetItem->Id_budget = $id;
		$modelBudgetItem->version_number = $version;
	
	
		$this->render('viewVersion',array(
				'model'=>$this->loadModel($id, $version),
				'modelBudgetItem'=>$modelBudgetItem,
		));
	}
	
	public function actionAdminAllVersion($id, $version)
	{
		$model=new Budget('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$model->attributes=$_GET['Budget'];

		$model->Id = $id;
		
		$this->render('adminAllVersion',array(
			'model'=>$model,
			'modelInstance'=>$this->loadModel($id, $version),
			'version'=>$version,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Budget;

		$modelBudgetState = BudgetState::model()->findAll();
		$modelProject = Project::model()->findAll();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Budget']))
		{
			//Genero el Id
			$model->Id = Budget::model()->count() + 1;
			
			//Solo para la creacion la version 1
			$model->version_number = 1;
			
			$model->attributes=$_POST['Budget'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id, 'version'=>$model->version_number));
		}
		
		$this->render('create',array(
			'model'=>$model,
			'modelBudgetState'=>$modelBudgetState,
			'modelProject'=>$modelProject,
		));
	}

	public function actionAjaxDeleteBudgetItem($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			BudgetItem::model()->deleteByPk($id);
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('addItem'));
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $version)
	{
		$model=$this->loadModel($id, $version);

		$modelBudgetState = BudgetState::model()->findAll();
		$modelProject = Project::model()->findAll();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Budget']))
		{
			$model->attributes=$_POST['Budget'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id, 'version'=>$model->version_number));
		}

		$this->render('update',array(
			'model'=>$model,
			'modelBudgetState'=>$modelBudgetState,
			'modelProject'=>$modelProject,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id, $version)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id, $version)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		
		$criteria->join = ',(SELECT Id, MAX(version_number) vn
				FROM budget
				GROUP BY Id) b2';
		
		$criteria->condition = 't.Id = b2.Id and t.version_number = b2.vn';
		
		$dataProvider=new CActiveDataProvider('Budget', array(
			'criteria'=>$criteria,
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Budget('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$model->attributes=$_GET['Budget'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAjaxSelect()
	{
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
	
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];
	
		$this->render('_filteredGrid',array(
					'modelProduct'=>$modelProduct,
					'idArea'=>1,
		));
	}
	
	public function actionAddItem($id, $version)
	{
		$model = $this->loadModel($id, $version);
		
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
		
		$priceListItemSale = new PriceListItem();
		$priceListItemSale->unsetAttributes();
		
		$areaProjects = AreaProject::model()->findAllByAttributes(array('Id_project'=>$model->Id_project));
		
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
			$modelBudgetItem->attributes=$_GET['BudgetItem'];

		$modelBudgetItem->Id_budget = $id;
		$modelBudgetItem->version_number = $version;
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];

		if(isset($_GET['PriceListItem'])){
			$priceListItemSale->attributes=$_GET['PriceListItem'];
		}

		if(isset($_GET['ProductSale']['Id'])){
			$priceListItemSale->Id_product=$_GET['ProductSale']['Id'];
		}

		$this->render('addItem',array(
					'model'=>$model,
					'modelProduct'=>$modelProduct,
					'modelBudgetItem'=>$modelBudgetItem,
					'priceListItemSale'=>$priceListItemSale,
					'areaProjects'=>$areaProjects,
		));
	}

	public function actionAjaxDinamicViewPopUp()
	{
		if(isset($_POST['Id_budget_item']) && isset($_POST['Id_area']) && isset($_POST['Id_product']))
		{
			$modelBudgetItem = new BudgetItem('search');
			$modelBudgetItem->unsetAttributes();  // clear any default values
			$modelBudgetItem->Id_budget_item = $_POST['Id_budget_item'];
			
			$modelProduct = Product::model()->findByPk($_POST['Id_product']);
		
			echo $this->renderPartial('_budgetItemChildren', array('idArea'=>$_POST['Id_area'],
																   'modelBudgetItem'=>$modelBudgetItem,
																   'canEdit'=>false,
																   'modelProduct'=>$modelProduct,));
			
		}
	}
	
	public function actionAjaxNewVersion()
	{

		$id = isset($_POST['id'])?$_POST['id']:'';
		$version = isset($_POST['version'])?$_POST['version']:'';
		$note = isset($_POST['note'])?$_POST['note']:'';
		
		$model = new Budget;
		$transaction = $model->dbConnection->beginTransaction();
		
		try {
			$previousModel = $this->loadModel($id, $version);
			$previousModel->note = $note;
			$previousModel->save();
			
			
			$model->attributes = $previousModel->attributes;
			$model->date_creation = new CDbExpression('NOW()');
			$model->version_number = $model->version_number + 1;
			$model->note = '';
			
			if($model->save())
			{
				$budgetItems = BudgetItem::model()->findAllByAttributes(array('Id_budget'=>$previousModel->Id, 'version_number'=>$previousModel->version_number));
				
				foreach($budgetItems as $item)
				{
					$modelBudgetItem = new BudgetItem;
					$modelBudgetItem->attributes = $item->attributes;
					$modelBudgetItem->version_number = $model->version_number;
					$modelBudgetItem->save();
				}
				
				$transaction->commit();				
			}
		} catch (Exception $e) {
			$transaction->rollback();
		}
		
	}
	
	public function actionAjaxAddBudgetItem()
	{
		$idPriceList = isset($_POST['IdPriceList'])?$_POST['IdPriceList']:'';
		$idProduct = isset($_POST['IdProduct'])?$_POST['IdProduct']:'';
		$idShippingType = isset($_POST['IdShippingType'])?$_POST['IdShippingType']:'';
		$idBudget = isset($_POST['IdBudget'])?$_POST['IdBudget']:'';
		$idVersion = isset($_POST['IdVersion'])?$_POST['IdVersion']:'';
		$idArea = isset($_POST['IdArea'])?$_POST['IdArea']:'';
				
		if(!empty($idPriceList)&&!empty($idProduct)&&!empty($idShippingType)&&!empty($idBudget)&&!empty($idVersion)&&!empty($idArea))
		{
			$modelPriceListItem = PriceListItem::model()->findByAttributes(array('Id_price_list'=>$idPriceList,'Id_product'=>$idProduct));
			
			$modelBudgetItem = new BudgetItem;
			$modelBudgetItem->Id_budget = $idBudget;
			$modelBudgetItem->Id_price_list = $idPriceList;
			$modelBudgetItem->Id_product = $idProduct;
			$modelBudgetItem->Id_shipping_type = $idShippingType;
			$modelBudgetItem->version_number = $idVersion;
			$modelBudgetItem->Id_area = $idArea;
			$modelBudgetItem->price = ($idShippingType==1)?$modelPriceListItem->maritime_cost:$modelPriceListItem->air_cost;
			$modelBudgetItem->save();
			
			$productGroups = ProductGroup::model()->findAllByAttributes(array('Id_product_parent'=>$idProduct));
			foreach($productGroups as $item)
			{
				for($index = 0; $index < $item->quantity; $index++)
				{
					$modelPriceListItem = PriceListItem::model()->findByAttributes(array('Id_price_list'=>$idPriceList,'Id_product'=>$item->Id_product_child));
					
					$modelBudgetItemChild = new BudgetItem;
					$modelBudgetItemChild->Id_budget = $idBudget;
					$modelBudgetItemChild->Id_product = $item->Id_product_child;
					$modelBudgetItemChild->version_number = $idVersion;
					$modelBudgetItemChild->Id_budget_item = $modelBudgetItem->Id;
					$modelBudgetItemChild->Id_area = $idArea;
					$modelBudgetItemChild->price = 0;
					$modelBudgetItemChild->save();
				}
			}
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id, $version)
	{
		$model=Budget::model()->findByPk(array('Id'=>$id,'version_number'=>$version));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='budget-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}