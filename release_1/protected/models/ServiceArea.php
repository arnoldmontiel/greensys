<?php

/**
 * This is the model class for table "service_area".
 *
 * The followings are the available columns in table 'service_area':
 * @property integer $Id_service
 * @property integer $Id_area
 */
class ServiceArea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ServiceArea the static model class
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
		return 'service_area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_service, Id_area', 'required'),
			array('Id_service, Id_area', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_service, Id_area', 'safe', 'on'=>'search'),
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
			'area' => array(self::BELONGS_TO, 'Area', 'Id_area'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_service' => 'Id Service',
			'Id_area' => 'Id Area',
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
		$criteria->compare('Id_area',$this->Id_area);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}