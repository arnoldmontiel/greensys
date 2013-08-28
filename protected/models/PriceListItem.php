<?php

/**
 * This is the model class for table "price_list_item".
 *
 * The followings are the available columns in table 'price_list_item':
 * @property integer $Id
 * @property integer $Id_product
 * @property integer $Id_price_list
 * @property string $msrp
 * @property string $dealer_cost
 * @property string $profit_rate
 * @property string $maritime_cost
 * @property string $air_cost

 *
 * The followings are the available model relations:
 * @property PriceList $idPriceList
 * @property Product $idProduct
 */
class PriceListItem extends ModelAudit
{
	
	public $description_customer;
	public $code;
	public $model;
	public $part_number;
	public $code_supplier;
	public $Id_importer;
	public $importer_desc;
	public $maritime_days;
	public $air_days;
	/**
	 * Returns the static model of the specified AR class.
	 * @return PriceListItem the static model class
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
		return 'price_list_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_product, Id_price_list', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_product, Id_price_list', 'numerical', 'integerOnly'=>true),
			array('msrp, dealer_cost, profit_rate, maritime_cost,air_cost', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_product, Id_price_list, cost, description_customer, code, code_supplier,importer_desc, maritime_days, air_days', 'safe'),
			array('Id, Id_product, Id_price_list, description_customer, code, code_supplier, msrp, dealer_cost, profit_rate, maritime_cost,air_cost, importer_desc, maritime_days, air_days,part_number,model', 'safe', 'on'=>'search'),
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
			'priceList' => array(self::BELONGS_TO, 'PriceList', 'Id_price_list'),
			'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_product' => 'Id Product',
			'Id_price_list' => 'Id Price List',
			'msrp' => 'Msrp',
			'dealer_cost' => 'Dealer Cost',
			'profit_rate' => 'Profit Rate',
			'maritime_cost' => 'Maritime',
			'air_cost' => 'Air',
			'importer_desc'=>'Importer',
			'maritime_days'=>'Maritime days',
			'air_days'=>'Air days',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.		
		
		$criteria=new CDbCriteria;
		
		$criteria->compare('Id',$this->Id);
 		$criteria->compare('Id_product',$this->Id_product);
 		$criteria->compare('Id_price_list',$this->Id_price_list);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('dealer_cost',$this->dealer_cost,true);
		$criteria->compare('profit_rate',$this->profit_rate,true);
		$criteria->compare('maritime_cost',$this->maritime_cost,true);
		$criteria->compare('air_cost',$this->air_cost,true);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchForBudget()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_product',$this->Id_product);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('dealer_cost',$this->dealer_cost,true);
		$criteria->compare('profit_rate',$this->profit_rate,true);
		$criteria->compare('maritime_cost',$this->maritime_cost,true);
		$criteria->compare('air_cost',$this->air_cost,true);
	
		$criteria->join = "INNER JOIN price_list pl ON (t.Id_price_list = pl.Id)
							INNER JOIN importer i ON (pl.Id_importer = i.Id)
							INNER JOIN contact c ON (i.Id_contact = c.Id)
							INNER JOIN shipping_parameter sp ON (i.Id = sp.Id_importer AND sp.current = 1)
							INNER JOIN shipping_parameter_maritime spm ON (sp.Id_shipping_parameter_maritime = spm.Id)
							INNER JOIN shipping_parameter_air spa ON (sp.Id_shipping_parameter_air = spa.Id)";
		
		$criteria->addSearchCondition("c.description",$this->importer_desc,true);
		$criteria->addSearchCondition("pl.Id_price_list_type",2);
		$criteria->addSearchCondition("pl.validity",1);
		$criteria->addSearchCondition("spm.days",$this->maritime_days,true);
		$criteria->addSearchCondition("spa.days",$this->air_days,true);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
								      'msrp',
								      'maritime_cost',
								      'air_cost',
								      'dealer_cost',
								      'profit_rate',
								      'importer_desc' => array(
								        'asc' => 'c.description',
								        'desc' => 'c.description DESC',
		),
									'maritime_days' => array(
										        'asc' => 'spm.days',
										        'desc' => 'spm.days DESC',
		),
									'air_days' => array(
										        'asc' => 'spa.days',
										        'desc' => 'spa.days DESC',
		),
				'*',
		);
		
		return new CActiveDataProvider($this, array(
										'criteria'=>$criteria,
										'sort'=>$sort,
		));
		
	}
	
	public function searchPriceList()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id',$this->Id);
		$criteria->compare('t.Id_product',$this->Id_product);
		$criteria->compare('t.Id_price_list',$this->Id_price_list);
		$criteria->compare('t.msrp',$this->msrp);
		$criteria->compare('t.dealer_cost',$this->dealer_cost);
		$criteria->compare('t.profit_rate',$this->profit_rate);
		$criteria->compare('t.maritime_cost',$this->maritime_cost);
		$criteria->compare('t.air_cost',$this->air_cost);
		
		$criteria->with[]='product';
		$criteria->addSearchCondition("description_customer",$this->description_customer);
		$criteria->addSearchCondition("code",$this->code);
		$criteria->addSearchCondition("code_supplier",$this->code_supplier);
		$criteria->addSearchCondition("part_number",$this->part_number);
		$criteria->addSearchCondition("model",$this->model);		
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		      'cost',
		// For each relational attribute, create a 'virtual attribute' using the public variable name
		'part_number' => array(
				        'asc' => 'product.part_number',
				        'desc' => 'product.part_number DESC',
		),
		'model' => array(
				        'asc' => 'product.model',
				        'desc' => 'product.model DESC',
		),
		      'description_customer' => array(
		        'asc' => 'product.description_customer',
		        'desc' => 'product.description_customer DESC',
				),
		      'code' => array(
		        'asc' => 'product.code',
		        'desc' => 'product.code DESC',
		),
		      'code_supplier' => array(
		        'asc' => 'product.code_supplier',
		        'desc' => 'product.code_supplier DESC',
		),
		'*',
		);
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
	public function getMaritimePurchaseCost()
	{
		if(!isset($this->priceList))	return;
		$importer = $this->priceList->importer;
		if(isset($importer))
		{
			if(!empty($importer->shippingParameters))
			{
				$shippingParameter = $importer->shippingParameters[0];
				$maritime = $shippingParameter->shippingParameterMaritime;
				if (isset($this)&&isset($shippingParameter)&&isset($maritime)&&isset($this->product))
				{
					$cost = $this->dealer_cost+($maritime->cost_measurement_unit*$this->product->getVolume());
					return number_format(round($cost,4),2);
				}
			}						
		}
	}
	public function getAirPurchaseCost()
	{
		if(!isset($this->priceList))	return;		
		$importer = $this->priceList->importer;
		if(isset($importer))
		{
			if(!empty($importer->shippingParameters))
			{
				$shippingParameter = $importer->shippingParameters[0];
				$air = $shippingParameter->shippingParameterAir;
				if (isset($this)&&isset($shippingParameter)&&isset($air)&&isset($this->product))
				{
					$cost = $this->dealer_cost+($air->cost_measurement_unit*$this->product->weight);		
					return number_format(round($cost,4),2);
				}
			}						
		}
	}
}