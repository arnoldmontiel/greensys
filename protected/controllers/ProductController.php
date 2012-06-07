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
		$modelProductMultimedias = ProductMultimedia::model()->findAllByAttributes(array('Id_product'=>$id));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'modelProductMultimedias'=>$modelProductMultimedias,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Product;

		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_product'=>$model->Id,'Id_entity_type'=>$this->getEntityType()));
		$modelNote = new Note;
					
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			
			if(!$model->need_rack)
				$model->unit_rack = 0;
			
			$transaction = $model->dbConnection->beginTransaction();
			try {
				//save image
				
				if($_FILES['upfile']['size'] > 0)
					$model->Id_multimedia = $this->saveImage($_FILES['upfile']);
				
				$model->Id_volts = 1;
				if($model->save()){
					//save links
					if(isset($_POST['links'])){
						$this->saveLinks($_POST['links'], $model->Id);
					}
				
					//save note
					if(isset($_POST['notes']) && !empty($_POST['notes']))
						$this->saveNote($_POST['notes'], $model->Id);
				
					$this->createCode($model);
					$transaction->commit();		
					$this->redirect(array('updateMultimedia','id'=>$model->Id));
				}	
			} catch (Exception $e) {
				$transaction->rollback();
			}			
		}

		if(isset($_POST['Product']))
		{
			if(isset($_POST['Product']['Id_category']))
				$ddlCategory = Category::model()->findByPk($_POST['Product']['Id_category']);
			else
			{
				$ddlCategory = Category::model()->findAll();
				if($ddlCategory)
					$ddlCategory = $ddlCategory[0];
			}
		}
		else
		{
			$ddlCategory = Category::model()->findAll();
			if($ddlCategory)
				$ddlCategory = $ddlCategory[0];
		}
		 
		$ddlSubCategory = array();
		if($ddlCategory)
		{
			foreach($ddlCategory->subCategorys as $itemSubCat)
			{			
				$item['Id'] = $itemSubCat->Id;
				$item['description'] = $itemSubCat->description;
				$ddlSubCategory[$itemSubCat->Id] = $item;
			}
		}
		
		$ddlRacks = array();
		for($index = 1; $index <= 10; $index++ )
		{
			$item['Id'] = $index;
			$item['description'] = $index;
			$ddlRacks[$index] = $item;
		}
		
		$this->render('create',array(
			'model'=>$model,
			'modelHyperlink'=>$modelHyperlink,
			'modelNote'=>$modelNote,
			'ddlSubCategory'=>$ddlSubCategory,
			'ddlRacks'=>$ddlRacks,
		));
	}

	public function getEntityType()
	{
		return EntityType::model()->findByAttributes(array('name'=>get_class(Product::model())))->Id;
	}
	
	public function createCode($model)
	{
		$newId = str_pad($model->Id, 2, "0", STR_PAD_LEFT);
		$category = strtoupper(str_pad(substr($model->category->description,0,2), 2, "0"));
		$subCategory = strtoupper(str_pad(substr($model->subCategory->description,0,2), 2, "0"));
		$brand = strtoupper(str_pad(substr($model->brand->description,0,2), 2, "0"));
		$productDesc = strtoupper(str_pad(substr($model->description_supplier,0,1), 1, "0"));
		$color = strtoupper(str_pad(substr($model->color,0,1), 1, "0"));
		$other = strtoupper(str_pad(substr($model->other,0,1), 1, "0"));
		
		
		$model->code = $category . $subCategory . $brand . $productDesc . $newId .  $color . $other;
		$model->save();
	}
	
	private function saveImage($multimediaData)
	{			
		
		$multi = new Multimedia;
		$multi->uploadedFile = $multimediaData;
		if($multi->save())
			return $multi->Id;
		return null; 
			
	}
	
	private function deleteImage($id)
	{
		Multimedia::model()->deleteAllByAttributes(array('Id_product'=>$id));
	}
	
	private function saveNote($noteProduct, $id)
	{
		$this->deleteNote($id);
	
		$note = new Note;
		$note->attributes = array(
							'note'=>$noteProduct,							
							'Id_entity_type'=>$this->getEntityType(),
							'Id_product'=>$id);
		$note->save();							
	}
	
	private function deleteNote($id)
	{
		Note::model()->deleteAllByAttributes(array('Id_product'=>$id));
	}
	
	private function saveLinks($links, $id)
	{
		$this->deleteLinks($id);
	
		foreach ($links as $link){
			$hyperlink = new Hyperlink;
			$hyperlink->attributes = array(
									'description'=>$link,
									'Id_entity_type'=>$this->getEntityType(),
									'Id_product'=>$id);
	
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
		$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_product'=>$model->Id,'Id_entity_type'=>$this->getEntityType()));
		$modelNote = Note::model()->findByAttributes(array('Id_product'=>$model->Id,'Id_entity_type'=>$this->getEntityType()));
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			
			if(!$model->need_rack)
				$model->unit_rack = 0;
			
			if($_FILES['upfile']['size'] > 0)
				$model->Id_multimedia = $this->saveImage($_FILES['upfile']);
			
			//$this->createCode($model);
			if($model->save()){
				
				//update links
				if(isset($_POST['links'])){
					$this->saveLinks($_POST['links'], $model->Id);
				}
				
				//update note
				if(isset($_POST['notes']) && !empty($_POST['notes']))
					$this->saveNote($_POST['notes'], $model->Id);
				
				
				$this->redirect(array('view','id'=>$model->Id));
			}
			$ddlCategory = Category::model()->findByPk($_POST['Product']['Id_category']);
		}
		else
		{
			$ddlCategory = Category::model()->findByPk($model->Id_category);
		}
		
		
		$ddlSubCategory = array();
		foreach($ddlCategory->subCategorys as $itemSubCat)
		{
			$item['Id'] = $itemSubCat->Id;
			$item['description'] = $itemSubCat->description;
			$ddlSubCategory[$itemSubCat->Id] = $item;
		}
		
		$ddlRacks = array();
		for($index = 1; $index <= 10; $index++ )
		{
			$item['Id'] = $index;
			$item['description'] = $index;
			$ddlRacks[$index] = $item;
		}
		
		$this->render('update',array(
			'model'=>$model,
			'modelHyperlink'=>$modelHyperlink,
			'modelNote'=>$modelNote,
			'ddlSubCategory'=>$ddlSubCategory,
			'ddlRacks'=>$ddlRacks,
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
			else if($measureLinear->short_description=='ft')
			{
				$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'ft3'));
			}
				
			$settings = new Settings();
			
			$cubicTo = $settings->getMeasurementUnit(Settings::MT_VOLUME);
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
	
	public function actionAjaxDeleteIcon()
	{
		$id = isset($_POST['id'])?$_POST['id']:null;
		
		$model = $this->loadModel($id);
		
		$modelMultimedia = Multimedia::model()->findByPk($model->Id_multimedia);
		$this->unlinkFile($modelMultimedia);
		$model->Id_multimedia = null;
		$model->save();
	}
	
	public function actionAjaxCheckCode()
	{
		$code = isset($_POST['code'])?$_POST['code']:null;
		$id = isset($_POST['id'])?$_POST['id']:null;
		
		if($code)
		{
			$criteria=new CDbCriteria;
			$criteria->condition='Id <> '.$id;
		
			$codeDB = Product::model()->findByAttributes(array('code'=>$code),$criteria);
			if($codeDB)
				echo "Code already exists";
		}
		else
			echo "Empty value";
	}
	
	public function actionCreateDependency($dependency)
	{
		$this->redirect(array($dependency.'/createNew','modelCaller'=>get_class(Product::model())));
	}
	
	public function actionUpdateMultimedia($id)
	{
		$model = $this->loadModel($id);
		$productMultimedias = ProductMultimedia::model()->findAllByAttributes(array('Id_product'=>$id));
	
		$this->render('updateMultimedia',array(
				'model'=>$model,
				'productMultimedias'=>$productMultimedias,
			
		));
	}
	
	public function actionAjaxRemoveMultimedia()
	{
			
		$idMultimedia = isset($_GET['IdMultimedia'])?$_GET['IdMultimedia']:null;
		$id = isset($_GET['id'])?$_GET['id']:null;
		$model = Multimedia::model()->findByPk($idMultimedia);
		ProductMultimedia::model()->deleteByPk(array('Id_multimedia'=>$idMultimedia, 'Id_product'=>$id));
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
	
	public function actionAjaxUpload($id)
	{
		$file = $_FILES['file'];
	
	
		$modelMultimedia = new Multimedia;
			
		$modelMultimedia->uploadedFile = $file;
		if($modelMultimedia->save())
		{
			$modelProductMultimedia = new ProductMultimedia;
			$modelProductMultimedia->Id_multimedia = $modelMultimedia->Id;
			$modelProductMultimedia->Id_product = $id;
			$modelProductMultimedia->save();
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
	
	public function actionAjaxFillSubCategory()
	{
		//please enter current controller name because yii send multi dim array
		$idCategory = $_POST['Product']['Id_category'];
		$data = CategorySubCategory::model()->findAllByAttributes(array('Id_category'=>$idCategory));
		foreach($data as $item)
		{
			echo CHtml::tag('option',
			array('value'=>$item->Id_sub_category),CHtml::encode($item->subCategory->description),true);
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
