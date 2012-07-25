<?php

/**
 * This is the model class for table "product_item".
 *
 * The followings are the available columns in table 'product_item':
 * @property integer $Id
 * @property integer $Id_product
 * @property string $real_shipping_cost
 * @property integer $Id_purchase_order_item
 * @property integer $Id_budget_item
 * @property integer $Id_project
 *
 * The followings are the available model relations:
 * @property BudgetItem $idBudgetItem
 * @property Project $idProject
 * @property Product $idProduct
 * @property PurchaseOrderItem $idPurchaseOrderItem
 * @property ProductRequirement[] $productRequirements
 * @property TrackingItem[] $trackingItems
 */
class ProductItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductItem the static model class
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
		return 'product_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_product', 'required'),
			array('Id_product, Id_purchase_order_item, Id_budget_item, Id_project', 'numerical', 'integerOnly'=>true),
			array('real_shipping_cost', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_product, real_shipping_cost, Id_purchase_order_item, Id_budget_item, Id_project', 'safe', 'on'=>'search'),
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
			'idBudgetItem' => array(self::BELONGS_TO, 'BudgetItem', 'Id_budget_item'),
			'idProject' => array(self::BELONGS_TO, 'Project', 'Id_project'),
			'idProduct' => array(self::BELONGS_TO, 'Product', 'Id_product'),
			'idPurchaseOrderItem' => array(self::BELONGS_TO, 'PurchaseOrderItem', 'Id_purchase_order_item'),
			'productRequirements' => array(self::MANY_MANY, 'ProductRequirement', 'product_requirement_product_item(Id_product_item, Id_product_requirement)'),
			'trackingItems' => array(self::HAS_MANY, 'TrackingItem', 'Id_product_item'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_product' => 'Id Product',
			'real_shipping_cost' => 'Real Shipping Cost',
			'Id_purchase_order_item' => 'Id Purchase Order Item',
			'Id_budget_item' => 'Id Budget Item',
			'Id_project' => 'Id Project',
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
		$criteria->compare('Id_product',$this->Id_product);
		$criteria->compare('real_shipping_cost',$this->real_shipping_cost,true);
		$criteria->compare('Id_purchase_order_item',$this->Id_purchase_order_item);
		$criteria->compare('Id_budget_item',$this->Id_budget_item);
		$criteria->compare('Id_project',$this->Id_project);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}