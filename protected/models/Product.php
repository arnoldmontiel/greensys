<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $Id
 * @property integer $Id_brand
 * @property integer $Id_category
 * @property integer $Id_nomenclator
 * @property string $description_customer
 * @property string $description_supplier
 * @property string $code
 * @property string $code_supplier
 * @property integer $discontinued
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $profit_rate
 * @property string $msrp
 * @property string $time_instalation
 * @property integer $hide
 * @property string $weight
 * @property integer $Id_supplier
 * @property string $dealer_cost
 *
 * The followings are the available model relations:
 * @property BudgetItem[] $budgetItems
 * @property Hyperlink[] $hyperlinks
 * @property Multimedia[] $multimedias
 * @property Note[] $notes
 * @property PriceListItem[] $priceListItems
 * @property Brand $idBrand
 * @property Category $idCategory
 * @property Nomenclator $idNomenclator
 * @property Area[] $areas
 * @property Category[] $categories
 * @property ProductGroup[] $productGroups
 * @property ProductGroup[] $productGroups1
 * @property ProductItem[] $productItems
 * @property ProductRequirement[] $productRequirements
 * @property Supplier $idSupplier
 */
class Product extends CActiveRecord
{
	
	public $brand_description;
	public $category_description;
	public $nomenclator_description;
	public $supplier_description;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_brand, Id_category, Id_nomenclator, Id_supplier', 'required'),
			array('Id_brand, Id_category, Id_nomenclator, discontinued, hide, Id_supplier', 'numerical', 'integerOnly'=>true),
			array('description_customer, description_supplier', 'length', 'max'=>255),
			array('code, code_supplier', 'length', 'max'=>45),
			array('length, width, height, profit_rate, msrp, weight, dealer_cost', 'length', 'max'=>10),
			array('time_instalation, Id_supplier, brand_description, category_description, nomenclator_description, supplier_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_brand, Id_category, Id_nomenclator, description_customer, description_supplier, code, code_supplier, discontinued, length, width, height, profit_rate, msrp, time_instalation, hide, weight,Id_supplier, brand_description, category_description, nomenclator_description, supplier_description, dealer_cost', 'safe', 'on'=>'search'),
		
			
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
			'budgetItems' => array(self::HAS_MANY, 'BudgetItem', 'Id_product'),
			'hyperlinks' => array(self::HAS_MANY, 'Hyperlink', 'Id_product'),
			'multimedias' => array(self::HAS_MANY, 'Multimedia', 'Id_product'),
			'notes' => array(self::HAS_MANY, 'Note', 'Id_product'),
			'priceListItems' => array(self::HAS_MANY, 'PriceListItem', 'Id_product'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'Id_brand'),
			'category' => array(self::BELONGS_TO, 'Category', 'Id_category'),
			'nomenclator' => array(self::BELONGS_TO, 'Nomenclator', 'Id_nomenclator'),
			'areas' => array(self::MANY_MANY, 'Area', 'product_area(Id_product, Id_area)'),
			'categories' => array(self::MANY_MANY, 'Category', 'product_category(Id_product, Id_category)'),
			'productGroupsChild' => array(self::HAS_MANY, 'ProductGroup', 'Id_product_child'),
			'productGroupsParent' => array(self::HAS_MANY, 'ProductGroup', 'Id_product_parent'),
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'Id_product'),
			'productRequirements' => array(self::MANY_MANY, 'ProductRequirement', 'product_requirement_product(Id_product, Id_product_requirement)'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'Id_supplier'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_brand' => 'Brand',
			'Id_category' => 'Category',
			'Id_nomenclator' => 'Nomenclator',
			'description_customer' => 'Description Customer',
			'description_supplier' => 'Description Supplier',
			'code' => 'Code',
			'code_supplier' => 'Code Supplier',
			'discontinued' => 'Discontinued',
			'length' => 'Length',
			'width' => 'Width',
			'height' => 'Height',
			'profit_rate' => 'Profit Rate',
			'msrp' => 'MSRP',
			'time_instalation' => 'Time Instalation',
			'hide' => 'Hide',
			'weight' => 'Weight',
			'link'=>'Links',
			'note'=>'Note',
			'image'=>'Image',
			'Id_supplier' => 'Supplier',
			'dealer_cost' => 'Dealer Cost',
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
		$criteria->compare('Id_brand',$this->Id_brand);
		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('Id_nomenclator',$this->Id_nomenclator);
		$criteria->compare('description_customer',$this->description_customer,true);
		$criteria->compare('description_supplier',$this->description_supplier,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('code_supplier',$this->code_supplier,true);
		$criteria->compare('discontinued',$this->discontinued);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('profit_rate',$this->profit_rate,true);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('time_instalation',$this->time_instalation,true);
		$criteria->compare('hide',$this->hide);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('Id_supplier',$this->Id_supplier);
		$criteria->compare('dealer_cost',$this->dealer_cost,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchSummary()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_brand',$this->Id_brand);
		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('Id_nomenclator',$this->Id_nomenclator);
		$criteria->compare('Id_supplier',$this->Id_supplier);
		$criteria->compare('description_customer',$this->description_customer,true);
		$criteria->compare('description_supplier',$this->description_supplier,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('code_supplier',$this->code_supplier,true);
		$criteria->compare('discontinued',$this->discontinued);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('profit_rate',$this->profit_rate,true);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('time_instalation',$this->time_instalation,true);
		$criteria->compare('hide',$this->hide);
		$criteria->compare('weight',$this->weight,true);
	
		
		$criteria->with[]='brand';
		$criteria->addSearchCondition("brand.description",$this->brand_description);
		
		$criteria->with[]='category';
		$criteria->addSearchCondition("category.description",$this->category_description);
		
		$criteria->with[]='nomenclator';
		$criteria->addSearchCondition("nomenclator.description",$this->nomenclator_description);
		
		$criteria->with[]='supplier';
		$criteria->addSearchCondition("supplier.business_name",$this->supplier_description);
	
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				      'code',
				      'brand_description' => array(
				        'asc' => 'brand.description',
				        'desc' => 'brand.description DESC',
		),
				      'category_description' => array(
				        'asc' => 'category.description',
				        'desc' => 'category.description DESC',
		),
				      'nomenclator_description' => array(
				        'asc' => 'nomenclator.description',
				        'desc' => 'nomenclator.description DESC',
		),
					  'supplier_description' => array(
						        'asc' => 'supplier.business_name',
						        'desc' => 'supplier.business_name DESC',
		),
				      '*',
		);
		
		return new CActiveDataProvider($this, array(
						'criteria'=>$criteria,
						'sort'=>$sort,
		));
		
	}
}