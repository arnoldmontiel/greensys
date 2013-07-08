<?php

/**
 * This is the model class for table "measurement_unit".
 *
 * The followings are the available columns in table 'measurement_unit':
 * @property integer $Id
 * @property string $description
 * @property string $short_description
 * @property integer $Id_measurement_type
 *
 * The followings are the available model relations:
 * @property MeasurementType $idMeasurementType
 * @property MeasurementUnitConverter[] $measurementUnitConverters
 * @property MeasurementUnitConverter[] $measurementUnitConverters1
 * @property Product[] $products
 * @property Product[] $products1
 */
class MeasurementUnit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MeasurementUnit the static model class
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
		return 'measurement_unit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_measurement_type', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id, Id_measurement_type', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>45),
			array('short_description', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, short_description, Id_measurement_type', 'safe', 'on'=>'search'),
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
			'idMeasurementType' => array(self::BELONGS_TO, 'MeasurementType', 'Id_measurement_type'),
			'measurementUnitConverters' => array(self::HAS_MANY, 'MeasurementUnitConverter', 'Id_measurement_from'),
			'measurementUnitConverters1' => array(self::HAS_MANY, 'MeasurementUnitConverter', 'Id_measurement_to'),
			'products' => array(self::HAS_MANY, 'Product', 'Id_measurement_unit_volume'),
			'products1' => array(self::HAS_MANY, 'Product', 'Id_measurement_unit_weight'),
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
			'short_description' => 'Short Description',
			'Id_measurement_type' => 'Id Measurement Type',
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
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('Id_measurement_type',$this->Id_measurement_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}