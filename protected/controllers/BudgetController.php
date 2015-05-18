<?php

class BudgetController extends GController
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
	public function actionView($id, $version)
	{	
		
		$this->render('view',array(
			'modelBudget'=>$this->loadModel($id, $version),
		));
	}
	
	public function actionDownloadPDF($id, $version)
	{		
		
		if(isset($id) && isset($version))
		{
			$modelBudget = $this->loadModel($id, $version);						
			$filename = GreenHelper::getExportedFileName($modelBudget,'pdf');
			if(isset($modelBudget))
			{
				include('js/mpdf/mpdf.php');
				ob_end_clean();
				
				$mpdf=new mPDF('utf-8','A4');
				$stylesheet = file_get_contents('css/bootstrap.min.css');
				$stylesheet2 = file_get_contents('protected/views/layouts/estilos.php');
				$mpdf->WriteHTML($stylesheet,1);
				$mpdf->WriteHTML($stylesheet2,1);
				$mpdf->WriteHTML(GreenHelper::generateBudgetPDF($modelBudget),2);
				
				$mpdf->Output($filename,'I');
			}
		}
	}
	
	public function actionReadOnly()
	{
		$this->render('readOnly');
	}
	
	public function actionViewService($id, $version)
	{
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
		{
			$modelBudgetItem->attributes =$_GET['BudgetItem'];
		}
	
		//seteo el presupuesto y su version
		$modelBudgetItem->Id_budget = $id;
		$modelBudgetItem->version_number = $version;
	
	
		$this->render('viewService',array(
				'model'=>$this->loadModel($id, $version),
				'modelBudgetItem'=>$modelBudgetItem,
		));
	}
	
	public function actionViewVersion($id, $version)
	{
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
		{
			$modelBudgetItem->attributes =$_GET['BudgetItem'];
		}
	
		//seteo el presupuesto y su version
		$modelBudgetItem->Id_budget = $id;
		$modelBudgetItem->version_number = $version;
	
	
		$this->render('viewVersion',array(
				'model'=>$this->loadModel($id, $version),
				'modelBudgetItem'=>$modelBudgetItem,
		));
	}
	
	public function actionAdminAllVersion($id, $version)
	{
		$model=new Budget('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$model->attributes=$_GET['Budget'];

		$model->Id = $id;
		
		$this->render('adminAllVersion',array(
			'model'=>$model,
			'modelInstance'=>$this->loadModel($id, $version),
			'version'=>$version,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Budget;

		$modelBudgetState = BudgetState::model()->findAll();
		$criteria = new CDbCriteria;		
		$criteria->with[]="Contact";
		$criteria->addCondition("t.description!= 'Contacto Inicial'");
		$criteria->order = 't.description ASC';
		$modelProject = Project::model()->findAll($criteria);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Budget']))
		{
			//Genero el Id
			$model->Id = Budget::model()->count() + 1;
			
			//Solo para la creacion la version 1
			$model->version_number = 1;
			
			$model->attributes=$_POST['Budget'];
			if($model->save())
				$this->redirect(array('addItem', 'id'=>$model->Id, 'version'=>$model->version_number));
		}
		
		$this->render('create',array(
			'model'=>$model,
			'modelBudgetState'=>$modelBudgetState,
			'modelProject'=>$modelProject,
		));
	}
	
	public function actionAjaxGetTotalPrice()
	{
		if(isset($_POST['BudgetItem']))
		{
			$budgetItem = new BudgetItem();
			
			$budgetItem->attributes = $_POST['BudgetItem'];
			$budgetItem->discount =$_POST['BudgetItem']['discount'];
			$budgetItem->discount_type =$_POST['BudgetItem']['discount_type'];
			echo json_encode(array('total_price'=>$budgetItem->getTotalPrice()));						
		}
	}
	
	public function actionAjaxRemoveCommissionist()
	{
		$idBudget = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$idPerson = (isset($_POST['idPerson']))?$_POST['idPerson']:null;
	
		if(isset($idBudget) && isset($version) && isset($idPerson))
		{
			$modelCommissionist = Commissionist::model()->findByAttributes(array('Id_budget'=>$idBudget,
															'version_number'=>$version,
															'Id_person'=>$idPerson,
																		));	
			if(isset($modelCommissionist))
				$modelCommissionist->delete();
			
		}
	
	}
	
	public function actionAjaxAddCommissionist()
	{
		$idBudget = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$name = (isset($_POST['name']))?$_POST['name']:'';
		$last_name = (isset($_POST['last_name']))?$_POST['last_name']:'';
		$value = (isset($_POST['value']))?$_POST['value']:0;

		if(isset($idBudget) && isset($version))
		{
			$modelPerson = new Person();
			
			$transaction = $modelPerson->dbConnection->beginTransaction();
			try {
				$modelPerson->name = $name;
				$modelPerson->last_name = $last_name;
				$modelPerson->save();
					
				$modelCommissionist = new Commissionist();
				$modelCommissionist->Id_budget = $idBudget;
				$modelCommissionist->version_number = $version;
				$modelCommissionist->Id_person = $modelPerson->Id;
				$modelCommissionist->percent_commission = $value;
				$modelCommissionist->save();
				
				$transaction->commit();
				
			} catch (Exception $e) {
				$transaction->rollback();
			}			
		}
		
	}
	
	public function actionAjaxUpdateCommission()
	{
		$idBudget = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$idPerson = (isset($_POST['idPerson']))?$_POST['idPerson']:null;
		$value = (isset($_POST['value']))?$_POST['value']:0;
	
		if(isset($idBudget) && isset($version) && isset($idPerson))
		{
			$modelCommissionist = Commissionist::model()->findByAttributes(array('Id_budget'=>$idBudget,
															'version_number'=>$version,
															'Id_person'=>$idPerson));
			
			if(isset($modelCommissionist))
			{
				$modelCommissionist->percent_commission = $value;
				$modelCommissionist->save();
			}
		}
	
	}
	public function actionAjaxSetAccessoryProduct()
	{
		$idProduct = (isset($_POST['idProduct']))?$_POST['idProduct']:null;
		$value = (isset($_POST['value']))?$_POST['value']:0;
		
		if(isset($idProduct))
		{
			$modelProduct = Product::model()->findByPk($idProduct);
			$modelProduct->is_accessory = $value;
			$modelProduct->save();
		}
	}
	
	public function actionAjaxSetHideItem()
	{
		$idBudgetItem = (isset($_POST['idBudgetItem']))?$_POST['idBudgetItem']:null;
		$value = (isset($_POST['value']))?$_POST['value']:0;
	
		if(isset($idBudgetItem))
		{
			$modelProduct = BudgetItem::model()->findByPk($idBudgetItem);
			$modelProduct->hide = $value;
			$modelProduct->save();
		}
	}	
	
	public function actionAjaxCreateItem()
	{
		if(isset($_POST['BudgetItem']))
		{
			$budgetItem = new BudgetItem;
				
			$budgetItem->attributes = $_POST['BudgetItem'];
			$budgetItem->discount =$_POST['BudgetItem']['discount'];
			$budgetItem->discount_type =$_POST['BudgetItem']['discount_type'];
				
			if($budgetItem->save())
				echo json_encode($budgetItem->attributes);
		}
		
	}	
	public function actionAjaxRemoveBudgetItem()
	{
		if($_POST['id'])
		{
			$budgetItem = BudgetItem::model()->findByPk($_POST['id']);
			$budgetItem->delete();
		}
	}
	
	public function actionAjaxOpenUpdateClause()
	{
		$id = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		
		if(isset($id) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				echo $model->clause_description;
			}
		}
	}
	
	public function actionAjaxOpenUpdateNoteVersion()
	{
		$id = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
	
		if(isset($id) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				echo $model->note_version;
			}
		}
	}
	
	public function actionAjaxHideArea()
	{
		$id = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$idAreaProject = (isset($_POST['idAreaProject']))?$_POST['idAreaProject']:null;
		$value = (isset($_POST['value']))?$_POST['value']:0;
	
		if(isset($idAreaProject))
		{
			$modelAreaProject = AreaProject::model()->findByAttributes(array('Id'=>$idAreaProject));
			if(isset($modelAreaProject))
			{
				$modelAreaProject->hide = $value;
				$modelAreaProject->save();
			}
		}
	}	

	public function actionAjaxGetHideAreaChk()
	{
		$value = 0;
		$idAreaProject = (isset($_POST['idAreaProject']))?$_POST['idAreaProject']:null;
		if(isset($idAreaProject))
		{
			$modelAreaProject = AreaProject::model()->findByAttributes(array('Id'=>$idAreaProject));
			if(isset($modelAreaProject))
				$value = $modelAreaProject->hide;
		}
		echo $value;
	}
	
	public function actionAjaxUpdateClause()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$description = (isset($_POST['description']))?$_POST['description']:'';
		
		if(isset($id) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				$model->clause_description = $description;
				$model->save();
			}
		}
	}
	
	public function actionAjaxUpdateNoteVersion()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$description = (isset($_POST['description']))?$_POST['description']:'';
	
		if(isset($id) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				$model->note_version = $description;
				$model->save();
			}
		}
	}
	
	public function actionAjaxShowCreateModalBudgetItem()
	{
		$model=new BudgetItem;
		$model->price=0.00;
		$model->quantity=0;
		$model->discount=0.00;
		
		$field_caller ="";
		if($_POST['field_caller'])
			$field_caller=$_POST['field_caller'];
		if($_POST['id'])
			$model->Id_budget=$_POST['id'];
		if($_POST['version_number'])
			$model->version_number=$_POST['version_number'];
		if($_POST['idService'])
			$model->Id_service=$_POST['idService'];
		
		// Uncomment the following line if AJAX validation is needed
		$this->renderPartial('_modalAddBudgetItem',array(
				'model'=>$model,
				'field_caller'=>$field_caller
		));
	}
	
	public function actionAjaxDeleteAreaProject()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$id = $_POST['id'];
			// we only allow deletion via POST request
	
			$items = BudgetItem::model()->findAllByAttributes(array('Id_area_project'=>$id));
			if(empty($items))
			{
				$items = AreaProject::model()->findAllByAttributes(array('Id_parent'=>$id));
				if(empty($items))
				{				
					$model = AreaProject::model()->findByAttributes(array("Id"=>$id));
					$model->delete();
					echo 1;
				}
			}
			else {
				echo 0;
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionAjaxDeleteBudgetItem()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$id = $_POST['id'];
			// we only allow deletion via POST request
			$model = BudgetItem::model()->findByPk($id);
			$transaction = $model->dbConnection->beginTransaction();
			try {
				
				BudgetItem::model()->deleteAllByAttributes(array('Id_budget_item'=>$id));
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $version)
	{
		$model=$this->loadModel($id, $version);
		$criteria = new CDbCriteria();
		$criteria->with[]="Contact";
		$criteria->addCondition("t.description!= 'Contacto Inicial'");
		
		$modelBudgetState = BudgetState::model()->findAll();
		
		$modelProject = Project::model()->findAll($criteria);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Budget']))
		{
			$model->attributes=$_POST['Budget'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id, 'version'=>$model->version_number));
		}

		$this->render('update',array(
			'model'=>$model,
			'modelBudgetState'=>$modelBudgetState,
			'modelProject'=>$modelProject,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id, $version)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id, $version)->delete();

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
		$modelBudgets = new Budget('search');
		$modelBudgets->unsetAttributes();
		if(isset($_GET['Budget']))
			$modelBudgets->attributes=$_GET['Budget'];
		
		$openQty = Budget::model()->countByAttributes(array('Id_budget_state'=>1));
		$waitingQty = Budget::model()->countByAttributes(array('Id_budget_state'=>2));
		$approvedQty = Budget::model()->countByAttributes(array('Id_budget_state'=>3));
		$cancelledQty = Budget::model()->countByAttributes(array('Id_budget_state'=>4));
		$this->render('index', array('modelBudgets'=>$modelBudgets,
									'openQty'=>$openQty,
									'waitingQty'=>$waitingQty,
									'approvedQty'=>$approvedQty,
									'cancelledQty'=>$cancelledQty,
									));		
	}
	
	public function actionAjaxDelete()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		
		if(isset($id) && isset($version))
		{
			$modelBudget = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
	
			if(isset($modelBudget))
			{
				$modelBudget->delete();
			}
		}
	
		$openQty = Budget::model()->countByAttributes(array('Id_budget_state'=>1));
		
		$response = array('openQty'=>$openQty);
		
		echo json_encode($response);
		
	}
	
	public function actionAjaxGetTotalQty()
	{
		$idBudget = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$idArea = (isset($_POST['idArea']))?$_POST['idArea']:null;
		$idAreaProject = (isset($_POST['idAreaProject']))?$_POST['idAreaProject']:null;
		
		$criteria = new CDbCriteria();
		$criteria->select = 'sum(quantity) as quantity';
		$criteria->addCondition('Id_budget = '.$idBudget);
		$criteria->addCondition('Id_area = '.$idArea);
		$criteria->addCondition('Id_area_project = '.$idAreaProject);
		$criteria->addCondition('version_number = '.$version);
		$model = BudgetItem::model()->find($criteria);
		
		echo isset($model)?round($model->quantity):0;		
	}
	
	public function actionAjaxAddProduct()
	{
		$idBudget = (isset($_POST['idBudget']))?$_POST['idBudget']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$idProduct = (isset($_POST['idProduct']))?$_POST['idProduct']:null;
		$idArea = (isset($_POST['idArea']))?$_POST['idArea']:null;
		$idAreaProject = (isset($_POST['idAreaProject']))?$_POST['idAreaProject']:null;
		$qty = (isset($_POST['qty']))?$_POST['qty']:0;
	
		if(isset($idBudget) && isset($version) && isset($idProduct) && isset($idArea) && isset($idAreaProject))
		{
			$modelBudgetItemBD =  BudgetItem::model()->findByAttributes(array('Id_budget'=>$idBudget, 'Id_area'=>$idArea, 'Id_area_project'=>$idAreaProject, 'Id_product'=>$idProduct, 'version_number'=>$version));
			
			if($qty > 0)
			{
				if(isset($modelBudgetItemBD))
				{
					$modelBudgetItemBD->quantity = $modelBudgetItemBD->quantity + $qty; 
				}
				else
				{
					$modelBudgetItemBD = new BudgetItem();
					
					$modelProduct = Product::model()->findByPk($idProduct);
					
					if(isset($modelProduct))
					{
						//traigo datos de price_list (precios, shipping_type)
						$criteria = new CDbCriteria();
						$criteria->join = 'inner join price_list pl on (pl.Id = t.Id_price_list)
								inner join shipping_parameter sp on (sp.Id_importer = pl.Id_importer)';
						$criteria->addCondition('pl.Id_price_list_type = 2'); //lista de venta
						$criteria->addCondition('t.Id_product = '. $idProduct);
						$criteria->addCondition('sp.description <> "FOB"');
						$criteria->order = 'sp.Id_importer DESC'; //Esto es para que traiga por default el id 7 (BWR) a pedido de Fede Melo
						
						$modelPriceListItem = PriceListItem::model()->find($criteria);
						
						if(isset($modelPriceListItem))
						{
							$modelBudgetItemBD->Id_price_list = $modelPriceListItem->Id_price_list;
							if(isset($modelPriceListItem->maritime_cost) && $modelPriceListItem->maritime_cost > 0)
							{
								$modelBudgetItemBD->Id_shipping_type = 1;
								$modelBudgetItemBD->price = $modelPriceListItem->getMaritimeSalePrice();
							}
							else 
							{						
								$modelBudgetItemBD->Id_shipping_type = 2;
								$modelBudgetItemBD->price = $modelPriceListItem->getAirSalePrice();
							}
						}
						else 
						{
							$criteria = new CDbCriteria();
							$criteria->join = 'inner join price_list pl on (pl.Id = t.Id_price_list)
									inner join shipping_parameter sp on (sp.Id_importer = pl.Id_importer)';
							$criteria->addCondition('pl.Id_price_list_type = 2'); //lista de venta
							$criteria->addCondition('t.Id_product = '. $idProduct);
							$criteria->addCondition('sp.description = "FOB"');
							
							$modelPriceListItem = PriceListItem::model()->find($criteria);
							if(isset($modelPriceListItem))
							{
								$modelBudgetItemBD->Id_price_list = $modelPriceListItem->Id_price_list;
								$modelBudgetItemBD->Id_shipping_type = 1;
								$modelBudgetItemBD->price = $modelPriceListItem->getMaritimeSalePrice();
							}
						}
						
						$modelBudgetItemBD->time_programation = $modelProduct->time_programation;
						$modelBudgetItemBD->time_instalation = $modelProduct->time_instalation;
						$modelBudgetItemBD->Id_area = $idArea;
						$modelBudgetItemBD->Id_area_project = $idAreaProject;
						$modelBudgetItemBD->Id_budget = $idBudget;
						$modelBudgetItemBD->version_number = $version;
						$modelBudgetItemBD->Id_product = $idProduct;
						$modelBudgetItemBD->quantity = $qty;
					}
				}
				$item = BudgetItem::model()->findByAttributes(array('Id_product'=>$idProduct,'Id_budget'=>$idBudget,'version_number'=>$version));
				if(isset($item))
				{
					$modelBudgetItemBD->discount =$item->discount;
					$modelBudgetItemBD->discount_type =$item->discount_type;
						
				}
				$modelBudgetItemBD->save();
			}
			else 
			{
// 				if(isset($modelBudgetItemBD))
// 				{
// 					$modelBudgetItemBD->delete();
// 				}
			}
			
			$criteria = new CDbCriteria();
			$criteria->select = 'sum(quantity) as quantity';
			$criteria->addCondition('Id_budget = '.$idBudget);
			$criteria->addCondition('Id_area = '.$idArea);
			$criteria->addCondition('Id_area_project = '.$idAreaProject);
			$criteria->addCondition('version_number = '.$version);
			$model = BudgetItem::model()->find($criteria);
			
			echo isset($model)?round($model->quantity):0;
		}
		else 
		{
			echo 0;
		}
		
	}
	
	public function actionAjaxCloseVersion()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		
		if(isset($id) && isset($version))
		{
			$modelBudget = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($modelBudget))
			{
				$modelBudget->percent_profitability = $modelBudget->getProfitPercenTotal(); 
				$modelBudget->Id_budget_state = 2;
				$modelBudget->date_close = new CDbExpression('NOW()');
				$criteria = new CDbCriteria;
				$criteria->addCondition('Id_currency_from='.$modelBudget->Id_currency);
				$criteria->addCondition('Id_currency_to='.$modelBudget->Id_currency_view);
				$criteria->order='validity_date DESC';
				$currencyConversor= CurrencyConversor::model()->find($criteria);
				if(isset($currencyConversor))
				{
					$modelBudget->Id_currency_conversor =$currencyConversor->Id; 
					$modelBudget->Id_currency_from_currency_conversor =$currencyConversor->Id_currency_from; 
					$modelBudget->Id_currency_to_currency_conversor =$currencyConversor->Id_currency_to; 
				}
				else 
				{
					$criteria = new CDbCriteria;
					$criteria->addCondition('Id_currency_from='.$modelBudget->Id_currency_view);
					$criteria->addCondition('Id_currency_to='.$modelBudget->Id_currency);
					$criteria->order='validity_date DESC';
					$currencyConversor= CurrencyConversor::model()->find($criteria);
					if(isset($currencyConversor))
					{
						$modelBudget->Id_currency_conversor =$currencyConversor->Id;
						$modelBudget->Id_currency_from_currency_conversor =$currencyConversor->Id_currency_from;
						$modelBudget->Id_currency_to_currency_conversor =$currencyConversor->Id_currency_to;
					}					
				}
				$modelBudget->save();
			}
		}
		$openQty = Budget::model()->countByAttributes(array('Id_budget_state'=>1));
		$waitingQty = Budget::model()->countByAttributes(array('Id_budget_state'=>2));
		
		$response = array('openQty'=>$openQty,
									'waitingQty'=>$waitingQty);
		echo json_encode($response);
	}
	
	public function actionAjaxReOpen()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		$note = isset($_POST['note'])?$_POST['note']:'';
	
		if(isset($id) && isset($version))
		{
			$modelBudget = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($modelBudget))
			{
				$transaction = $modelBudget->dbConnection->beginTransaction();
				
				try {
					$modelBudget->Id_budget_state = 5; //cerrado
					$modelBudget->save();
					
					$modelNewBudget = new Budget();
					$modelNewBudget->attributes = $modelBudget->attributes;
					$modelNewBudget->Id_budget_state = 1; //open
					$modelNewBudget->date_creation = new CDbExpression('NOW()');
					$modelNewBudget->date_close = null;
					$modelNewBudget->date_cancelled = null;
					$modelNewBudget->date_approved = null;
					$modelNewBudget->note = $note;
					$modelNewBudget->version_number = $modelBudget->version_number + 1;
					$modelNewBudget->Id_currency_conversor = null;
					$modelNewBudget->Id_currency_from_currency_conversor = null;
					$modelNewBudget->Id_currency_to_currency_conversor = null;
						
					
					$modelNewBudget->save();
					
					$budgetItems = BudgetItem::model()->findAllByAttributes(
							array('Id_budget'=>$modelBudget->Id,
									 'version_number'=>$modelBudget->version_number,
									'service_type'=>0));
						
					foreach($budgetItems as $item)
					{
						$modelBudgetItem = new BudgetItem;
						$modelBudgetItem->attributes = $item->attributes;
						$modelBudgetItem->version_number = $modelNewBudget->version_number;
						$modelBudgetItem->save();
					}
						
					//genero la nueva relacion area_project
					$areaProjects = AreaProject::model()->findAllByAttributes(array(
										'Id_project'=>$modelBudget->Id_project,
										'Id_budget'=>$modelBudget->Id,
										'version_number'=>$modelBudget->version_number
					));
					foreach($areaProjects as $areaProj)
					{
						$newAreaProject = new AreaProject();
						$newAreaProject->setAttributes($areaProj->attributes);
						$newAreaProject->version_number = $modelNewBudget->version_number;
						$newAreaProject->save();
					
						BudgetItem::model()->updateAll(array( 'Id_area_project' => $newAreaProject->Id ),
						'Id_budget = '.$modelNewBudget->Id.' AND version_number = '.$modelNewBudget->version_number.' AND Id_area_project = '.$areaProj->Id );
					}
					
					//replico todos los comisionistas
					$modelCommissionists = Commissionist::model()->findAllByAttributes(array('Id_budget'=>$modelBudget->Id, 'version_number'=>$modelBudget->version_number));
					foreach($modelCommissionists as $commission)
					{
						$modelCommissionist = new Commissionist();
						$modelCommissionist->attributes = $commission->attributes;
						$modelCommissionist->version_number = $modelNewBudget->version_number;
						$modelCommissionist->save();
					}
					
					$transaction->commit();
					
				} catch (Exception $e) {
					$transaction->rollback();
				}
				
			}
			
		}
		$openQty = Budget::model()->countByAttributes(array('Id_budget_state'=>1));
		$waitingQty = Budget::model()->countByAttributes(array('Id_budget_state'=>2));
		$cancelledQty = Budget::model()->countByAttributes(array('Id_budget_state'=>4));
	
		$response = array('openQty'=>$openQty,
				'waitingQty'=>$waitingQty,
				'cancelledQty'=>$cancelledQty);
		
		echo json_encode($response);
	}
	
	public function actionAjaxApprove()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$version = (isset($_POST['version']))?$_POST['version']:null;
		
		if(isset($id) && isset($version))
		{
			$modelBudget = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($modelBudget))
			{
				$modelBudget->Id_budget_state = 3;
				$modelBudget->date_approved = new CDbExpression('NOW()');
				$modelBudget->save();
			}
		}
		$approvedQty = Budget::model()->countByAttributes(array('Id_budget_state'=>3));
		$waitingQty = Budget::model()->countByAttributes(array('Id_budget_state'=>2));
		
		$response = array('approvedQty'=>$approvedQty,
				'waitingQty'=>$waitingQty);
		echo json_encode($response);
	}
	
	public function actionAjaxOpenTabOpen()
	{
		$modelBudgets = new Budget('search');
		$modelBudgets->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$modelBudgets->attributes=$_GET['Budget'];
		
		echo $this->renderPartial('_tabOpen',array('modelBudgets'=>$modelBudgets));
	}
	
	public function actionAjaxOpenTabWaiting()
	{
		$modelBudgets = new Budget('search');
		$modelBudgets->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$modelBudgets->attributes=$_GET['Budget'];
	
		echo $this->renderPartial('_tabWaiting',array('modelBudgets'=>$modelBudgets));
	}
	
	public function actionAjaxOpenTabApproved()
	{
		$modelBudgets = new Budget('search');
		$modelBudgets->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$modelBudgets->attributes=$_GET['Budget'];
	
		echo $this->renderPartial('_tabApproved',array('modelBudgets'=>$modelBudgets));
	}
	
	public function actionAjaxOpenTabCancelled()
	{
		$modelBudgets = new Budget('search');
		$modelBudgets->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$modelBudgets->attributes=$_GET['Budget'];
	
		echo $this->renderPartial('_tabCancelled',array('modelBudgets'=>$modelBudgets));
	}
	
	public function actionExportToExcel($id,$version)
	{
		GreenHelper::exportBudgetToExcel($id, $version);
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Budget('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Budget']))
			$model->attributes=$_GET['Budget'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}		
	
	public function actionAjaxOpenUpdateBudget()
	{		
		$idBudget = isset($_POST['idBudget'])?$_POST['idBudget']:null;
		$version = isset($_POST['version'])?$_POST['version']:null;
				
		$model = Budget::model()->findByPk(array('Id'=>$idBudget, 'version_number'=>$version));		

		$ddlCurrency = Currency::model()->findAll();
		
		echo $this->renderPartial('_modalFormBudget', array('model'=>$model,'ddlCurrency'=>$ddlCurrency),
		/*parametros extras para que funcione CJuiDatePicker*/false,true);
	}
	
	public function actionAjaxOpenNewBudget()
	{
		$criteria=new CDbCriteria;
		$criteria->select ="t.*, contact.description designacion";
		$criteria->join =" INNER JOIN customer c on (t.Id_customer = c.Id)
					INNER JOIN contact contact on (c.Id_contact = contact.Id)";
		$criteria->addCondition("t.description != 'Contacto Inicial'");
		$criteria->order="designacion, t.description";
		
		$ddlProjects = Project::model()->findAll($criteria);
		
		$criteria=new CDbCriteria;
		
		$criteria->with[]='contact';
		$criteria->order="contact.description";
		
		$ddlCustomer = Customer::model()->findAll($criteria);
		
		$model = new Budget();
		$modelProject = new Project();
		
		$ddlCurrency = Currency::model()->findAll();
		
		echo $this->renderPartial('_modalFormBudget', array('model'=>$model,
															'modelProject'=>$modelProject,
															'ddlProjects'=>$ddlProjects,
															'ddlCustomer'=>$ddlCustomer,
															'ddlCurrency'=>$ddlCurrency,),
															/*parametros extras para que funcione CJuiDatePicker*/
															false,true);
	}
		
	public function actionAjaxChangePrintChk()
	{
		$id = isset($_POST['id'])?$_POST['id']:null;
		$version = isset($_POST['version'])?$_POST['version']:null;
		$value = isset($_POST['value'])?$_POST['value']:0;
	
		if(isset($id) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				$model->print_clause = $value;
				$model->save();
			}
		}
	
	}
	
	public function actionAjaxChangePrintNoteChk()
	{
		$id = isset($_POST['id'])?$_POST['id']:null;
		$version = isset($_POST['version'])?$_POST['version']:null;
		$value = isset($_POST['value'])?$_POST['value']:0;
	
		if(isset($id) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				$model->print_note_version = $value;
				$model->save();
			}
		}
	
	}
	
	public function actionAjaxupdateToDefaultClause()
	{
		$id = isset($_POST['id'])?$_POST['id']:null;
		$version = isset($_POST['version'])?$_POST['version']:null;
		
		if(isset($id) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				$modelClause = Clause::model()->findByPk(1);
				if(isset($modelClause))
				{
					$model->clause_description = $modelClause->description;
					$model->save();
					echo $modelClause->description;
				}
			}
		}
	}
	
	public function actionAjaxChangeCurrencyView()
	{
		$id = isset($_POST['id'])?$_POST['id']:null;
		$version = isset($_POST['version'])?$_POST['version']:null;
		$idCurrencyView = isset($_POST['idCurrencyView'])?$_POST['idCurrencyView']:null;
	
		if(isset($id) && isset($idCurrencyView) && isset($version))
		{
			$model = Budget::model()->findByPk(array('Id'=>$id, 'version_number'=>$version));
			if(isset($model))
			{
				$model->Id_currency_view = $idCurrencyView;
				$model->save();
			}
		}
	
	}
	
	public function actionAjaxSaveNewBudget()
	{
		$modelBudget = new Budget();		
		$response = array();
		$idBudget = 0;
		$version = 0;
		
		if(isset($_POST['Budget']))
		{
			$modelBudget->attributes = $_POST['Budget'];

			if($_POST['create-project'] == "true")
			{
				$modelProject = new Project();
				$modelProject->attributes = $_POST['Project'];
				
				$modelProject->save();
				$modelBudget->Id_project = $modelProject->Id; 
			}
				
			//Genero el Id
			$modelBudget->Id = Budget::model()->count() + 1;
			//Solo para la creacion la version 1
			$modelBudget->version_number = 1;
			$modelBudget->Id_budget_state = 1;
				
			//la moneda lo tomo de settings
			$modelSettings = Setting::model()->findByPk(1);
			if(isset($modelSettings))
				$modelBudget->Id_currency = $modelSettings->Id_currency;
				
			$modelBudget->save();
				
			$idBudget = $modelBudget->Id;
			$version = $modelBudget->version_number;			
		}
		
		$response = array('openQty'=>Budget::model()->countByAttributes(array('Id_budget_state'=>1)),
					'idBudget'=>$idBudget,
					'version'=>$version);
		
		echo json_encode($response);
	}
	
	public function actionAjaxSaveUpdatedBudget()
	{		
		$response = array();
		if(isset($_POST['Budget']))
		{
			$idBudget = $_POST['Budget']['Id'];
			$version = $_POST['Budget']['version_number'];			
			$modelBudget = Budget::model()->findByPk(array('Id'=>$idBudget, 'version_number'=>$version));
			
			$modelBudget->attributes = $_POST['Budget'];
			$modelBudget->save();
						
			$response = array('description'=>$modelBudget->description,
							'version_number'=>$modelBudget->version_number,
							'date_estimated_inicialization'=>isset($modelBudget->date_estimated_inicialization)?Yii::app()->dateFormatter->formatDateTime($modelBudget->date_estimated_inicialization,'small',null):'',
							'date_estimated_finalization'=>isset($modelBudget->date_estimated_finalization)?Yii::app()->dateFormatter->formatDateTime($modelBudget->date_estimated_finalization,'small',null):'');
		}
		
		echo json_encode($response);		
	}
	
	public function actionEditBudget($id,$version_number)
	{
		$this->render('editBudget');
	}
	
	public function actionAjaxSelect()
	{
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
	
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];
	
		$this->render('_filteredGrid',array(
					'modelProduct'=>$modelProduct,
					'idArea'=>1,
		));
	}
	
	public function actionAjaxCancelBudget()
	{
		$idBudget = isset($_POST['idBudget'])?$_POST['idBudget']:null;
		$version = isset($_POST['version'])?$_POST['version']:null;
		$note = isset($_POST['note'])?$_POST['note']:'';
		
		if(isset($idBudget) && isset($version))
		{
			$modelBudget = Budget::model()->findByPk(array('Id'=>$idBudget, 'version_number'=>$version));
			if(isset($modelBudget))
			{
				$modelBudget->Id_budget_state = 4;
				$modelBudget->note = $note;
				$modelBudget->date_cancelled = new CDbExpression('NOW()');
				$modelBudget->save();
			}	
		}
		
		$waitingQty = Budget::model()->countByAttributes(array('Id_budget_state'=>2));
		$cancelledQty = Budget::model()->countByAttributes(array('Id_budget_state'=>4));
		
		$response = array('cancelledQty'=>$cancelledQty,
				'waitingQty'=>$waitingQty);
		
		echo json_encode($response);
		
	}
	
	public function actionAjaxOpenChangeStateBudget()
	{
		$idBudget = isset($_POST['idBudget'])?$_POST['idBudget']:null;
		$version = isset($_POST['version'])?$_POST['version']:null;
		$newState = isset($_POST['newState'])?$_POST['newState']:4; //defecto cancelado
				
		if(isset($idBudget) && isset($version))
		{
			$modelBudget = Budget::model()->findByPk(array('Id'=>$idBudget, 'version_number'=>$version));
			if(isset($modelBudget))
			{
				echo $this->renderPartial('_modalChangeStateBudget',
						array(
								'modelBudget'=>$modelBudget,
								'newState'=>$newState,
						));
			}
		}
	}
	
	public function actionAjaxSaveService()
	{
		if(isset($_POST['Id_budget_item'])&&isset($_POST['Id_service']))
		{
			$budgetItem = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
			if(isset($budgetItem))
			{
				$budgetItem->calcTimeBeforeChangeService();
				if(!empty($_POST['Id_service']))
					$budgetItem->Id_service = $_POST['Id_service'];
				else
					$budgetItem->Id_service = null;
				$budgetItem->order_by_service = null;
				$budgetItem->save();				
			}
		}
	}	
	public function actionAjaxUpdateBudgetItemGrid()
	{		
		if(isset($_GET['Id'])&&$_GET['version_number'])
			$model = $this->loadModel($_GET['Id'], $_GET['version_number']);
		
		$areaProject = new AreaProject;
		if(isset($_GET['Id_area_project']))
			$areaProject->Id =$_GET['Id_area_project'];
		if(isset($_GET['Id_area']))
			$areaProject->Id_area =$_GET['Id_area'];
		
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
			$modelBudgetItem->attributes=$_GET['BudgetItem'];
		
		$modelBudgetItem->Id_area = $areaProject->Id_area;
		$modelBudgetItem->Id_area_project = $areaProject->Id;
		
		$modelBudgetItem->Id_budget = $model->Id;
		$modelBudgetItem->version_number = $model->version_number;
		
		$this->render('_tabEditBudgetByArea',array(
				'modelBudgetItem'=>$modelBudgetItem,
				'areaProject'=>$areaProject,
		));
	}
	
	public function actionAjaxUpdateBudgetServiceExtras()
	{
		if(isset($_GET['Id'])&&$_GET['version_number'])
			$model = $this->loadModel($_GET['Id'], $_GET['version_number']);
		if(isset($_GET['idService']))
			$idService =  $_GET['idService'];
	
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
			$modelBudgetItem->attributes=$_GET['BudgetItem'];
	
		$modelBudgetItem->Id_service = $idService;
		$modelBudgetItem->Id_budget = $model->Id;
		$modelBudgetItem->version_number = $model->version_number;
	
		$this->render('_tabEditBudgetServiceExtras',array(
				'model'=>$model,
				'modelBudgetItem'=>$modelBudgetItem,
				'idService'=>$idService,
		));
	}
	
	public function actionAjaxUpdateBudgetItemGridByService()
	{		
		if(isset($_GET['Id'])&&$_GET['version_number'])
			$model = $this->loadModel($_GET['Id'], $_GET['version_number']);
		if(isset($_GET['idService']))
			$idService =  $_GET['idService'];
		if($idService==0)
			$idService = null;
				
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
			$modelBudgetItem->attributes=$_GET['BudgetItem'];
		
		$modelBudgetItem->Id_service = $idService; 
		$modelBudgetItem->Id_budget = $model->Id;
		$modelBudgetItem->version_number = $model->version_number;
		
		$this->render('_tabEditBudgetByService',array(
				'modelBudgetItem'=>$modelBudgetItem,
				'idService'=>$idService,
		));
	}
	public function actionAjaxUpdateProjectServiceGrid()
	{
		if(isset($_GET['Id'])&&$_GET['version_number'])
			$model = $this->loadModel($_GET['Id'], $_GET['version_number']);
	
		$this->render('_tabBudgetServiceConfig',array(
				'model'=>$model,
		));
	
	}
	
	public function actionAjaxUpdateCommissionistGrid()
	{
		if(isset($_GET['Id'])&&$_GET['version_number'])
			$model = $this->loadModel($_GET['Id'], $_GET['version_number']);
	
		$modelCommissionists = new Commissionist('search');
		$modelCommissionists->unsetAttributes();
		$modelCommissionists->Id_budget = $model->Id;
		$modelCommissionists->version_number = $model->version_number;
		
		$this->render('_editCommissionist',array( 'modelBudget'=>$model, 'modelCommissionists'=>$modelCommissionists));
	
	}	
	
	public function actionAjaxUpdateSelectProductGrid()
	{
		$modelProducts = new Product('search');
		$modelProducts->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$modelProducts->attributes=$_GET['Product'];
		
		
		$this->render('_modalAddProduct',array(
					'modelProducts'=>$modelProducts,
		));
	}
	public function actionAjaxUpdateBudgetTotalServiceGrid()
	{
		$model = new Budget();
		if(isset($_GET['Id'])&&$_GET['version_number'])
			$model = $this->loadModel($_GET['Id'], $_GET['version_number']);
		
		$criteria = new CDbCriteria();
		$criteria->with[]="service";				
		$criteria->addCondition('Id_budget='.$model->Id);
		$criteria->addCondition('version_number='.$model->version_number);		
		$criteria->group="Id_service";
		$criteria->order="service.description";
		
		$modelBudgetItemService = New BudgetItem();
		$sort=new CSort;
		
		$dataProvider = new CActiveDataProvider($modelBudgetItemService, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
		
		$this->render('_tabEditBudgetTotals',array(
					'dataProvider'=>$dataProvider,
					'model'=>$model,
		));
	}	
	public function actionAddItem($id, $version, $byService=false)
	{
		$model = $this->loadModel($id, $version);
		
		$modelBudgetItemGeneric = new BudgetItem('search');
		$modelBudgetItemGeneric->unsetAttributes();  // clear any default values		
		$modelBudgetItemGeneric->Id_budget = $id;
		$modelBudgetItemGeneric->version_number = $version;
		
		
		$modelProduct = new Product('search');
		$modelProduct->unsetAttributes();
		
		$priceListItemSale = new PriceListItem();
		$priceListItemSale->unsetAttributes();
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_project = '.$model->Id_project);
		$criteria->addCondition('version_number ='.$version);
		$criteria->addCondition('Id_budget ='.$id);
		$criteria->addCondition('Id_parent is null');
		$areaProjects = AreaProject::model()->findAll($criteria);
		
		$allAreaProjects = AreaProject::model()->findAllByAttributes(array("Id_project" => $model->Id_project));
		
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		if(isset($_GET['BudgetItem']))
			$modelBudgetItem->attributes=$_GET['BudgetItem'];

		$modelBudgetItem->Id_budget = $id;
		$modelBudgetItem->version_number = $version;
		if(isset($_GET['Product']))
			$modelProduct->attributes=$_GET['Product'];

		if(isset($_GET['PriceListItem'])){
			$priceListItemSale->attributes=$_GET['PriceListItem'];
		}

		if(isset($_GET['ProductSale']['Id'])){
			$priceListItemSale->Id_product=$_GET['ProductSale']['Id'];
		}
		
		$modelProducts = new Product('search');
		$modelProducts->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$modelProducts->attributes=$_GET['Product'];
		
		$modelProducts->budget_id = $id;
		$modelProducts->budget_version = $version;
		if(isset($_GET['idAreaProject']))
			$modelProducts->budget_area_project = $_GET['idAreaProject'];
		//deprecated
// 		if(isset($idArea))
// 			$modelProducts->budget_area = $idArea;
		
		$this->GenerateProjectServiceRelation($model);
		$this->render('editBudget',array(
					'model'=>$model,
					'modelProduct'=>$modelProduct,
					'modelProducts'=>$modelProducts,
					'modelBudgetItem'=>$modelBudgetItem,
					'priceListItemSale'=>$priceListItemSale,
					'areaProjects'=>$areaProjects,
					'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,
					'allAreaProjects'=>$allAreaProjects,
					'byService'=>$byService,
		));
	}
	public function GenerateProjectServiceRelation($modelBudget)
	{
		$services = Service::model()->findAll();
		foreach ($services as $service)
		{
			$projectService = ProjectService::model()->findByAttributes(array('Id_project'=>$modelBudget->Id_project,'Id_service'=>$service->Id,
																	'Id_budget'=>$modelBudget->Id, 'version_number'=>$modelBudget->version_number));
			if(!isset($projectService))
			{
				$projectService = new ProjectService();
				$projectService->Id_service = $service->Id;
				$projectService->Id_project = $modelBudget->Id_project;
				$projectService->Id_budget = $modelBudget->Id;
				$projectService->version_number = $modelBudget->version_number;
				$projectService->long_description = $service->long_description;
				$projectService->note = $service->note;
				$projectService->order = $service->default_order;
				$projectService->save();
			}							
		}		
	}
	public function actionAjaxFillDDPriceSelector()
	{
		if(isset($_POST['Id']))
		{
			$model = BudgetItem::model()->findByPk($_POST['Id']);
			$this->renderPartial("_tabEditBudgetSelectPrice",array("model"=>$model));
		}
	}
	
	public function actionAjaxChangePriceList()
	{
		if(isset($_POST['Id_budget_item'])&&isset($_POST['shipping_type'])&&isset($_POST['Id_price_list_item']))
		{
			$modelBudgetItem = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
			$modelPriceListItem = PriceListItem::model()->findByPk($_POST['Id_price_list_item']);
			$shippingType = $_POST['shipping_type'];

			$modelBudgetItem->Id_shipping_type =$shippingType; 				
			$modelBudgetItem->Id_price_list = $modelPriceListItem->Id_price_list;
			if($shippingType==1)//maritime
			{		
				$modelBudgetItem->price = round($modelPriceListItem->getMaritimeSalePrice(),2); 				
			}
			else//air
			{
				$modelBudgetItem->price =round($modelPriceListItem->getAirSalePrice(),2);				
			}
			var_dump($modelBudgetItem);
			$modelBudgetItem->save();
		}
	}
	public function actionAjaxUpdatePercentDiscount()
	{
		if(isset($_POST['Id'])&&isset($_POST['version_number'])&&isset($_POST['percent_discount']))
		{
			$model = Budget::model()->findByPk(array('Id'=>$_POST['Id'],'version_number'=>$_POST['version_number']));
			if(isset($model))
			{
				$model->percent_discount = $_POST['percent_discount'];
				if($model->save())
				{
					$result['total_price_with_discount']=$model->TotalPriceWithDiscountFormated;
					$result['total_discount']=$model->TotalDiscountFormated;
					$result['total_price']=$model->totalPriceFormated;					
					echo json_encode(array_merge($model->attributes,$result)); 
				}				
			}			
		}
	}
	public function actionAjaxGetTotals()
	{
		if(isset($_POST['Id'])&&isset($_POST['version_number']))
		{
			$model = Budget::model()->findByPk(array('Id'=>$_POST['Id'],'version_number'=>$_POST['version_number']));
			if(isset($model))
			{
				$result['total_price_with_discount']=$model->TotalPriceWithDiscountFormated;
				$result['total_discount']=$model->TotalDiscountFormated;
				$result['total_price']=$model->totalPriceFormated;
				echo json_encode(array_merge($model->attributes,$result));
			}
		}
	}
	
	public function actionAjaxUpdateUpdateGenericItem()
	{
		$id = isset($_POST['Id'])?$_POST['Id']:null;
		$quantity = isset($_POST['quantity'])?$_POST['quantity']:0;
		$price = isset($_POST['price'])?$_POST['price']:0;
		
		if(isset($id) && $quantity > 0 && $price > 0)
		{
			$modelBudgetItemDB = BudgetItem::model()->findByPk($id);
			if(isset($modelBudgetItemDB))
			{
				$modelBudgetItemDB->quantity = $quantity;
				$modelBudgetItemDB->price = $price;
				$modelBudgetItemDB->save();
				$result['total_price']=$modelBudgetItemDB->totalPrice;
				echo json_encode(array_merge($modelBudgetItemDB->attributes,$result));						
				
			}
		}
	}
	
	public function actionAjaxCreateBudgetItem()
	{
		$modelBudgetItem = new BudgetItem();
		
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($modelBudgetItem);
		
		if(isset($_POST['BudgetItem']))
		{
			$modelBudgetItem->attributes = $_POST['BudgetItem'];
			try {
				$modelBudgetItem->save();
				echo json_encode($modelBudgetItem->attributes);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
	}
	
	public function actionAjaxBudgetItemChildren()
	{
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
		
		if(isset($_GET['BudgetItem']['Id_budget_item']))
			$modelBudgetItem->Id_budget_item = $_GET['BudgetItem']['Id_budget_item'];
		
		if(isset($_GET['BudgetItem']['Id'])){
			$model = BudgetItem::model()->findByPk($_GET['BudgetItem']['Id']);
			$modelBudgetItem->Id_budget_item = $model->Id_budget_item;
		}
		
			
		$priceListItemSale = new PriceListItem();
		$priceListItemSale->unsetAttributes();
			
		if(isset($_GET['ProductSale']['Id'])){
			$priceListItemSale->Id_product=$_GET['ProductSale']['Id'];
		}
			
		echo $this->renderPartial('_budgetItemChildren', array('modelBudgetItem'=>$modelBudgetItem,
															    'priceListItemSale'=>$priceListItemSale,
																));
	}
	
	public function actionAjaxBudgetItemChildrenView()
	{
		$modelBudgetItem = new BudgetItem('search');
		$modelBudgetItem->unsetAttributes();  // clear any default values
	
		if(isset($_GET['BudgetItem']['Id_budget_item']))
			$modelBudgetItem->Id_budget_item = $_GET['BudgetItem']['Id_budget_item'];
	
		if(isset($_GET['BudgetItem']['Id'])){
			$model = BudgetItem::model()->findByPk($_GET['BudgetItem']['Id']);
			$modelBudgetItem->Id_budget_item = $model->Id_budget_item;
		}
	
			
		$priceListItemSale = new PriceListItem();
		$priceListItemSale->unsetAttributes();
			
		if(isset($_GET['ProductSale']['Id'])){
			$priceListItemSale->Id_product=$_GET['ProductSale']['Id'];
		}
			
		echo $this->renderPartial('_budgetItemChildrenView', array('modelBudgetItem'=>$modelBudgetItem,
																    'priceListItemSale'=>$priceListItemSale,
		));
	}
	
	public function actionAjaxVerified()
	{
		if(isset($_POST['IdBudgetItem'])&&isset($_POST['isChecked']))
		{
			$model = BudgetItem::model()->findByPk($_POST['IdBudgetItem']);
			if(isset($model))
			{
				$model->do_not_warning = $_POST['isChecked']=="true"?1:0;
				$model->save();
			}
		}
	}
	public function actionAjaxGetParentInfo()
	{
		
		if(isset($_POST['IdBudgetItem']))
		{
			$model = BudgetItem::model()->findByPk($_POST['IdBudgetItem']);
			if(isset($model))
			{
				$arrayParent = array();
				$arrayParent['parent_code'] = $model->product->code;
				$arrayParent['parent_model'] = $model->product->model;
				$arrayParent['parent_part_number'] = $model->product->part_number;
				$arrayParent['parent_customer_desc'] = $model->product->description_customer;
				$arrayParent['parent_brand_desc'] = $model->product->brand->description;
				$arrayParent['parent_supplier_name'] = $model->product->supplier->business_name;
				$arrayParent['parent_price'] = $model->price;
				$arrayParent['id'] = $model->Id;
				$arrayParent['parent_do_not_warning'] = $model->do_not_warning;
				echo json_encode($arrayParent);
			} 
		}
	}
	
	public function actionAjaxGetChildrenTotalPrice()
	{
		if(isset($_POST['IdBudgetItem']))
		{
			$model = BudgetItem::model()->findByPk($_POST['IdBudgetItem']);
			echo $model->ChildrenTotalPrice;
		}	
	}
	
	public function actionAjaxUpdateChildPrice()
	{
		$idProduct = isset($_POST['IdProduct'])?$_POST['IdProduct']:'';
		$idShippingType = isset($_POST['IdShippingType'])?$_POST['IdShippingType']:'';
		$idBudgetItem = isset($_POST['IdBudgetItem'][0])?$_POST['IdBudgetItem'][0]:'';
		$idPriceList = isset($_POST['IdPriceList'])?$_POST['IdPriceList']:'';
		$price = isset($_POST['price'])?$_POST['price']:'';
		
		if(!empty($idPriceList)&&!empty($idProduct)&&!empty($idShippingType)&&!empty($price)&&!empty($idBudgetItem))
		{
			$model = BudgetItem::model()->findByPk($idBudgetItem);
			$model->Id_shipping_type = $idShippingType;
			$model->Id_price_list = $idPriceList;
			$model->price = $price;
			$model->is_included = 1;
			$model->save();
		}
	}
	
	public function actionAjaxAssignFromStock()
	{
	
		$idBudgetItem = isset($_POST['IdBudgetItem'])?$_POST['IdBudgetItem']:'';
		$idProduct = isset($_POST['IdProduct'])?$_POST['IdProduct']:'';
		
		if(!empty($idProduct)&&!empty($idBudgetItem))
		{
			$modelProductItem = ProductItem::model()->findByAttributes(array(
																		'Id_product'=>$idProduct,
																		'Id_budget_item'=>null,
																		'Id_purchase_order_item'=>null,
																		));
			if(isset($modelProductItem))
			{
				$modelProductItem->Id_budget_item = $idBudgetItem;
				$modelProductItem->save();
			}

		}

	}
	
	public function actionAjaxViewAssign()
	{
	
		$idBudgetItem = isset($_POST['IdBudgetItem'])?$_POST['IdBudgetItem']:'';
		$idProduct = isset($_POST['IdProduct'])?$_POST['IdProduct']:'';
		
		$modelProductItem = ProductItem::model()->findByAttributes(array('Id_product'=>$idProduct,'Id_budget_item'=>$idBudgetItem));
		
		echo $this->renderPartial('_viewAssign',array(
					'model'=>$modelProductItem,
		));
	
	}
	
	public function actionAjaxUnAssignStock()
	{
	
		$idBudgetItem = isset($_POST['IdBudgetItem'])?$_POST['IdBudgetItem']:'';
		$idProduct = isset($_POST['IdProduct'])?$_POST['IdProduct']:'';
	
		$modelProductItem = ProductItem::model()->findByAttributes(array('Id_product'=>$idProduct,'Id_budget_item'=>$idBudgetItem));
		$modelProductItem->Id_budget_item = null;
		$modelProductItem->save();
	
	}
	
	public function actionAjaxUpdateQuantity()
	{
		$idBudgetItem = isset($_POST['IdBudgetItem'])?$_POST['IdBudgetItem']:'';
		$quantity = isset($_POST['quantity'])?$_POST['quantity']:'';
	
		if(!empty($quantity)&&!empty($idBudgetItem))
		{
			$model = BudgetItem::model()->findByPk($idBudgetItem);
			$model->quantity = $quantity;			
			$model->save();
		}
	}
	
	public function actionAjaxQuitItem()
	{
		$idBudgetItem = isset($_POST['IdBudgetItem'])?$_POST['IdBudgetItem']:'';
	
		if(!empty($idBudgetItem))
		{
			$model = BudgetItem::model()->findByPk($idBudgetItem);
			$model->price = 0;
			$model->quantity = 1;
			$model->is_included = 0;
			$model->save();
		}
	}
	
	public function actionAjaxNewVersion()
	{

		$id = isset($_POST['id'])?$_POST['id']:'';
		$version = isset($_POST['version'])?$_POST['version']:'';
		$note = isset($_POST['note'])?$_POST['note']:'';
		
		$model = new Budget;
		$transaction = $model->dbConnection->beginTransaction();
		
		try {
			$previousModel = $this->loadModel($id, $version);
			$previousModel->note = $note;
			$previousModel->save();
			
			
			$model->attributes = $previousModel->attributes;
			$model->date_creation = new CDbExpression('NOW()');
			$model->version_number = $model->version_number + 1;
			$model->note = '';
			$model->Id_currency_conversor =null;
			$model->Id_currency_from_currency_conversor =null;
			$model->Id_currency_to_currency_conversor =null;
			
			if($model->save())
			{
				$budgetItems = BudgetItem::model()->findAllByAttributes(array('Id_budget'=>$previousModel->Id, 'version_number'=>$previousModel->version_number));
				
				foreach($budgetItems as $item)
				{
					$modelBudgetItem = new BudgetItem;
					$modelBudgetItem->attributes = $item->attributes;
					$modelBudgetItem->version_number = $model->version_number;
					$modelBudgetItem->save();
				}
				
				$transaction->commit();				
			}
		} catch (Exception $e) {
			$transaction->rollback();
		}
		
	}
	public function actionAjaxSaveDiscountType()
	{
		if(isset($_POST['Id_budget_item'])&&isset($_POST['discount_type']))
		{
			$budgetItem = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
			if(isset($budgetItem))
			{
				
				$transaction = $budgetItem->dbConnection->beginTransaction();
				try {
					$budgetItem->discount_type = $_POST['discount_type'];
					if($budgetItem->save())
					{
						//Se aplica el mismo descuento a todos los mismos productos dentro del presupuesto
						if(isset($budgetItem->Id_product))
						{
						
							$budgetItems =
							BudgetItem::model()->findAllByAttributes(
									array('Id_product'=>$budgetItem->Id_product,
											'Id_budget'=>$budgetItem->Id_budget,
											'version_number'=>$budgetItem->version_number
									));
							foreach ($budgetItems as $item)
							{
								$item->discount_type = $_POST['discount_type'];
								$item->save();
							}
						}
						$transaction->commit();
						$budgetItem->refresh();
						$result['total_price']=$budgetItem->totalPrice;
						echo json_encode(array_merge($budgetItem->attributes,$result));
					}
				} catch (Exception $e) {
					$transaction->rollback();
						
				}
				
			}
		}
	}
	public function actionAjaxSaveDiscountValue()
	{
		if(isset($_POST['Id_budget_item'])&&isset($_POST['discount']))
		{
			$budgetItem = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
			if(isset($budgetItem))
			{
				$transaction = $budgetItem->dbConnection->beginTransaction();
				try {
					$budgetItem->discount= $_POST['discount'];
					if($budgetItem->save())
					{
						//Se aplica el mismo descuento a todos los mismos productos dentro del presupuesto					
						if(isset($budgetItem->Id_product))
						{
							$budgetItems =
							BudgetItem::model()->findAllByAttributes(
									array('Id_product'=>$budgetItem->Id_product,
											'Id_budget'=>$budgetItem->Id_budget,
											'version_number'=>$budgetItem->version_number
									));
							foreach ($budgetItems as $item)
							{
								$item->discount = $_POST['discount'];
								$item->save();
							}								
						}
						$transaction->commit();
						$budgetItem->refresh();
						$result['total_price']=$budgetItem->totalPrice;
						echo json_encode(array_merge($budgetItem->attributes,$result));
					}						
				} catch (Exception $e) {
					$transaction->rollback();
					
				}
			}
		}
	}	
	public function actionAjaxSaveTimeProgramation()
	{
		if(isset($_POST['Id_budget_item'])&&isset($_POST['time_programation']))
		{
			$budgetItem = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
			if(isset($budgetItem))
			{
				$budgetItem->time_programation= $_POST['time_programation'];
				if($budgetItem->save())
				{
					$budgetItem->refresh();
					echo json_encode($budgetItem->attributes);						
				}
			}
		}
	}
	public function actionAjaxSaveTimeInstalation()
	{
		if(isset($_POST['Id_budget_item'])&&isset($_POST['time_instalation']))
		{
			$budgetItem = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
			if(isset($budgetItem))
			{
				$budgetItem->time_instalation= $_POST['time_instalation'];
				if($budgetItem->save())
				{
					$budgetItem->refresh();
					echo json_encode($budgetItem->attributes);						
				}
			}
		}
	}
	public function actionAjaxSaveQuantity()
	{
		if(isset($_POST['Id_budget_item'])&&isset($_POST['quantity']))
		{
			$budgetItem = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
			if(isset($budgetItem))
			{
				$budgetItem->quantity= $_POST['quantity'];
				if($budgetItem->save())
				{
					$budgetItem->refresh();
					$result['total_price']=$budgetItem->totalPrice;
					echo json_encode(array_merge($budgetItem->attributes,$result));						
				}
			}
		}
	}
	public function actionAjaxDownServiceItem()
	{
		if(isset($_POST['idService']) && isset($_POST['idProject']))
		{
			$modelProjectService = ProjectService::model()->findByAttributes(array('version_number'=>$_POST['versionNumber'], 'Id_budget'=>$_POST['idBudget'], 'Id_service'=>$_POST['idService'], 'Id_project'=>$_POST['idProject']));
			if(isset($modelProjectService->order))
			{
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_project='.$modelProjectService->Id_project);
				$criteria->addCondition('Id_budget='.$modelProjectService->Id_budget);
				$criteria->addCondition('version_number='.$modelProjectService->version_number);
				
				$criteria->addCondition('t.order > '.$modelProjectService->order);
				$criteria->order="t.order ASC";
				$projectService = ProjectService::model()->find($criteria);
				if(isset($projectService))
				{
					$transaction = $modelProjectService->dbConnection->beginTransaction();
					try {
						$orderAux=$projectService->order;
						$projectService->order = $modelProjectService->order;
						$modelProjectService->order = $orderAux;
						$modelProjectService->save();
						$projectService->save();
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
					}
				}
			}
				
		}
	}
	public function actionAjaxUpServiceItem()
	{
		if(isset($_POST['idService']) && isset($_POST['idProject']))
		{
			$modelProjectService = ProjectService::model()->findByAttributes(array('version_number'=>$_POST['versionNumber'], 'Id_budget'=>$_POST['idBudget'], 'Id_service'=>$_POST['idService'], 'Id_project'=>$_POST['idProject']));
			if(isset($modelProjectService->order))
			{
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_project='.$modelProjectService->Id_project);
				$criteria->addCondition('Id_budget='.$modelProjectService->Id_budget);
				$criteria->addCondition('version_number='.$modelProjectService->version_number);
				
				$criteria->addCondition('t.order < '.$modelProjectService->order);
				$criteria->order="t.order DESC";
				$projectService = ProjectService::model()->find($criteria);
				if(isset($projectService))
				{
					$transaction = $modelProjectService->dbConnection->beginTransaction();
					try {
						$orderAux=$projectService->order;
						$projectService->order = $modelProjectService->order;
						$modelProjectService->order = $orderAux;
						$modelProjectService->save();
						$projectService->save();
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
					}
				}
			}
	
		}
	}
	public function actionAjaxDownToBottomService()
	{
		if(isset($_POST['idService']) && isset($_POST['idProject']))
		{
			$modelProjectService = ProjectService::model()->findByAttributes(array('version_number'=>$_POST['versionNumber'], 'Id_budget'=>$_POST['idBudget'], 'Id_service'=>$_POST['idService'], 'Id_project'=>$_POST['idProject']));
			if(isset($modelProjectService->order))
			{
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_project='.$modelProjectService->Id_project);
				$criteria->addCondition('Id_budget='.$modelProjectService->Id_budget);
				$criteria->addCondition('version_number='.$modelProjectService->version_number);
				
				$criteria->addCondition('t.order > '.$modelProjectService->order);
				$criteria->order="t.order DESC";
				$projectService = ProjectService::model()->findAll($criteria);
				if(!empty($projectService))
				{
					$transaction = $modelProjectService->dbConnection->beginTransaction();
					try {
						$isFistTime = true;
						$currentPos= $modelProjectService->order;
						$prevItem = null;
						foreach ($projectService as $item)
						{
							if($isFistTime)
							{
								$isFistTime = false;
								$modelProjectService->order = $item->order;
								$modelProjectService->save();
							}
							else
							{
								$prevItem->order = $item->order;
								$prevItem->save();
							}
							$prevItem = $item;
						}
						$item->order = $currentPos;
						$item->save();
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
						var_dump($e);
					}
				}
			}
				
		}
	}
	public function actionAjaxUpToAboveService()
	{
		if(isset($_POST['idService']) && isset($_POST['idProject']))
		{
			$modelProjectService = ProjectService::model()->findByAttributes(array('version_number'=>$_POST['versionNumber'], 'Id_budget'=>$_POST['idBudget'], 'Id_service'=>$_POST['idService'], 'Id_project'=>$_POST['idProject']));
			if(isset($modelProjectService->order))
			{
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_project='.$modelProjectService->Id_project);
				$criteria->addCondition('Id_budget='.$modelProjectService->Id_budget);
				$criteria->addCondition('version_number='.$modelProjectService->version_number);
				
				$criteria->addCondition('t.order < '.$modelProjectService->order);
				$criteria->order="t.order ASC";
				$projectService = ProjectService::model()->findAll($criteria);
				if(!empty($projectService))
				{
					$transaction = $modelProjectService->dbConnection->beginTransaction();
					try {
						$isFistTime = true;
						$currentPos= $modelProjectService->order;
						$prevItem = null;
						foreach ($projectService as $item)
						{
							if($isFistTime)
							{
								$isFistTime = false;
								$modelProjectService->order = $item->order;
								$modelProjectService->save();
							}
							else
							{
								$prevItem->order = $item->order;
								$prevItem->save();
							}
							$prevItem = $item;
						}
						$item->order = $currentPos;
						$item->save();
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
						var_dump($e);
					}
				}
			}
	
		}
	}
	public function actionAjaxDownBudgetItem()
	{
		if(isset($_POST['id']))
		{
			$modelBudgetItem = BudgetItem::model()->findByPk($_POST['id']);
			if(isset($modelBudgetItem->order_by_service))
			{
				$criteria = new CDbCriteria();
				if(isset($modelBudgetItem->Id_product))
				{
					$criteria->addCondition('Id_product is not null');
					$criteria->addCondition('version_number='.$modelBudgetItem->version_number);
					$criteria->addCondition('Id_budget='.$modelBudgetItem->Id_budget);						
					if(isset($modelBudgetItem->Id_service))
					{
						$criteria->addCondition('Id_service ='.$modelBudgetItem->Id_service);
					}
					else
					{
						$criteria->addCondition('Id_service is null');
							
					}
					$criteria->addCondition('order_by_service > '.$modelBudgetItem->order_by_service);
					$criteria->order="order_by_service ASC";
					$budgetItem = BudgetItem::model()->find($criteria);
					if(isset($budgetItem))
					{
						$transaction = $modelBudgetItem->dbConnection->beginTransaction();
						try {
							$orderAux=$budgetItem->order_by_service;
							$budgetItem->order_by_service = $modelBudgetItem->order_by_service;
							$modelBudgetItem->order_by_service = $orderAux;
							$modelBudgetItem->save();
							$budgetItem->save();
							$transaction->commit();
						} catch (Exception $e) {
							$transaction->rollback();
						}
					}
				}
			}
			
		}
	}
	public function actionAjaxDownToBottomBudgetItem()
	{
		if(isset($_POST['id']))
		{
			$modelBudgetItem = BudgetItem::model()->findByPk($_POST['id']);
			if(isset($modelBudgetItem->order_by_service))
			{
				$criteria = new CDbCriteria();
				if(isset($modelBudgetItem->Id_product))
				{
					$criteria->addCondition('Id_product is not null');
					$criteria->addCondition('version_number='.$modelBudgetItem->version_number);
					$criteria->addCondition('Id_budget='.$modelBudgetItem->Id_budget);						
					if(isset($modelBudgetItem->Id_service))
					{
						$criteria->addCondition('Id_service ='.$modelBudgetItem->Id_service);
					}
					else
					{
						$criteria->addCondition('Id_service is null');
							
					}
					$criteria->addCondition('order_by_service > '.$modelBudgetItem->order_by_service);
					$criteria->order="order_by_service DESC";
					$budgetItems = BudgetItem::model()->findAll($criteria);
					if(!empty($budgetItems))
					{
						$transaction = $modelBudgetItem->dbConnection->beginTransaction();
						try {
							$isFistTime = true;
							$currentPos= $modelBudgetItem->order_by_service;
							$prevItem = null;
							foreach ($budgetItems as $item)
							{
								if($isFistTime)
								{
									$isFistTime = false;
									$modelBudgetItem->order_by_service = $item->order_by_service;
									$modelBudgetItem->save();
								}
								else
								{									
									$prevItem->order_by_service = $item->order_by_service;
									$prevItem->save();
								}
								$prevItem = $item;
							}
							$item->order_by_service = $currentPos;
							$item->save();
							$transaction->commit();								
						} catch (Exception $e) {
							$transaction->rollback();
							var_dump($e);
						}
					}
				}
			}
			
		}
	}
	public function actionAjaxUpBudgetItem()
	{
		if(isset($_POST['id']))
		{
			$modelBudgetItem = BudgetItem::model()->findByPk($_POST['id']);
			if(isset($modelBudgetItem->order_by_service))
			{
				$criteria = new CDbCriteria();
				if(isset($modelBudgetItem->Id_product))
				{
					$criteria->addCondition('version_number='.$modelBudgetItem->version_number);
					$criteria->addCondition('Id_budget='.$modelBudgetItem->Id_budget);						
					$criteria->addCondition('Id_product is not null');
					if(isset($modelBudgetItem->Id_service))
					{
						$criteria->addCondition('Id_service ='.$modelBudgetItem->Id_service);
					}
					else
					{
						$criteria->addCondition('Id_service is null');
							
					}
					$criteria->addCondition('order_by_service < '.$modelBudgetItem->order_by_service);
					$criteria->order="order_by_service DESC";
					$budgetItem = BudgetItem::model()->find($criteria);
					if(isset($budgetItem))
					{
						$transaction = $modelBudgetItem->dbConnection->beginTransaction();
						try {
							$orderAux=$budgetItem->order_by_service;
							$budgetItem->order_by_service = $modelBudgetItem->order_by_service;
							$modelBudgetItem->order_by_service = $orderAux;
							$modelBudgetItem->save();
							$budgetItem->save();
							$transaction->commit();
						} catch (Exception $e) {
							$transaction->rollback();
						}
					}
				}
			}
				
		}
	
	}
	public function actionAjaxUpToAboveBudgetItem()
	{
		if(isset($_POST['id']))
		{
			$modelBudgetItem = BudgetItem::model()->findByPk($_POST['id']);
			if(isset($modelBudgetItem->order_by_service))
			{
				$criteria = new CDbCriteria();
				if(isset($modelBudgetItem->Id_product))
				{
					$criteria->addCondition('version_number='.$modelBudgetItem->version_number);
					$criteria->addCondition('Id_budget='.$modelBudgetItem->Id_budget);
					$criteria->addCondition('Id_product is not null');
					if(isset($modelBudgetItem->Id_service))
					{
						$criteria->addCondition('Id_service ='.$modelBudgetItem->Id_service);
					}
					else
					{
						$criteria->addCondition('Id_service is null');
							
					}
					$criteria->addCondition('order_by_service < '.$modelBudgetItem->order_by_service);
					$criteria->order="order_by_service ASC";
					$budgetItems = BudgetItem::model()->findAll($criteria);
					if(!empty($budgetItems))
					{
						$transaction = $modelBudgetItem->dbConnection->beginTransaction();
						try {
							$isFistTime = true;
							$currentPos= $modelBudgetItem->order_by_service;
							$prevItem = null;
							foreach ($budgetItems as $item)
							{
								if($isFistTime)
								{
									$isFistTime = false;
									$modelBudgetItem->order_by_service = $item->order_by_service;
									$modelBudgetItem->save();
								}
								else
								{
									$prevItem->order_by_service = $item->order_by_service;
									$prevItem->save();
								}
								$prevItem = $item;
							}
							$item->order_by_service = $currentPos;
							$item->save();
							$transaction->commit();
						} catch (Exception $e) {
							$transaction->rollback();
							var_dump($e);
						}
					}
				}
			}
				
		}
	}
	
	public function actionAjaxAddBudgetItem()
	{
		$idPriceList = isset($_POST['IdPriceList'])?$_POST['IdPriceList']:'';
		$idProduct = isset($_POST['IdProduct'])?$_POST['IdProduct']:'';
		$idShippingType = isset($_POST['IdShippingType'])?$_POST['IdShippingType']:'';
		$idBudget = isset($_POST['IdBudget'])?$_POST['IdBudget']:'';
		$idVersion = isset($_POST['IdVersion'])?$_POST['IdVersion']:'';
		$idArea = isset($_POST['IdArea'])?$_POST['IdArea']:'';
		$idAreaProject = isset($_POST['IdAreaProject'])?$_POST['IdAreaProject']:'';
		
		if(!empty($idPriceList)&&!empty($idProduct)&&!empty($idShippingType)&&!empty($idBudget)&&!empty($idVersion)&&!empty($idArea))
		{
			$modelPriceListItem = PriceListItem::model()->findByAttributes(array('Id_price_list'=>$idPriceList,'Id_product'=>$idProduct));
			
			$modelBudgetItem = new BudgetItem;
			$modelBudgetItem->Id_budget = $idBudget;
			$modelBudgetItem->Id_price_list = $idPriceList;
			$modelBudgetItem->Id_product = $idProduct;
			$modelBudgetItem->Id_shipping_type = $idShippingType;
			$modelBudgetItem->version_number = $idVersion;
			$modelBudgetItem->Id_area = $idArea;
			$modelBudgetItem->Id_area_project = $idAreaProject;
			$modelBudgetItem->price = ($idShippingType==1)?$modelPriceListItem->getMaritimeSalePrice():$modelPriceListItem->getAirSalePrice();
			$modelBudgetItem->save();
			
			$productGroups = ProductGroup::model()->findAllByAttributes(array('Id_product_parent'=>$idProduct));
			foreach($productGroups as $item)
			{
				for($index = 0; $index < $item->quantity; $index++)
				{
					$modelPriceListItem = PriceListItem::model()->findByAttributes(array('Id_price_list'=>$idPriceList,'Id_product'=>$item->Id_product_child));
					
					$modelBudgetItemChild = new BudgetItem;
					$modelBudgetItemChild->Id_budget = $idBudget;
					$modelBudgetItemChild->Id_product = $item->Id_product_child;
					$modelBudgetItemChild->version_number = $idVersion;
					$modelBudgetItemChild->Id_budget_item = $modelBudgetItem->Id;
					$modelBudgetItemChild->Id_area = $idArea;
					$modelBudgetItemChild->Id_area_project = $idAreaProject;
					$modelBudgetItemChild->price = 0;
					$modelBudgetItemChild->save();
				}
			}
		}
	}
	public function actionAjaxFillAddAreaToProject()
	{
		if(isset($_POST['Id_project']))
		{
			$this->renderPartial('_addAreasToProject',array(
					'Id_project'=>$_POST['Id_project'],
					'Id_area_project'=>$_POST['Id_area_project'],
			));				
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id, $version)
	{
		$model=Budget::model()->findByPk(array('Id'=>$id,'version_number'=>$version));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='budget-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
