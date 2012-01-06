<?php

/**
 * This is the model class for table "importer".
 *
 * The followings are the available columns in table 'importer':
 * @property integer $Id
 * @property string $description
 * @property integer $Id_contact
 *
 * The followings are the available model relations:
 * @property Contact $idContact
 * @property PurchaseOrder[] $purchaseOrders
 * @property ShippingParameter[] $shippingParameters
 */
class Importer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Importer the static model class
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
		return 'importer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_contact', 'required'),
			array('Id, Id_contact', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, Id_contact', 'safe', 'on'=>'search'),
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
			'contact' => array(self::BELONGS_TO, 'Contact', 'Id_contact'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'Id_importer'),
			'shippingParameters' => array(self::HAS_MANY, 'ShippingParameter', 'Id_importer'),
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
			'Id_contact' => 'Id Contact',
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
		$criteria->compare('Id_contact',$this->Id_contact);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}