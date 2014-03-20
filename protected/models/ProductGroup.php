<?php

/**
 * This is the model class for table "product_group".
 *
 * The followings are the available columns in table 'product_group':
 * @property integer $Id_product_parent
 * @property integer $Id_product_child
 * @property integer $quantity
 *
 * The followings are the available model relations:
 * @property Product $idProductChild
 * @property Product $idProductParent
 */
class ProductGroup extends CActiveRecord
{
	public $product_brand_description;
	public $product_category_description;
	public $product_nomenclator_description;
	public $product_supplier_business_name;
	public $product_description_supplier;
	public $product_description_customer;
	public $product_code;
	public $product_model;
	public $product_part_number;
	public $product_short_description;
	public $product_dealer_cost;
	public $product_msrp;
	
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
			array('Id_product_parent, Id_product_child', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_product_parent, Id_product_child, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_product_parent, Id_product_child, quantity, product_brand_description, product_category_description, product_nomenclator_description,product_description_supplier,product_description_customer, product_code, product_supplier_business_name,product_model,product_part_number,product_short_description', 'safe', 'on'=>'search'),
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
			'productChild' => array(self::BELONGS_TO, 'Product', 'Id_product_child'),
			'productParent' => array(self::BELONGS_TO, 'Product', 'Id_product_parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_product_parent' => 'Id Product Parent',
			'Id_product_child' => 'Id Product Child',
			'quantity' => 'Quantity',
			'product_model'=>'Model',
			'product_part_number'=>'Part Number',
			'product_short_description'=>'Short Description',
			'product_supplier_business_name'=>'Supplier',
			'product_brand_description'=>'Brand',
			'product_code'=>'Code',
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

		$criteria->compare('Id_product_parent',$this->Id_product_parent);
		$criteria->compare('Id_product_child',$this->Id_product_child);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchProduct()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id_product_parent',$this->Id_product_parent);
		$criteria->compare('Id_product_child',$this->Id_product_child);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	* Retrieves a list of models based on the current search/filter conditions.
	* @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	*/
	public function searchProductChild()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_product_parent',$this->Id_product_parent);
		$criteria->compare('Id_product_child',$this->Id_product_child);
		$criteria->compare('quantity',$this->quantity);
			
		$criteria->with[]='productChild';
		$criteria->addSearchCondition("productChild.code",$this->product_code);
		$criteria->addSearchCondition("productChild.description_customer",$this->product_description_customer);
		$criteria->addSearchCondition("productChild.description_supplier",$this->product_description_supplier);
		$criteria->addSearchCondition("productChild.model",$this->product_model);
		$criteria->addSearchCondition("productChild.part_number",$this->product_part_number);
		$criteria->addSearchCondition("productChild.short_description",$this->product_short_description);
		
		$criteria->join =	"LEFT OUTER JOIN product p ON p.Id=t.Id_product_child
								 LEFT OUTER JOIN brand b ON p.Id_brand=b.Id
								 LEFT OUTER JOIN supplier s ON p.Id_supplier=s.Id";
		$criteria->addSearchCondition("b.description",$this->product_brand_description);
		$criteria->addSearchCondition("s.business_name",$this->product_supplier_business_name);
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
							      'quantity',
							      'product_code' => array(
							        'asc' => 'productChild.code',
							        'desc' => 'productChild.code DESC',
		),
		'product_model' => array(
									        'asc' => 'productChild.model',
									        'desc' => 'productChild.model DESC',
		),
		'product_part_number' => array(
											        'asc' => 'productChild.part_number',
											        'desc' => 'productChild.part_number DESC',
		),
		'product_short_description' => array(
													        'asc' => 'productChild.short_description',
													        'desc' => 'productChild.short_description DESC',
		),
									'product_description_customer' => array(
							        'asc' => 'productChild.description_customer',
							        'desc' => 'productChild.description_customer DESC',
		),
							      'product_description_supplier' => array(
							        'asc' => 'productChild.description_supplier',
							        'desc' => 'productChild.description_supplier DESC',
		),
									'product_brand_description'=> array(
									'asc'=>'b.description',
									'desc'=>'b.description DESC'
		),
									'product_supplier_business_name'=> array(
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
	
	
}