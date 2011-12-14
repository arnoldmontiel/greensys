<?php

class ProductController extends Controller
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
				'actions'=>array('@'),
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
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
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

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
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
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionProductGroup()
	{
		$model=new Product('search');
		if(isset($_GET['ProductGroup']))
		$model->attributes=$_GET['ProductGroup'];
		
		// Uncomment the following line if AJAX validation is needed
		$dataProvider=new CActiveDataProvider('Product');
		$dataProviderCategory=new CActiveDataProvider('Category');
		
		$this->render('productGroup',array(
						'dataProvider'=>$dataProvider,
						'model'=>$model //model for creation
		));
		
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function actionAjaxFillProductGroup()
	{
		$data=ProductGroup::model()->findAll('id_product_parent=:parent_id',
		array(':parent_id'=>(int) $_POST['Product']['Id']));
	
	
		foreach($data as $item)
		{
			for ($i = 0; $i < $item->quantity; $i++) {
				echo CHtml::tag('li',
				array('id'=>"items_".$item->id_product_child,'class'=>'ui-state-default'),CHtml::encode($item->productChild->description_customer),true);
			}
		}
	}
	public function actionAjaxFillProducts()
	{
		$data=Product::model()->findAll('Id_category=:Id_category',
		array(':Id_category'=>(int) $_POST['Category']['Id']));
	
		$itemsProduct = CHtml::listData($data, 'Id', 'description_customer');
	
		$this->widget('ext.draglist.draglist', array(
						'id'=>'dlProduct',
						'items' => $itemsProduct,
						'options'=>array(
								'helper'=> 'clone',
								'connectToSortable'=>'#ddlAssigment',
		),
		));
	}
	/**
	* adds a new item into ProductArea table
	* @param new_product, should be "tag_id", ei. product_1
	* @param areaId, should be "id", ei. 2
	*/
	
	public function actionAjaxAddProductGroup()
	{
		$idProductParent = isset($_POST['IdProductParent'])?$_POST['IdProductParent']:'';
		$idProductChild = isset($_POST['IdProductChild'])?$_POST['IdProductChild']:'';
		$IdProductChildArray = explode("_",$idProductChild);
		$idProductChild = $IdProductChildArray[1];
			
		if(!empty($idProductParent)&&!empty($idProductChild))
		{
			$productGroupInDb = ProductGroup::model()->findByPk(array('id_product_parent'=>(int) $idProductParent,'id_product_child'=>(int)$idProductChild));
			if($productGroupInDb==null)
			{
				$productGroup=new ProductGroup;
				$productGroup->attributes = array('id_product_parent'=>$idProductParent,'id_product_child'=>$idProductChild,'quantity'=>1);
				$productGroup->save();
			}
			else
			{
				$quantity = $productGroupInDb->quantity+1;
				$productGroupInDb->attributes = array('quantity'=>$quantity);
				$productGroupInDb->save();
			}
		}
	}
	public function actionAjaxRemoveProductGroup()
	{
		$idProductParent = isset($_POST['IdProductParent'])?$_POST['IdProductParent']:'';
		$idProductChild = isset($_POST['IdProductChild'])?$_POST['IdProductChild']:'';
		$IdProductChildArray = explode("_",$idProductChild);
		$idProductChild = $IdProductChildArray[1];
			
		if(!empty($idProductParent)&&!empty($idProductChild))
		{
			$productGroupInDb = ProductGroup::model()->findByPk(array('id_product_parent'=>(int) $idProductParent,'id_product_child'=>(int)$idProductChild));
			if($productGroupInDb!=null)
			{
				if($productGroupInDb->quantity>1)
				{
					$productGroupInDb->attributes = array('quantity'=>$productGroupInDb->quantity-1);
					$productGroupInDb->save();
				}
				else
				{
					$productGroupInDb->delete();
				}
			}
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
