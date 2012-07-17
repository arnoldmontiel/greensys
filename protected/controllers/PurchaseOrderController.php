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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAssignProducts($id)
	{
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
		if(isset($_GET['Product']))
		{
			$modelProduct->attributes =$_GET['Product'];				
		}
		$modelPurchaseOrderItem = new PurchaseOrderItem('search');
		$modelPurchaseOrderItem->unsetAttributes();
		if(isset($_GET['PurchaseOrderItem']))
		{
			$modelPurchaseOrderItem->attributes =$_GET['PurchaseOrderItem'];
		}
		$modelPurchaseOrderItem->Id_purchase_order = $id;
		
		$this->render('assignProducts',array(
				'model'=>$this->loadModel($id),
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
	public function actionAjaxAddPurchaseOrderItem()
	{
		if(isset($_POST['Id_product'])&&isset($_POST['Id_purchase_order'])){
			$idPurchaseOrder = $_POST['Id_purchase_order'];

			$purchaseOrder = PurchaseOrder::model()->findByPk($idPurchaseOrder);
				
			$product = Product::model()->findByPk($_POST['Id_product']);
			
			if(isset($product)){
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
					if(!isset($purchasOrderItemInDb))
					{
						$purchaseOrderItem=new PurchaseOrderItem();
		
						$shippingParameter = $purchaseOrder->shippingParameter;
						$air = $shippingParameter->shippingParameterAir;
						$maritime = $shippingParameter->shippingParameterMaritime;
						$cost = 0;
						if($purchaseOrder->Id_shipping_type == 1)
						{
							$cost = $priceListItemPurchase->dealer_cost+($maritime->cost_measurement_unit*$product->length*$product->height*$product->width);
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
				if(isset($priceListItemPurchase))
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
							$cost = $priceListItemPurchase->dealer_cost+($maritime->cost_measurement_unit*$product->length*$product->height*$product->width);
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PurchaseOrder']))
		{
			$model->attributes=$_POST['PurchaseOrder'];
			$model->Id_purchase_order_state = 1;//nuevo
			$importer = Importer::model()->findByPk($model->Id_importer);
			$model->Id_shipping_parameter = $importer->shippingParameters[0]->Id;
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

		if(isset($_POST['PurchaseOrder']))
		{
			$model->attributes=$_POST['PurchaseOrder'];
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
		$dataProvider=new CActiveDataProvider('PurchaseOrder');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
}
