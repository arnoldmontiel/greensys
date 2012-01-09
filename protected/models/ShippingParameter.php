<?php

/**
 * This is the model class for table "shipping_parameter".
 *
 * The followings are the available columns in table 'shipping_parameter':
 * @property integer $Id
 * @property string $description
 * @property integer $Id_importer
 * @property integer $Id_shipping_parameter_air
 * @property integer $Id_shipping_parameter_maritime
 * @property integer $current
 *
 * The followings are the available model relations:
 * @property PurchaseOrder[] $purchaseOrders
 * @property Importer $idImporter
 * @property ShippingParameterAir $idShippingParameterAir
 * @property ShippingParameterMaritime $idShippingParameterMaritime
 */
class ShippingParameter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShippingParameter the static model class
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
		return 'shipping_parameter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_importer, Id_shipping_parameter_air, Id_shipping_parameter_maritime', 'required'),
			array('Id_importer, Id_shipping_parameter_air, Id_shipping_parameter_maritime, current', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, Id_importer, Id_shipping_parameter_air, Id_shipping_parameter_maritime, current', 'safe', 'on'=>'search'),
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
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'Id_shipping_parameter'),
			'importer' => array(self::BELONGS_TO, 'Importer', 'Id_importer'),
			'shippingParameterAir' => array(self::BELONGS_TO, 'ShippingParameterAir', 'Id_shipping_parameter_air'),
			'shippingParameterMaritime' => array(self::BELONGS_TO, 'ShippingParameterMaritime', 'Id_shipping_parameter_maritime'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'Description',
			'Id_importer' => 'Id Importer',
			'Id_shipping_parameter_air' => 'Id Shipping Parameter Air',
			'Id_shipping_parameter_maritime' => 'Id Shipping Parameter Maritime',
			'current' => 'Current',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('Id_importer',$this->Id_importer);
		$criteria->compare('Id_shipping_parameter_air',$this->Id_shipping_parameter_air);
		$criteria->compare('Id_shipping_parameter_maritime',$this->Id_shipping_parameter_maritime);
		$criteria->compare('current',$this->current);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}