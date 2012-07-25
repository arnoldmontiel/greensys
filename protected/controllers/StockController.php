<?php

class StockController extends Controller
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
	public function actionView($id)
	{
		$modelStockItem = new StockItem('search');
		$modelStockItem->unsetAttributes();  // clear any default values
		if(isset($_GET['StockItem']))
		{
			$modelStockItem->attributes =$_GET['StockItem'];			
		}
		$modelStockItem->Id_stock = $id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'modelStockItem'=>$modelStockItem
		));
	}

	public function actionMoveStock($id)
	{
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
	
		$modelStockItem = new StockItem('search');
		$modelStockItem->unsetAttributes();  // clear any default values
		if(isset($_GET['StockItem']))
			$modelStockItem->attributes=$_GET['StockItem'];
		$modelStockItem->Id_stock = $id;
		
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];
	
		$this->render('moveStock',array(
				'model'=>$this->loadModel($id),
				'modelProduct'=>$modelProduct,
				'modelStockItem'=>$modelStockItem,
		));
	}
	
	public function actionAjaxDeleteStockItem($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			
			$model = StockItem::model()->findByPk($id);
			$transaction = $model->dbConnection->beginTransaction();
			try {
				ProductItem::model()->deleteAllByAttributes(array(
																	'Id_product'=>$model->Id_product,
																	'Id_stock'=>$model->Id_stock,
				));
				$model->delete();
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('moveStock'));
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionAjaxUpdateQuantity()
	{
		$idStockItem = isset($_POST['idStockItem'])?(int)$_POST['idStockItem']:null;
		$quantity = $_POST['quantity'];
		
		$stockItemInDB = StockItem::model()->findByPk($idStockItem);
		if(isset($stockItemInDB))
		{
			$transaction = $stockItemInDB->dbConnection->beginTransaction();
			try {
				//elimino todos los product item
				ProductItem::model()->deleteAllByAttributes(array(
																	'Id_product'=>$stockItemInDB->Id_product,
																	'Id_stock'=>$stockItemInDB->Id_stock,
				));
				//creo la cantidad necesaria
				for($i=0;$i<$quantity;$i++)
				{
					$this->createProductItem($stockItemInDB->Id_product, $stockItemInDB->Id_stock);
				}
					
				$stockItemInDB->attributes = array('quantity'=>(double) $quantity);
				$stockItemInDB->save();
				
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		return $stockItemInDB;
	
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Stock;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stock']))
		{
			$model->attributes=$_POST['Stock'];
			if($model->username=="")
			{
				$model->username= null;				
			}
			if($model->save())
				$this->redirect(array('moveStock','id'=>$model->Id));
		}
		
		$movementTypes = MovementType::model()->findAll();
		$projects = Project::model()->findAll();
		$users = User::model()->findAll();
		
		$this->render('create',array(
			'model'=>$model,
			'movementTypes'=>$movementTypes,
			'projects'=>$projects,
			'users'=>$users,
		));
	}

	public function actionAjaxMoveProductStock()
	{
	
		$idStock = isset($_GET['IdStock'])?$_GET['IdStock']:'';
		$idProduct = isset($_GET['IdProduct'])?(int)$_GET['IdProduct'][0]:'';
	
		if(!empty($idStock)&&!empty($idProduct))
		{
			$stockItemInDb = StockItem::model()->findByAttributes(array('Id_stock'=>(int) $idStock,'Id_product'=>(int)$idProduct));
			if($stockItemInDb==null)
			{				
				$stockItem = new StockItem();
				$transaction = $stockItem->dbConnection->beginTransaction();
				try {
					
					$stockItem->attributes = array('Id_stock'=>$idStock,
																	'Id_product'=>$idProduct,
																	'quantity'=>1,												
					);
					$stockItem->save();
					
					$this->createProductItem($idProduct, $idStock);					
					
					$transaction->commit();
				} catch (Exception $e) {
					$transaction->rollback();
				}
				
			}
			else
			{
				throw new CDbException('Item has already been added');
			}
		}
	
	}
	
	private function createProductItem($idProduct, $idStock)
	{
		$productItem = new ProductItem();
		$productItem->Id_product = $idProduct;
		$productItem->Id_stock = $idStock;
		$productItem->save();
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stock']))
		{
			$model->attributes=$_POST['Stock'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$movementTypes = MovementType::model()->findAll();
		$projects = Project::model()->findAll();
		$users = User::model()->findAll();
		
		$this->render('update',array(
			'model'=>$model,
			'movementTypes'=>$movementTypes,
			'projects'=>$projects,
			'users'=>$users,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

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
		$dataProvider=new CActiveDataProvider('Stock');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Stock('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Stock']))
			$model->attributes=$_GET['Stock'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Stock::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='stock-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
