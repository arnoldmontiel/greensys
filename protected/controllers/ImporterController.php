<?php

class ImporterController extends Controller
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
		$model = $this->loadModel($id);
		$this->render('view',array(
			'model'=>$model,
			'modelContact'=>$this->loadModelContact($model->Id_contact),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Importer;
		$modelContact=new Contact;
		$modelShippingParameter =  new ShippingParameter;
		$modelShippingParameterAir = new ShippingParameterAir;
		$modelShippingParameterMaritime = new ShippingParameterMaritime;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Importer'])&&isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Importer'];
			$modelContact->attributes=$_POST['Contact'];
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if($modelContact->save())
				{
					$model->Id_contact = $modelContact->Id; 
					if($model->save())
					{
						$transaction->commit();
						$this->redirect(array('view','id'=>$model->Id));
					}
				}				
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		
		$this->render('create',array(
			'model'=>$model,
			'modelContact'=>$modelContact,
			'modelShippingParameterMaritime'=>$modelShippingParameterMaritime,
			'modelShippingParameterAir'=>$modelShippingParameterAir,
			'modelShippingParameter'=>$modelShippingParameter,		
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
		$modelContact=$this->loadModelContact($model->Id_contact);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Importer'])&&isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Importer'];
			$modelContact->attributes=$_POST['Contact'];
			$transaction = $model->dbConnection->beginTransaction();
			try 
			{
				if($model->save()&&$modelContact->save())
				{
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->Id));
				}					
					
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelContact'=>$modelContact,
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
			$transaction = $model->dbConnection->beginTransaction();

			try {
				// we only allow deletion via POST request
				$model = $this->loadModel($id);
				$modelContact = $this->loadModelContact($model->Id_contact);

				if($model->delete() && $modelContact->delete())
				{
					$transaction->commit();						
				}				
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				
			} catch (Exception $e) {
				$transaction->rollback();				
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Importer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Importer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Importer']))
			$model->attributes=$_GET['Importer'];

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
		$model=Importer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModelContact($id)
	{
		$model=Contact::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='importer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
