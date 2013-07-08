<?php

/**
 * This is the model class for table "shipping_parameter_maritime".
 *
 * The followings are the available columns in table 'shipping_parameter_maritime':
 * @property integer $Id
 * @property string $cost_measurement_unit
 * @property integer $Id_measurement_unit_cost
 * @property integer $days
 *
 * The followings are the available model relations:
 * @property ShippingParameter[] $shippingParameters
 * @property MeasurementUnit $idMeasurementUnitCost
 */
class ShippingParameterMaritime extends ModelAudit
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShippingParameterMaritime the static model class
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
		return 'shipping_parameter_maritime';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_measurement_unit_cost', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id, Id_measurement_unit_cost, days', 'numerical', 'integerOnly'=>true),
			array('cost_measurement_unit', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, cost_measurement_unit, Id_measurement_unit_cost, days', 'safe', 'on'=>'search'),
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
			'shippingParameters' => array(self::HAS_MANY, 'ShippingParameter', 'Id_shipping_parameter_maritime'),
			'measurementUnitCost' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_unit_cost'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'cost_measurement_unit' => 'Cost Measurement Unit',
			'Id_measurement_unit_cost' => 'Id Measurement Unit Cost',
			'days' => 'Days',
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
		$criteria->compare('cost_measurement_unit',$this->cost_measurement_unit,true);
		$criteria->compare('Id_measurement_unit_cost',$this->Id_measurement_unit_cost);
		$criteria->compare('days',$this->days);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}