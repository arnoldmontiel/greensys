<?php

class InitCustomerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/tcolumn2';

	public function beforeAction(CAction $action)
	{
		$result = parent::beforeAction($action);
		$this->menu[]= array('label'=>'Dashboard', 'url'=>array('review/dashboardClient'));
		return $result;
	}
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model= $this->loadModel($id);
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$model->Id_contact,'Id_entity_type'=>$this->getEntityType()));
		$this->render('view',array(
			'model'=>$model,
			'modelHyperlink'=>$modelHyperlink,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$modelCustomer=new Customer();
		$modelContact=new Contact();
		$modelPerson=new Person();
		
		$modelHyperlink = new Hyperlink;
		
		$modelCustomer->Id_user_group = 3; // cliente
		
		if(isset($_POST['Person'])&&isset($_POST['Contact']))
		{
			$valid = true;
			$modelContact->attributes=$_POST['Contact'];
			$modelPerson->attributes=$_POST['Person'];
			$transactionT = TCustomer::model()->dbConnection->beginTransaction();
			$transaction = $modelCustomer->dbConnection->beginTransaction();
			try {				
		
				if(!$modelPerson->save())
					$valid = false;
		
				if(!$modelContact->save())
					$valid = false;
				
				$modelCustomer->Id_contact = $modelContact->Id;
				$modelCustomer->Id_person = $modelPerson->Id;
		
				if(!$modelCustomer->save())
					$valid = false;
		
				Hyperlink::model()->deleteAllByAttributes(array('Id_contact'=>$modelCustomer->Id_contact));
				if(isset($_POST['Hyperlink']))
				{
					$links=explode(",", $_POST['Hyperlink']['description']);
					GreenHelper::saveLinks($links, $modelCustomer->Id_contact, $this->getEntityType(),'Id_contact');
				}
				
				$transaction->commit();
				$transactionT->commit();
				if($valid)
					$this->redirect(array('view','id'=>$modelCustomer->Id));
				
			} catch (Exception $e) {
				$transaction->rollback();
				$transactionT->rollback();
			}
		}
		
		$this->render('create',array(
							'modelCustomer'=>$modelCustomer,
							'modelContact'=>$modelContact,
							'modelPerson'=>$modelPerson,
							'modelHyperlink'=>$modelHyperlink
		));
	}

	public function actionAjaxDelete()
	{
		// we only allow deletion via POST request
		$id =  isset($_GET['Id'])?$_GET['Id']:'';
		if(!empty($id))
		{
			$model=Customer::model()->findByPk($id);
			if(isset($model))
			{
	
				$transaction = $model->dbConnection->beginTransaction();
				try {
					if(!empty($model->notes))
					{
						echo "El proyecto tiene notas asociadas. No puede elimiarse.";						
					}										
					elseif(!empty($model->multimedias))
					{
						echo "Primero debe eliminar el contenido multimedia asociados al cliente";
					}
					elseif(!empty($model->albums))
					{
						echo "Primero debe eliminar los albums asociados al cliente";
					}
					else
					{
						foreach($model->projects as $project)
							$project->delete();

						$model->delete();
						$transaction->commit();
					}
	
				} catch (Exception $e) {
					$transaction->rollback();
				}
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
		$modelContact= $modelCustomer->contact;
		$modelPerson= $modelCustomer->person();
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>$this->getEntityType()));
		
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($modelCustomer,$modelContact,$modelPerson));
		
		if(isset($_POST['Person'])&&isset($_POST['Contact']))
		{
			$modelContact->attributes=$_POST['Contact'];
			$modelPerson->attributes=$_POST['Person'];
			$transaction = $modelCustomer->dbConnection->beginTransaction();
			try {
				$saveOk = true;
				
				$saveOk &= $modelContact->save();
				$saveOk &= $modelPerson->save();
				$saveOk &= $modelCustomer->save();
				
				Hyperlink::model()->deleteAllByAttributes(array('Id_contact'=>$modelCustomer->Id_contact));
				if(isset($_POST['Hyperlink']))
				{
					$links=explode(",", $_POST['Hyperlink']['description']);					
					GreenHelper::saveLinks($links, $modelCustomer->Id_contact, $this->getEntityType(),'Id_contact');						
				}

				$transaction->commit();
		
				//$this->createDefaultPermissions($modelCustomer->Id);
				if($saveOk)
					$this->redirect(array('view','id'=>$modelCustomer->Id));
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		
		$this->render('update',array(
							'modelCustomer'=>$modelCustomer,
							'modelContact'=>$modelContact,
							'modelPerson'=>$modelPerson,
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TCustomer the loaded model
	 * @throws CHttpException
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
	 * @param TCustomer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='init-customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
