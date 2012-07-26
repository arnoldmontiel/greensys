<?php

/**
 * This is the model class for table "purchase_order".
 *
 * The followings are the available columns in table 'purchase_order':
 * @property integer $Id
 * @property integer $code
 * @property integer $Id_supplier
 * @property integer $Id_shipping_parameter
 * @property string $date_creation
 * @property integer $Id_purchase_order_state
 * @property integer $Id_importer
 * @property integer $Id_shipping_type
 *
 * The followings are the available model relations:
 * @property ShippingParameter $idShippingParameter
 * @property PurchaseOrderState $idPurchaseOrderState
 * @property ShippingType $idShippingType
 * @property Supplier $idSupplier
 * @property Importer $idImporter
 * @property PurchaseOrderItem[] $purchaseOrderItems
 */
class PurchaseOrder extends CActiveRecord

{
	public $price_total;
	public $price_shipping_total;
	public function beforeSave()
	{
		$modelSupplier = Supplier::model()->findByPk($this->Id_supplier);
		$sub = strtoupper(substr($modelSupplier->business_name,0,2));
		
		$newId = PurchaseOrder::model()->countByAttributes(array('Id_supplier'=>$this->Id_supplier));
		$newId = str_pad($newId, 4, "0", STR_PAD_LEFT);
		
		$model->code = $sub . $newId;
		return parent::beforeSave();
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PurchaseOrder the static model class
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
		return 'purchase_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_supplier, Id_shipping_parameter, Id_purchase_order_state, Id_importer, Id_shipping_type', 'required'),
			array('Id_supplier, Id_shipping_parameter, Id_purchase_order_state, Id_importer, Id_shipping_type', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>45),				
			array('date_creation', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, code, Id_supplier, Id_shipping_parameter, date_creation, Id_purchase_order_state, Id_importer, Id_shipping_type', 'safe', 'on'=>'search'),
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
			'shippingParameter' => array(self::BELONGS_TO, 'ShippingParameter', 'Id_shipping_parameter'),
			'purchaseOrderState' => array(self::BELONGS_TO, 'PurchaseOrderState', 'Id_purchase_order_state'),
			'shippingType' => array(self::BELONGS_TO, 'ShippingType', 'Id_shipping_type'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'Id_supplier'),
			'importer' => array(self::BELONGS_TO, 'Importer', 'Id_importer'),
			'purchaseOrderItems' => array(self::HAS_MANY, 'PurchaseOrderItem', 'Id_purchase_order'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'code' => 'Code',
			'Id_supplier' => 'Supplier',
			'Id_shipping_parameter' => 'Shipping Parameter',
			'date_creation' => 'Creation',
			'Id_purchase_order_state' => 'State',
			'Id_importer' => 'Importer',
			'Id_shipping_type' => 'Shipping Type',
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
		$criteria->compare('code',$this->code);
		$criteria->compare('Id_supplier',$this->Id_supplier);
		$criteria->compare('Id_shipping_parameter',$this->Id_shipping_parameter);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('Id_purchase_order_state',$this->Id_purchase_order_state);
		$criteria->compare('Id_importer',$this->Id_importer);
		$criteria->compare('Id_shipping_type',$this->Id_shipping_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getPriceTotal()
	{
		$criteria=new CDbCriteria;
	
		$criteria->select='sum(purchaseOrderItems.price_total) as price_total, t.*';
		$criteria->condition='t.Id = '.$this->Id;
		$criteria->with[]='purchaseOrderItems';
		
		$modelTotal = PurchaseOrder::model()->find($criteria);
		
		return $modelTotal->price_total;
	}
	public function getPriceShippingTotal()
	{
		$criteria=new CDbCriteria;
	
		$criteria->select='sum(purchaseOrderItems.price_shipping*purchaseOrderItems.quantity) as price_shipping_total, t.*';
		$criteria->condition='t.Id = '.$this->Id;
		$criteria->with[]='purchaseOrderItems';
		
		$modelTotal = PurchaseOrder::model()->find($criteria);
		
		return $modelTotal->price_shipping_total;
	}
}
