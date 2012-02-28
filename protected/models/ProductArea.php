<?php

/**
 * This is the model class for table "product_area".
 *
 * The followings are the available columns in table 'product_area':
 * @property integer $Id_area
 * @property integer $Id_product
 * @property integer $quantity
 */
class ProductArea extends CActiveRecord
{
	public $product_brand_description;
	public $product_category_description;
	public $product_nomenclator_description;
	public $product_supplier_business_name;
	public $product_description_supplier;
	public $product_description_customer;
	public $product_code;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductArea the static model class
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
		return 'product_area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_area, Id_product', 'required'),
			array('Id_area, Id_product, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_area, Id_product, quantity, product_brand_description, product_category_description, product_nomenclator_description,product_description_supplier,product_description_customer, product_code, product_supplier_business_name', 'safe', 'on'=>'search'),
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
			'area' => array(self::BELONGS_TO, 'Area', 'Id_area'),
			'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_area' => 'Id Area',
			'Id_product' => 'Id Product',
			'quantity' => 'Quantity',
			'product_category_description'=>'Category',
			'product_brand_description'=>'Brand',
			'product_nomenclator_description'=>'Nomenclador',
			'product_supplier_business_name'=>'Supplier Name',
			'product_description_supplier'=>'Description Supplier',
			'product_description_customer'=>'Description Customer',
			'product_code'=>'Code'
		
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

		$criteria->compare('Id_area',$this->Id_area);
		$criteria->compare('Id_product',$this->Id_product);
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

		$criteria->compare('Id_area',$this->Id_area);
		$criteria->compare('Id_product',$this->Id_product);
		$criteria->compare('quantity',$this->quantity);
		
		$criteria->with[]='product';
		$criteria->addSearchCondition("product.code",$this->product_code);
		$criteria->addSearchCondition("product.description_customer",$this->product_description_customer);
		$criteria->addSearchCondition("product.description_supplier",$this->product_description_supplier);
		
		$criteria->join =  	"LEFT OUTER JOIN product p ON p.Id=t.Id_product
							LEFT OUTER JOIN brand b ON p.Id_brand=b.Id
							LEFT OUTER JOIN category c ON p.Id_category=c.Id
							LEFT OUTER JOIN supplier s ON p.Id_supplier=s.Id";
		$criteria->addSearchCondition("b.description",$this->product_brand_description);
		$criteria->addSearchCondition("s.business_name",$this->product_supplier_business_name);
		$criteria->addSearchCondition("c.description",$this->product_category_description);
				// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
						      'quantity',
						      'product_code' => array(
						        'asc' => 'product.code',
						        'desc' => 'product.code DESC',
								),
								'product_description_customer' => array(
						        'asc' => 'product.description_customer',
						        'desc' => 'product.description_customer DESC',
								),
						      'product_description_supplier' => array(
						        'asc' => 'product.description_supplier',
						        'desc' => 'product.description_supplier DESC',
								),
								'product_brand_description'=> array(
								'asc'=>'b.description',
								'desc'=>'b.description DESC'
								),
								'product_supplier_business_name'=> array(
								'asc'=>'s.business_name',
								'desc'=>'s.business_name DESC'
								),
								'product_category_description'=> array(
								'asc'=>'c.description',
								'desc'=>'c.description DESC'
								),		
		'*',
		);
		
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
								'sort'=>$sort,
		));
	}
}