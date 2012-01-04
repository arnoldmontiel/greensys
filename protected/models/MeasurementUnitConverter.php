<?php

/**
 * This is the model class for table "measurement_unit_converter".
 *
 * The followings are the available columns in table 'measurement_unit_converter':
 * @property integer $Id
 * @property integer $Id_measurement_from
 * @property integer $Id_measurement_to
 * @property string $factor
 *
 * The followings are the available model relations:
 * @property MeasurementUnit $idMeasurementFrom
 * @property MeasurementUnit $idMeasurementTo
 */
class MeasurementUnitConverter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MeasurementUnitConverter the static model class
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
		return 'measurement_unit_converter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_measurement_from, Id_measurement_to', 'required'),
			array('Id, Id_measurement_from, Id_measurement_to', 'numerical', 'integerOnly'=>true),
			array('factor', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_measurement_from, Id_measurement_to, factor', 'safe', 'on'=>'search'),
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
			'idMeasurementFrom' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_from'),
			'idMeasurementTo' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_measurement_from' => 'Id Measurement From',
			'Id_measurement_to' => 'Id Measurement To',
			'factor' => 'Factor',
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
		$criteria->compare('Id_measurement_from',$this->Id_measurement_from);
		$criteria->compare('Id_measurement_to',$this->Id_measurement_to);
		$criteria->compare('factor',$this->factor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}