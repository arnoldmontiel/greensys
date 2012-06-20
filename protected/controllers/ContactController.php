<?php

class ContactController extends Controller
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
		$model=new Contact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionAjaxCreate()
	{
		$model=new Contact;
	
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
	
		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
			if($model->save())
				echo json_encode($model->attributes);
		}
	}
	
	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionAjaxCreateContact($modelRelName, $id, $viewField)
	{

		if(isset($_POST['Cancel']))
			$this->redirect(array(strtolower($modelRelName) .'/view','id'=>$id));
		
		$newModel = $modelRelName . get_class(Contact::model());
  		$modelRelated=new $newModel;
		
		$model=new Contact;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Contact']) && !isset($_POST['Cancel']))
		{
			$model->attributes=$_POST['Contact'];
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if($model->save()){
					$modelRelated->Id_contact = $model->Id;
					$field = "Id_".strtolower($modelRelName);
					$modelRelated->$field = $id;
					$modelRelated->save();
					
					$transaction->commit();
					$this->redirect(array(strtolower($modelRelName) .'/view','id'=>$id));
				}	
			} catch (Exception $e) {
				$transaction->rollback();
			}
 			
		}
		
		$this->render('create',array(
				'model'=>$model,
				'modelRelName'=>$modelRelName,
				'viewField'=>$viewField,
				'id'=>$id
		));
	}
	
	public function actionAjaxAdminContact($modelRelName, $id, $viewField)
	{
		
		$newModel = $modelRelName . get_class(Contact::model());
 		$field = "Id_".strtolower($modelRelName);

 		$model = new $newModel('search');

 		$model->$field = $id;

 		if(isset($_GET[$newModel]))
 			$model->attributes = $_GET[$newModel]; 
		
 		
		$this->render('admin',array(
				'model'=>$model,
				'modelRelName'=>$modelRelName,
				'id'=>$id,
				'viewField'=>$viewField
		));
	}
	
	public function actionAjaxBackPrevious($modelRelName, $id)
	{
		$this->redirect(array(strtolower($modelRelName) .'/view','id'=>$id));
	}
	
	public function actionAjaxRemoveContact()
	{
		$id = isset($_GET['id'])?$_GET['id']:'';
		$idContact = isset($_GET['idContact'])?$_GET['idContact']:'';
		$modelRelName = isset($_GET['relation'])?$_GET['relation']:'';
			
		if(!empty($id)&&!empty($idContact))
		{
			$newModel = $modelRelName . get_class(Contact::model());
			$field = "Id_".strtolower($modelRelName);
			$model = new $newModel;
			
			$modelDb = $model->findByPk(array('Id_contact'=>(int)$idContact, $field=>(int)$id));
			 
			$contactInDb = Contact::model()->findByPk($idContact);
			
			if($contactInDb!=null && $modelDb!=null)
			{
				$transaction = $contactInDb->dbConnection->beginTransaction();
				try {
					$modelDb->delete();
					$contactInDb->delete();
					$transaction->commit();
				} catch (Exception $e) {
					$transaction->rollback();
				}
			}
		}
	}
	
	public function actionAjaxViewContact()
	{
		$id = isset($_GET['id'])?$_GET['id']:'';
		$idContact = isset($_GET['idContact'])?$_GET['idContact']:'';
		$modelRelName = isset($_GET['modelRelName'])?$_GET['modelRelName']:'';
		$viewField = isset($_GET['viewField'])?$_GET['viewField']:'';

		$this->render('view',array(
				'model'=>$this->loadModel($idContact),
				'modelRelName'=>$modelRelName,
				'id'=>$id,
				'viewField'=>$viewField
		));
	}
	
	public function actionAjaxUpdateContact()
	{	
		$id = isset($_GET['id'])?$_GET['id']:'';
		$idContact = isset($_GET['idContact'])?$_GET['idContact']:'';
		$modelRelName = isset($_GET['modelRelName'])?$_GET['modelRelName']:'';
		$viewField = isset($_GET['viewField'])?$_GET['viewField']:'';
		
		if(isset($_POST['Cancel']))
			$this->redirect(array('contact/AjaxAdminContact','modelRelName'=>$modelRelName, 'id'=> $id, 'viewField'=>$viewField));
		
		$model=$this->loadModel($idContact);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
			if($model->save())
				$this->redirect(array('contact/AjaxViewContact', 'id'=>$id, 'idContact'=>$idContact, 'modelRelName'=>$modelRelName,'viewField'=>$viewField));
		}
	
		$this->render('update',array(
				'model'=>$model,
				'modelRelName'=>$modelRelName,
				'id'=>$id,
				'idContact'=>$idContact,
				'viewField'=>$viewField
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

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
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
		$dataProvider=new CActiveDataProvider('Contact');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contact']))
			$model->attributes=$_GET['Contact'];

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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
