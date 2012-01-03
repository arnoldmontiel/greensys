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

 *
 * The followings are the available model relations:
 * @property PriceList $idPriceList
 * @property Product $idProduct
 */
class PriceListItem extends CActiveRecord
{
	
	public $description_customer;
	public $code;
	public $code_supplier;
	
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
			array('Id_product, Id_price_list', 'required'),
			array('Id_product, Id_price_list', 'numerical', 'integerOnly'=>true),
			array('msrp, dealer_cost, profit_rate', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_product, Id_price_list, cost, description_customer, code, code_supplier', 'safe'),
			array('Id, Id_product, Id_price_list, description_customer, code, code_supplier, msrp, dealer_cost, profit_rate', 'safe', 'on'=>'search'),
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
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchPriceList()
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
	
		$criteria->with[]='product';
		$criteria->addSearchCondition("product.description_customer",$this->description_customer);
		$criteria->addSearchCondition("product.code",$this->code);
		$criteria->addSearchCondition("product.code_supplier",$this->code_supplier);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		      'cost',
		// For each relational attribute, create a 'virtual attribute' using the public variable name
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
}