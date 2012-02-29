<?php

/**
 * This is the model class for table "service_category".
 *
 * The followings are the available columns in table 'service_category':
 * @property integer $Id_service
 * @property integer $Id_category
 * @property integer $quantity
 */
class ServiceCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ServiceCategory the static model class
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
		return 'service_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_service, Id_category', 'required'),
			array('Id_service, Id_category, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_service, Id_category, quantity', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'Id_service'),
			'category' => array(self::BELONGS_TO, 'Category', 'Id_category'),
		);
			}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_service' => 'Id Service',
			'Id_category' => 'Id Category',
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

		$criteria->compare('Id_service',$this->Id_service);
		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}