<?php

/**
 * This is the model class for table "budget".
 *
 * The followings are the available columns in table 'budget':
 * @property integer $Id
 * @property integer $Id_project
 * @property string $percent_discount
 * @property string $date_creation
 * @property integer $Id_budget_state
 * @property string $date_inicialization
 * @property string $date_finalization
 * @property string $date_estimated_inicialization
 * @property string $date_estimated_finalization
 * @property integer $version_number
 * @property string $description
 * @property string $note
 * @property string $date_close
 * @property string $date_cancelled
 * @property string $date_approved
 * @property integer $Id_currency
 * @property integer $Id_currency_view
 * @property integer $Id_currency_conversor
 * @property integer $Id_currency_from_currency_conversor
 * @property integer $Id_currency_to_currency_conversor
 * @property string $percent_commission
 * @property string $name_commission
 * @property string $last_name_commission
 * @property string $clause_description
 * @property integer $print_clause
 * 
 * The followings are the available model relations:
 * @property CurrencyConversor $currencyConversor
 * @property CurrencyConversor $currencyFromCurrencyConversor
 * @property CurrencyConversor $currencyToCurrencyConversor
 * @property Currency $currency
 * @property BudgetState $idBudgetState
 * @property Project $idProject
 * @property BudgetItem[] $budgetItems
 * @property GNote[] $notes
 * @property Tracking[] $trackings
 */
class Budget extends ModelAudit
{
	public $curVersion;
	public $totPrice;
	public $project_description;
	
	public function beforeSave()
	{
		$this->date_estimated_inicialization = (!empty($this->date_estimated_inicialization))?Yii::app()->lc->toDatabase($this->date_estimated_inicialization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
		$this->date_estimated_finalization = (!empty($this->date_estimated_finalization))?Yii::app()->lc->toDatabase($this->date_estimated_finalization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
		$this->date_inicialization = (!empty($this->date_inicialization))?Yii::app()->lc->toDatabase($this->date_inicialization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
		$this->date_finalization = (!empty($this->date_finalization))?Yii::app()->lc->toDatabase($this->date_finalization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
		
		if(!empty($this->date_creation))
			$this->date_creation = Yii::app()->lc->toDatabase($this->date_creation,'date','small','date',null);
		
		$this->date_close = (!empty($this->date_close))?Yii::app()->lc->toDatabase($this->date_close,'date','small','date',null):null;
		$this->date_cancelled = (!empty($this->date_cancelled))?Yii::app()->lc->toDatabase($this->date_cancelled,'date','small','date',null):null;
		$this->date_approved = (!empty($this->date_approved))?Yii::app()->lc->toDatabase($this->date_approved,'date','small','date',null):null;		

		if($this->isNewRecord && empty($this->clause_description))
		{
			$modelClause = Clause::model()->findByPk(1);
			if(isset($modelClause))
				$this->clause_description = $modelClause->description;
		}
		
		return parent::beforeSave();
	}
	
	protected function afterFind(){
		
		$this->date_estimated_inicialization = isset($this->date_estimated_inicialization)?Yii::app()->dateFormatter->formatDateTime($this->date_estimated_inicialization,'small',null):null;
		
		$this->date_estimated_finalization = isset($this->date_estimated_finalization)?Yii::app()->dateFormatter->formatDateTime($this->date_estimated_finalization,'small',null):null;
		
		$this->date_inicialization = isset($this->date_inicialization)?Yii::app()->dateFormatter->formatDateTime($this->date_inicialization,'small',null):null;
		
		$this->date_finalization = isset($this->date_finalization)?Yii::app()->dateFormatter->formatDateTime($this->date_finalization,'small',null):null;
	
		$this->date_creation = isset($this->date_creation)?Yii::app()->dateFormatter->formatDateTime($this->date_creation,'small',null):null;
	
		$this->date_close = isset($this->date_close)?Yii::app()->dateFormatter->formatDateTime($this->date_close,'small',null):null;
		$this->date_cancelled = isset($this->date_cancelled)?Yii::app()->dateFormatter->formatDateTime($this->date_cancelled,'small',null):null;
		$this->date_approved = isset($this->date_approved)?Yii::app()->dateFormatter->formatDateTime($this->date_approved,'small',null):null;
		
		return true;
	}
	
	public function afterSave()
	{ 
		if($this->isNewRecord)
		{
			
			$modelServices = Service::model()->findAll();
			foreach($modelServices as $modelService)
			{
				$modelBudgetItem = new BudgetItem();
				$modelBudgetItem->version_number = $this->version_number;
				$modelBudgetItem->Id_budget = $this->Id;
				$modelBudgetItem->Id_service = $modelService->Id;
				$modelBudgetItem->description = 'Programación';
				$modelBudgetItem->service_type = 1;
				$modelBudgetItem->quantity = 0;
				$modelBudgetItem->save();
				
				$modelBudgetItem = new BudgetItem();
				$modelBudgetItem->version_number = $this->version_number;
				$modelBudgetItem->Id_budget = $this->Id;
				$modelBudgetItem->Id_service = $modelService->Id;
				$modelBudgetItem->description = 'Instalación';
				$modelBudgetItem->service_type = 2;
				$modelBudgetItem->quantity = 0;
				$modelBudgetItem->save();
			}
			
		}
		return parent::afterSave();
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Budget the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'budget';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_project, Id_budget_state, version_number, Id_currency, Id_currency_view', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_project, Id_budget_state, version_number, Id_currency, Id_currency_view, Id_currency_conversor, Id_currency_from_currency_conversor, Id_currency_to_currency_conversor,percent_commission, print_clause', 'numerical', 'integerOnly'=>true),
			array('percent_discount', 'length', 'max'=>10),
			array('date_creation, date_inicialization, date_finalization, date_estimated_inicialization, date_estimated_finalization, date_close, date_cancelled, date_approved,percent_commission,name_commission,last_name_commission, clause_description, percent_profitability', 'safe'),
			array('description, note,name_commission,last_name_commission', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_project, percent_discount, date_creation, Id_budget_state, date_inicialization, date_finalization, date_estimated_inicialization, date_estimated_finalization, version_number, totPrice, note, project_description, date_close, date_cancelled, date_approved, Id_currency, Id_currency_view, Id_currency_conversor, Id_currency_from_currency_conversor, Id_currency_to_currency_conversor,percent_commission,name_commission,last_name_commission, clause_description, print_clause', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'budgetState' => array(self::BELONGS_TO, 'BudgetState', 'Id_budget_state'),
			'project' => array(self::BELONGS_TO, 'Project', 'Id_project'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'Id_currency'),
			'currencyView' => array(self::BELONGS_TO, 'Currency', 'Id_currency_view'),
			'budgetItems' => array(self::HAS_MANY, 'BudgetItem', 'Id_budget'),
			'notes' => array(self::HAS_MANY, 'GNote', 'budget_Id'),
			'trackings' => array(self::HAS_MANY, 'Tracking', 'Id_budget'),
			'currencyConversor' => array(self::BELONGS_TO, 'CurrencyConversor', 'Id_currency_conversor'),
			'currencyFromCurrencyConversor' => array(self::BELONGS_TO, 'CurrencyConversor', 'Id_currency_from_currency_conversor'),
			'currencyToCurrencyConversor' => array(self::BELONGS_TO, 'CurrencyConversor', 'Id_currency_to_currency_conversor'),
					
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_project'=>'Proyecto',
			'project_description' => 'Proyecto',
			'percent_discount' => 'Descuento',
			'date_creation' => 'Fecha Creación',
			'Id_budget_state' => 'State',
			'Id_currency_view'=>'Moneda para descarga',
			'date_inicialization' => 'Fecha Inicio',
			'date_finalization' => 'Fecha Finalización',
			'date_estimated_inicialization' => 'Fecha Estimada Inicio',
			'date_estimated_finalization' => 'Fecha Estimada Finalización',
			'version_number' => 'N° Versión',
			'description' => 'Descripción',
			'subTotalPrice'=>'Subtotal',
			'totalPrice'=>'Total',
			'note' => 'Razón',
			'date_close'=>'Cerrado', 
			'date_cancelled'=>'Cancelado', 
			'date_approved'=>'Aprobado',
			'percent_commission'=>'% Comisi&oacute;n',
			'name_commission'=>'Nombre',
			'last_name_commission'=>'Apellido'
		);
	}

	public function getCurrentVersion()
	{
		$criteria=new CDbCriteria;
	
		$criteria->select='MAX(version_number) as curVersion';
		$criteria->condition='Id = '.$this->Id;
		
		$modelMax = Budget::model()->find($criteria);
		
		return $modelMax->curVersion;
	}
	
	public function getTotalRack()
	{
		$criteria=new CDbCriteria;
		
		$criteria->select='SUM(unit_rack) as total_unit_rack';
		$criteria->with[] = 'product';
		$criteria->condition='Id_budget = '.$this->Id . ' 
				AND version_number = '. $this->version_number . '
				AND need_rack = 1';
		
		$modelBudgetItem = BudgetItem::model()->find($criteria);
		
		return (isset($modelBudgetItem))?$modelBudgetItem->total_unit_rack:0;
	}
	
	public function getTotalFan()
	{
		$criteria=new CDbCriteria;
	
		$criteria->select='SUM(unit_fan) as total_unit_fan';
		$criteria->with[] = 'product';
		$criteria->condition='Id_budget = '.$this->Id . '
					AND version_number = '. $this->version_number . '
					AND need_rack = 1';
	
		$modelBudgetItem = BudgetItem::model()->find($criteria);
	
		return (isset($modelBudgetItem))?$modelBudgetItem->total_unit_fan: 0;
	}
	
	public function getTotalPriceTimeProgramationByService($Id_service)
	{
		$criteria=new CDbCriteria;
		
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		$criteria->addCondition('(t.Id_product is null)');
		$criteria->addCondition('t.service_type = 1');
		
		if(isset($Id_service))
			$criteria->addCondition('t.Id_service='.$Id_service);
		else
			$criteria->addCondition('(t.Id_service is null)');
		
		$modelBudgetItem = BudgetItem::model()->find($criteria);
		$total = 0;
		if(isset($modelBudgetItem))
		{
			$discount = 0;
			if($modelBudgetItem->discount_type ==0)
			{
				$discount = (($modelBudgetItem->price)*$modelBudgetItem->quantity )* $modelBudgetItem->discount/100;
			}
			else
			{
				$discount = $modelBudgetItem->discount;
			}
			$total = (($modelBudgetItem->price)*$modelBudgetItem->quantity) - $discount;
		}
		
		return round($total,2);
		
	}
	public function getTotalPriceTimeInstalationByService($Id_service)
	{
		$criteria=new CDbCriteria;
		
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		$criteria->addCondition('(t.Id_product is null)');
		$criteria->addCondition('t.description like "Instalación"');
		
		if(isset($Id_service))
			$criteria->addCondition('t.Id_service='.$Id_service);
		else
			$criteria->addCondition('(t.Id_service is null)');
		
		$modelBudgetItem = BudgetItem::model()->find($criteria);
		$total = 0;
		if(isset($modelBudgetItem))
		{
			$discount = 0;
			if($modelBudgetItem->discount_type ==0)
			{
				$discount = (($modelBudgetItem->price)*$modelBudgetItem->quantity )* $modelBudgetItem->discount/100;
			}
			else
			{
				$discount = $modelBudgetItem->discount;
			}
			$total = (($modelBudgetItem->price)*$modelBudgetItem->quantity) - $discount;
		}
		
		return round($total,2);
	}
	public function getTotalPriceAdditionalByService($Id_service)
	{
		$criteria=new CDbCriteria;
		
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		$criteria->addCondition('(t.Id_product is null)');
		$criteria->addCondition('t.service_type != 1 and t.service_type != 2');
		
		if(isset($Id_service))
			$criteria->addCondition('t.Id_service='.$Id_service);
		else
			$criteria->addCondition('(t.Id_service is null)');
		
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalTime = 0;
		foreach ($modelBudgetItem as $item)
		{
			$discount = 0;
			if($item->discount_type ==0)
			{
				$discount = (($item->price)*$item->quantity )* $item->discount/100;
			}
			else
			{
				$discount = $item->discount;
			}
			$totalTime += (($item->price)*$item->quantity) - $discount;
		}
		return round($totalTime,2);
	}
	public function getTotalPriceByService($Id_service)
	{
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		$criteria->addCondition('(t.Id_product is not null)');
// 		$criteria->with[]="product";
// 		$criteria->addCondition('(product.is_accessory ==0 )');
		
		
		if(isset($Id_service))
			$criteria->addCondition('t.Id_service='.$Id_service);
		else
			$criteria->addCondition('(t.Id_service is null)');				
				
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();
		}
		return round($totalPrice,2);
	}
	public function getTotalPriceAccessoryByService($Id_service)
	{
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		$criteria->addCondition('(t.Id_product is not null)');
// 		$criteria->with[]="product";
// 		$criteria->addCondition('(product.is_accessory ==1 )');
	
	
		if(isset($Id_service))
			$criteria->addCondition('t.Id_service='.$Id_service);
		else
			$criteria->addCondition('(t.Id_service is null)');
	
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();
		}
		return round($totalPrice,2);
	}
	
	public function getTotalPriceByServiceWithHours($Id_service)
	{
		return round($this->getTotalPriceByService($Id_service)+$this->getTotalPriceTimeInstalationByService($Id_service)+$this->getTotalPriceTimeProgramationByService($Id_service)+  $this->getTotalPriceAdditionalByService($Id_service) ,2);
	}
	public function getTotalPrice()
	{
		
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		
	
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();			
		}
		return round($totalPrice,2);
	}
	public function getTotalPriceFormated()
	{
		return number_format($this->getTotalPrice(),2);
	}
	public function getTotalPriceCurrencyConverted()
	{
		$totalPrice = $this->getTotalPrice();
		return GreenHelper::convertCurrency($totalPrice, $this->Id_currency, $this->Id_currency_view,$this->currencyConversor);
	}
	public function getTotalDiscount()
	{
		$criteria=new CDbCriteria;
		
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		
		
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();
		}
		return round(($totalPrice*$this->percent_discount/100),2);
		
	}
	
	public function getTotalDiscountFormated()
	{
		return number_format($this->getTotalDiscount(),2);
	}
	public function getTotalDiscountCurrencyConverted()
	{
		$totalDiscount = $this->getTotalDiscount();
		return GreenHelper::convertCurrency($totalDiscount, $this->Id_currency, $this->Id_currency_view,$this->currencyConversor);
	}
	
	public function getTotalPriceWithDiscount()
	{
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
	
	
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();
		}
		return round($totalPrice-($totalPrice*$this->percent_discount/100),2);
	}
	public function getTotalPriceWithDiscountFormated()
	{
		return number_format($this->getTotalPriceWithDiscount(),2);
	}
	public function getTotalPriceWithDiscountCurrencyConverted()
	{
		$totalPriceWDiscount = $this->getTotalPriceWithDiscount();
		return GreenHelper::convertCurrency($totalPriceWDiscount, $this->Id_currency, $this->Id_currency_view,$this->currencyConversor);
	}
	

	public function getProfitPercenTotal()
	{
		if($this->Id_budget_state!=1&&$this->Id_budget_state!=5)//abierto y reabierto
		{
			if($this->percent_profitability!=0)
				return $this->percent_profitability;
		}
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
	
	
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		$totalCost= 0;
		foreach ($modelBudgetItem as $item)
		{
			$price = $item->getTotalPriceNotFormated();
			$totalPrice += $price; 
			if($item->service_type == 0)
			{			
				$totalCost += $item->getTotalCostNotFormated();
			}
			else//programacion o instalacion
			{
				$totalCost += $price;				
			}
			
		}
		$total = ($totalPrice*(1-($this->percent_discount/100)));
		if($total>0)
			$this->percent_profitability = round(100-($totalCost / $total * 100),2);
		else
			$this->percent_profitability =  0;
		
		if($this->Id_budget_state!=1&&$this->Id_budget_state!=5)//abierto y reabierto
		{
			$this->save();
		}
		
		return $this->percent_profitability;
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	
	public function searchOpen()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_budget_state',1);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('t.description',$this->description,true);
		
		$criteria->with[]='project';
		$criteria->addSearchCondition("project.description",$this->project_description);		
		
		$sort=new CSort;
		$sort->attributes=array(
				'date_creation',
				'date_inicialization',
				'version_number',
				'description',
				'percent_discount',
				'project_description' => array(
						'asc' => 'project.description',
						'desc' => 'project.description DESC',
				),
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}	
	
	public function searchWaiting()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_budget_state',2);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('date_estimated_inicialization',$this->date_estimated_inicialization,true);
		$criteria->compare('date_estimated_finalization',$this->date_estimated_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('t.description',$this->description,true);
		$criteria->compare('date_close',$this->date_close,true);
		
		$criteria->with[]='project';
		$criteria->addSearchCondition("project.description",$this->project_description);


		$sort=new CSort;
		$sort->attributes=array(
				'date_creation',
				'date_inicialization',
				'version_number',
				'date_close',
				'description',
				'percent_discount',
				'project_description' => array(
						'asc' => 'project.description',
						'desc' => 'project.description DESC',
				),
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	public function searchApproved()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_budget_state',3);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('date_estimated_inicialization',$this->date_estimated_inicialization,true);
		$criteria->compare('date_estimated_finalization',$this->date_estimated_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('t.description',$this->description,true);		
		$criteria->compare('date_approved',$this->date_approved,true);
		
		$criteria->with[]='project';
		$criteria->addSearchCondition("project.description",$this->project_description);
	
	
		$sort=new CSort;
		$sort->attributes=array(
				'date_creation',
				'date_inicialization',
				'version_number',
				'description',
				'percent_discount',
				'project_description' => array(
						'asc' => 'project.description',
						'desc' => 'project.description DESC',
				),
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	public function searchCancelled()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_budget_state',4);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('date_estimated_inicialization',$this->date_estimated_inicialization,true);
		$criteria->compare('date_estimated_finalization',$this->date_estimated_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('note',$this->note, true);
		$criteria->compare('t.description',$this->description,true);
		$criteria->compare('date_cancelled',$this->date_cancelled,true);
		
		$criteria->with[]='project';
		$criteria->addSearchCondition("project.description",$this->project_description);
	
	
		$sort=new CSort;
		$sort->attributes=array(
				'date_creation',
				'note',
				'date_inicialization',
				'version_number',
				'description',
				'percent_discount',
				'project_description' => array(
						'asc' => 'project.description',
						'desc' => 'project.description DESC',
				),
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->join = ',(SELECT Id_budget, version_number, SUM(price) as totPrice
												FROM budget_item group by Id_budget, version_number
												) bi';
		$criteria->condition = 't.Id = bi.Id_budget and t.version_number = bi.version_number';
		
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_project',$this->Id_project);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('Id_budget_state',$this->Id_budget_state);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('date_estimated_inicialization',$this->date_estimated_inicialization,true);
		$criteria->compare('date_estimated_finalization',$this->date_estimated_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('description',$this->description,true);

		$criteria->addSearchCondition('bi.totPrice',$this->totPrice);
		
		$sort=new CSort;
		$sort->attributes=array(
					'date_creation',
					'date_inicialization',
					'version_number',
					'description',
					'percent_discount',
					'totPrice' => array(
						'asc' => 'bi.totPrice',
						'desc' => 'bi.totPrice DESC',
					),
		);
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
	
	public function searchSummary()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join = ',(SELECT Id, MAX(version_number) vn
						FROM budget
						GROUP BY Id) b2, 
						project, budget_state';
		
		$criteria->condition = 't.Id = b2.Id and t.version_number = b2.vn and
								project.Id = t.Id_project and budget_state.Id = t.Id_budget_state';
		
		$criteria->compare('Id',$this->Id);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('date_estimated_inicialization',$this->date_estimated_inicialization,true);
		$criteria->compare('date_estimated_finalization',$this->date_estimated_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('description',$this->description,true);
		$criteria->order="date_creation DESC";
		
		//$criteria->with[]='project';
		$criteria->addSearchCondition('project.description',$this->Id_project);
		
		//$criteria->with[]='budgetState';
		$criteria->addSearchCondition('budgetState.description',$this->Id_budget_state);
		
		$sort=new CSort;
		$sort->attributes=array(
					'date_creation',
					'date_inicialization',
					'version_number',
					'description',
					'percent_discount',
					'Id_budget_state' => array(
						'asc' => 'budgetState.description',
						'desc' => 'budgetState.description DESC',
					),
					'Id_project' => array(
								'asc' => 'project.description',
								'desc' => 'project.description DESC',
					),
		);
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
	
}