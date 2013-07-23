<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $Id
 * @property integer $Id_brand
 * @property integer $Id_category
 * @property integer $Id_nomenclator
 * @property integer $Id_product_type
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
 * @property integer Id_measurement_unit_weight
 * @property integer Id_measurement_unit_linear
 * @property string $color
 * @property integer $Id_sub_category
 * @property string $other
 * @property integer $power
 * @property integer $current
 * @property integer $need_rack
 * @property integer $unit_rack
 * @property integer $unit_fan
 * @property integer $Id_multimedia
 * @property integer $Id_volts
 * @property string $date_creation
 * @property integer $from_dtools
 * @property string $long_description
 * @property string $short_description
 * @property string $part_number
 * @property string $url
 * @property string $tags
 * @property string $phase
 * @property string $accounting_item_name
 * @property string $unit_cost_A
 * @property string $unit_price_A
 * @property string $unit_cost_B
 * @property string $unit_price_B
 * @property string $unit_cost_C
 * @property string $unit_price_C
 * @property integer $taxable
 * @property double $btu
 * @property string $summarize
 * @property string $sales_tax
 * @property string $labor_sales_tax
 * @property string $dispersion
 * @property string $bulk_wire
 * @property string $input_terminals
 * @property string $input_signals
 * @property string $input_labels
 * @property string $output_terminals
 * @property string $output_signals
 * @property string $output_labels
 * @property string $import_code
 * @property integer $verified
 * @property string $model
 * @property string $vendor
 * @property integer $Id_product
 * 
 * The followings are the available model relations:
 * @property BudgetItem[] $budgetItems
 * @property Hyperlink[] $hyperlinks
 * @property Multimedia[] $multimedias
 * @property GNote[] $notes
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
class Product extends ModelAudit
{
	
	public $brand_description;
	public $category_description;
	public $nomenclator_description;
	public $supplier_description;
	public $product_area_id;
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$category = strtoupper(str_pad(substr($this->category->description,0,1), 1, "0"));
			$subCategory = strtoupper(str_pad(substr($this->subCategory->description,0,1), 1, "0"));
			$brand = strtoupper(str_pad(substr($this->brand->description,0,2), 2, "0"));
			$productDesc = strtoupper(str_pad(substr($this->productType->description,0,1), 1, "0"));
			$color = strtoupper(substr($this->color,0,1));
			$other = strtoupper(substr($this->other,0,1));
			
			
			$newId = Product::model()->countByAttributes( array('Id_category'=>$this->Id_category,
					'Id_sub_category'=>$this->Id_sub_category,
					'Id_brand'=>$this->Id_brand,
					'Id_product_type'=>$this->Id_product_type,
			));
			$newId++;
			$newId = str_pad($newId, 2, "0", STR_PAD_LEFT);
			
			$this->code = $category . $subCategory . $brand . $productDesc . $newId .  $color . $other;				
		}
		return parent::beforeSave();
	}
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
			array('Id_brand, Id_category, Id_nomenclator, Id_product_type, Id_supplier,Id_measurement_unit_weight,Id_measurement_unit_linear, Id_category, Id_sub_category', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_volts,Id_brand, Id_category, Id_nomenclator, Id_product_type, discontinued, hide, Id_supplier,Id_measurement_unit_weight,Id_measurement_unit_linear, power, current, need_rack, unit_rack, unit_fan, from_dtools, verified, Id_product', 'numerical', 'integerOnly'=>true),
			array('description_customer, description_supplier, short_description, part_number, url, tags, 
				accounting_item_name, summarize, sales_tax, labor_sales_tax, dispersion, bulk_wire, model, vendor', 'length', 'max'=>255),
			array('code, code_supplier, color, other', 'length', 'max'=>45),
			array('length, width, height, profit_rate, msrp, weight, dealer_cost', 'length', 'max'=>10),
			array('phase', 'length', 'max'=>100),
			array('Id_volts, time_instalation, Id_supplier, brand_description, category_description, nomenclator_description, supplier_description, Id_sub_category', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_brand, Id_category, Id_nomenclator, Id_product_type, description_customer, description_supplier, code, code_supplier, discontinued, length, width, height, profit_rate, msrp, time_instalation, hide, weight,Id_supplier, brand_description, category_description, nomenclator_description, supplier_description, dealer_cost, color, other, Id_category, power, current, need_rack, unit_rack, from_dtools, verified, model, vendor, Id_product', 'safe', 'on'=>'search'),
		
			
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
			'multimedia' => array(self::BELONGS_TO, 'Multimedia', 'Id_multimedia'),
			'volts' => array(self::BELONGS_TO, 'Volts', 'Id_volts'),
			'notes' => array(self::HAS_MANY, 'GNote', 'Id_product'),
			'priceListItems' => array(self::HAS_MANY, 'PriceListItem', 'Id_product'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'Id_brand'),
			'category' => array(self::BELONGS_TO, 'Category', 'Id_category'),
			'subCategory' => array(self::BELONGS_TO, 'SubCategory', 'Id_sub_category'),
			'nomenclator' => array(self::BELONGS_TO, 'Nomenclator', 'Id_nomenclator'),
			'productType' => array(self::BELONGS_TO, 'ProductType', 'Id_product_type'),
			'areas' => array(self::MANY_MANY, 'Area', 'product_area(Id_product, Id_area)'),
			'categories' => array(self::MANY_MANY, 'Category', 'product_category(Id_product, Id_category)'),
			'productGroupsChild' => array(self::HAS_MANY, 'ProductGroup', 'Id_product_child'),
			'productGroupsParent' => array(self::HAS_MANY, 'ProductGroup', 'Id_product_parent'),
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'Id_product'),
			'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
			'productRequirements' => array(self::MANY_MANY, 'ProductRequirement', 'product_requirement_product(Id_product, Id_product_requirement)'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'Id_supplier'),
			'measurementUnitWeight' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_unit_weight'),
			'measurementUnitLinear' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_unit_linear'),
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
			'Id_product_type' => 'Type',
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
			'Id_measurement_unit_linear' => 'Measure Linear',		
			'Id_measurement_unit_weight' => 'Measure Weight',		
			'volume' => 'Volume',
			'color'=>'Color',		
			'other'=>'Other',
			'Id_sub_category'=>'Sub Category',
			'power' => 'Power',
			'current' => 'Current',
			'need_rack' => 'Need Rack',
			'unit_rack' => 'Unit Rack',
			'unit_fan' => 'Unit fan',
			'Id_volts' => 'Volts',
			'supplier_description'=>'Supplier',
			'brand_description'=>'Brand',
			'category_description'=>'Category',
		);
	}

	public function getProductDesc()
	{
		return $this->description_customer . ' - ' . $this->code;
	}
	
	public function getStockCount()
	{
		return ProductItem::model()->countByAttributes(array('Id_product'=>$this->Id,
												'Id_budget_item'=>null,
												'Id_purchase_order_item'=>null));		
	}
	
	public function getVolume()
	{
		$width = $this->width;
		$height = $this->height;
		$length = $this->length;
		$measureLinear = MeasurementUnit::model()->findByPk($this->Id_measurement_unit_linear);
		if($measureLinear->short_description=='ml' || $measureLinear->short_description=='mm')
		{
			$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'m3'));
		}
		else if($measureLinear->short_description=='in')
		{
			$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'in3'));				
		}
			
		$cubicTo = MeasurementUnit::model()->findByAttributes(array('short_description'=>'m3'));
		$converter = MeasurementUnitConverter::model()->findByAttributes(
			array(
				'Id_measurement_from'=>$cubicFrom->Id,
				'Id_measurement_to'=>$cubicTo->Id,
			)
		);
		return round($converter->factor * (double)$width * (double)$height * (double)$length, 6);	
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
		$criteria->compare('Id_product_type',$this->Id_product_type);
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
		$criteria->compare('Id_measurement_unit_weight',$this->Id_measurement_unit_weight,true);
		$criteria->compare('Id_measurement_unit_linear',$this->Id_measurement_unit_linear,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('color',$this->other,true);
		$criteria->compare('Id_sub_category',$this->Id_sub_category);
		$criteria->compare('power',$this->power);
		$criteria->compare('current',$this->current);
		$criteria->compare('need_rack',$this->need_rack);
		$criteria->compare('unit_rack',$this->unit_rack);
		$criteria->compare('unit_fan',$this->unit_fan);
		
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
		$criteria->compare('Id_product_type',$this->Id_product_type);
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
		$criteria->compare('color',$this->color,true);
		$criteria->compare('color',$this->other,true);
		$criteria->compare('Id_sub_category',$this->Id_sub_category);
		$criteria->compare('power',$this->power);
		$criteria->compare('current',$this->current);
		$criteria->compare('need_rack',$this->need_rack);
		$criteria->compare('unit_rack',$this->unit_rack);
		$criteria->compare('unit_fan',$this->unit_fan);
		
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
	
	
	public function searchDuplicade()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_brand',$this->Id_brand);
		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('Id_nomenclator',$this->Id_nomenclator);
		$criteria->compare('Id_product_type',$this->Id_product_type);
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
		$criteria->compare('color',$this->color,true);
		$criteria->compare('color',$this->other,true);
		$criteria->compare('Id_sub_category',$this->Id_sub_category);
		$criteria->compare('power',$this->power);
		$criteria->compare('current',$this->current);
		$criteria->compare('need_rack',$this->need_rack);
		$criteria->compare('unit_rack',$this->unit_rack);
		$criteria->compare('unit_fan',$this->unit_fan);
		$criteria->compare('model',$this->model,true);
		$criteria->addCondition('Id_product is not null');
		
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
	
	public function searchByProduct()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_brand',$this->Id_brand);
		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('Id_nomenclator',$this->Id_nomenclator);
		$criteria->compare('Id_product_type',$this->Id_product_type);
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
		$criteria->compare('color',$this->color,true);
		$criteria->compare('color',$this->other,true);
		$criteria->compare('Id_sub_category',$this->Id_sub_category);
		$criteria->compare('power',$this->power);
		$criteria->compare('current',$this->current);
		$criteria->compare('need_rack',$this->need_rack);
		$criteria->compare('unit_rack',$this->unit_rack);
		$criteria->compare('unit_fan',$this->unit_fan);
	
		$criteria->with[]='brand';
		$criteria->addSearchCondition("brand.description",$this->brand_description);
	
		$criteria->with[]='category';
		$criteria->addSearchCondition("category.description",$this->category_description);
	
		$criteria->with[]='nomenclator';
		$criteria->addSearchCondition("nomenclator.description",$this->nomenclator_description);
	
		$criteria->with[]='supplier';
		$criteria->addSearchCondition("supplier.business_name",$this->supplier_description);
	
		$criteria->condition = "t.Id IN (SELECT Id_product FROM product_area WHERE Id_area = ".$this->product_area_id.")";
	
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
	
	public function searchByCategory()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_brand',$this->Id_brand);
		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('Id_nomenclator',$this->Id_nomenclator);
		$criteria->compare('Id_product_type',$this->Id_product_type);
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
		$criteria->compare('color',$this->color,true);
		$criteria->compare('color',$this->other,true);
		$criteria->compare('Id_sub_category',$this->Id_sub_category);
		$criteria->compare('power',$this->power);
		$criteria->compare('current',$this->current);
		$criteria->compare('need_rack',$this->need_rack);
		$criteria->compare('unit_rack',$this->unit_rack);
		$criteria->compare('unit_fan',$this->unit_fan);
	
		$criteria->with[]='brand';
		$criteria->addSearchCondition("brand.description",$this->brand_description);
	
		$criteria->with[]='category';
		$criteria->addSearchCondition("category.description",$this->category_description);
	
		$criteria->with[]='nomenclator';
		$criteria->addSearchCondition("nomenclator.description",$this->nomenclator_description);
	
		$criteria->with[]='supplier';
		$criteria->addSearchCondition("supplier.business_name",$this->supplier_description);
	
		$criteria->condition = "t.Id_category IN (SELECT Id_category FROM category_area WHERE Id_area = ".$this->product_area_id.")";
	
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
	public function searchPending()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_brand',$this->Id_brand);
		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('Id_nomenclator',$this->Id_nomenclator);
		$criteria->compare('Id_product_type',$this->Id_product_type);
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
		$criteria->compare('color',$this->color,true);
		$criteria->compare('color',$this->other,true);
		$criteria->compare('Id_sub_category',$this->Id_sub_category);
		$criteria->compare('power',$this->power);
		$criteria->compare('current',$this->current);
		$criteria->compare('need_rack',$this->need_rack);
		$criteria->compare('unit_rack',$this->unit_rack);
		$criteria->compare('unit_fan',$this->unit_fan);
	
		$criteria->with[]='brand';
		$criteria->addSearchCondition("brand.description",$this->brand_description);
	
		$criteria->with[]='category';
		$criteria->addSearchCondition("category.description",$this->category_description);
	
		$criteria->with[]='nomenclator';
		$criteria->addSearchCondition("nomenclator.description",$this->nomenclator_description);
	
		$criteria->with[]='supplier';
		$criteria->addSearchCondition("supplier.business_name",$this->supplier_description);
		
		$criteria->join='INNER JOIN `budget_item` `budgetItems` ON (`budgetItems`.`Id_product`=`t`.`Id`)';
		
		$criteria->addCondition('budgetItems.Id not in (select pi.Id_budget_item from product_item pi where pi.Id_product=t.Id and pi.Id_budget_item is not NULL)');
		
		
	
	
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