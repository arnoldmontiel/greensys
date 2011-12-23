<?php

/**
 * This is the model class for table "product_area".
 *
 * The followings are the available columns in table 'product_area':
 * @property integer $id_area
 * @property integer $id_product
 * @property integer $quantity
 */
class ProductArea extends CActiveRecord
{
	public $product_brand_description;
	public $product_category_description;
	public $product_nomenclator_description;
	public $product_supplier_description;
	public $product_description_supplier;
	public $product_description_customer;
	
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
			array('id_area, id_product', 'required'),
			array('id_area, id_product, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_area, id_product, quantity, product_brand_description, product_category_description, product_nomenclator_description, product_supplier_description,product_description_supplier,product_description_customer', 'safe', 'on'=>'search'),
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
			'area' => array(self::BELONGS_TO, 'Area', 'id_area'),
			'product' => array(self::BELONGS_TO, 'Product', 'id_product'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_area' => 'Id Area',
			'id_product' => 'Id Product',
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

		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('id_product',$this->id_product);
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

		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('id_product',$this->id_product);
		$criteria->compare('quantity',$this->quantity);
		
		$criteria->with[]='product';
		$criteria->addSearchCondition("product.description_customer",$this->product_description_customer);
		$criteria->addSearchCondition("product.description_supplier",$this->product_description_supplier);
		$criteria->join =	"LEFT OUTER JOIN Product p ON p.Id=t.id_product
							 LEFT OUTER JOIN Brand b ON p.id_brand=b.Id";
		$criteria->addSearchCondition("b.description",$this->product_brand_description);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
						      'quantity',
						      'product_description_customer' => array(
						        'asc' => 'product.description_customer',
						        'desc' => 'product.description_customer DESC',
		),
						      'product_description_supplier' => array(
						        'asc' => 'product.description_customer',
						        'desc' => 'product.description_customer DESC',
		),
						      '*',
		);
		
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
								'sort'=>$sort,
		));
	}
}