<?php

class BrandController extends GController
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
		$model=new Brand;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Brand']))
		{
			$model->attributes=$_POST['Brand'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxCreate()
	{
		$model=new Brand;
	
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
	
		if(isset($_POST['Brand']))
		{
			$model->attributes=$_POST['Brand'];
			if($model->save())
				echo json_encode($model->attributes); 
		}
	}
	public function actionAjaxUpdate()
	{
		if(isset($_POST['Brand']['Id']))
		{
			$model=$this->loadModel($_POST['Brand']['Id']);
			
			if(isset($_POST['Brand']))
			{
				$model->attributes=$_POST['Brand'];
				if($model->save())
					echo json_encode($model->attributes);
			}
		}
	}
	public function actionAjaxShowCreateModal()
	{
		$model=new Brand;
		$field_caller ="";
		if($_POST['field_caller'])
			$field_caller=$_POST['field_caller'];
		// Uncomment the following line if AJAX validation is needed		
		$this->renderPartial('_formModal',array(
			'model'=>$model,
				'field_caller'=>$field_caller
		));
	}
	public function actionAjaxShowUpdateModal()
	{
		if(isset($_POST['id']))
		{
			$model=$this->loadModel($_POST['id']);
			$field_caller ="";
			if($_POST['field_caller'])
				$field_caller=$_POST['field_caller'];
			// Uncomment the following line if AJAX validation is needed
			$this->renderPartial('_formModal',array(
					'model'=>$model,
					'field_caller'=>$field_caller
			));				
		}
	}
	public function actionCreateNew($modelCaller)
	{
		$model=new Brand;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Brand']))
		{
			$model->attributes=$_POST['Brand'];
			if($model->save())
				$this->redirect(array($modelCaller.'/create'));
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

		if(isset($_POST['Brand']))
		{
			$model->attributes=$_POST['Brand'];
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAjaxDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$id = $_POST['id'];
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
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Brand('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Brand']))
			$model->attributes=$_GET['Brand'];

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
		$model=Brand::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='brand-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
