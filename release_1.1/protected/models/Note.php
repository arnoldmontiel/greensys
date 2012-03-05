<?php

/**
 * This is the model class for table "note".
 *
 * The followings are the available columns in table 'note':
 * @property integer $Id
 * @property string $note
 * @property string $creation_date
 * @property integer $Id_entity_type
 * @property integer $Id_product_requirement_product_requirement_product_item
 * @property integer $Id_product_item_product_requirement_product_item
 * @property integer $budget_Id
 * @property integer $budget_version_number
 * @property integer $Id_tracking
 * @property integer $Id_product
 * @property integer $Id_product_requirement
 *
 * The followings are the available model relations:
 * @property Budget $budget
 * @property Budget $budgetVersionNumber
 * @property Product $idProduct
 * @property ProductRequirement $idProductRequirement
 * @property EntityType $idEntityType
 * @property ProductRequirementProductItem $idProductRequirementProductRequirementProductItem
 * @property ProductRequirementProductItem $idProductItemProductRequirementProductItem
 * @property Tracking $idTracking
 */
class Note extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Note the static model class
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
		return 'note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_entity_type', 'required'),
			array('Id_entity_type, Id_product_requirement_product_requirement_product_item, Id_product_item_product_requirement_product_item, budget_Id, budget_version_number, Id_tracking, Id_product', 'numerical', 'integerOnly'=>false),
			array('creation_date','default',
		              'value'=>new CDbExpression('NOW()'),
		              'setOnEmpty'=>false,'on'=>'insert'),
			array('note, creation_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, note, creation_date, Id_entity_type, Id_product_requirement_product_requirement_product_item, Id_product_item_product_requirement_product_item, budget_Id, budget_version_number, Id_tracking, Id_product', 'safe', 'on'=>'search'),
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
			'budget' => array(self::BELONGS_TO, 'Budget', 'budget_Id'),
			'budgetVersionNumber' => array(self::BELONGS_TO, 'Budget', 'budget_version_number'),
			'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
			'entityType' => array(self::BELONGS_TO, 'EntityType', 'Id_entity_type'),
			'productRequirementProductRequirementProductItem' => array(self::BELONGS_TO, 'ProductRequirementProductItem', 'Id_product_requirement_product_requirement_product_item'),
			'productItemProductRequirementProductItem' => array(self::BELONGS_TO, 'ProductRequirementProductItem', 'Id_product_item_product_requirement_product_item'),
			'tracking' => array(self::BELONGS_TO, 'Tracking', 'Id_tracking'),
			'productRequirement' => array(self::BELONGS_TO, 'ProductRequirement', 'Id_product_requirement'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'note' => 'Note',
			'creation_date' => 'Creation Date',
			'Id_entity_type' => 'Id Entity Type',
			'Id_product_requirement_product_requirement_product_item' => 'Id Product Requirement Product Requirement Product Item',
			'Id_product_item_product_requirement_product_item' => 'Id Product Item Product Requirement Product Item',
			'budget_Id' => 'Budget',
			'budget_version_number' => 'Budget Version Number',
			'Id_tracking' => 'Id Tracking',
			'Id_product' => 'Id Product',
			'Id_product_requirement' => 'Id Product Requirement',
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
		$criteria->compare('note',$this->note,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('Id_entity_type',$this->Id_entity_type);
		$criteria->compare('Id_product_requirement_product_requirement_product_item',$this->Id_product_requirement_product_requirement_product_item);
		$criteria->compare('Id_product_item_product_requirement_product_item',$this->Id_product_item_product_requirement_product_item);
		$criteria->compare('budget_Id',$this->budget_Id);
		$criteria->compare('budget_version_number',$this->budget_version_number);
		$criteria->compare('Id_tracking',$this->Id_tracking);
		$criteria->compare('Id_product',$this->Id_product);
		$criteria->compare('Id_product_requirement',$this->Id_product_requirement);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}