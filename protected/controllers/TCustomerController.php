<?php

class TCustomerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/tcolumn2';
	
	public function getEntityType()
	{
		return EntityType::model()->findByAttributes(array('name'=>get_class(Customer::model())))->Id;
	}
	

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
		
		$modelUserCustomer = new UserCustomer('Search');
		$modelUserCustomer->unsetAttributes();
		$modelUserCustomer->Id_customer = $id;
		
		if(isset($_GET['UserCustomer']))
		{
			$modelUserCustomer->attributes =$_GET['UserCustomer'];
			 			
			if(isset($_GET['UserCustomer']['Id_user_group']))
				$modelUserCustomer->Id_user_group =$_GET['UserCustomer']['Id_user_group']; 			

			if(isset($_GET['UserCustomer']['name']))
				$modelUserCustomer->name =$_GET['UserCustomer']['name']; 			

			if(isset($_GET['UserCustomer']['last_name']))
				$modelUserCustomer->last_name =$_GET['UserCustomer']['last_name']; 			

			if(isset($_GET['UserCustomer']['email']))
				$modelUserCustomer->email =$_GET['UserCustomer']['email']; 			

			if(isset($_GET['UserCustomer']['phone_house']))
				$modelUserCustomer->phone_house =$_GET['UserCustomer']['phone_house']; 			

			if(isset($_GET['UserCustomer']['phone_mobile']))
				$modelUserCustomer->phone_mobile =$_GET['UserCustomer']['phone_mobile']; 			
		}
		
		$modelUserGroupCustomer = new UserGroupCustomer('Search');
		$modelUserGroupCustomer->unsetAttributes();
		$modelUserGroupCustomer->Id_customer = $id;
		if(isset($_GET['UserGroupCustomer']))
		{
			$modelUserGroupCustomer->attributes = $_GET['UserGroupCustomer'];
		}
		$modelUserGrid = new User('Search');		
		$modelUser = new User('Search');
		$modelUser->unsetAttributes();
		if(isset($_GET['User']))
		{
			$modelUser->attributes = $_GET['User'];
			$modelUserGrid->attributes = $_GET['User'];
			if(isset($_GET['User']['Id_project']))
			{
				$modelUser->Id_project =$_GET['User']['Id_project'];				
				$modelUserGrid->Id_project =$_GET['User']['Id_project'];
			}
		}
		$model= $this->loadModel($id);

		$modelProject = new Project('Search');
		$modelProject->unsetAttributes();
		$modelProject->Id_customer = $model->Id;
		if(isset($_GET['Project']))
		{
			$modelProject->attributes = $_GET['Project'];
			if(isset($_GET['Project']['Id']))
			{
				$modelUserGrid->Id_project =$_GET['Project']['Id'];				
				$modelUserCustomer->Id_project =$_GET['Project']['Id'];				
				$modelUserGroupCustomer->Id_project =$_GET['Project']['Id'];				
			}
		}
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$model->Id_contact,'Id_entity_type'=>$this->getEntityType()));
		$this->render('view',array(
			'model'=>$model,
			'modelContact'=>$model->contact,
			'modelPerson'=>$model->person,
			'modelUser'=>$model->user,
			'modelUserCustomer'=>$modelUserCustomer,
			'modelUserGroupCustomer'=>$modelUserGroupCustomer,
			'modelProject'=>$modelProject,
			'modelHyperlink'=>$modelHyperlink,
			'modelUserGrid'=>$modelUserGrid
		));
	}

	public function actionAjaxUpdatePermission()
	{
		$idUserGroup = $_POST['idUserGroup'];
		$idInterestPower = $_POST['idInterestPower'];
		$idCustomer = $_POST['idCustomer'];
		$idProject = $_POST['idProject'];
		
		$modelUserGroupCustomer = UserGroupCustomer::model()->findByPk(array('Id_user_group'=>$idUserGroup, 'Id_customer'=>$idCustomer,'Id_project'=>$idProject));
		$modelUserGroupCustomer->Id_interest_power = $idInterestPower;
		$modelUserGroupCustomer->save();
	}
	
	public function actionAjaxUpdatePermissionGrid()
	{
		$idCustomer = $_POST['idCustomer'];
		$idProject = $_POST['idProject'];
		
		$userGroups = UserGroup::model()->findAll();
		
		foreach($userGroups as $userGroup)
		{
			$uGroupCustomerDb = UserGroupCustomer::model()->findAllByAttributes(array('Id_customer'=>$idCustomer,'Id_project'=>$idProject, 'Id_user_group'=>$userGroup->Id));
			if(empty($uGroupCustomerDb))
			{
				$this->savePermission($idCustomer, $userGroup, $idProject);
			}
		}
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$modelUser=new User();
		$modelCustomer=new Customer();
		$modelContact=new Contact();
		$modelPerson=new Person();
		
		$modelHyperlink = new Hyperlink;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$modelCustomer->Id_user_group = 3; // cliente
		
		if(isset($_POST['User'])&&isset($_POST['Person'])&&isset($_POST['Contact']))
		{
			$modelUser->attributes=$_POST['User'];
			$modelContact->attributes=$_POST['Contact'];
			$modelPerson->attributes=$_POST['Person'];
			$transaction = $modelCustomer->dbConnection->beginTransaction();
			$transactionTapia = $modelUser->dbConnection->beginTransaction();
			try {
				$modelUser->email = $modelContact->email;
				$modelUser->Id_user_group = $modelCustomer->Id_user_group;
				$modelUser->save();
				$modelContact->save();
				$modelPerson->save();
				
				$modelCustomer->Id_contact = $modelContact->Id;
				$modelCustomer->Id_person = $modelPerson->Id;
				$modelCustomer->username = $modelUser->username;
				$modelCustomer->save();

				Hyperlink::model()->deleteAllByAttributes(array('Id_customer'=>$modelCustomer->Id));
				GreenHelper::saveLinks($_POST['links'], $modelCustomer->Id_contact, $this->getEntityType(),'Id_contact');
				
				$transaction->commit();
				$transactionTapia->commit();
				
				//$this->createDefaultPermissions($modelCustomer->Id);
				$this->redirect(array('view','id'=>$modelCustomer->Id));
			} catch (Exception $e) {
				$transaction->rollback();
				$transactionTapia->rollback();
			}
		}
		
		$this->render('create',array(
					'modelCustomer'=>$modelCustomer,
					'modelUser'=>$modelUser,
					'modelContact'=>$modelContact,
					'modelPerson'=>$modelPerson,
					'modelHyperlink'=>$modelHyperlink
		));
	}

	private function createDefaultPermissions($idCustomer)
	{
		$userGroups = UserGroup::model()->findAll();
		foreach($userGroups as $item)
		{
			$this->savePermission($idCustomer, $item);
		}
	}
	
	private function savePermission($idCustomer, $modelUserGroup,$idProject)
	{
		$modelUserGroupCustomer = new UserGroupCustomer;
		$modelUserGroupCustomer->Id_customer = $idCustomer;
		$modelUserGroupCustomer->Id_project = $idProject;
		$modelUserGroupCustomer->Id_user_group = $modelUserGroup->Id;
		if($modelUserGroup->is_administrator)
			$modelUserGroupCustomer->Id_interest_power = 2;
		else
			$modelUserGroupCustomer->Id_interest_power = 1;
			
		$modelUserGroupCustomer->save();
	}
	
	public function actionAssign()
	{
		$model = new TCustomer;
		$modelUserGroup = new UserGroup;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		$ddlCustomer = TCustomer::model()->findAll();
		
	
		$criteria=new CDbCriteria;
			
		$criteria->addCondition('t.is_internal <> 1');
		$criteria->addCondition('t.Id <> 3');
		
		$ddlUserGroup = UserGroup::model()->findAll($criteria);
		
		$modelUser = new User;
		if(isset($_GET['UserGroup']))
			$modelUser->Id_user_group = $_GET['UserGroup']['Id'];
			 
		
		$modelUserCustomer = new UserCustomer;
		if(isset($_GET['TCustomer']))
			$modelUserCustomer->Id_customer = $_GET['TCustomer']['Id'];
		
		if(isset($_GET['User']))
			$modelUser->attributes = $_GET['User'];
		
		if(isset($_GET['UserCustomer']))
			$modelUserCustomer->attributes = $_GET['UserCustomer'];
		
		$this->render('assign',array(
				'model'=>$model,
				'ddlCustomer'=>$ddlCustomer,
				'ddlUserGroup'=>$ddlUserGroup,
				'modelUserGroup'=>$modelUserGroup,
				'modelUser'=>$modelUser,
				'modelUserCustomer'=>$modelUserCustomer,
		));
	}
	
	public function actionAjaxAddUserCustomer()
	{
		
		$idCustomer = isset($_GET['IdCustomer'])?$_GET['IdCustomer']:'';
		$idProject = isset($_GET['IdProject'])?$_GET['IdProject']:'';
		$idUser = isset($_GET['username'])?$_GET['username'][0]:'';
	
		if(!empty($idCustomer)&&!empty($idUser)&&!empty($idProject))
		{
			$userCustomerDb = UserCustomer::model()->findByAttributes(array('Id_customer'=>(int) $idCustomer,'Id_project'=>$idProject,'username'=>$idUser));
			if($userCustomerDb==null)
			{
				$userCustomer = new UserCustomer;
				$userCustomer->attributes =  array('Id_customer'=>$idCustomer,
													'Id_project'=>$idProject,
													'username'=>$idUser,
												);
				$userCustomer->save();
			}
			else
			{
				throw new CDbException('El usuario ya esta asignado');
			}
		}
	}
	
	public function actionAjaxRemoveUserCustomer()
	{
	
		$idCustomer = isset($_GET['IdCustomer'])?$_GET['IdCustomer']:'';
		$idUser = isset($_GET['username'])?$_GET['username']:'';
	
		if(!empty($idCustomer)&&!empty($idUser))
		{
			$userCustomerDb = UserCustomer::model()->findByAttributes(array('Id_customer'=>(int) $idCustomer,'username'=>$idUser));
			if($userCustomerDb)
			{
				$userCustomerDb->delete();
			}
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelCustomer = $this->loadModel($id);
		$modelUser= $modelCustomer->user;
		$modelContact= $modelCustomer->contact;
		$modelPerson= $modelCustomer->person();
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>$this->getEntityType()));
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['User'])&&isset($_POST['Person'])&&isset($_POST['Contact']))
		{
			$modelUser->attributes=$_POST['User'];
			$modelContact->attributes=$_POST['Contact'];
			$modelPerson->attributes=$_POST['Person'];
			$transaction = $modelCustomer->dbConnection->beginTransaction();
			try {
				$modelUser->email = $modelContact->email;
				$modelUser->Id_user_group = $modelCustomer->Id_user_group;				
				$modelUser->save();
				$modelContact->save();
				$modelPerson->save();
// 				$modelCustomer->Id_contact = $modelContact->Id;
// 				$modelCustomer->Id_person = $modelPerson->Id;
// 				$modelCustomer->username = $modelPerson->username;
				$modelCustomer->save();
				
				Hyperlink::model()->deleteAllByAttributes(array('Id_contact'=>$modelCustomer->Id_contact));
				GreenHelper::saveLinks($_POST['links'], $modelCustomer->Id_contact, $this->getEntityType(),'Id_contact');

				$transaction->commit();
		
				//$this->createDefaultPermissions($modelCustomer->Id);
				$this->redirect(array('view','id'=>$modelCustomer->Id));
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		
		$this->render('update',array(
							'modelCustomer'=>$modelCustomer,
							'modelUser'=>$modelUser,
							'modelContact'=>$modelContact,
							'modelPerson'=>$modelPerson,
							'modelHyperlink'=>$modelHyperlink
		));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
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
		$dataProvider=new CActiveDataProvider('TCustomer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TCustomer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TCustomer']))
			$model->attributes=$_GET['TCustomer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionAjaxRemoveProject()
	{
		//TODO
	}
	
	public function actionAjaxSelect()
	{
		$model=new TCustomer('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['TCustomer']))
			$model->attributes=$_GET['TCustomer'];
	
		$this->render('_select',array(
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
		$model=TCustomer::model()->findByPk($id);
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
