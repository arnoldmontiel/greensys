<?php

/**
 * This is the model class for table "stock_summary".
 *
 * The followings are the available columns in table 'stock_summary':
 * @property string $description_customer
 * @property string $description_supplier
 * @property string $code
 * @property string $code_supplier
 * @property string $brand_description
 * @property string $supplier_description
 * @property string $quantity
 */
class StockSummary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StockSummary the static model class
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
		return 'stock_summary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description_customer, description_supplier', 'length', 'max'=>255),
			array('code, code_supplier, supplier_description', 'length', 'max'=>45),
			array('brand_description', 'length', 'max'=>100),
			array('quantity', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('description_customer, description_supplier, code, code_supplier, brand_description, supplier_description, quantity', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'description_customer' => 'Description Customer',
			'description_supplier' => 'Description Supplier',
			'code' => 'Code',
			'code_supplier' => 'Code Supplier',
			'brand_description' => 'Brand Description',
			'supplier_description' => 'Supplier Description',
			'quantity' => 'Quantity',
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

		$criteria->compare('description_customer',$this->description_customer,true);
		$criteria->compare('description_supplier',$this->description_supplier,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('code_supplier',$this->code_supplier,true);
		$criteria->compare('brand_description',$this->brand_description,true);
		$criteria->compare('supplier_description',$this->supplier_description,true);
		$criteria->compare('quantity',$this->quantity,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}