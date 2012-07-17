<?php

/**
 * This is the model class for table "purchase_order_item".
 *
 * The followings are the available columns in table 'purchase_order_item':
 * @property integer $Id
 * @property integer $Id_purchase_order
 * @property string $price_shipping
 * @property string $price_purchase
 * @property string $price_total
 * 
 *
 * The followings are the available model relations:
 * @property ProductItem[] $productItems
 * @property PurchaseOrder $idPurchaseOrder
 */
class PurchaseOrderItem extends CActiveRecord
{
	public $product_description_supplier;
	public $product_description_customer;
	public $product_code;
	public $product_code_supplier;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PurchaseOrderItem the static model class
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
		return 'purchase_order_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_purchase_order, Id_product', 'required'),
			array('Id_purchase_order, Id_product,quantity', 'numerical', 'integerOnly'=>true),
			array('price_shipping, price_purchase,price_total', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_purchase_order, price_shipping,price_total, price_purchase, price_total,product_description_supplier,product_description_customer,product_code,product_code_supplier,quantity', 'safe', 'on'=>'search'),
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
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'Id_purchase_order_item'),
			'purchaseOrder' => array(self::BELONGS_TO, 'PurchaseOrder', 'Id_purchase_order'),
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
			'Id_purchase_order' => 'Id Purchase Order',
			'price_shipping' => 'Price Shipping',
			'price_purchase' => 'Price Purchase',
				'price_total'=> 'Price Total',
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
		$criteria->compare('Id_purchase_order',$this->Id_purchase_order);
		$criteria->compare('price_shipping',$this->price_shipping,true);
		$criteria->compare('price_purchase',$this->price_purchase,true);
		$criteria->compare('price_total',$this->price_total,true);		
		
		$criteria->with[]='product';
		$criteria->addSearchCondition("description_customer",$this->product_description_customer);
		$criteria->addSearchCondition("description_supplier",$this->product_description_supplier);
		$criteria->addSearchCondition("code",$this->product_code);
		$criteria->addSearchCondition("code_supplier",$this->product_code_supplier);
		
		$sort=new CSort;
		$sort->attributes=array(
				'product_description_customer' => array(
						'asc' => 'product.description_customer',
						'desc' => 'product.description_customer DESC',
				),
				'product_description_supplier' => array(
						'asc' => 'product.description_supplier',
						'desc' => 'product.description_supplier DESC',
				),
				'product_code' => array(
						'asc' => 'product.code',
						'desc' => 'product.code DESC',
				),
				'product_code_supplier' => array(
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