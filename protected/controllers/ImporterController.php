<?php

class ImporterController extends GController
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

	public function actionAjaxOpenNewImporter()
	{
		$model=new Importer;
		$modelContact=new Contact;
		$modelShippingParameter =  new ShippingParameter;
		$modelShippingParameterAir = new ShippingParameterAir;
		$modelShippingParameterMaritime = new ShippingParameterMaritime;
		
		echo $this->renderPartial('_modalFormImporter', array('model'=>$model,
							'modelContact'=>$modelContact,
							'modelShippingParameterMaritime'=>$modelShippingParameterMaritime,
							'modelShippingParameterAir'=>$modelShippingParameterAir,
							'modelShippingParameter'=>$modelShippingParameter,
							));
				
	}
	
	public function actionAjaxSaveNewImporter()
	{
		$model=new Importer;
		$modelContact=new Contact;
		$modelShippingParameter =  new ShippingParameter;
		$modelShippingParameterAir = new ShippingParameterAir;
		$modelShippingParameterMaritime = new ShippingParameterMaritime;
		
		if(
		isset($_POST['Contact'])
		&&isset($_POST['ShippingParameter'])
		&&isset($_POST['ShippingParameterAir'])
		&&isset($_POST['ShippingParameterMaritime'])
		){
			$modelContact->attributes=$_POST['Contact'];
			$modelShippingParameter->attributes=$_POST['ShippingParameter'];
			$modelShippingParameterAir->attributes=$_POST['ShippingParameterAir'];
			$modelShippingParameterMaritime->attributes=$_POST['ShippingParameterMaritime'];
			
			// Uncomment the following line if AJAX validation is needed
			//$this->performAjaxValidation($model,$modelContact,$modelShippingParameter,$modelShippingParameterAir,$modelShippingParameterMaritime);
		
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if($modelContact->save())
				{
					$model->Id_contact = $modelContact->Id;
					if($model->save())
					{
						if($modelShippingParameterAir->save()&&$modelShippingParameterMaritime->save())
						{							
							$modelShippingParameter->Id_importer = $model->Id;
							$modelShippingParameter->Id_shipping_parameter_air = $modelShippingParameterAir->Id;
							$modelShippingParameter->Id_shipping_parameter_maritime = $modelShippingParameterMaritime->Id;
							if($modelShippingParameter->save())
							{								
								$transaction->commit();								
							}
		
						}
					}
				}
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	}
	
	public function actionAjaxOpenUpdateImporter()
	{
		$id = isset($_POST['id'])?$_POST['id']:null;
	
		$model=$this->loadModel($id);
		$modelContact=$this->loadModelContact($model->Id_contact);
		
		$modelShippingParameter =  $this->loadModelShippingParameter($model->Id);
		$modelShippingParameterAir = $this->loadModelShippingParameterAir($modelShippingParameter->Id_shipping_parameter_air);
		$modelShippingParameterMaritime = $this->loadModelShippingParameterMaritime($modelShippingParameter->Id_shipping_parameter_maritime);
		
		echo $this->renderPartial('_modalFormImporter', array('model'=>$model,
				'modelContact'=>$modelContact,
				'modelShippingParameterMaritime'=>$modelShippingParameterMaritime,
				'modelShippingParameterAir'=>$modelShippingParameterAir,
				'modelShippingParameter'=>$modelShippingParameter,
		));
	}
	
	public function actionAjaxSaveUpdatedImporter()
	{
		if(
		isset($_POST['Contact'])
		&&isset($_POST['ShippingParameter'])
		&&isset($_POST['ShippingParameterAir'])
		&&isset($_POST['ShippingParameterMaritime'])
		){
			//save contact
			$id = $_POST['Contact']['Id'];
			$modelContact = Contact::model()->findByPk($id);
				
			$modelContact->attributes = $_POST['Contact'];
			$modelContact->save();
			
			//save shipping parameter
			$id = $_POST['ShippingParameter']['Id'];
			$modelShippingParameter = ShippingParameter::model()->findByPk($id);
			
			$modelShippingParameter->attributes = $_POST['ShippingParameter'];
			$modelShippingParameter->save();
			
			//save shipping parameter AIR
			$id = $_POST['ShippingParameterAir']['Id'];
			$modelShippingParameterAir = ShippingParameterAir::model()->findByPk($id);
				
			$modelShippingParameterAir->attributes = $_POST['ShippingParameterAir'];
			$modelShippingParameterAir->save();
			
			//save shipping parameter MARITIME
			$id = $_POST['ShippingParameterMaritime']['Id'];
			$modelShippingParameterMaritime = ShippingParameterMaritime::model()->findByPk($id);
				
			$modelShippingParameterMaritime->attributes = $_POST['ShippingParameterMaritime'];
			$modelShippingParameterMaritime->save();
			
		}
	}
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAjaxDelete()
	{
		$id = isset($_POST['id'])?$_POST['id']:null;
		
		if(isset($id))
		{
			$model = $this->loadModel($id);
			$transaction = $model->dbConnection->beginTransaction();

			try {
				$modelContact = $this->loadModelContact($model->Id_contact);
				
				$modelShippingParameter =  $this->loadModelShippingParameter($model->Id);
				$modelShippingParameterAir = $this->loadModelShippingParameterAir($modelShippingParameter->Id_shipping_parameter_air);
				$modelShippingParameterMaritime = $this->loadModelShippingParameterMaritime($modelShippingParameter->Id_shipping_parameter_maritime);
								
				$modelContact->delete();
				$modelShippingParameter->delete();
				$modelShippingParameterAir->delete();
				$modelShippingParameterMaritime->delete();
				$model->delete(); 

				$transaction->commit();										
				
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
		$this->redirect(array('admin'));
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
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModelShippingParameter($id_importer)
	{
		$model=ShippingParameter::model()->findByAttributes(array('Id_importer'=>$id_importer,'current'=>true));
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModelShippingParameterAir($id)
	{
		$model=ShippingParameterAir::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModelShippingParameterMaritime($id)
	{
		$model=ShippingParameterMaritime::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model,$modelContact,$modelShippingParameter,$modelShippingParameterAir,$modelShippingParameterMaritime)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='importer-form')
		{
			echo CActiveForm::validate($model);
			echo CActiveForm::validate($modelContact);
			echo CActiveForm::validate($modelShippingParameter);
			echo CActiveForm::validate($modelShippingParameterAir);
			echo CActiveForm::validate($modelShippingParameterMaritime);
			Yii::app()->end();
		}
	}
}
