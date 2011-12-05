<?php

class AreaController extends Controller
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Area;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Area']))
		{
			$model->attributes=$_POST['Area'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Area']))
		{
			$model->attributes=$_POST['Area'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Area');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Area('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Area']))
			$model->attributes=$_GET['Area'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionProductArea()
	{
		$cmodel=new Area;
		$model=new Area('search');
		if(isset($_GET['AreaProduct']))
		$model->attributes=$_GET['AreaProduct'];
	
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$dataProvider=new CActiveDataProvider('Area');
		$dataProviderProduct=new CActiveDataProvider('Product');

		$this->render('productArea',array(
				'dataProvider'=>$dataProvider,
				'dataProviderProduct'=>$dataProviderProduct,
				'model'=>$cmodel //model for creation
		));
	
	}
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Area::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionAjaxFillProductArea()
	{
		$data=ProductArea::model()->findAll('id_area=:parent_id',
		array(':parent_id'=>(int) $_POST['Area']['Id']));
	
	
		foreach($data as $item)
		{
			for ($i = 0; $i < $item->quantity; $i++) {
				echo CHtml::tag('li',
				array('id'=>"items_".$item->id_product),CHtml::encode($item->product->description_customer),true);
			}
		}
	}
	public function actionAjaxSaveProductArea()
	{

		parse_str($_POST['productId']);
		$areaId = $_POST['areaId'];

		$data=ProductArea::model()->findAll('id_area=:parent_id',
		array(':parent_id'=>(int) $areaId));
		
	
		foreach($data as $item)
		{
			$item->delete();
		}
		
		foreach($items as $productId)
		{
			$productAreaInDb = ProductArea::model()->findByPk(array('id_area'=>(int) $areaId,'id_product'=>(int)$productId));
			if($productAreaInDb==null)
			{
				$productArea=new ProductArea;
				$productArea->attributes = array('id_area'=>$areaId,'id_product'=>$productId,'quantity'=>1);
				$productArea->save();
			}
			else
			{
				$quantity = $productAreaInDb->quantity+1;				
				$productAreaInDb->attributes = array('quantity'=>$quantity);
				$productAreaInDb->save();
			}
		}		
	}	
	/**
	* adds a new item into ProductArea table
	* @param new_product, should be "tag_id", ei. product_1
	* @param areaId, should be "id", ei. 2
	*/
	
	public function actionAjaxAddProductArea()
	{
		$idArea = isset($_POST['areaId'])?$_POST['areaId']:'';
		$new_IdProduct = isset($_POST['new_IdProduct'])?$_POST['new_IdProduct']:'';
		$new_IdProduct = explode("_",$new_IdProduct);
		$idProduct = $new_IdProduct[1];

		if(!empty($idProduct)&&!empty($idArea))
		{
			$productAreaInDb = ProductArea::model()->findByPk(array('id_area'=>(int) $idArea,'id_product'=>(int)$idProduct));
			if($productAreaInDb==null)
			{
				$productArea=new ProductArea;
				$productArea->attributes = array('id_area'=>$idArea,'id_product'=>$idProduct,'quantity'=>1);
				$productArea->save();
			}
			else
			{
				$quantity = $productAreaInDb->quantity+1;				
				$productAreaInDb->attributes = array('quantity'=>$quantity);
				$productAreaInDb->save();
			}
		}		
	}	
	public function actionAjaxRemoveProductArea()
	{
		$idArea = isset($_POST['areaId'])?$_POST['areaId']:'';
		$new_IdProduct = isset($_POST['new_IdProduct'])?$_POST['new_IdProduct']:'';
		$new_IdProduct = explode("_",$new_IdProduct);
		$idProduct = $new_IdProduct[1];
				
		if(!empty($idProduct)&&!empty($idArea))
		{
			$productAreaInDb = ProductArea::model()->findByPk(array('id_area'=>(int) $idArea,'id_product'=>(int)$idProduct));
			if($productAreaInDb!=null)
			{
				$productArea->remove();
			}
		}
	}	
	public function actionAjaxTest()
	{
		$_POST;
		$_GET;
		
		$data=ProductArea::model()->findAll('id_area=:parent_id',
		array(':parent_id'=>1));
		$this->widget('ext.draglist.draglist', array(
																
																'id'=>'dlTest',
																'items'=>array('1'=>'hola','2'=>'groso','3'=>'sisi, lo sabes'),
																'options'=>array(
																	'helper'=> 'clone',
																	'connectToSortable'=>'#ddlAssigment',
		),
		));
	}
	public function actionAjaxFillCategoryArea()
	{
		$data=CategoryArea::model()->findAll('id_area=:parent_id',
		array(':parent_id'=>(int) $_POST['Area']['Id']));
	
	
		foreach($data as $item)
		{
			for ($i = 0; $i < $item->quantity; $i++) {
				echo CHtml::tag('li',
				array('id'=>"items_".$item->id_product),CHtml::encode($item->product->description_customer),true);
			}
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='area-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
