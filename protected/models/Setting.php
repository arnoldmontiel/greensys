<?php

/**
 * This is the model class for table "setting".
 *
 * The followings are the available columns in table 'setting':
 * @property integer $Id
 * @property integer $Id_volts
 * @property integer $Id_currency
 * @property integer $Id_measurement
 * @property string $time_instalation_price
 * @property string $time_programation_price
 *
 * The followings are the available model relations:
 * @property Measurement $idMeasurement
 * @property Currency $idCurrency
 * @property Volts $idVolts
 */
class Setting extends ModelAudit
{
	public $measurement_description;
	public $currency_description;
	public $volts_description;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Setting the static model class
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
		return 'setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_volts, Id_currency, Id_measurement', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id, Id_volts, Id_currency, Id_measurement', 'numerical', 'integerOnly'=>true),
			array('time_instalation_price, time_programation_price','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_volts, Id_currency, Id_measurement, time_instalation_price, time_programation_price, measurement_description,currency_description,volts_description', 'safe', 'on'=>'search'),
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
			'measurement' => array(self::BELONGS_TO, 'Measurement', 'Id_measurement'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'Id_currency'),
			'volts' => array(self::BELONGS_TO, 'Volts', 'Id_volts'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_volts' => 'Volts',
			'Id_currency' => 'Currency',
			'Id_measurement' => 'Measurement',
			'time_instalation_price'=>'Time Instalation Price',
			'time_programation_price'=>'Time Programation Price',
			'measurement_description'=>'Measurement',
			'currency_description'=>'Currency',
			'volts_description'=>'Volts',
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
		$criteria->compare('Id_volts',$this->Id_volts);
		$criteria->compare('Id_currency',$this->Id_currency);
		$criteria->compare('Id_measurement',$this->Id_measurement);
		$criteria->compare('time_instalation_price',$this->time_instalation_price);
		$criteria->compare('time_programation_price',$this->time_programation_price);
		
		$criteria->with[]='measurement';
		$criteria->compare('measurement.description',$this->measurement_description,true);
		
		$criteria->with[]='currency';
		$criteria->compare('currency.short_description',$this->currency_description,true);
		
		$criteria->with[]='volts';
		$criteria->compare('volts.volts',$this->volts_description,true);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
							'time_instalation_price',
							'time_programation_price',
							'measurement_description' => array(
							        'asc' => 'measurement.description',
							        'desc' => 'measurement.description DESC',
							),
							'currency_description' => array(
							        'asc' => 'currency.short_description',
							        'desc' => 'currency.short_description DESC',
							),
							'volts_description' => array(
							        'asc' => 'volts.volts',
							        'desc' => 'volts.volts DESC',
							),
							'*',
		);
		
		return new CActiveDataProvider($this, array(
									'criteria'=>$criteria,
									'sort'=>$sort,
		));
		
	}
}