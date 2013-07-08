<?php

/**
 * This is the model class for table "setting".
 *
 * The followings are the available columns in table 'setting':
 * @property integer $Id
 * @property integer $Id_volts
 * @property integer $Id_currency
 * @property integer $Id_measurement
 *
 * The followings are the available model relations:
 * @property Measurement $idMeasurement
 * @property Currency $idCurrency
 * @property Volts $idVolts
 */
class Setting extends ModelAudit
{
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
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_volts, Id_currency, Id_measurement', 'safe', 'on'=>'search'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}