<?php

class PriceListController extends Controller
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
				'actions'=>array('*'),
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
		$modelPriceListItem = new PriceListItem();
		$modelPriceListItem->unsetAttributes();
		if(isset($_GET['PriceListItem']))
		{
			$modelPriceListItem->attributes = $_GET['PriceListItem']; 
		}
		$modelPriceListItem->Id_price_list = $model->Id;
		$view = 'view';
		if($model->Id_price_list_type==2)
		{
			$view ='viewSale';		 	
		}
		$this->render($view,array(
			'model'=>$model,
			'modelPriceListItem'=>$modelPriceListItem,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PriceList;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PriceList']))
		{
			$model->attributes=$_POST['PriceList'];
			if($model->save())
			{
				$this->redirect(array('priceListItem','PriceList'=>array('Id'=>$model->Id)));
				//array('label'=>'Assing Products', 'url'=>array('priceListItem',),
				
			}
		}

		$model->validity=1;
		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionClonePriceList()
	{
		$model=new PriceList;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		$modelToClone=new PriceList('search');
		$modelToClone->unsetAttributes();  // clear any default values
		
		
		$modelPriceListItem=new PriceListItem('search');
		$modelPriceListItem->unsetAttributes();  // clear any default values
		
		
		if(isset($_GET['PriceListItem']))
			$modelPriceListItem->attributes=$_GET['PriceListItem'];
	
		if(isset($_GET['PriceList'])){
			$modelToClone->attributes=$_GET['PriceList'];
		}
		
		
		if(isset($_GET['PriceList']['id']))
			$modelPriceListItem->Id_price_list = $_GET['PriceList']['id'];
		
		if(isset($_POST['PriceList']) && isset($_POST['hiddenPriceListId']))
		{
			$transaction = $model->dbConnection->beginTransaction();
			try {

				$modelDB = PriceList::model()->findByPk($_POST['hiddenPriceListId']);
				
				$model->attributes = array('Id_price_list_type'=>$modelDB->Id_price_list_type,
											'Id_supplier'=>$modelDB->Id_supplier);
				
				
				$modelDB->validity = 0;
				$modelDB->save();
				
				$model->attributes = $_POST['PriceList'];
				$model->validity = 1;
				
				if($model->save())
				{
					
					$items = PriceListItem::model()->findAllByAttributes(array('Id_price_list'=>(int)$_POST['hiddenPriceListId']));
					foreach ($items as $item)
					{
						$priceListItem = new PriceListItem;
						$priceListItem->attributes = $item->attributes;
						$priceListItem->Id = null;
						$priceListItem->Id_price_list = $model->Id;
						$priceListItem->save();
					}
				}
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->Id));
			} catch (Exception $e) {
				$transaction->rollback();
			}
	
		}
		$modelToClone->Id_price_list_type= 1;
	
		$this->render('clonePriceList',array(
				'model'=>$model,
				'modelToClone'=>$modelToClone,
				'modelPriceListItem'=>$modelPriceListItem,
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

		if(isset($_POST['PriceList']))
		{
			$model->attributes=$_POST['PriceList'];
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
			$model = $this->loadModel($id);
			
			if($model->Id_price_list_type == 1) //de compra
			{
				$criteria = new CDbCriteria();
				
				$criteria->join = 'inner join price_list_item pli1 on pli1.Id_price_list = t.Id';
				$criteria->addCondition('pli1.Id_product not in
								(select pli2.Id_product from price_list_item pli2
								where
								pli2.Id_price_list = '.$id.')
								and t.Id_price_list_type = 2');
				
				if(PriceList::model()->count($criteria)>0)
					$model->delete();
				else
					throw new CHttpException(500,Yii::app()->lc->t('The current Price List is used by a Sale Price List, you can not delete it.'));
			}
			else
			{
				if(BudgetItem::model()->countByAttributes(array('Id_price_list'=>$id)) == 0)
					$model->delete();
				else
					throw new CHttpException(500,Yii::app()->lc->t('The current Sale Price List is used by a Budget, you can not delete it.'));
			}
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionAjaxDeletePriceListItem($id)
	{
		if(Yii::app()->request->isPostRequest)
		{

			$model = $this->loadPriceListItem($id);
			if($model->priceList->Id_price_list_type == 1) //de compra
			{
				$criteria = new CDbCriteria();
			
				$criteria->join = 'inner join price_list_item pli1 on pli1.Id_price_list = t.Id';
				$criteria->addCondition('pli1.Id_product in
											(select pli2.Id_product from price_list_item pli2
											where
											pli2.Id = '.$id.')
											and t.Id_price_list_type = 2');
				
				if(PriceList::model()->count($criteria) == 0)
					$model->delete();
				else
					throw new CHttpException(500,Yii::app()->lc->t('The current Price List Item is used by a Sale Price List, you can not delete it.'));
			}
			else
			{
				if(BudgetItem::model()->countByAttributes(array('Id_price_list'=>$model->Id_price_list,'Id_product'=>$model->Id_product)) == 0)
					$model->delete();
				else
					throw new CHttpException(500,Yii::app()->lc->t('The current Sale Price List is used by a Budget, you can not delete it.'));
			}
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('priceListItem'));
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
		$model=new PriceList('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PriceList']))
			$model->attributes=$_GET['PriceList'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionPriceListItem()
	{
		
		$model=new PriceListItem('search');
		$model->unsetAttributes();  // clear any default values
		
		$modelProduct=new Product('search');
		$modelProduct->unsetAttributes();
		
		if(isset($_GET['PriceListItem']))
			$model->attributes=$_GET['PriceListItem'];
		
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];
		
		$modelPriceList = new PriceList();
		if(isset($_GET['PriceList'])){
			$model->Id_price_list=$_GET['PriceList']['Id'];
			$modelPriceList = PriceList::model()->findByPk($_GET['PriceList']['Id']);
			$modelProduct->Id_supplier = $modelPriceList->Id_supplier;
		}
		
		$this->render('priceListItem',array(
					'model'=>$model,
					'modelProduct'=>$modelProduct,
					'modelPriceList'=>$modelPriceList,
		));
		
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PriceList::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadPriceListItem($id)
	{
		$model=PriceListItem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function actionAjaxUpdateMaritimeCost()
	{
		$idPriceListItem = $_POST['id_price_list_item'];
		$maritimeCost = $_POST['maritime_cost'];
		$priceListItem= PriceListItem::model()->findByPk($idPriceListItem);
		if(isset($priceListItem))
		{
			$priceListItem->maritime_cost = (double) $maritimeCost;
			$priceListItem->save();
		}
		echo json_encode($priceListItem->attributes);
	}
	public function actionAjaxUpdateAirCost()
	{
		$idPriceListItem = $_POST['id_price_list_item'];
		$airCost = $_POST['air_cost'];
		$priceListItem= PriceListItem::model()->findByPk($idPriceListItem);
		if(isset($priceListItem))
		{
			$priceListItem->air_cost = (double) $airCost;
			$priceListItem->save();
		}
		echo json_encode($priceListItem->attributes);
	}
	
	public function actionAjaxUpdateMsrp()
	{
		$idPriceListItem = $_POST['idPriceListItem'];
		$msrp = $_POST['msrp'];
		$profitRate = $_POST['profitRate'];
		$priceListItem= PriceListItem::model()->findByPk($idPriceListItem);
		if($priceListItem!= null)
		{
			if($profitRate > 0)
				$priceListItem->attributes = array('msrp'=>(double) $msrp, 'profit_rate'=>(double) $profitRate);
			else
				$priceListItem->attributes = array('msrp'=>(double) $msrp);
			
			$priceListItem->save();
		}
		return $priceListItem;
		
	}

	public function actionAjaxUpdateDealerCost()
	{
		$idPriceListItem = $_POST['idPriceListItem'];
		$dealerCost = $_POST['dealerCost'];
		$profitRate = $_POST['profitRate'];
		$priceListItem= PriceListItem::model()->findByPk($idPriceListItem);
		if($priceListItem!= null)
		{
			if($profitRate > 0)
				$priceListItem->attributes = array('dealer_cost'=>(double) $dealerCost, 'profit_rate'=>(double) $profitRate);
			else
				$priceListItem->attributes = array('dealer_cost'=>(double) $dealerCost);
			
			$priceListItem->save();
		}
		return $priceListItem;
	
	}

	public function actionAjaxUpdateProfitRate()
	{
		$idPriceListItem = $_POST['idPriceListItem'];
		$profitRate = $_POST['profitRate'];
		$priceListItem= PriceListItem::model()->findByPk($idPriceListItem);
		if($priceListItem!= null)
		{
			$priceListItem->attributes = array('profit_rate'=>(double) $profitRate);
			$priceListItem->save();
		}
		return $priceListItem;
	
	}	
	
	public function actionAjaxAddPriceListItem()
	{	
		
		$idPriceList = isset($_GET['IdPriceList'])?$_GET['IdPriceList']:'';
		$idProduct = isset($_GET['IdProduct'])?(int)$_GET['IdProduct'][0]:'';
		
		if(!empty($idPriceList)&&!empty($idProduct))
		{
			$priceListItemInDb = PriceListItem::model()->findByAttributes(array('Id_price_list'=>(int) $idPriceList,'Id_product'=>(int)$idProduct));
			if($priceListItemInDb==null)
			{
				$product = Product::model()->findByPk($idProduct);
				$priceListItem=new PriceListItem();
				$priceListItem->attributes =  array('Id_price_list'=>$idPriceList,
													'Id_product'=>$idProduct,
													'msrp'=>$product->msrp,
													'dealer_cost'=>$product->dealer_cost,
													'profit_rate'=>$product->profit_rate);
				$priceListItem->save();
			}
			else
			{
				throw new CHttpException(500,Yii::app()->lc->t('Item has already been added'));
			}
		}
		
	}
	
	public function actionAjaxAddPriceListItemSale()
	{
		$idPriceList = isset($_GET['Id_price_list'])?$_GET['Id_price_list']:'';
		$idProduct = isset($_GET['Id_product'])?$_GET['Id_product']:'';
		
		if(!empty($idPriceList)&&!empty($idProduct))
		{
			$priceListItemInDb = PriceListItem::model()->findByAttributes(array('Id_price_list'=>(int) $idPriceList,'Id_product'=>(int)$idProduct));
			if($priceListItemInDb==null)
			{
				$criteria = new CDbCriteria;
				$criteria->compare('t.Id_product', $idProduct);
				$criteria->with[]='priceList';
				$criteria->compare('priceList.Id_price_list_type',1);//purchase
				//$criteria->compare('priceList.validity',1);
				$criteria->order = 't.Id_price_list DESC';
				$priceListItemPurchase = PriceListItem::model()->find($criteria);
				$product = Product::model()->findByPk($idProduct);
				$volume = $product->getVolume();
				if($volume===false)
				{
					throw new CHttpException(500,Yii::app()->lc->t('Product has not width or height or or length.'));
				}
				if(isset($priceListItemPurchase))
				{
					$priceListItem=new PriceListItem();
					$priceList = PriceList::model()->findByPk($idPriceList);
					$importer = $priceList->importer;
					if(!empty($importer->shippingParameters))
					{
						$shippingParameter = $importer->shippingParameters[0];
						$air = $shippingParameter->shippingParameterAir;
						$maritime = $shippingParameter->shippingParameterMaritime;
						
						$maritime_cost = $priceListItemPurchase->dealer_cost+($maritime->cost_measurement_unit*$volume); 
						$air_cost = $priceListItemPurchase->dealer_cost+($air->cost_measurement_unit*$product->weight);
						$priceListItem->attributes =  array('Id_price_list'=>$idPriceList,
								'Id_product'=>$idProduct,
								'msrp'=>$priceListItemPurchase->msrp,
								'dealer_cost'=>$priceListItemPurchase->dealer_cost,
								'profit_rate'=>$priceListItemPurchase->profit_rate,
								'maritime_cost'=>$maritime_cost * $priceListItemPurchase->profit_rate,
								'air_cost'=>$air_cost * $priceListItemPurchase->profit_rate,
						);
						
						$priceListItem->save();
					}
				}
				else
				{
					throw new CHttpException(500,Yii::app()->lc->t('Product must be included in at least one purchase price list.'));											
				}
			}
			else
			{
				throw new CHttpException(500,Yii::app()->lc->t('Item has already been added.'));
			}
		}
	
	}
	
	
	public function actionAjaxAddFilteredProducts()
	{
	
		$productFilter = isset($_POST['Product'])?$_POST['Product']:null;
		$idPriceList = isset($_POST['Id_price_list'])?$_POST['Id_price_list']:null;

		if($productFilter != null && $idPriceList != null){
			$products = Product::model();
			$products->attributes = $productFilter;
			
			$pl = PriceList::model()->findByPk($idPriceList);
			$products->Id_supplier = $pl->Id_supplier;
			
			$prov = $products->searchSummary();
			$prov->pagination = false;
			foreach($prov->getData(true) as $product){
				$priceListItemInDb = PriceListItem::model()->findByAttributes(array('Id_price_list'=> $idPriceList,'Id_product'=>$product->Id));
				if($priceListItemInDb==null)
				{
					$priceListItem=new PriceListItem();
					$priceListItem->attributes =  array('Id_price_list'=>$idPriceList,
														'Id_product'=>$product->Id,
														'msrp'=>$product->msrp,
														'dealer_cost'=>$product->dealer_cost,
														'profit_rate'=>$product->profit_rate);
					
					$priceListItem->save();
				}
			}
		}
	
	}
	public function actionAjaxUpdatePriceListItemGrid()
	{
		$modelEmpty = new Product();
		$model=new PriceListItem();
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['PriceListItem']))
			$model->attributes=$_GET['PriceListItem'];
				
		if(isset($_GET['PriceList']))
		{
			$model->Id_price_list= $_GET['PriceList']['Id'];
		}
		
		$this->render('priceListItem',array(
				'model'=>$model,
				'modelProduct'=>$modelEmpty,
		));				
	}
	public function actionAjaxUpdateProductGrid()
	{
		$modelEmpty = new PriceListItem();
		$model=new Product();
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];
		
		if(isset($_GET['PriceList']))
		{
			$modelPriceList = PriceList::model()->findByPk($_GET['PriceList']['Id']);
			$model->Id_supplier = $modelPriceList->Id_supplier;
		}
		
		$this->render('priceListItem',array(
				'model'=>$modelEmpty,
				'modelProduct'=>$model,
		));				
	}
	public function actionAjaxAddFilteredProductsSale()
	{
	
		$productFilter = isset($_POST['Product'])?$_POST['Product']:null;
		$idPriceList = isset($_POST['Id_price_list'])?(int)$_POST['Id_price_list']:null;
	
		if(isset($productFilter) && isset($idPriceList))
		{
			
			$modelProduct = Product::model();
			$modelProduct->attributes = $productFilter;
	
			$priceList = PriceList::model()->findByPk($idPriceList);
			$modelProduct->Id_supplier = $priceList->Id_supplier;
	
			$provProduct = $modelProduct->searchSummary();
			$provProduct->pagination = false;
			$products = $provProduct->data;
			foreach($products as $product){
				$criteria = new CDbCriteria;
				$criteria->compare('t.Id_product', $product->Id);
				$criteria->with[]='priceList';
				$criteria->compare('priceList.Id_price_list_type',1);//purchase
				//$criteria->compare('priceList.validity',1);
				$criteria->order = 't.Id_price_list DESC';
				$priceListItemPurchase = PriceListItem::model()->find($criteria);
				$volume = $product->getVolume();
				if(isset($priceListItemPurchase)&&$volume!==false)
				{
					$priceListItemInDb = PriceListItem::model()->findByAttributes(array('Id_price_list'=>(int) $idPriceList,'Id_product'=>$product->Id));
					if(!isset($priceListItemInDb))
					{
						$priceListItem=new PriceListItem();
						$importer = $priceList->importer;
						if(!empty($importer->shippingParameters))
						{
							$shippingParameter = $importer->shippingParameters[0];
							$air = $shippingParameter->shippingParameterAir;
							$maritime = $shippingParameter->shippingParameterMaritime;
								
							$maritime_cost = $priceListItemPurchase->dealer_cost+($maritime->cost_measurement_unit*$volume);
							$air_cost = $priceListItemPurchase->dealer_cost+($air->cost_measurement_unit*$product->weight);
							$priceListItem->attributes =  array('Id_price_list'=>$idPriceList,
									'Id_product'=>$product->Id,
									'msrp'=>$priceListItemPurchase->msrp,
									'dealer_cost'=>$priceListItemPurchase->dealer_cost,
									'profit_rate'=>$priceListItemPurchase->profit_rate,
									'maritime_cost'=>$maritime_cost * $priceListItemPurchase->profit_rate,
									'air_cost'=>$air_cost * $priceListItemPurchase->profit_rate,
							);
							$priceListItem->save();
						}
					}						
				}
			}
		}
	}
	
	
	public function actionAjaxDeleteFilteredProducts()
	{
	
		$plItemsFilter = isset($_POST['PriceListItem'])?$_POST['PriceListItem']:null;
		$plItemId = isset($_POST['Id_price_list'])?$_POST['Id_price_list']:null;
		
		if($plItemsFilter != null && $plItemId != null){
			$plItems = PriceListItem::model();
			$plItems->attributes = $plItemsFilter;
			$plItems->Id_price_list = $plItemId;
			$prov = $plItems->searchPriceList();
			$prov->pagination = array('pageSize'=>100);
			foreach($prov->getData() as $plItem){
				$plItem->delete();
			}
		}
	
	}

	public function actionAjaxFillSidebar()
	{
		if(isset($_POST['PriceList']['Id']))
		{
			$priceList = PriceList::model()->findByPk($_POST['PriceList']['Id']);
			echo CHtml::openTag("ul");
			echo "Selected List:";
			echo CHtml::closeTag("ul");
			echo CHtml::openTag("ul");

			echo CHtml::openTag("li");
			echo $priceList->description;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo $priceList->priceListType->name;
			echo CHtml::closeTag("li");
				
			echo CHtml::openTag("li");
			if($priceList->Id_price_list_type=="1")
			{
				echo $priceList->supplier->business_name;				
			}
			else
			{
				echo $priceList->importer->contact->description;				
			}
			echo CHtml::closeTag("li");
							
			echo CHtml::openTag("li");
			echo $priceList->date_validity;
			echo CHtml::closeTag("li");

			echo CHtml::closeTag("ul");
				
		}
	}	
	public function actionAjaxGetPriceListAttributes()
	{
		if(isset($_POST['PriceList']['Id']))
		{
			$model = PriceList::model()->findByPk($_POST['PriceList']['Id']);
			if(isset($model))
			{
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='price-list-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
