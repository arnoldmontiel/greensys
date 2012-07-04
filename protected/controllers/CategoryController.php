<?php

class CategoryController extends Controller
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
		$modelCategorySubCategory = new CategorySubCategory();
		$modelCategorySubCategory->Id_category = $id;
		if(isset($_GET['CategorySubCategory']))
		{
			$modelCategorySubCategory->attributes =$_GET['CategorySubCategory'];
			if(isset($_GET['CategorySubCategory']['subCategory_description']))
				$modelCategorySubCategory->subCategory_description = $_GET['CategorySubCategory']['subCategory_description'];
			if(isset($_GET['CategorySubCategory']['category_description']))
				$modelCategorySubCategory->category_description = $_GET['CategorySubCategory']['category_description'];
		}		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
				'modelCategorySubCategory'=>$modelCategorySubCategory,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionAjaxCreate()
	{
		$model=new Category;
	
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
	
		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save())
				echo json_encode($model->attributes);
		}
	
	}
	
	
	public function actionCreateNew($modelCaller)
	{
		$model=new Category;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save())
				$this->redirect(array($modelCaller.'/create'));
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

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
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
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAssignSubCategory()
	{
		$model=new Category('search');
		
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		$dataProvider=new CActiveDataProvider('Category');
		$dataProviderSubCategory=new CActiveDataProvider('SubCategory');
		
		if(isset($_GET['Category']['Id']))
		{
			$model->Id = $_GET['Category']['Id'];
		}
		$this->render('assignSubCategory',array(
						'dataProvider'=>$dataProvider,
						'dataProviderSubCategory'=>$dataProviderSubCategory,
						'model'=>$model
		));
	}
	
	public function actionAjaxFillCategorySubCat()
	{
		$data=CategorySubCategory::model()->findAll('Id_category=:parent_id',
		array(':parent_id'=>(int) $_POST['Category']['Id']));
	
		foreach($data as $item)
		{
			echo CHtml::tag('li',
			array('id'=>"items_".$item->Id_sub_category,'class'=>'ui-state-default'),CHtml::encode($item->subCategory->description),true);
		}
	}
	
	public function actionAjaxAddSubCategory()
	{
		$IdCategory = isset($_POST['IdCategory'])?$_POST['IdCategory']:'';
		$IdSubCategory= isset($_POST['IdSubCategory'])?$_POST['IdSubCategory']:'';
		$IdSubCategory = explode("_",$IdSubCategory);
		$IdSubCategory = $IdSubCategory[1];
		
		if(!empty($IdCategory)&&!empty($IdSubCategory))
		{
			$categorySubCatInDb = CategorySubCategory::model()->findByPk(array('Id_category'=>(int) $IdCategory,'Id_sub_category'=>(int)$IdSubCategory));
			if($categorySubCatInDb==null)
			{
				$categorySubCat=new CategorySubCategory;
				$categorySubCat->attributes = array('Id_category'=>$IdCategory,'Id_sub_category'=>$IdSubCategory);
				$categorySubCat->save();
			}			
		}
	}
	
	public function actionAjaxRemoveSubCategory()
	{
		$IdCategory = isset($_POST['IdCategory'])?$_POST['IdCategory']:'';
		$IdSubCategory = isset($_POST['IdSubCategory'])?$_POST['IdSubCategory']:'';
		$IdSubCategory = explode("_",$IdSubCategory);
		$IdSubCategory = $IdSubCategory[1];
	
		if(!empty($IdSubCategory)&&!empty($IdCategory))
		{
			$categorySubCatInDb = CategorySubCategory::model()->findByPk(array('Id_category'=>(int) $IdCategory,'Id_sub_category'=>(int)$IdSubCategory));
			if($categorySubCatInDb!=null)
			{
				$categorySubCatInDb->delete();
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
		$model=Category::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
