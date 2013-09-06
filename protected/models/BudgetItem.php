<?php

/**
 * This is the model class for table "budget_item".
 *
 * The followings are the available columns in table 'budget_item':
 * @property integer $Id
 * @property integer $Id_product
 * @property integer $Id_budget
 * @property integer $version_number
 * @property string $price
 * @property integer $Id_budget_item
 * @property integer $Id_price_list
 * @property integer $Id_shipping_type
 * @property integer $Id_area
 * @property integer $Id_service
 * @property integer $quantity
 * @property integer $is_included
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Budget $versionNumber
 * @property Area $idArea
 * @property Budget $idBudget
 * @property BudgetItem $idBudgetItem
 * @property BudgetItem[] $budgetItems
 * @property Product $idProduct
 * @property PriceList $idPriceList
 * @property ShippingType $idShippingType
 * @property ProductItem[] $productItems
 * @property Service $service
 */
class BudgetItem extends ModelAudit
{
	public $product_model;
	public $product_part_number;	
	public $product_code;
	public $product_code_supplier;
	public $product_brand_desc;
	public $product_supplier_name;
	public $product_customer_desc;
	public $area_desc;
	public $parent_product_code;
	public $total_price;
	public $total_unit_rack;
	public $total_unit_fan;
	public $children_total_price;
	public $children_count;
	public $children_included;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BudgetItem the static model class
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
		return 'budget_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_budget, version_number', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_product, Id_budget, version_number, Id_budget_item, Id_price_list, Id_shipping_type, Id_area, Id_service, is_included', 'numerical', 'integerOnly'=>true),
			array('price, quantity', 'length', 'max'=>10),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_product, Id_area, Id_service, Id_budget, version_number, price, Id_budget_item, Id_price_list, Id_shipping_type, product_code,product_model,product_part_number, product_code_supplier, product_brand_desc, product_supplier_name, product_customer_desc, area_desc, parent_product_code, quantity, children_count, children_included, description', 'safe', 'on'=>'search'),
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
			'budgetItem' => array(self::BELONGS_TO, 'BudgetItem', 'Id_budget_item'),
			'budgetItems' => array(self::HAS_MANY, 'BudgetItem', 'Id_budget_item'),
			'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
			'area' => array(self::BELONGS_TO, 'Area', 'Id_area'),
			'service' => array(self::BELONGS_TO, 'Service', 'Id_service'),				
			'priceList' => array(self::BELONGS_TO, 'PriceList', 'Id_price_list'),
			'shippingType' => array(self::BELONGS_TO, 'ShippingType', 'Id_shipping_type'),
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'Id_budget_item'),
			'budget' => array(self::BELONGS_TO, 'Budget', 'Id_budget, version_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_product' => 'Product',
			'Id_budget' => 'Budget',
			'version_number' => 'Version',
			'price' => 'Price',
			'Id_budget_item' => 'Budget Item',
			'Id_price_list' => 'Price List',
			'Id_shipping_type' => 'Shipping Type',
			'product_code'=>'Code',
			'product_model'=>'Model',
			'product_part_number'=>'Part Number',
			'product_code_supplier'=>'Code Supplier',
			'product_customer_desc'=>'Customer',
			'product_brand_desc'=>'Brand',
			'product_supplier_name'=>'Supplier Name',
			'Id_area'=>'Area',
			'Id_service'=>'Service',
			'parent_product_code'=>'Parent Code',
			'quantity'=>'Quantity',
			'children_count'=>'Children Qty',
			'children_included'=>'Children Inc',
			'total_price'=>'Total price',
			'description'=>'Description',
		);
	}

	public function getChildrenCount()
	{
		$count = BudgetItem::model()->countByAttributes(array('Id_budget_item'=>$this->Id));
		return $count;
	}
	
	public function getChildrenIncluded()
	{
		$count = BudgetItem::model()->countByAttributes(array('Id_budget_item'=>$this->Id, 'is_included'=>'1'));
		return $count;
	}
	
	public function getHasStockAssigned()
	{
		return ProductItem::model()->countByAttributes(array('Id_product'=>$this->Id_product,'Id_budget_item'=>$this->Id)) > 0;
	}
	
	public function getChildrenTotalPrice()
	{
		$criteria=new CDbCriteria;
	
		$criteria->select='sum(price * quantity) as children_total_price';
		$criteria->condition='t.Id_budget_item = '.$this->Id;
	
		$modelTotal = BudgetItem::model()->find($criteria);
	
		return $modelTotal->children_total_price;
	}
	
	public function getTotalPrice()
	{	if($this->discount_type ==0)
		{
			$discount = (($this->getChildrenTotalPrice() + $this->price)*$this->quantity )* $this->discount/100;				
		}
		else
		{
			$discount = $this->discount;				
		}
		return number_format((($this->getChildrenTotalPrice() + $this->price)*$this->quantity) - $discount , 2);
	}
	
	public function getDoNotWarning()
	{
		if($this->getChildrenCount()==0)
			return true;
		return $this->do_not_warning;
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

		$criteria->compare('t.Id',$this->Id);
		$criteria->compare('t.Id_product',$this->Id_product);
		$criteria->compare('t.Id_area',$this->Id_area);
		$criteria->compare('t.Id_service',$this->Id_service);
		$criteria->compare('t.Id_budget',$this->Id_budget);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->compare('t.Id_budget_item',$this->Id_budget_item);
		$criteria->compare('t.price',$this->price,true);
		$criteria->compare('t.Id_price_list',$this->Id_price_list);
		$criteria->compare('t.Id_shipping_type',$this->Id_shipping_type);
		$criteria->compare('quantity',$this->quantity);
		
		if(!isset($this->Id_budget_item))
			$criteria->addCondition('isnull(t.Id_budget_item)');
		
		$criteria->join =	"LEFT OUTER JOIN product p ON p.Id=t.Id_product
												 LEFT OUTER JOIN brand b ON p.Id_brand=b.Id
												 LEFT OUTER JOIN area a ON a.Id = t.Id_area
												 LEFT OUTER JOIN service se ON se.Id = t.Id_service
												 LEFT OUTER JOIN supplier s ON p.Id_supplier=s.Id
												 LEFT OUTER JOIN (select Id_budget_item, count(*) as child 
												 	from budget_item group by Id_budget_item) bud on
													t.Id =  bud.Id_budget_item
												 LEFT OUTER JOIN (select Id_budget_item, count(*) as child 
												 	from budget_item where is_included = 1 
												 	group by Id_budget_item) bud2 on
													t.Id =  bud2.Id_budget_item";
		
		
		
		$criteria->addSearchCondition("p.code",$this->product_code);
		$criteria->addSearchCondition("p.model",$this->product_model);
		$criteria->addSearchCondition("p.part_number",$this->product_part_number);		
		$criteria->addSearchCondition("p.code_supplier",$this->product_code_supplier);
		$criteria->addSearchCondition("p.description_customer",$this->product_customer_desc);
		$criteria->addSearchCondition("b.description",$this->product_brand_desc);
		$criteria->addSearchCondition("s.business_name",$this->product_supplier_name);
		$criteria->addSearchCondition("a.description",$this->area_desc);
		$criteria->addSearchCondition("bud.child",$this->children_count);
		$criteria->addSearchCondition("bud2.child",$this->children_included);
		
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
											      'product_code' => array(
											        'asc' => 'p.code',
											        'desc' => 'p.code DESC',
		),
											      'product_model' => array(
											        'asc' => 'p.model',
											        'desc' => 'p.model DESC',
		),
								      'product_part_number' => array(
											        'asc' => 'p.part_number',
											        'desc' => 'p.part_number DESC',
		),
														'children_count' => array(
													        'asc' => 'bud.child',
													        'desc' => 'bud.child DESC',
		),
												'children_included' => array(
															        'asc' => 'bud2.child',
															        'desc' => 'bud2.child DESC',
		),
													'product_code_supplier' => array(
											        'asc' => 'p.code_supplier',
											        'desc' => 'p.code_supplier DESC',
		),
													'area_desc' => array(
													        'asc' => 'a.description',
													        'desc' => 'a.description DESC',
		),
													'product_customer_desc' => array(
													        'asc' => 'p.description_customer',
													        'desc' => 'p.description_customer DESC',
		),
													'product_brand_desc'=> array(
													'asc'=>'b.description',
													'desc'=>'b.description DESC'
		),
													'product_supplier_name'=> array(
													'asc'=>'s.business_name',
													'desc'=>'s.business_name DESC'
		),
							'*',
		);
		
		return new CActiveDataProvider($this, array(
													'criteria'=>$criteria,
													'sort'=>$sort,
		));
	}
	public function searchByProductsPending()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id',$this->Id);
		$criteria->compare('t.Id_product',$this->Id_product);
		$criteria->compare('t.Id_area',$this->Id_area);
		$criteria->compare('t.Id_service',$this->Id_service);
		$criteria->compare('t.Id_budget',$this->Id_budget);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->compare('t.Id_budget_item',$this->Id_budget_item);
		$criteria->compare('t.price',$this->price,true);
		$criteria->compare('t.Id_price_list',$this->Id_price_list);
		$criteria->compare('t.Id_shipping_type',$this->Id_shipping_type);
		$criteria->compare('quantity',$this->quantity);
	
		$criteria->addCondition('t.version_number in (SELECT MAX(version_number) FROM budget WHERE budget.Id = t.Id_budget)');
		$criteria->addCondition('t.Id not in (select pi.Id_budget_item from product_item pi where pi.Id_product=t.Id_product and pi.Id_budget_item is not NULL )');

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	public function searchGenericItem()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id_budget);
		$criteria->compare('t.version_number',$this->version_number);
		
		$criteria->addCondition('t.Id_product is null');
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
							'description',
							'quantity',
							'price',
							'*',
		);
		
		return new CActiveDataProvider($this, array(
													'criteria'=>$criteria,
													'sort'=>$sort,
		));
	}
	public function searchByPurchaseItemsAssigned($Id_purchase_item)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id',$this->Id);
		$criteria->compare('t.Id_product',$this->Id_product);
		$criteria->compare('t.Id_area',$this->Id_area);
		$criteria->compare('t.Id_service',$this->Id_service);
		$criteria->compare('t.Id_budget',$this->Id_budget);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->compare('t.Id_budget_item',$this->Id_budget_item);
		$criteria->compare('t.price',$this->price,true);
		$criteria->compare('t.Id_price_list',$this->Id_price_list);
		$criteria->compare('t.Id_shipping_type',$this->Id_shipping_type);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('productItems.Id_purchase_order_item',$Id_purchase_item);
		$criteria->join='LEFT OUTER JOIN `product_item` `productItems` ON (`productItems`.`Id_budget_item`=`t`.`Id`) ';
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
}