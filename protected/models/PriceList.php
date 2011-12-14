<?php

/**
 * This is the model class for table "price_list".
 *
 * The followings are the available columns in table 'price_list':
 * @property integer $Id
 * @property string $date_creation
 * @property string $date_validity
 * @property integer $validity
 * @property integer $Id_supplier
 * @property integer $id_price_list_type
 *
 * The followings are the available model relations:
 * @property Budget[] $budgets
 * @property PriceListType $idPriceListType
 * @property Supplier $idSupplier
 * @property PriceListItem[] $priceListItems
 */
class PriceList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PriceList the static model class
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
		return 'price_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_price_list_type', 'required'),
			array('validity, Id_supplier, id_price_list_type', 'numerical', 'integerOnly'=>true),
			array('date_creation, date_validity', 'safe'),
			array('date_creation','default',
		              'value'=>new CDbExpression('NOW()'),
		              'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, date_creation, date_validity, validity, Id_supplier, id_price_list_type', 'safe', 'on'=>'search'),
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
			'budgets' => array(self::HAS_MANY, 'Budget', 'Id_price_list'),
			'idPriceListType' => array(self::BELONGS_TO, 'PriceListType', 'id_price_list_type'),
			'idSupplier' => array(self::BELONGS_TO, 'Supplier', 'Id_supplier'),
			'priceListItems' => array(self::HAS_MANY, 'PriceListItem', 'Id_price_list'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'date_creation' => 'Date Creation',
			'date_validity' => 'Date Validity',
			'validity' => 'Validity',
			'Id_supplier' => 'Id Supplier',
			'id_price_list_type' => 'Id Price List Type',
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
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('date_validity',$this->date_validity,true);
		$criteria->compare('validity',$this->validity);
		$criteria->compare('Id_supplier',$this->Id_supplier);
		$criteria->compare('id_price_list_type',$this->id_price_list_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}