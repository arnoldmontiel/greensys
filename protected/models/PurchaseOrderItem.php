<?php

/**
 * This is the model class for table "purchase_order_item".
 *
 * The followings are the available columns in table 'purchase_order_item':
 * @property integer $Id
 * @property integer $Id_purchase_order
 * @property string $price_with_shipping
 * @property string $price_purchase
 *
 * The followings are the available model relations:
 * @property ProductItem[] $productItems
 * @property PurchaseOrder $idPurchaseOrder
 */
class PurchaseOrderItem extends CActiveRecord
{
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
			array('Id_purchase_order', 'required'),
			array('Id_purchase_order', 'numerical', 'integerOnly'=>true),
			array('price_with_shipping, price_purchase', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_purchase_order, price_with_shipping, price_purchase', 'safe', 'on'=>'search'),
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
			'idPurchaseOrder' => array(self::BELONGS_TO, 'PurchaseOrder', 'Id_purchase_order'),
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
			'price_with_shipping' => 'Price With Shipping',
			'price_purchase' => 'Price Purchase',
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
		$criteria->compare('price_with_shipping',$this->price_with_shipping,true);
		$criteria->compare('price_purchase',$this->price_purchase,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}