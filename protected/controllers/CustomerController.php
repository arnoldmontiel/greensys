<?php

class CustomerController extends GController
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
		$model=$this->loadModel($id);
		
		$this->render('view',array('model'=>$model));
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
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>$this->getEntityType()));

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
			'modelPerson'=>$modelPerson,
			'modelContact'=>$modelContact,
			'modelHyperlink'=>$modelHyperlink
		));
	}

	public function actionCreateNew($modelCaller)
	{
		$model=new Customer;
		$modelPerson = new Person;
		$modelContact = new Contact;
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>$this->getEntityType()));
	
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
						$this->saveLinks($_POST['links'], $modelContact->Id);
					}
						
					if($model->save()){
						$transaction->commit();
						$this->redirect(array($modelCaller.'/create'));
					}
				}
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	
		$this->render('create',array(
				'model'=>$model,
				'modelPerson'=>$modelPerson,
				'modelContact'=>$modelContact,
				'modelHyperlink'=>$modelHyperlink
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
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>$this->getEntityType()));
		
		if(isset($_POST['Person']) && isset($_POST['Contact']))
		{
			$modelPerson->attributes=$_POST['Person'];
			$modelContact->attributes=$_POST['Contact'];
				
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if( $modelPerson->save() && $modelContact->save()){
					
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
			'modelPerson'=>$modelPerson,
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
		return EntityType::model()->findByAttributes(array('name'=>get_class(Customer::model())))->Id;
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

	public function actionAjaxAddContact($id)
	{
		$this->redirect(array('contact/AjaxCreateContact','modelRelName'=>get_class(Customer::model()), 'id'=> $id, 'viewField'=> $this->loadModel($id)->person->last_name));
	}
	
	public function actionAjaxViewContact($id)
	{
		$this->redirect(array('contact/AjaxAdminContact','modelRelName'=>get_class(Customer::model()), 'id'=> $id, 'viewField'=> $this->loadModel($id)->person->last_name));
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
	
	public function actionAjaxOpenNewCustomer()
	{
		$modelCustomer=new Customer();
		$modelContact=new Contact();
		$modelPerson=new Person();
	
		echo $this->renderPartial('_modalFormCustomer', 
					array('modelCustomer'=>new Customer(),
					'modelContact'=>new Contact(),
					'modelPerson'=>new Person()),
					/*parametros extras para que funcione CJuiDatePicker*/
					false,true);
	}
	
	public function actionAjaxSaveNewCustomer()
	{	
		if(isset($_POST['Person'])&&isset($_POST['Contact']))
		{
			$modelCustomer=new Customer();
			$modelContact=new Contact();
			$modelPerson=new Person();
			
			$valid = true;
			$contactErrors = array();
			$personErrors = array();
			$modelContact->attributes=$_POST['Contact'];
			$modelPerson->attributes=$_POST['Person'];	
			$modelContact->description = $modelPerson->name ." " .$modelPerson->last_name;
				
			$transaction = $modelCustomer->dbConnection->beginTransaction();
			try {				
		
				if(!$modelPerson->validate() || !$modelPerson->save())
					$valid = false;
		
				if(empty($modelContact->telephone_2))
					$modelContact->tel2_description = '';
				if(empty($modelContact->telephone_3))
					$modelContact->tel3_description = '';
				
				if(!$modelContact->validate() || !$modelContact->save())
					$valid = false;
				
				$modelCustomer->Id_contact = $modelContact->Id;
				$modelCustomer->Id_person = $modelPerson->Id;
		
				if(!$modelCustomer->validate() || !$modelCustomer->save())
					$valid = false;				

				if(isset($_POST['address']))
				{
					foreach($_POST['address'] as $address)
					{
						$modelProject = new Project();
						$modelProject->Id_customer = $modelCustomer->Id;
						$modelProject->address = $address['value'];
						$modelProject->description = $address['nickname'];
						$modelProject->save();					
					}
				}
				
				if($valid)
				{
					$transaction->commit();
				}
				else 
				{
					$contactErrors = $modelContact->getErrors();
					$personErrors = $modelPerson->getErrors();
					$transaction->rollback();
				}
				
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	
		$response = array('hasError'=>($valid)?0:1,
				'personError'=>$personErrors,
				'contactError'=>$contactErrors,);
	
		echo json_encode($response);
	}
	
	public function actionAjaxSaveUpdatedCustomer()
	{
		if(isset($_POST['Person'])&&isset($_POST['Contact'])&&isset($_POST['Customer']))
		{
			$modelCustomer=Customer::model()->findByPk($_POST['Customer']['Id']);
			$modelContact = Contact::model()->findByPk($modelCustomer->Id_contact);
			$modelPerson = Person::model()->findByPk($modelCustomer->Id_person);
							
			$valid = true;
			$contactErrors = array();
			$personErrors = array();
			$customerErrors = array();
			$modelContact->attributes=$_POST['Contact'];
			$modelPerson->attributes=$_POST['Person'];
			
			$modelContact->description = $modelPerson->name ." " .$modelPerson->last_name;
			 
			$transaction = $modelCustomer->dbConnection->beginTransaction();
			try {
	
				if(!$modelPerson->validate() || !$modelPerson->save())
					$valid = false;
	
				if(!$modelContact->validate() || !$modelContact->save())
					$valid = false;
	
				if(isset($_POST['address']))
				{
					foreach($_POST['address'] as $address)
					{
						if(isset($address['Id']))
						{
							$modelProject = Project::model()->findByPk($address['Id']);
							if(!isset($modelProject))
								$modelProject = new Project();
						}
						else					
							$modelProject = new Project();
						
						$modelProject->Id_customer = $modelCustomer->Id;
						$modelProject->address = $address['value'];
						$modelProject->description = $address['nickname'];
						$modelProject->save();
					}
				}
				
				if(isset($_POST['remove_address']))
				{
					foreach($_POST['remove_address'] as $address)
					{
						Project::model()->deleteByPk($address['Id']);
					}
				}
				
				if($valid)
				{
					$transaction->commit();
				}
				else
				{
					$contactErrors = $modelContact->getErrors();
					$personErrors = $modelPerson->getErrors();
					$customerErrors = $modelCustomer->getErrors();
					$transaction->rollback();
				}
	
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	
		$response = array('hasError'=>($valid)?0:1,
				'personError'=>$personErrors,
				'contactError'=>$contactErrors,
				'customerError'=>$customerErrors,);
	
		echo json_encode($response);
	}
	
	public function actionAjaxDelete()
	{
		$canDelete = true;
		if(isset($_POST['id']))
		{
			$modelProjects = Project::model()->findAllByAttributes(array('Id_customer'=>$_POST['id']));
			foreach($modelProjects as $project)
			{
				$qty = Budget::model()->countByAttributes(array('Id_project'=>$project->Id));
				if($qty > 0)
				{
					$canDelete = false;
					break;
				}
			}
			
			if($canDelete)
			{
				$modelCustomer = Customer::model()->findByPk($_POST['id']);
				$transaction = $modelCustomer->dbConnection->beginTransaction();
				try {
					Project::model()->deleteAllByAttributes(array('Id_customer'=>$modelCustomer->Id));
					Person::model()->deleteByPk($modelCustomer->Id_person);
					Contact::model()->deleteByPk($modelCustomer->Id_contact);
					$modelCustomer->delete();
					$transaction->commit();
				} catch (Exception $e) {
					$canDelete = false;
					$transaction->rollback();
				}
			}
		}
	
		echo ($canDelete)?1:0;
	}
	
	public function actionAjaxCanRemoveAddress()
	{
		$canRemove = 1;
		if(isset($_POST['idProject']))
		{
			$qty = Budget::model()->countByAttributes(array('Id_project'=>$_POST['idProject']));
			if($qty > 0)
				$canRemove = 0;
		}
		
		echo $canRemove;
	}
	
	public function actionAjaxShowUpdateModal()
	{
		if(isset($_POST['id']))
		{
			$modelCustomer = $this->loadModel($_POST['id']);
			if(isset($modelCustomer))
			{
						
				$modelContact = Contact::model()->findByPk($modelCustomer->Id_contact);
				$modelPerson = Person::model()->findByPk($modelCustomer->Id_person);
				
				echo $this->renderPartial('_modalFormCustomer',
						array('modelCustomer'=>$modelCustomer,
								'modelContact'=>$modelContact,
								'modelPerson'=>$modelPerson),
						/*parametros extras para que funcione CJuiDatePicker*/
						false,true);
			}
		}
	}	
}
