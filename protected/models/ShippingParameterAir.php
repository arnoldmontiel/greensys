<?php

/**
 * This is the model class for table "shipping_parameter_air".
 *
 * The followings are the available columns in table 'shipping_parameter_air':
 * @property integer $Id
 * @property double $cost_measurement_unit
 * @property integer $Id_measurement_unit_cost
 * @property double $weight_max
 * @property double $length_max
 * @property double $width_max
 * @property double $height_max
 * @property double $volume_max
 * @property integer $Id_measurement_unit_sizes_max
 * @property integer $days
 *
 * The followings are the available model relations:
 * @property ShippingParameter[] $shippingParameters
 * @property MeasurementUnit $idMeasurementUnitCost
 * @property MeasurementUnit $idMeasurementUnitSizesMax
 */
class ShippingParameterAir extends ModelAudit
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShippingParameterAir the static model class
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
		return 'shipping_parameter_air';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_measurement_unit_cost, Id_measurement_unit_sizes_max', 'required'),
			array('Id_measurement_unit_cost, Id_measurement_unit_sizes_max, days', 'numerical', 'integerOnly'=>true),
			array('cost_measurement_unit, weight_max, length_max, width_max, height_max, volume_max', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, cost_measurement_unit, Id_measurement_unit_cost, weight_max, length_max, width_max, height_max, volume_max, Id_measurement_unit_sizes_max, days', 'safe', 'on'=>'search'),
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
			'shippingParameters' => array(self::HAS_MANY, 'ShippingParameter', 'Id_shipping_parameter_air'),
			'measurementUnitCost' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_unit_cost'),
			'measurementUnitSizesMax' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_unit_sizes_max'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'cost_measurement_unit' => 'Costo por Medida de Unidad',
			'Id_measurement_unit_cost' => 'Unidad',
			'weight_max' => 'Peso Max',
			'length_max' => 'Largo Max',
			'width_max' => 'Ancho Max',
			'height_max' => 'Alto Max',
			'volume_max' => 'Vol Max',
			'Id_measurement_unit_sizes_max' => 'Unidad Max',
			'days' => 'Dias',
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
		$criteria->compare('cost_measurement_unit',$this->cost_measurement_unit);
		$criteria->compare('Id_measurement_unit_cost',$this->Id_measurement_unit_cost);
		$criteria->compare('weight_max',$this->weight_max);
		$criteria->compare('length_max',$this->length_max);
		$criteria->compare('width_max',$this->width_max);
		$criteria->compare('height_max',$this->height_max);
		$criteria->compare('volume_max',$this->volume_max);
		$criteria->compare('Id_measurement_unit_sizes_max',$this->Id_measurement_unit_sizes_max);
		$criteria->compare('days',$this->days);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}