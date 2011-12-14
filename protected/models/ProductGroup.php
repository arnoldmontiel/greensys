<?php

/**
 * This is the model class for table "product_group".
 *
 * The followings are the available columns in table 'product_group':
 * @property integer $id_product_parent
 * @property integer $id_product_child
 * @property integer $quantity
 *
 * The followings are the available model relations:
 * @property Product $idProductChild
 * @property Product $idProductParent
 */
class ProductGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductGroup the static model class
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
		return 'product_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_product_parent, id_product_child', 'required'),
			array('id_product_parent, id_product_child, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_product_parent, id_product_child, quantity', 'safe', 'on'=>'search'),
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
			'productChild' => array(self::BELONGS_TO, 'Product', 'id_product_child'),
			'productParent' => array(self::BELONGS_TO, 'Product', 'id_product_parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_product_parent' => 'Id Product Parent',
			'id_product_child' => 'Id Product Child',
			'quantity' => 'Quantity',
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

		$criteria->compare('id_product_parent',$this->id_product_parent);
		$criteria->compare('id_product_child',$this->id_product_child);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}