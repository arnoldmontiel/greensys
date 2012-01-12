<?php

class ProductController extends Controller
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
				'actions'=>array('@'),
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
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				if($model->save()){
					//save links
					if(isset($_POST['links'])){
						$this->saveLinks($_POST['links'], $model);
					}
				
					//save note
					if(isset($_POST['notes']) && !empty($_POST['notes']))
						$this->saveNote($_POST['notes'], $model);
				
					//save image
					if(isset($_POST['Multimedia']))
						$this->saveImage($model);
				
					$transaction->commit();		
					$this->redirect(array('view','id'=>$model->Id));
				}	
			} catch (Exception $e) {
				$transaction->rollback();
			}			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	private function saveImage($model)
	{			
			$multimedia = Multimedia::model()->findByAttributes(array('Id_product'=>$model->Id));
			
			$entity = EntityType::model()->findByAttributes(array('name'=>get_class($model)));
		
			$multi = new Multimedia;
			$multi->attributes = array(
									'Id_entity_type'=>$entity->Id,
									'Id_product'=>$model->Id);
			if($multi->save() && $multimedia->Id != null)
				Multimedia::model()->deleteByPk($multimedia->Id);
			
	}
	
	private function deleteImage($id)
	{
		Multimedia::model()->deleteAllByAttributes(array('Id_product'=>$id));
	}
	
	private function saveNote($noteProduct, $model)
	{
		$this->deleteNote($model->Id);
		
		$entity = EntityType::model()->findByAttributes(array('name'=>get_class($model)));
		
		$note = new Note;
		$note->attributes = array(
							'note'=>$noteProduct,							
							'Id_entity_type'=>$entity->Id,
							'Id_product'=>$model->Id);
		$note->save();							
	}
	
	private function deleteNote($id)
	{
		Note::model()->deleteAllByAttributes(array('Id_product'=>$id));
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
							'Id_product'=>$model->Id);
			
			$hyperlink->save();
		}
	}
	
	private function deleteLinks($id)
	{
		Hyperlink::model()->deleteAllByAttributes(array('Id_product'=>$id));
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

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save()){
				
				//update links
				if(isset($_POST['links'])){
					$this->saveLinks($_POST['links'], $model);
				}
				
				//update note
				if(isset($_POST['notes']) && !empty($_POST['notes']))
					$this->saveNote($_POST['notes'], $model);
				
				//save image
				if(isset($_POST['Multimedia']))
					$this->saveImage($model);
				
				$this->redirect(array('view','id'=>$model->Id));
			}
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
			$model=$this->loadModel($id);
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				//First delete links
				$this->deleteLinks($id);
					
				//First delete note
				$this->deleteNote($id);
					
				//First delete image
				$this->deleteImage($id);
					
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
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	* Manages all models.
	*/
	public function actionProductGroup()
	{
		$model=new Product('search');
		$model->unsetAttributes();
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$modelGroup=new ProductGroup('search');
		$modelGroup->unsetAttributes();
		if(isset($_GET['ProductGroup']))
			$modelGroup->attributes=$_GET['ProductGroup'];

		if(isset($_GET['Product']['Id'])){
			$modelGroup->Id_product_parent=$_GET['Product']['Id'];
			$model->unsetAttributes();
		}
		
		// Uncomment the following line if AJAX validation is needed
		$dataProvider=new CActiveDataProvider('Product');
		$dataProviderProductGroup=new CActiveDataProvider('ProductGroup');
		$this->render('productGroup',array(
							'dataProvider'=>$dataProvider,
							'model'=>$model, //model for creation
							'dataProviderGroup'=>$dataProviderProductGroup,
							'modelProductGroup'=>$modelGroup //model for creation
		));
	
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionAjaxFillProductGroup()
	{
		$data=ProductGroup::model()->findAll('Id_product_parent=:parent_id',
		array(':parent_id'=>(int) $_POST['Product']['Id']));
	
	
		foreach($data as $item)
		{
			for ($i = 0; $i < $item->quantity; $i++) {
				echo CHtml::tag('li',
				array('id'=>"items_".$item->Id_product_child,'class'=>'ui-state-default'),CHtml::encode($item->productChild->description_customer),true);
			}
		}
	}
	public function actionAjaxFillProducts()
	{
		$data=Product::model()->findAll('Id_category=:Id_category',
		array(':Id_category'=>(int) $_POST['Category']['Id']));
	
		$itemsProduct = CHtml::listData($data, 'Id', 'description_customer');
	
		$this->widget('ext.draglist.draglist', array(
							'id'=>'dlProduct',
							'items' => $itemsProduct,
							'options'=>array(
									'helper'=> 'clone',
									'connectToSortable'=>'#ddlAssigment',
		),
		));
	}
	/**
	 * adds a new item into ProductArea table
	 * @param new_product, should be "tag_id", ei. product_1
	 * @param areaId, should be "id", ei. 2
	 */
	
	public function actionAjaxAddProductGroup()
	{
		$idProductParent = isset($_GET['IdProductParent'][0])?$_GET['IdProductParent'][0]:'';
		$idProductChild = isset($_GET['IdProductChild'][0])?$_GET['IdProductChild'][0]:'';
			
		if(!empty($idProductParent)&&!empty($idProductChild))
		{
			$productGroupInDb = ProductGroup::model()->findByPk(array('Id_product_parent'=>(int) $idProductParent,'Id_product_child'=>(int)$idProductChild));
			if($productGroupInDb==null)
			{
				$productGroup=new ProductGroup;
				$productGroup->attributes = array('Id_product_parent'=>$idProductParent,'Id_product_child'=>$idProductChild,'quantity'=>1);
				$productGroup->save();
			}
			else
			{
				$quantity = $productGroupInDb->quantity+1;
				$productGroupInDb->attributes = array('quantity'=>$quantity);
				$productGroupInDb->save();
			}
		}
	}
	public function actionAjaxRemoveProductGroup()
	{
		$idProductParent = isset($_GET['IdProductParent'])?$_GET['IdProductParent']:'';
		$idProductChild = isset($_GET['IdProductChild'])?$_GET['IdProductChild']:'';
			
		if(!empty($idProductParent)&&!empty($idProductChild))
		{
			$productGroupInDb = ProductGroup::model()->findByPk(array('Id_product_parent'=>(int) $idProductParent,'Id_product_child'=>(int)$idProductChild));
			if($productGroupInDb!=null)
			{
				if($productGroupInDb->quantity>1)
				{
					$productGroupInDb->attributes = array('quantity'=>$productGroupInDb->quantity-1);
					$productGroupInDb->save();
				}
				else
				{
					$productGroupInDb->delete();
				}
			}
		}
	}
	public function actionAjaxFillSidebar()
	{
		if(isset($_POST['Product']['Id']))
		{
			$product = Product::model()->findByPk($_POST['Product']['Id']);
			echo CHtml::openTag("ul");
			echo "Selected Product:";
			echo CHtml::closeTag("ul");
			echo CHtml::openTag("ul");
	
			echo CHtml::openTag("li");
			echo $product->code;
			echo CHtml::closeTag("li");
			
			echo CHtml::openTag("li");
			echo $product->supplier->business_name;
			echo CHtml::closeTag("li");
				
			echo CHtml::openTag("li");
			echo $product->brand->description;
			echo CHtml::closeTag("li");
	
			echo CHtml::openTag("li");
			echo $product->category->description;
			echo CHtml::closeTag("li");
			
			echo CHtml::openTag("li");
			echo $product->description_customer;
			echo CHtml::closeTag("li");
			
			echo CHtml::openTag("li");
			echo $product->description_supplier;
			echo CHtml::closeTag("li");
			
			echo CHtml::closeTag("ul");
	
		}
	}	
	public function actionAjaxFillVolume()
	{
		if(isset($_POST['Product']['width'])&&isset($_POST['Product']['height'])&&isset($_POST['Product']['length']))
		{
			$width = $_POST['Product']['width'];
			$height = $_POST['Product']['height'];
			$length = $_POST['Product']['length'];
			$measureLinear = MeasurementUnit::model()->findByPk($_POST['Product']['Id_measurement_unit_linear']);
			if($measureLinear->short_description=='ml')
			{
				$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'m3'));
			}
			else if($measureLinear->short_description=='in')
			{
				$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'in3'));				
			}
				
			$cubicTo = MeasurementUnit::model()->findByAttributes(array('short_description'=>'m3'));
			$converter = MeasurementUnitConverter::model()->findByAttributes(
				array(
					'Id_measurement_from'=>$cubicFrom->Id,
					'Id_measurement_to'=>$cubicTo->Id,
				)
			);
			echo round($converter->factor * (double)$width * (double)$height * (double)$length, 6);	
		}
	}
	public function actionAjaxFillWeight()
	{
		if(isset($_POST['Id_measurement_unit_weight'])&&isset($_POST['weight']))
		{
			$id_measurement_unit_weight = $_POST['Product']['width'];
			$weight = $_POST['weight'];
			
			$weghtTo = MeasurementUnit::model()->findByAttributes(array('short_description'=>'kg'));		
			$weghtFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'lb'));
			
			$converter = MeasurementUnitConverter::model()->findByAttributes(
			array(
							'Id_measurement_from'=>$weghtFrom->Id,
							'Id_measurement_to'=>$weghtTo->Id,
			)
			);
			echo round($converter->factor * (double)$weight , 2);
		}
		
	}
	
	public function actionProductRequirement()
	{
		$model=new Product('search');
		$model->unsetAttributes();
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];
		
		$modelRequirement = new ProductRequirement('search');
		$modelRequirement->unsetAttributes();
		if(isset($_GET['ProductRequirement']))
			$modelRequirement->attributes=$_GET['ProductRequirement'];
		
		$modelProductRequirement = new ProductRequirementProduct('search');
		$modelProductRequirement->unsetAttributes();
		if(isset($_GET['ProductRequirementProduct']))
			$modelProductRequirement->attributes=$_GET['ProductRequirementProduct'];
		
		if(isset($_GET['Product']['Id'])){
			$modelProductRequirement->Id_product=$_GET['Product']['Id'];
			$model->unsetAttributes();
		}
		
		$this->render('productRequirement',array(
							'model'=>$model, //model for creation
							'modelRequirement'=>$modelRequirement,
							'modelProductRequirement'=>$modelProductRequirement
		));
		
	}
	
	public function actionAjaxAddProductRequirement()
	{
		$idProduct = isset($_GET['IdProduct'][0])?$_GET['IdProduct'][0]:'';
		$idRequirement = isset($_GET['IdRequirement'][0])?$_GET['IdRequirement'][0]:'';
			
		if(!empty($idProduct)&&!empty($idRequirement))
		{
			$productReqProdInDb = ProductRequirementProduct::model()->findByPk(array('Id_product'=>(int) $idProduct,'Id_product_requirement'=>(int)$idRequirement));
			if($productReqProdInDb==null)
			{
				$productReqProd=new ProductRequirementProduct;
				$productReqProd->attributes = array('Id_product'=>$idProduct,'Id_product_requirement'=>$idRequirement);
				$productReqProd->save();
			}
			else
			{
				throw new CDbException('Item has already been added');
			}
		}
	}
	public function actionAjaxRemoveProductRequirement()
	{
		$idProduct = isset($_GET['IdProduct'])?$_GET['IdProduct']:'';
		$idRequirement = isset($_GET['IdRequirement'])?$_GET['IdRequirement']:'';
			
		if(!empty($idProduct)&&!empty($idRequirement))
		{
			$productReqProdInDb = ProductRequirementProduct::model()->findByPk(array('Id_product'=>(int) $idProduct,'Id_product_requirement'=>(int)$idRequirement));
			if($productReqProdInDb!=null)
			{
				$productReqProdInDb->delete();
			}
		}
	}
	
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
