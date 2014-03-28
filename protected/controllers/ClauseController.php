<?php

class ClauseController extends GController
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
			'postOnly + delete', // we only allow deletion via POST request
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=Clause::model()->findByPk(1);
		if(!isset($model))
		{
			$model = new Clause();
			$model->save();
		}
		
		$this->render('index',array('model'=>$model));
	}


	public function actionAjaxSave()
	{
		$description = (isset($_POST['description']))?$_POST['description']:'';
		$model = Clause::model()->findByPk(1);
		if(isset($model))
		{
			$model->description = $description;
			$model->save();
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Clause the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Clause::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Clause $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='clause-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
