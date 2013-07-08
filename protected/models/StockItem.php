<?php

/**
 * This is the model class for table "stock_item".
 *
 * The followings are the available columns in table 'stock_item':
 * @property integer $Id
 * @property integer $Id_stock
 * @property integer $Id_product
 * @property integer $quantity
 *
 * The followings are the available model relations:
 * @property Stock $idStock
 * @property Product $idProduct
 */
class StockItem extends CActiveRecord
{
	public $product_code;
	public $product_code_supplier;
	public $product_brand_desc;
	public $product_supplier_name;
	public $product_customer_desc;
	
	public $project_desc;
	public $movement_type_desc;
	public $username;
	public $stock_desc;
	public $stock_creation_date;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StockItem the static model class
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
		return 'stock_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_stock, Id_product', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_stock, Id_product, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_stock, Id_product, quantity, product_code, product_code_supplier, product_brand_desc, product_supplier_name, product_customer_desc, project_desc, movement_type_desc, username, stock_desc, stock_creation_date', 'safe', 'on'=>'search'),
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
			'stock' => array(self::BELONGS_TO, 'Stock', 'Id_stock'),
			'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_stock' => 'Id Stock',
			'Id_product' => 'Id Product',
			'quantity' => 'Quantity',
			'product_code'=>'Code',
			'product_code_supplier'=>'Code Supplier',
			'product_customer_desc'=>'Description Customer',
			'product_brand_desc'=>'Brand Description',
			'product_supplier_name'=>'Supplier Name',
			'project_desc'=>'Project', 
			'movement_type_desc'=>'Movement Type', 
			'username'=>'Username', 
			'stock_desc'=>'Description',
			'stock_creation_date'=>'Date',
		
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
		$criteria->compare('Id_stock',$this->Id_stock);
		$criteria->compare('Id_product',$this->Id_product);
		$criteria->compare('quantity',$this->quantity);
		
		$criteria->join =	"LEFT OUTER JOIN product p ON p.Id=t.Id_product
										 LEFT OUTER JOIN brand b ON p.Id_brand=b.Id
										 LEFT OUTER JOIN supplier s ON p.Id_supplier=s.Id";
		$criteria->addSearchCondition("p.code",$this->product_code);
		$criteria->addSearchCondition("p.code_supplier",$this->product_code_supplier);
		$criteria->addSearchCondition("p.description_customer",$this->product_customer_desc);
		$criteria->addSearchCondition("b.description",$this->product_brand_desc);
		$criteria->addSearchCondition("s.business_name",$this->product_supplier_name);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
									      'quantity',
									      'product_code' => array(
									        'asc' => 'p.code',
									        'desc' => 'p.code DESC',
		),
											'product_code_supplier' => array(
									        'asc' => 'p.code_supplier',
									        'desc' => 'p.code_supplier DESC',
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
	
	public function searchDetail()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_stock',$this->Id_stock);
		$criteria->compare('Id_product',$this->Id_product);
		$criteria->compare('quantity',$this->quantity);
	
		
		$criteria->join =	"LEFT OUTER JOIN stock s ON s.Id=t.Id_stock
											 LEFT OUTER JOIN project p ON p.Id=s.Id_project
											 LEFT OUTER JOIN movement_type m ON m.Id=s.Id_movement_type";
		$criteria->addSearchCondition("p.description",$this->project_desc);
		$criteria->addSearchCondition("m.description",$this->movement_type_desc);
		$criteria->addSearchCondition("s.username",$this->username);
		$criteria->addSearchCondition("s.description",$this->stock_desc);
		$criteria->addSearchCondition("s.creation_date",$this->stock_creation_date);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
										      'quantity',
										      'project_desc' => array(
										        'asc' => 'p.description',
										        'desc' => 'p.description DESC',
		),
												'movement_type_desc' => array(
										        'asc' => 'm.description',
										        'desc' => 'm.description DESC',
		),
										      'username' => array(
										        'asc' => 's.username',
										        'desc' => 's.username DESC',
		),
												'stock_desc'=> array(
												'asc'=>'s.description',
												'desc'=>'s.description DESC'
		),
												'stock_creation_date'=> array(
														'asc'=>'s.creation_date',
														'desc'=>'s.creation_date DESC'
		),
						'*',
		);
	
		return new CActiveDataProvider($this, array(
												'criteria'=>$criteria,
												'sort'=>$sort,
		));
	}
}