<?php

class CustomerController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
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
		$model=new Customer;
		$modelPerson = new Person;
		$modelContact = new Contact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Person']) && isset($_POST['Contact']))
		{
			$modelPerson->attributes=$_POST['Person'];
			$modelContact->attributes=$_POST['Contact'];
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if( $modelPerson->save() && $modelContact->save()){
					
					$model->Id_person = $modelPerson->Id;
					$model->Id_contact = $modelContact->Id;
					
					//save links
					if(isset($_POST['links'])){
						$this->saveLinks($_POST['links'], $modelContact);
					}
					
					if($model->save()){
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
			'modelPerson'=>$modelPerson,
			'modelContact'=>$modelContact
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
		$modelPerson = Person::model()->findByPk($model->Id_person);
		$modelContact = Contact::model()->findByPk($model->Id_contact);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		if(isset($_POST['Person']) && isset($_POST['Contact']))
		{
			$modelPerson->attributes=$_POST['Person'];
			$modelContact->attributes=$_POST['Contact'];
				
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if( $modelPerson->save() && $modelContact->save()){
					
					//save links
					if(isset($_POST['links'])){
						$this->saveLinks($_POST['links'], $modelContact);
					}
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->Id));
				}
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		
		
		$this->render('update',array(
			'model'=>$model,
			'modelPerson'=>$modelPerson,
			'modelContact'=>$modelContact
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
			$model = $this->loadModel($id);
			$modelPerson = Person::model()->findByPk($model->Id_person);
			$modelContact = Contact::model()->findByPk($model->Id_contact);
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				
				//delete links
				$this->deleteLinks($modelContact->Id);
				$modelPerson->delete();
				$modelContact->delete();
				
				// we only allow deletion via POST request
				$model->delete();
				
				$transaction->commit();
				
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

	private function saveLinks($links, $model)
	{
		$this->deleteLinks($model->Id);
	
		$entity = EntityType::model()->findByAttributes(array('name'=>get_class($model)));
		foreach ($links as $link){
			$hyperlink = new Hyperlink;
			$hyperlink->attributes = array(
								'description'=>$link,
								'Id_entity_type'=>$entity->Id,
								'Id_contact'=>$model->Id);
				
			$hyperlink->save();
		}
	}
	
	private function deleteLinks($id)
	{
		Hyperlink::model()->deleteAllByAttributes(array('Id_contact'=>$id));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Customer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

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
		$model=Customer::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
