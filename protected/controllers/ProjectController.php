<?php

class ProjectController extends GController
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
		$model=new Project;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save()){
				$this->createDefaultPermissions($model->Id_customer,$model->Id);
				$this->redirect(array('view','id'=>$model->Id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionAjaxUpdateProjectService()
	{
		if(isset($_POST['ProjectService']['Id_project'])&&isset($_POST['ProjectService']['Id_service']))
		{
			$model=ProjectService::model()->findByPk(array("Id_project"=>$_POST['ProjectService']['Id_project'],'Id_service'=>$_POST['ProjectService']['Id_service']));
				
			if(isset($_POST['ProjectService']))
			{
				$model->attributes=$_POST['ProjectService'];
				if(empty($model->note))
				{
					$modelService = Service::model()->findByPk($model->Id_service);
					if(isset($modelService))
						$model->note = $modelService->note;
				}
				if(empty($model->long_description))
				{
					$modelService = Service::model()->findByPk($model->Id_service);
					if(isset($modelService))
						$model->long_description = $modelService->long_description;
				}
				if($model->save()){
					echo json_encode($model->attributes);
				}
			}
		}
	}
	
	public function actionAjaxShowUpdateModalProjectService()
	{
		if(isset($_POST['Id_project'])&&isset($_POST['Id_service']))
		{
			$model=ProjectService::model()->findByPk(array("Id_project"=>$_POST['Id_project'],'Id_service'=>$_POST['Id_service']));
			$field_caller ="";
			if($_POST['field_caller'])
				$field_caller=$_POST['field_caller'];
			// Uncomment the following line if AJAX validation is needed
			$this->renderPartial('_formModalProjectService',array(
					'model'=>$model,
					'field_caller'=>$field_caller
			));
		}
	}
	
	public function actionAjaxShowUpdateModalProjectServiceNote()
	{
		if(isset($_POST['Id_project'])&&isset($_POST['Id_service']))
		{
			$model=ProjectService::model()->findByPk(array("Id_project"=>$_POST['Id_project'],'Id_service'=>$_POST['Id_service']));
			$field_caller ="";
			if($_POST['field_caller'])
				$field_caller=$_POST['field_caller'];
			// Uncomment the following line if AJAX validation is needed
			$this->renderPartial('_formModalProjectServiceNote',array(
					'model'=>$model,
					'field_caller'=>$field_caller
			));
		}
	}
	
	public function actionAjaxCreate()
	{
		$model=new Project;
	
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
	
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save()){
				$this->createDefaultPermissions($model->Id_customer,$model->Id);				
				echo json_encode($model->attributes);
			} 
		}
	
	}
	private function createDefaultPermissions($idCustomer,$idProject)
	{
		$userGroups = UserGroup::model()->findAll();
		foreach($userGroups as $item)
		{
			$this->savePermission($idCustomer, $item, $idProject);
		}
	}
	
	private function savePermission($idCustomer, $modelUserGroup, $idProject)
	{
		$modelUserGroupCustomer = new UserGroupCustomer;
		$modelUserGroupCustomer->Id_customer = $idCustomer;
		$modelUserGroupCustomer->Id_project = $idProject;
		$modelUserGroupCustomer->Id_user_group = $modelUserGroup->Id;
		$modelUserGroupCustomer->Id_interest_power = 1;
			
		$modelUserGroupCustomer->save();
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

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionAjaxUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
			{
				echo json_encode($model->attributes);				
			}
		}
		echo $this->renderPartial('_formUpdatePopUp', array('model'=>$model)); 				
	}
	public function actionAjaxSave()
	{
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Project']))
		{
			$model=$this->loadModel($_POST['Project']['Id']);
			$model->attributes=$_POST['Project'];
			if($model->save())
			{
				echo json_encode($model->attributes);
				return;
			}
		}
		echo "Error Updating";
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
		$this->redirect(array('admin'));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	public function actionProjectArea($id)
	{
		$modelArea = new Area('search');
		$modelArea->unsetAttributes();  // clear any default values
		if(isset($_GET['Area']))
			$modelArea->attributes=$_GET['Area'];
		
		$modelAssignedArea = new AreaProject('search');
		$modelAssignedArea->unsetAttributes();  // clear any default values
		if(isset($_GET['AreaProject']))
			$modelAssignedArea->attributes=$_GET['AreaProject'];
		
		$modelAssignedArea->Id_project = $id;
		
		$this->render('projectArea',array(
						'idProject'=>$id,
						'modelArea'=>$modelArea,
						'modelAssignedArea'=>$modelAssignedArea
		));
	
	}
	
	public function actionAjaxUpdateRelDescription()
	{
		$idAreaProject = isset($_POST['idAreaProject'])?$_POST['idAreaProject']:null;
		$relDescription = isset($_POST['relDescription'])?$_POST['relDescription']:'';
		
		if(isset($idAreaProject))
		{
			$modelAreaProject = AreaProject::model()->findByAttributes(array('Id'=>$idAreaProject));
			if(isset($modelAreaProject))
			{
				$modelAreaProject->description = $relDescription;
				$modelAreaProject->save();
			}
		}		
	}
	
	public function actionAjaxUpdateCentralized()
	{
		$idAreaProject = isset($_POST['idAreaProject'])?$_POST['idAreaProject']:null;
		$isCentralized = isset($_POST['isCentralized'])?$_POST['isCentralized']:false;
		
		if(isset($idAreaProject))
		{
			$modelAreaProject = AreaProject::model()->findByAttributes(array('Id'=>$idAreaProject));
			if(isset($modelAreaProject))
			{
				$modelAreaProject->centralized = ($isCentralized == "true")?1:0;
				$modelAreaProject->save();
			}
		}
		
		
		if(!empty($idProject)&&!empty($idArea))
		{
			$serviceAreaInDb = AreaProject::model()->findByAttributes(array('Id_area'=>(int) $idArea,'Id_project'=>(int)$idProject, 'centralized'=>$oldCentralizedState));
			if($serviceAreaInDb!=null)
			{
				$serviceAreaInDb->centralized = $centralized;
				$serviceAreaInDb->save();
			}
		}
	}
	
	public function actionAjaxAddProjectArea()
	{
		$idArea = isset($_POST['IdArea'])?$_POST['IdArea']:'';
		$idProject= isset($_POST['IdProject'])?$_POST['IdProject']:'';
		$idArea = $idArea[0];
	
		if(!empty($idProject)&&!empty($idArea))
		{			
			$projectArea=new AreaProject;
			$projectArea->attributes = array('Id_area'=>$idArea,'Id_project'=>$idProject);
			$projectArea->save();
		}
	}
	public function actionAjaxAddProjectAreaFromBudget()
	{
		if(isset($_POST['Id_area'])&&isset($_POST['Id_project']))
		{
			$projectArea=new AreaProject;
			$projectArea->attributes = array('Id_area'=>$_POST['Id_area'],'Id_project'=>$_POST['Id_project'],'Id_parent'=>$_POST['Id_area_project']);
			$projectArea->save();
		}
	}
	
	public function actionAjaxRemoveProjectArea()
	{
		$idArea = isset($_GET['IdArea'])?$_GET['IdArea']:'';
		$idProject= isset($_GET['IdProject'])?$_GET['IdProject']:'';
		$centralized= isset($_GET['centralized'])?(int)$_GET['centralized']:0;
	
		if(!empty($idProject)&&!empty($idArea))
		{
			$projectAreaInDb = AreaProject::model()->findByAttributes(array('Id_area'=>(int) $idArea,'Id_project'=>(int)$idProject, 'centralized'=>$centralized));
			if($projectAreaInDb!=null)
			{
				$projectAreaInDb->delete();
			}
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
	public function actionCreateCustomer()
	{
		$this->redirect(array('customer/createNew','modelCaller'=>get_class(Project::model())));
	}
	
	public function actionAjaxGetLongDescription()
	{
		if(isset($_POST['Id_service'])&&isset($_POST['Id_project']) )
		{
			$model = ProjectService::model()->findByPk(array('Id_service'=>$_POST['Id_service'],'Id_project'=>$_POST['Id_project']));
			if(isset($model))
			{
				echo json_encode($model->attributes);
			}
			else
			{
				$modelService = Service::model()->findByPk($_POST['Id_service']);
				echo json_encode($modelService->attributes);				
			}
		}
	}
	public function actionAjaxSaveServiceLongDescription()
	{
		if(isset($_POST['Id_service'])&&isset($_POST['Id_project'])&&isset($_POST['long_description']) )
		{
			$model = ProjectService::model()->findByPk(array('Id_service'=>$_POST['Id_service'],'Id_project'=>$_POST['Id_project']));
			if(isset($model))
			{
				$model->long_description = $_POST['long_description'];
				$model->save();
				echo json_encode($model->attributes);
			}
			else
			{
				$model = new ProjectService();
				$model->Id_project = $_POST['Id_project'];
				$model->Id_service = $_POST['Id_service'];
				$model->long_description = $_POST['long_description'];
				$model->save();
				echo json_encode($model->attributes);				
			}
		}
	}
	public function actionAjaxUpdateAreaDescription()
	{
		if(isset($_POST['AreaProject']) )
		{
			$model = AreaProject::model()->findByPk(array('Id_area'=>$_POST['AreaProject']['Id_area'],'Id_project'=>$_POST['AreaProject']['Id_project'],'Id'=>$_POST['AreaProject']['Id']));
			if(isset($model))
			{
				$model->description = $_POST['AreaProject']['description'];
				$model->save();
				echo json_encode($model->attributes);
			}
		}
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
