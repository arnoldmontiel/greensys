<?php

/**
 * This is the model class for table "price_list_item".
 *
 * The followings are the available columns in table 'price_list_item':
 * @property integer $Id
 * @property integer $id_product
 * @property integer $Id_price_list
 * @property string $cost
 *
 * The followings are the available model relations:
 * @property PriceList $idPriceList
 * @property Product $idProduct
 */
class PriceListItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PriceListItem the static model class
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
		return 'price_list_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_product, Id_price_list', 'required'),
			array('id_product, Id_price_list', 'numerical', 'integerOnly'=>true),
			array('cost', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, id_product, Id_price_list, cost', 'safe', 'on'=>'search'),
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
			'priceList' => array(self::BELONGS_TO, 'PriceList', 'Id_price_list'),
			'product' => array(self::BELONGS_TO, 'Product', 'id_product'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'id_product' => 'Id Product',
			'Id_price_list' => 'Id Price List',
			'cost' => 'Cost',
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
// 		$criteria->compare('id_product',$this->id_product);
 		$criteria->compare('Id_price_list',$this->Id_price_list);
		$criteria->compare('cost',$this->cost,true);
		
		$criteria->with[]='product';
		$criteria->addSearchCondition("product.description_customer",$this->id_product);

// 		$criteria->with[]='priceList';
// 		$criteria->addSearchCondition("priceList.id",$this->Id_price_list);
		
// 		$criteria->with[]='supplier';
// 		$criteria->addSearchCondition("supplier.business_name",$this->Id_price_list);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}