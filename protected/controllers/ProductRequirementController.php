<?php

class ProductRequirementController extends Controller
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
		$modelNote = GNote::model()->findByAttributes(array('Id_product_requirement'=>$model->Id, 'Id_entity_type'=>$this->getEntityType()));
		$modelProductReqMultimedias = ProductRequirementMultimedia::model()->findAllByAttributes(array('Id_product_requirement'=>$model->Id));

		$this->render('view',array(
			'model'=>$model,
			'modelNote'=>$modelNote,
			'modelProductReqMultimedias'=>$modelProductReqMultimedias,			
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ProductRequirement;
		$modelNote = new GNote;

		if(isset($_POST['ProductRequirement']))
		{
			
			$model->attributes=$_POST['ProductRequirement'];
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if($model->save()){
					//save note
					if(isset($_POST['notes']) && !empty($_POST['notes'])){
						$modelNote->attributes = array(
														'note'=> $_POST['notes'],
														'Id_entity_type'=>$this->getEntityType(),
														);
						$modelNote->Id_product_requirement = $model->Id;
						$modelNote->save();
					}
					
					$transaction->commit();
					$this->redirect(array('updateMultimedia','id'=>$model->Id));
				}
			} catch (Exception $e) {
				$transaction->rollback();
			}
			
		}

		$this->render('create',array(
			'model'=>$model,
			'modelNote'=>$modelNote
		));
	}

	public function actionUpdateMultimedia($id)
	{
		$model = $this->loadModel($id);
		$productReqMultimedias = ProductRequirementMultimedia::model()->findAllByAttributes(array('Id_product_requirement'=>$id));
		
		$this->render('updateMultimedia',array(
			'model'=>$model,
			'productReqMultimedias'=>$productReqMultimedias,
									
		));
	}
	
	public function actionAjaxRemoveMultimedia()
	{
			
		$idMultimedia = isset($_GET['IdMultimedia'])?$_GET['IdMultimedia']:null;
		$id = isset($_GET['id'])?$_GET['id']:null;
		$model = Multimedia::model()->findByPk($idMultimedia);
		ProductRequirementMultimedia::model()->deleteByPk(array('Id_multimedia'=>$idMultimedia, 'Id_product_requirement'=>$id));
		$this->unlinkFile($model);
		$model->delete();
	
	}
	
	private function unlinkFile($model)
	{
		$imagePath = 'images/';
		$docPath = 'docs/';
		if($model->Id_multimedia_type == 1)
		{
			unlink($imagePath.$model->file_name);
			unlink($imagePath.$model->file_name_small);
		}
		else
			unlink($docPath.$model->file_name);
	
		
	}
	
	public function actionAjaxAddMultimediaDescription()
	{
			
		$idMultimedia = isset($_GET['IdMultimedia'])?$_GET['IdMultimedia']:null;
		$description = isset($_GET['description'])?$_GET['description']:'';
		$model = Multimedia::model()->findByPk($idMultimedia);
		$model->description = $description;
		$model->save();
	
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelNote = GNote::model()->findByAttributes(array('Id_product_requirement'=>$model->Id, 'Id_entity_type'=>$this->getEntityType()));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductRequirement']))
		{
			$model->attributes=$_POST['ProductRequirement'];
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				
				if($model->save()){
					
					if(isset($_POST['notes']) && !empty($_POST['notes'])){
						if($modelNote == null){
							$modelNote = new GNote;
							$modelNote->attributes = array(
														'Id_entity_type'=>$this->getEntityType(),
														);
							$modelNote->Id_product_requirement = $model->Id;
						}
						$modelNote->note = $_POST['notes'];
						$modelNote->save();
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
			'modelNote'=>$modelNote
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
			$model = $this->loadModel($id);
			$modelNote = GNote::model()->findByAttributes(array('Id_product_requirement'=>$model->Id, 'Id_entity_type'=>$this->getEntityType()));
			
			$transaction = $model->dbConnection->beginTransaction();
			try {

				if($modelNote != null)
					$modelNote->delete();
				
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

	public function actionAjaxUpload($id)
	{
		$file = $_FILES['file'];
		
		
		$modelMultimedia = new Multimedia;
			
		$modelMultimedia->uploadedFile = $file;
		if($modelMultimedia->save())
		{
			$modelProductReqMultimedia = new ProductRequirementMultimedia;
			$modelProductReqMultimedia->Id_multimedia = $modelMultimedia->Id;
			$modelProductReqMultimedia->Id_product_requirement = $id;
			$modelProductReqMultimedia->save();
		}

		switch ( $modelMultimedia->Id_multimedia_type) {
			case 1:
				$img = "<img alt='Click to follow' src='" ."images/" . $modelMultimedia->file_name_small . "'" ;
				break;
			case 2:
				$img = "<img alt='Click to follow' src='images/image_resource.png'" ;
				break;
			case 3:
				$img = "<img alt='Click to follow' src='images/pdf_resource.png'" ;
				break;
			case 4:
				$img = "<img alt='Click to follow' src='images/autocad_resource.png'" ;
				break;
			case 5:
				$img = "<img alt='Click to follow' src='images/word_resource.png'" ;
				break;
			case 6:
				$img = "<img alt='Click to follow' src='images/excel_resource.png'" ;
				break;
		}
		
		$size = round($modelMultimedia->size/1024,2);
			
		echo json_encode(array("name" => $img,"type" => '',"size"=> $size, "id"=>$modelMultimedia->Id));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ProductRequirement');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProductRequirement('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductRequirement']))
			$model->attributes=$_GET['ProductRequirement'];

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
		$model=ProductRequirement::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function getEntityType()
	{
		return EntityType::model()->findByAttributes(array('name'=>get_class(ProductRequirement::model())))->Id;
	}
	
	public function actionCreateDependency($dependency)
	{
		$this->redirect(array($dependency.'/createNew','modelCaller'=>lcfirst(get_class(ProductRequirement::model()))));
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-requirement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
