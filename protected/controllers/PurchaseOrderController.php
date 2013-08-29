<?php

class PurchaseOrderController extends Controller
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
		$modelPurchaseOrderItem = new PurchaseOrderItem('search');
		$modelPurchaseOrderItem->unsetAttributes();
		if(isset($_GET['PurchaseOrderItem']))
		{
			$modelPurchaseOrderItem->attributes =$_GET['PurchaseOrderItem'];
		}
		$modelPurchaseOrderItem->Id_purchase_order = $id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
				'modelPurchaseOrderItem'=>$modelPurchaseOrderItem,
		));
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAssignProducts($id)
	{
		$model = $this->loadModel($id);
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
		if(isset($_GET['Product']))
		{
			$modelProduct->attributes =$_GET['Product'];				
		}
		$modelProduct->Id_supplier=$model->Id_supplier;
		$modelPurchaseOrderItem = new PurchaseOrderItem('search');
		$modelPurchaseOrderItem->unsetAttributes();
		if(isset($_GET['PurchaseOrderItem']))
		{
			$modelPurchaseOrderItem->attributes =$_GET['PurchaseOrderItem'];
		}
		$modelPurchaseOrderItem->Id_purchase_order = $id;
		
		$this->render('assignProducts',array(
				'model'=>$model,
				'modelProduct'=>$modelProduct,
				'modelPurchaseOrderItem'=>$modelPurchaseOrderItem,
		));
	}
	public function actionAjaxDeletePurchaseOrderItem($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$purchaseOrderItem = PurchaseOrderItem::model()->findByPk($id);
			if(isset($purchaseOrderItem))
			{
				$purchaseOrderItem->delete();				
			}
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');		
	}
	public function actionAjaxUpdateItemValues()
	{
		if(isset($_POST['Id_purchase_order_item'])
				&&isset($_POST['price_shipping'])
				&&isset($_POST['price_total'])
				&&isset($_POST['quantity']))
		{
			$purchaseOrderItem = PurchaseOrderItem::model()->findByPk($_POST['Id_purchase_order_item']);
			if(isset($purchaseOrderItem)){
				$purchaseOrderItem->price_shipping =$_POST['price_shipping'];
				$purchaseOrderItem->price_total =$_POST['price_total'];
				$purchaseOrderItem->quantity =$_POST['quantity'];
				if($purchaseOrderItem->save())
				{
					$result = array();
					$result = $purchaseOrderItem->attributes;
					$purchaseOrder = PurchaseOrder::model()->findByPk($purchaseOrderItem->Id_purchase_order);
					$result['purhcase_order_price_total'] =$purchaseOrder->PriceTotal;
					$result['purhcase_order_price_shipping'] =$purchaseOrder->PriceShippingTotal;
					echo json_encode($result);
						
				}
			}
		}
	}
	public function actionAjaxAddPurchaseOrderItem()
	{
		if(isset($_POST['budegetItems'])&&isset($_POST['Id_purchase_order'])&&isset($_POST['Id_product'])){
			$budgetItems = $_POST['budegetItems'];
			$idPurchaseOrder = $_POST['Id_purchase_order'];
			$idProduct = $_POST['Id_product'];

			$purchaseOrder = PurchaseOrder::model()->findByPk($idPurchaseOrder);
				
			$transaction = $purchaseOrder->dbConnection->beginTransaction();
			try {
				foreach($budgetItems as $budgetItem)
				{
					if(isset($budgetItem['Id']))
					{
						$modelBudgetItem = BudgetItem::model()->findByPk($budgetItem['Id']);
						$product = Product::model()->findByPk($idProduct);
						$criteria = new CDbCriteria;
						$criteria->compare('t.Id_product', $product->Id);
						$criteria->with[]='priceList';
						$criteria->compare('priceList.Id_price_list_type',1);//purchase
						//$criteria->compare('priceList.validity',1);
						$criteria->order = 't.Id_price_list DESC';
						$priceListItemPurchase = PriceListItem::model()->find($criteria);
						if(isset($priceListItemPurchase))
						{
							$purchasOrderItemInDb = PurchaseOrderItem::model()->findByAttributes(array('Id_purchase_order'=> $idPurchaseOrder,'Id_product'=>$product->Id));
							$cost = 0;
							if(!isset($purchasOrderItemInDb))
							{
								$purchaseOrderItem=new PurchaseOrderItem();
					
								$shippingParameter = $purchaseOrder->shippingParameter;
								$total = $priceListItemPurchase->dealer_cost+$cost;
								$purchaseOrderItem->attributes =  array('Id_purchase_order'=>$idPurchaseOrder,
										'Id_product'=>$product->Id,
										'price_purchase'=>$priceListItemPurchase->dealer_cost,
										'price_shipping'=>$cost,
										'quantity'=>$budgetItem['quantity'],
										'price_total'=>$total,
								);
								$purchaseOrderItem->save();
								for($i = 0; $i<$budgetItem['quantity']; $i++)
								{
									$modelProductItem = new ProductItem;
									$modelProductItem->Id_product = $purchaseOrderItem->Id_product;
									$modelProductItem->Id_purchase_order_item =$purchaseOrderItem->Id; 
									$modelProductItem->real_shipping_cost = $cost;
									if(isset($modelBudgetItem))
										$modelProductItem->Id_budget_item = $modelBudgetItem->Id;
									$modelProductItem->save();								
								}
							}
							else
							{
								$purchasOrderItemInDb->quantity += $budgetItem['quantity'];
								$purchasOrderItemInDb->price_total = $purchasOrderItemInDb->quantity*($purchasOrderItemInDb->price_purchase+$purchasOrderItemInDb->price_shipping);
								$purchasOrderItemInDb->save();
								for($i = 0; $i<$budgetItem['quantity']; $i++)
								{
									$modelProductItem = new ProductItem;
									$modelProductItem->Id_product = $purchasOrderItemInDb->Id_product;
									$modelProductItem->Id_purchase_order_item =$purchasOrderItemInDb->Id; 
									$modelProductItem->real_shipping_cost = $cost;
									if(isset($modelBudgetItem))
										$modelProductItem->Id_budget_item = $modelBudgetItem->Id;
									$modelProductItem->save();								
								}
							}
						}
					}
				}
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
				
		}
		
	}
	public function actionAjaxAddFilteredProducts()
	{
		if(isset($_POST['Product'])&&isset($_POST['Id_purchase_order'])){
			$idPurchaseOrder = $_POST['Id_purchase_order'];
			$modelProduct = new Product('search');
			$modelProduct->unsetAttributes();
			$modelProduct->attributes = $_POST['Product']; 
			$dataProvider = $modelProduct->searchSummary();
			$purchaseOrder = PurchaseOrder::model()->findByPk($idPurchaseOrder);
							
			$dataProvider->pagination = false;
			$data = $dataProvider->getData(true);
			foreach($data as $product){
				$criteria = new CDbCriteria;
				$criteria->compare('t.Id_product', $product->Id);
				$criteria->with[]='priceList';
				$criteria->compare('priceList.Id_price_list_type',1);//purchase
				//$criteria->compare('priceList.validity',1);
				$criteria->order = 't.Id_price_list DESC';
				$priceListItemPurchase = PriceListItem::model()->find($criteria);
				$volume = $product->getVolume();
				
				if(isset($priceListItemPurchase) && $volume!==false)
				{
					$purchasOrderItemInDb = PurchaseOrderItem::model()->findByAttributes(array('Id_purchase_order'=> $idPurchaseOrder,'Id_product'=>$product->Id));
					if(!isset($purchasOrderItemInDb))
					{
						$purchaseOrderItem=new PurchaseOrderItem();
						
						$shippingParameter = $purchaseOrder->shippingParameter;
						$air = $shippingParameter->shippingParameterAir;
						$maritime = $shippingParameter->shippingParameterMaritime;
						$cost = 0;
						if($purchaseOrder->Id_shipping_type == 1)
						{
							$cost = $priceListItemPurchase->dealer_cost+($maritime->cost_measurement_unit*$volume);
						}
						else
						{
							$cost = $priceListItemPurchase->dealer_cost+($air->cost_measurement_unit*$product->weight);
						}
						$total = $priceListItemPurchase->dealer_cost+$cost;
						$purchaseOrderItem->attributes =  array('Id_purchase_order'=>$idPurchaseOrder,
								'Id_product'=>$product->Id,
								'price_purchase'=>$priceListItemPurchase->dealer_cost,
								'price_shipping'=>$cost,
								'quantity'=>1,
								'price_total'=>$total,
						);
					
						$purchaseOrderItem->save();
					}
					else
					{
						$purchasOrderItemInDb->quantity += 1;
						$purchasOrderItemInDb->price_total = $purchasOrderItemInDb->quantity*($purchasOrderItemInDb->price_purchase+$purchasOrderItemInDb->price_shipping);
						$purchasOrderItemInDb->save();
					}						
				}
			}
		}
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PurchaseOrder;

		$criteria = new CDbCriteria;
		$criteria->order = 't.business_name ASC';
		$modelSupplier = Supplier::model()->findAll($criteria);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PurchaseOrder']))
		{
			$model->attributes=$_POST['PurchaseOrder'];
			$model->Id_purchase_order_state = 1;//nuevo
// 			$importer = Importer::model()->findByPk($model->Id_importer);
// 			$model->Id_shipping_parameter = $importer->shippingParameters[0]->Id;
			if($model->save())
				$this->redirect(array('assignProducts', 'id'=>$model->Id));				
		}

		$this->render('create',array(
			'model'=>$model,
			'modelSupplier'=>$modelSupplier,
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
		
		$criteria = new CDbCriteria;
		$criteria->order = 't.business_name ASC';
		$modelSupplier = Supplier::model()->findAll($criteria);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PurchaseOrder']))
		{
			$model->attributes=$_POST['PurchaseOrder'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('update',array(
			'model'=>$model,
			'modelSupplier'=>$modelSupplier,
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
		$model=new PurchaseOrder('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PurchaseOrder']))
			$model->attributes=$_GET['PurchaseOrder'];

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
		$model=PurchaseOrder::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='purchase-order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionAjaxDinamicBudgetSelectorPopUp()
	{
		if(isset($_POST['Id_product']))
		{
			
			$modelBudgetItem = new BudgetItem;
			$modelBudgetItem->unsetAttributes();
				
			$modelProduct = Product::model()->findByPk($_POST['Id_product']);
			
			$criteria = new CDbCriteria;
			$criteria->compare('t.Id_product', $modelProduct->Id);
			$criteria->with[]='priceList';
			$criteria->compare('priceList.Id_price_list_type',1);//purchase
			//$criteria->compare('priceList.validity',1);
			$criteria->order = 't.Id_price_list DESC';
			$priceListItemPurchase = PriceListItem::model()->find($criteria);
				
			$this->renderPartial('selectorBudget',array('modelProduct'=>$modelProduct,'modelBudgetItem'=>$modelBudgetItem,'modelPriceListItem'=>$priceListItemPurchase));
		}
	}
	public function actionAjaxDinamicBudgetSelectorViewPopUp()
	{
		if(isset($_POST['Id_purchase_item']))
		{
			
			$modelBudgetItem = new BudgetItem;
			$modelBudgetItem->unsetAttributes();
			
			$modelPurchaseOrderItem = PurchaseOrderItem::model()->findByPk($_POST['Id_purchase_item']);
			$modelProduct = Product::model()->findByPk($modelPurchaseOrderItem->Id_product);
			
			$criteria = new CDbCriteria;
			$criteria->compare('t.Id_product', $modelProduct->Id);
			$criteria->with[]='priceList';
			$criteria->compare('priceList.Id_price_list_type',1);//purchase
			//$criteria->compare('priceList.validity',1);
			$criteria->order = 't.Id_price_list DESC';
			$priceListItemPurchase = PriceListItem::model()->find($criteria);
				
			$this->renderPartial('selectorBudget',array('modelProduct'=>$modelProduct,'modelBudgetItem'=>$modelBudgetItem,'modelPriceListItem'=>$priceListItemPurchase,'modelPurchaseOrderItem'=>$modelPurchaseOrderItem));
		}
	}
}
