<?php

class SupplierController extends Controller
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
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$model->Id_contact,'Id_entity_type'=>$this->getEntityType()));
		$this->render('view',array(
			'model'=>$model,
			'modelHyperlink'=>$modelHyperlink
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Supplier;
		$modelContact = new Contact;
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>$this->getEntityType()));
		

		if(isset($_POST['Supplier']) && isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Supplier'];
			$modelContact->attributes=$_POST['Contact'];
				
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if($modelContact->save()){
						
					$model->Id_contact = $modelContact->Id;
						
					//save links
					if(isset($_POST['links'])){
						$this->saveLinks($_POST['links'], $modelContact->Id);
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
			'modelContact'=>$modelContact,
			'modelHyperlink'=>$modelHyperlink
		));
	}

	private function saveLinks($links, $id)
	{
		$this->deleteLinks($id);
	
		foreach ($links as $link){
			$hyperlink = new Hyperlink;
			$hyperlink->attributes = array(
								'description'=>$link,
								'Id_entity_type'=>$this->getEntityType(),
								'Id_contact'=>$id);
				
			$hyperlink->save();
		}
	}
	
	private function deleteLinks($id)
	{
		Hyperlink::model()->deleteAllByAttributes(array('Id_contact'=>$id,'Id_entity_type'=>$this->getEntityType()));
	}
	
	public function getEntityType()
	{
		return EntityType::model()->findByAttributes(array('name'=>get_class(Supplier::model())))->Id;
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelContact = Contact::model()->findByPk($model->Id_contact);
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>$this->getEntityType()));

		if(isset($_POST['Supplier']) && isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Supplier'];
			$modelContact->attributes=$_POST['Contact'];
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if( $model->save() && $modelContact->save()){
						
					//save links
					if(isset($_POST['links'])){
						$this->saveLinks($_POST['links'], $modelContact->Id);
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
			'modelContact'=>$modelContact,
			'modelHyperlink'=>$modelHyperlink
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
			$modelContact = Contact::model()->findByPk($model->Id_contact);
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
			
				//delete links
				$this->deleteLinks($modelContact->Id);
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Supplier');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Supplier('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Supplier']))
			$model->attributes=$_GET['Supplier'];

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
		$model=Supplier::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
	public function actionAjaxAddContact($id)
	{
  		$this->redirect(array('contact/createContact','modelRelName'=>get_class(Supplier::model()), 'id'=> $id, 'viewField'=>'business_name'));
	}
	
	public function actionAjaxViewContact($id)
	{
		$this->redirect(array('contact/adminContact','modelRelName'=>get_class(Supplier::model()), 'id'=> $id, 'viewField'=>'business_name'));
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='supplier-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
