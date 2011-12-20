<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $Id
 * @property integer $id_brand
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
 *
 * The followings are the available model relations:
 * @property Hyperlink[] $hyperlinks
 * @property Multimedia[] $multimedias
 * @property Note[] $notes
 * @property BudgetItem[] $budgetItems
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
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
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
			array('id_brand, Id_category, Id_nomenclator, Id_supplier', 'required'),
			array('id_brand, Id_category, Id_nomenclator, discontinued, hide, Id_supplier', 'numerical', 'integerOnly'=>true),
			array('description_customer, description_supplier', 'length', 'max'=>255),
			array('code, code_supplier', 'length', 'max'=>45),
			array('length, width, height, profit_rate, msrp, weight', 'length', 'max'=>10),
			array('time_instalation', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, id_brand, Id_category, Id_nomenclator, description_customer, description_supplier, code, code_supplier, discontinued, length, width, height, profit_rate, msrp, time_instalation, hide, weight,Id_supplier', 'safe', 'on'=>'search'),
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
			'priceListItems' => array(self::HAS_MANY, 'PriceListItem', 'id_product'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'id_brand'),
			'category' => array(self::BELONGS_TO, 'Category', 'Id_category'),
			'nomenclator' => array(self::BELONGS_TO, 'Nomenclator', 'Id_nomenclator'),
			'areas' => array(self::MANY_MANY, 'Area', 'product_area(id_product, id_area)'),
			'categories' => array(self::MANY_MANY, 'Category', 'product_category(id_product, id_category)'),
			'productGroupsChild' => array(self::HAS_MANY, 'ProductGroup', 'id_product_child'),
			'productGroupsParent' => array(self::HAS_MANY, 'ProductGroup', 'id_product_parent'),
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'Id_product'),
			'productRequirements' => array(self::MANY_MANY, 'ProductRequirement', 'product_requirement_product(id_product, id_product_requirement)'),
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
			'id_brand' => 'Brand',
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
			'msrp' => 'Msrp',
			'time_instalation' => 'Time Instalation',
			'hide' => 'Hide',
			'weight' => 'Weight',
			'link'=>'Links',
			'note'=>'Note',
			'image'=>'Image',
			'Id_supplier' => 'Supplier',
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
		$criteria->compare('id_brand',$this->id_brand);
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}