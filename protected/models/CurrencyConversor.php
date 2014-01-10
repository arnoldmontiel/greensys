<?php

/**
 * This is the model class for table "currency_conversor".
 *
 * The followings are the available columns in table 'currency_conversor':
 * @property integer $Id
 * @property integer $Id_currency_from
 * @property integer $Id_currency_to
 * @property string $creation_date
 * @property string $validity_date
 * @property string $factor
 *
 * The followings are the available model relations:
 * @property Currency $idCurrencyFrom
 * @property Currency $idCurrencyTo
 */
class CurrencyConversor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CurrencyConversor the static model class
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
		return 'currency_conversor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_currency_from, Id_currency_to', 'required'),
			array('Id_currency_from, Id_currency_to', 'numerical', 'integerOnly'=>true),
			array('factor', 'length', 'max'=>10),
			array('creation_date, validity_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_currency_from, Id_currency_to, creation_date, validity_date, factor', 'safe', 'on'=>'search'),
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
			'currencyFrom' => array(self::BELONGS_TO, 'Currency', 'Id_currency_from'),
			'currencyTo' => array(self::BELONGS_TO, 'Currency', 'Id_currency_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_currency_from' => 'Id Currency From',
			'Id_currency_to' => 'Id Currency To',
			'creation_date' => 'Creation Date',
			'validity_date' => 'Fecha',
			'factor' => 'Cotizaci&oacute;n',
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
		$criteria->compare('Id_currency_from',$this->Id_currency_from);
		$criteria->compare('Id_currency_to',$this->Id_currency_to);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('validity_date',$this->validity_date,true);
		$criteria->compare('factor',$this->factor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}