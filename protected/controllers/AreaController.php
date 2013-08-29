<?php

class AreaController extends Controller
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
		$model=new Area;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Area']))
		{
			$model->attributes=$_POST['Area'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Area']))
		{
			$model->attributes=$_POST['Area'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
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
		$model=new Area('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Area']))
			$model->attributes=$_GET['Area'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	*/
	public function actionProductArea()
	{
		$model=new Area('search');

		$modelProduct=new Product('search');
		$modelProduct->unsetAttributes();
		
		$modelProductArea=new ProductArea('search');
		$modelProductArea->unsetAttributes();
		
		if(isset($_GET['Area']))
			$model->attributes=$_GET['Area'];
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];
		if(isset($_GET['ProductArea']))
			$modelProductArea->attributes=$_GET['ProductArea'];
		if(isset($_GET['Area']['Id']))
			$modelProductArea->Id_area=$_GET['Area']['Id'];
		

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$dataProvider=new CActiveDataProvider('Area');
		$dataProviderProduct=new CActiveDataProvider('Product');
		$dataProviderProductArea=new CActiveDataProvider('ProductArea');
		//$modelProduct->code = "CLMJGP";
		
		$this->render('productArea',array(
				'dataProvider'=>$dataProvider,
				'dataProviderProduct'=>$dataProviderProduct,
				'dataProviderProductArea'=>$dataProviderProductArea,
				'model'=>$model,
				'modelProduct'=>$modelProduct,
				'modelProductArea'=>$modelProductArea,
		));
	
	}
	
	/**
	*/
	public function actionCategoryArea()
	{
	$model=new Area('search');
	if(isset($_GET['Area']))
		$model->attributes=$_GET['Area'];
		
	// Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($model);
	$dataProvider=new CActiveDataProvider('Area');
	$dataProviderCategory=new CActiveDataProvider('Category');
	
	$this->render('categoryArea',array(
				'dataProvider'=>$dataProvider,
				'dataProviderCategory'=>$dataProviderCategory,
				'model'=>$model
	));
	
	}
	
	public function actionServiceArea()
	{
		$model=new Area('search');
		if(isset($_GET['Area']))
			$model->attributes = $_GET['Area'];	
				
		$dataProvider=new CActiveDataProvider('Area');
		$dataProviderService=new CActiveDataProvider('Service');
		
		$this->render('serviceArea',array(
					'dataProvider'=>$dataProvider,
					'dataProviderService'=>$dataProviderService,
					'model'=>$model
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Area::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionAjaxFillProductArea()
	{
		$data=ProductArea::model()->findAll('Id_area=:parent_id',
		array(':parent_id'=>(int) $_POST['Area']['Id']));
	
	
		foreach($data as $item)
		{
			for ($i = 0; $i < $item->quantity; $i++) {
				echo CHtml::tag('li',
				array('id'=>"items_".$item->Id_product,'class'=>'ui-state-default'),CHtml::encode($item->product->description_customer),true);
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
	
	public function actionAjaxAddProductArea()
	{
		$idArea = isset($_GET['IdArea'])?$_GET['IdArea']:'';
		$idProduct = isset($_GET['IdProduct'])?(int)$_GET['IdProduct'][0]:'';

		if(!empty($idProduct)&&!empty($idArea))
		{
			$productAreaInDb = ProductArea::model()->findByPk(array('Id_area'=>(int) $idArea,'Id_product'=>(int)$idProduct));
			if($productAreaInDb==null)
			{
				$productArea=new ProductArea;
				$productArea->attributes = array('Id_area'=>$idArea,'Id_product'=>$idProduct,'quantity'=>1);
				$productArea->save();
			}
			else
			{
				$quantity = $productAreaInDb->quantity+1;				
				$productAreaInDb->attributes = array('quantity'=>$quantity);
				$productAreaInDb->save();
			}
		}		
	}	
	public function actionAjaxRemoveProductArea()
	{
		$idArea = isset($_GET['IdArea'])?$_GET['IdArea']:'';
		$idProduct = isset($_GET['IdProduct'])?(int)$_GET['IdProduct']:'';
						
		if(!empty($idProduct)&&!empty($idArea))
		{
			$productAreaInDb = ProductArea::model()->findByPk(array('Id_area'=>(int) $idArea,'Id_product'=>(int)$idProduct));
			if($productAreaInDb!=null)
			{
				if($productAreaInDb->quantity>1)
				{
					$productAreaInDb->attributes = array('quantity'=>$productAreaInDb->quantity-1);
					$productAreaInDb->save();
						
				}
				else 
				{
					$productAreaInDb->delete();						
				}
			}
		}
	}	
	public function actionAjaxFillCategoryArea()
	{
		$data=CategoryArea::model()->findAll('Id_area=:parent_id',
		array(':parent_id'=>(int) $_POST['Area']['Id']));
	
	
		foreach($data as $item)
		{
			for ($i = 0; $i < $item->quantity; $i++) {
				echo CHtml::tag('li',
				array('id'=>"items_".$item->Id_category,'class'=>'ui-state-default'),CHtml::encode($item->category->description),true);
			}
		}
	}
	
	public function actionAjaxAddCategoryArea()
	{
		$idArea = isset($_POST['areaId'])?$_POST['areaId']:'';
		$IdCategory= isset($_POST['IdCategory'])?$_POST['IdCategory']:'';
		$IdCategory = explode("_",$IdCategory);
		$idCategory = $IdCategory[1];

		if(!empty($idCategory)&&!empty($idArea))
		{
			$categoryAreaInDb = CategoryArea::model()->findByPk(array('Id_area'=>(int) $idArea,'Id_category'=>(int)$idCategory));
			if($categoryAreaInDb==null)
			{
				$categoryArea=new CategoryArea;
				$categoryArea->attributes = array('Id_area'=>$idArea,'Id_category'=>$idCategory,'quantity'=>1);
				$categoryArea->save();
			}
			else
			{
				$quantity = $categoryAreaInDb->quantity+1;				
				$categoryAreaInDb->attributes = array('quantity'=>$quantity);
				$categoryAreaInDb->save();
			}
		}		
	}	
	public function actionAjaxRemoveCategoryArea()
	{
		$idArea = isset($_POST['areaId'])?$_POST['areaId']:'';
		$IdCategory = isset($_POST['IdCategory'])?$_POST['IdCategory']:'';
		$IdCategory = explode("_",$IdCategory);
		$idCategory = $IdCategory[1];
				
		if(!empty($idCategory)&&!empty($idArea))
		{
			$categoryAreaInDb = CategoryArea::model()->findByPk(array('Id_area'=>(int) $idArea,'Id_category'=>(int)$idCategory));
			if($categoryAreaInDb!=null)
			{
				if($categoryAreaInDb->quantity>1)
				{
					$categoryAreaInDb->attributes = array('quantity'=>$categoryAreaInDb->quantity-1);
					$categoryAreaInDb->save();
				}
				else 
				{
					$categoryAreaInDb->delete();						
				}
			}
		}
	}	
	public function actionAjaxFillServiceArea()
	{
		$data=ServiceArea::model()->findAll('Id_area=:Id_area',
		array(':Id_area'=>(int) $_POST['Area']['Id']));
	
	
		foreach($data as $item)
		{
			echo CHtml::tag('li',
			array('id'=>"items_".$item->Id_service,'class'=>'ui-state-default'),CHtml::encode($item->service->description),true);
		}
	}

	public function actionAjaxAddServiceArea()
	{
		$idArea = isset($_POST['IdArea'])?$_POST['IdArea']:'';
		$IdService= isset($_POST['IdService'])?$_POST['IdService']:'';
		$IdService = explode("_",$IdService);
		$idService = $IdService[1];

		if(!empty($idService)&&!empty($idArea))
		{
			$serviceAreaInDb = ServiceArea::model()->findByPk(array('Id_area'=>(int) $idArea,'Id_service'=>(int)$idService));
			if($serviceAreaInDb==null)
			{
				$serviceArea=new ServiceArea;
				$serviceArea->attributes = array('Id_area'=>$idArea,'Id_service'=>$idService);
				$serviceArea->save();
			}
		}		
	}	
	public function actionAjaxRemoveServiceArea()
	{
		$idArea = isset($_POST['IdArea'])?$_POST['IdArea']:'';
		$IdService= isset($_POST['IdService'])?$_POST['IdService']:'';
		$IdService = explode("_",$IdService);
		$idService = $IdService[1];

		if(!empty($idService)&&!empty($idArea))
		{
			$serviceAreaInDb = ServiceArea::model()->findByPk(array('Id_area'=>(int) $idArea,'Id_service'=>(int)$idService));
			if($serviceAreaInDb!=null)
			{
					$serviceAreaInDb->delete();						
			}
		}
	}	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='area-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
