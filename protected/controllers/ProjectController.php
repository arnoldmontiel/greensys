<?php

class ProjectController extends Controller
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

	
	public function actionProjectArea()
	{
		$model=new Project;
	
		$dataProvider=new CActiveDataProvider('Project');
		$dataProviderArea=new CActiveDataProvider('Area');
	
		$this->render('projectArea',array(
					'dataProvider'=>$dataProvider,
					'dataProviderArea'=>$dataProviderArea,
					'model'=>$model //model for creation
		));
	
	}
	
	public function actionAjaxFillProjectArea()
	{
		$data=AreaProject::model()->findAll('Id_project=:Id_project',
		array(':Id_project'=>(int) $_POST['Project']['Id']));
	
	
		foreach($data as $item)
		{
			$checked = '';
			if($item->centralized > 0)
				$checked = 'checked';
				
			echo CHtml::tag('li',
							array('id'=>"items_".$item->Id_area,
				  				  'class'=>'ui-state-default'),
						    CHtml::encode($item->area->description). "  ". CHtml::checkBox("centralized",$item->centralized). 
						    "  <img id='centralizedok' src='images/save_ok.png' alt=''  style='position: relative;float:rigth;width:15px; height:15px; display:none;' />" ,
							true);
		}
	}
	
	public function actionAjaxSetCentralized()
	{
		$idArea = isset($_POST['IdArea'])?$_POST['IdArea']:'';
		$idProject = isset($_POST['IdProject'])?$_POST['IdProject']:'';
		$centralized = isset($_POST['centralized'])?(int)$_POST['centralized']:0;
		$idArea = explode("_",$idArea);
		$idArea = $idArea[1];
		
		$oldCentralizedState = 0;
		if($centralized==0)
			$oldCentralizedState = 1;
		
		
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
		$idArea = explode("_",$idArea);
		$idArea = $idArea[1];
	
		if(!empty($idProject)&&!empty($idArea))
		{			
			$projectArea=new AreaProject;
			$projectArea->attributes = array('Id_area'=>$idArea,'Id_project'=>$idProject);
			$projectArea->save();
		}
	}
	
	public function actionAjaxRemoveProjectArea()
	{
		$idArea = isset($_POST['IdArea'])?$_POST['IdArea']:'';
		$idProject= isset($_POST['IdProject'])?$_POST['IdProject']:'';
		$centralized= isset($_POST['centralized'])?(int)$_POST['centralized']:0;
		$idArea = explode("_",$idArea);
		$idArea = $idArea[1];
	
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
