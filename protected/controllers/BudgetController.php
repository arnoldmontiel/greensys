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
		$dataProvider=new CActiveDataProvider('Budget');
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

	public function actionAddItem($id, $version)
	{
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
		
		$priceListItemSale = new PriceListItem();
		$priceListItemSale->unsetAttributes();
		
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
			$modelBudgetItem->attributes=$_GET['BudgetItem'];

		$modelBudgetItem->Id_budget = $id;

		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];

		

		if(isset($_GET['ProductSale']['Id'])){
			$priceListItemSale->Id_product=$_GET['ProductSale']['Id'];
		}

		$this->render('addItem',array(
					'model'=>$this->loadModel($id, $version),
					'modelProduct'=>$modelProduct,
					'modelBudgetItem'=>$modelBudgetItem,
					'priceListItemSale'=>$priceListItemSale,
		));
	}

	public function actionAjaxAddBudgetItem()
	{
		$idPriceList = isset($_POST['IdPriceList'])?$_POST['IdPriceList']:'';
		$idProduct = isset($_POST['IdProduct'])?$_POST['IdProduct']:'';
		$idShippingType = isset($_POST['IdShippingType'])?$_POST['IdShippingType']:'';
		$idBudget = isset($_POST['IdBudget'])?$_POST['IdBudget']:'';
		$idVersion = isset($_POST['IdVersion'])?$_POST['IdVersion']:'';
				
		if(!empty($idPriceList)&&!empty($idProduct)&&!empty($idShippingType)&&!empty($idBudget)&&!empty($idVersion))
		{
			$modelPriceListItem = PriceListItem::model()->findByAttributes(array('Id_price_list'=>$idPriceList,'Id_product'=>$idProduct));
			
			$modelBudgetItem = new BudgetItem;
			$modelBudgetItem->Id_budget = $idBudget;
			$modelBudgetItem->Id_price_list = $idPriceList;
			$modelBudgetItem->Id_product = $idProduct;
			$modelBudgetItem->Id_shipping_type = $idShippingType;
			$modelBudgetItem->version_number = $idVersion;
			$modelBudgetItem->price = ($idShippingType==1)?$modelPriceListItem->maritime_cost:$modelPriceListItem->air_cost;
			$modelBudgetItem->save();
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
