<?php

/**
 * This is the model class for table "cost".
 *
 * The followings are the available columns in table 'cost':
 * @property integer $Id_priceListItem
 * @property integer $Id_priceList
 * @property integer $Id_product
 * @property integer $Id_importer
 * @property string $code
 * @property double $weight
 * @property double $cost_air
 * @property double $volume
 * @property double $cost_maritime
 * @property string $msrp
 * @property string $dealer_cost
 * @property string $profit_rate
 */
class Cost extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cost the static model class
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
		return 'cost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_priceListItem, Id_priceList, Id_product, Id_importer', 'numerical', 'integerOnly'=>true),
			array('weight, cost_air, volume, cost_maritime', 'numerical'),
			array('code', 'length', 'max'=>45),
			array('msrp, dealer_cost, profit_rate', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_priceListItem, Id_priceList, Id_product, Id_importer, code, weight, cost_air, volume, cost_maritime, msrp, dealer_cost, profit_rate', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_priceListItem' => 'Id Price List Item',
			'Id_priceList' => 'Id Price List',
			'Id_product' => 'Id Product',
			'Id_importer' => 'Id Importer',
			'code' => 'Code',
			'weight' => 'Weight',
			'cost_air' => 'Cost Air',
			'volume' => 'Volume',
			'cost_maritime' => 'Cost Maritime',
			'msrp' => 'Msrp',
			'dealer_cost' => 'Dealer Cost',
			'profit_rate' => 'Profit Rate',
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

		$criteria->compare('Id_priceListItem',$this->Id_priceListItem);
		$criteria->compare('Id_priceList',$this->Id_priceList);
		$criteria->compare('Id_product',$this->Id_product);
		$criteria->compare('Id_importer',$this->Id_importer);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('cost_air',$this->cost_air);
		$criteria->compare('volume',$this->volume);
		$criteria->compare('cost_maritime',$this->cost_maritime);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('dealer_cost',$this->dealer_cost,true);
		$criteria->compare('profit_rate',$this->profit_rate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}