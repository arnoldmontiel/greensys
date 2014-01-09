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
 * @property string $time_programation
 * @property integer $hide
 * @property string $weight
 * @property integer $Id_supplier
 * @property string $dealer_cost
 * @property integer Id_measurement_unit_weight
 * @property integer Id_measurement_unit_linear
 * @property string $color
 * @property integer $Id_sub_category
 * @property string $other
 * @property string $power
 * @property string $current
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
 * @property string $btu
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
 * @property string $default_broker
 * @property string $default_send_format
 * @property string $shipping_box_lenght
 * @property string $shipping_box_width
 * @property string $shipping_box_height
 * @property string $shipping_box_volume
 * @property string $shipping_box_weight
 * @property string $dimensional_weight_IATA
 * @property string $dimensional_weight_FEDEX
 * @property string $dimensional_weight_DHL
 * @property string $dimensional_weight_UPS
 * @property string $dimensional_weight_custom1
 * @property string $dimensional_weight_custom2
 * @property string $dimensional_weight_custom3
 * @property string $off
 * @property string $off_category_a
 * @property string $off_category_b
 * @property string $off_category_c
 * @property string $off_category_d
 * @property string $deale_distributor_price
 * @property integer $need_ups
 * @property string $commercial_name
 * @property string $commercial_description
 * @property string $accessory_a
 * @property string $accessory_b
 * @property string $accessory_c
 * @property string $accessory_d
 * @property string $attached
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
	public $budget_id;
	public $budget_version;
	public $budget_area;
	public $qty_per_prod;	
	
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
			array('Id_brand, Id_currency, Id_category, Id_nomenclator, Id_product_type, Id_supplier,Id_measurement_unit_weight,Id_measurement_unit_linear, Id_category, Id_sub_category', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_volts, Id_currency,Id_brand, Id_category, Id_nomenclator, Id_product_type, discontinued, hide, Id_supplier,Id_measurement_unit_weight,Id_measurement_unit_linear, need_rack, unit_rack, unit_fan, from_dtools, verified, Id_product, need_ups', 'numerical', 'integerOnly'=>true),
			array('description_customer, description_supplier, short_description, part_number, url, tags, 
				accounting_item_name, summarize, sales_tax, labor_sales_tax, dispersion, bulk_wire, model, vendor, default_broker, default_send_format, commercial_name, accessory_a, accessory_b, accessory_c, accessory_d, attached', 'length', 'max'=>255),
			array('code, code_supplier, color, other', 'length', 'max'=>45),
			array('length, width, height, profit_rate, msrp, weight, dealer_cost, btu, power, current, unit_cost_A, unit_price_A, unit_cost_B, unit_price_B, unit_cost_C, unit_price_C, btu, shipping_box_lenght, shipping_box_width, shipping_box_height, shipping_box_volume, shipping_box_weight, dimensional_weight_IATA, dimensional_weight_FEDEX, dimensional_weight_DHL, dimensional_weight_UPS, dimensional_weight_custom1, dimensional_weight_custom2, dimensional_weight_custom3, off, off_category_a, off_category_b, off_category_c, off_category_d, deale_distributor_price', 'length', 'max'=>10),
			array('phase', 'length', 'max'=>100),
			array('date_creation, long_description, input_terminals, input_signals, input_labels, output_terminals, output_signals, output_labels, commercial_description', 'safe'),
			array('Id_volts, time_instalation, time_programation, Id_supplier, brand_description, category_description, nomenclator_description, supplier_description, Id_sub_category', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_brand, Id_category, Id_nomenclator, Id_product_type, description_customer, description_supplier, code, code_supplier, discontinued, length, width, height, profit_rate, msrp, time_instalation,time_programation, hide, weight,Id_supplier, brand_description, category_description, nomenclator_description, supplier_description, dealer_cost, color, other, Id_category, power, current, need_rack, unit_rack, from_dtools, verified, model, vendor, Id_product, default_broker, default_send_format, shipping_box_lenght, shipping_box_width, shipping_box_height, shipping_box_volume, shipping_box_weight, dimensional_weight_IATA, dimensional_weight_FEDEX, dimensional_weight_DHL, dimensional_weight_UPS, dimensional_weight_custom1, dimensional_weight_custom2, dimensional_weight_custom3, off, off_category_a, off_category_b, off_category_c, off_category_d, deale_distributor_price, need_ups, commercial_name, commercial_description, accessory_a, accessory_b, accessory_c, accessory_d, attached, budget_id, budget_version qty_per_prod, budget_area', 'safe', 'on'=>'search'),
		
			
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
			'Id_brand' => 'Marca',
			'Id_category' => 'Categoría',
			'Id_nomenclator' => 'Nomenclator',
			'Id_product_type' => 'Tipo',
			'description_customer' => 'Corta SL',
			'description_supplier' => 'Larga SL',
			'code' => 'Code',
			'code_supplier' => 'Code Supplier',
			'discontinued' => 'Descontinuado',
			'length' => 'Largo',
			'width' => 'Ancho',
			'height' => 'Alto',
			'profit_rate' => 'Profit Rate',
			'msrp' => 'MSRP',
			'time_instalation' => 'Instalación',
			'time_programation'=>'Programación',
			'hide' => 'Oculto',
			'weight' => 'Peso',
			'link'=>'Links',
			'note'=>'Note',
			'image'=>'Image',
			'Id_supplier' => 'Proveedor',
			'dealer_cost' => 'Dealer Cost',
			'Id_measurement_unit_linear' => 'U. Medida lineal',		
			'Id_measurement_unit_weight' => 'U. Medida peso',		
			'volume' => 'Volumen',
			'color'=>'Color',		
			'other'=>'Other',
			'Id_sub_category'=>'Subcategoría',
			'power' => 'Potencia',
			'current' => 'Consumo',
			'need_rack' => 'Necesita Rack',
			'unit_rack' => 'Unidades Rack',
			'unit_fan' => 'Unidades Vent.',
			'Id_volts' => 'Voltaje',
			'supplier_description'=>'Supplier',
			'brand_description'=>'Marca',
			'category_description'=>'Categoría',
			'date_creation' => 'Date Creation',
			'from_dtools' => 'From Dtools',
			'long_description' => 'Larga',
			'short_description' => 'Corta',
			'part_number' => 'Part Number',
			'url' => 'Url',
			'tags' => 'Tags',
			'phase' => 'Phase',
			'accounting_item_name' => 'Accounting Item Name',
			'unit_cost_A' => 'Unit Cost A',
			'unit_price_A' => 'Unit Price A',
			'unit_cost_B' => 'Unit Cost B',
			'unit_price_B' => 'Unit Price B',
			'unit_cost_C' => 'Unit Cost C',
			'unit_price_C' => 'Unit Price C',
			'taxable' => 'Taxable',
			'btu' => 'Btu',
			'summarize' => 'Summarize',
			'sales_tax' => 'Sales Tax',
			'labor_sales_tax' => 'Labor Sales Tax',
			'dispersion' => 'Dispersion',
			'bulk_wire' => 'Bulk Wire',
			'input_terminals' => 'Input Terminals',
			'input_signals' => 'Input Signals',
			'input_labels' => 'Input Labels',
			'output_terminals' => 'Output Terminals',
			'output_signals' => 'Output Signals',
			'output_labels' => 'Output Labels',
			'import_code' => 'Import Code',
			'verified' => 'Verified',
			'model' => 'Modelo',
			'vendor' => 'Vendor',
			'Id_product' => 'Id Product',
			'default_broker' => 'Despachante por defecto',
			'default_send_format' => 'Formato de envio por defecto',
			'shipping_box_lenght' => 'Largo',
			'shipping_box_width' => 'Ancho',
			'shipping_box_height' => 'Alto',
			'shipping_box_volume' => 'Volumen',
			'shipping_box_weight' => 'Peso',
			'dimensional_weight_IATA' => 'IATA',
			'dimensional_weight_FEDEX' => 'Fedex',
			'dimensional_weight_DHL' => 'DHL',
			'dimensional_weight_UPS' => 'UPS',
			'dimensional_weight_custom1' => 'Custom 1',
			'dimensional_weight_custom2' => 'Custom 2',
			'dimensional_weight_custom3' => 'Custom 3',
			'off' => 'Descuento',
			'off_category_a' => 'Cat. A',
			'off_category_b' => 'Cat. B',
			'off_category_c' => 'Cat. C',
			'off_category_d' => 'Cat. D',
			'deale_distributor_price' => 'Deale Distributor Price',
			'need_ups' => 'Necesita Ups',
			'commercial_name' => 'Nombre Commercial',
			'commercial_description' => 'Description Commercial',
			'accessory_a' => 'A',
			'accessory_b' => 'B',
			'accessory_c' => 'C',
			'accessory_d' => 'D',
			'attached' => 'Adjuntos',
		);
	}

	public function showPrice($value)
	{
		$settings = Setting::getInstance();
		$currency = '$';
		if(isset($settings))
			$currency = $settings->currency->short_description;
		
		return $value . " " . $currency; 
	}
	
	public function showVolume($value)
	{
		$unitLinear = $this->measurementUnitLinear->short_description;
		return $value . " " . $unitLinear;
	}

	public function showWeight($value)
	{
		$unitWeight = $this->measurementUnitWeight->short_description;
		return $value . " " . $unitWeight;
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
	public function hasWeight()
	{
		return ($this->weight > 0)?true:false;
	}
	
	public function getHasWarnings($warning)
	{		
		switch ($warning) {
			case "hasMeasure":
				return ($this->getVolume()===false || !$this->hasWeight() );
				break;
			case "hasPriceListPurch":
				$criteria = new CDbCriteria;
				$criteria->compare('Id_product',$this->Id);
				$criteria->with[]="priceList";
				$criteria->compare('priceList.Id_price_list_type',1);//compro			
				$priceList = PriceListItem::model()->findAll($criteria);
				if(empty($priceList))
					return true;
				break;
			case "hasPriceListSale":
				$criteria = new CDbCriteria;
				$criteria->compare('Id_product',$this->Id);
				$criteria->with[]="priceList";
				$criteria->compare('priceList.Id_price_list_type',2);//venta			
				$priceList = PriceListItem::model()->findAll($criteria);
				if(empty($priceList))
					return true;
				break;
		}
		return false;
	}
	
	public function getWarningsDescription($warning)
	{
		$hasWarning = $this->getHasWarnings($warning);
		
		switch ($warning) {
			case "hasMeasure":
				if ($hasWarning)
					return Yii::app()->lc->t('Missing Measures.');
				break;
			case "hasPriceListPurch":
				if ($hasWarning)
					return Yii::app()->lc->t('Missing price list.');
				break;
			case "hasPriceListSale":
				if ($hasWarning)
					return Yii::app()->lc->t('Missing purchase price list.');
				break;
		}		
		return Yii::app()->lc->t('No warnings.');
	}
	public function getWeightConverted()
	{
		$weight = $this->weight;
		$measureWeightFrom = MeasurementUnit::model()->findByPk($this->Id_measurement_unit_weight);
		
		$settings = new Settings();
			
		$weightTo = $settings->getMeasurementUnit(Settings::MT_WEIGHT);
		$converter = MeasurementUnitConverter::model()->findByAttributes(
				array(
						'Id_measurement_from'=>$measureWeightFrom->Id,
						'Id_measurement_to'=>$weightTo->Id,
				)
		);
		return round($converter->factor * (double)$weight, 6);
		
	}
	public function getVolume()
	{
		$width = $this->width;
		$height = $this->height;
		$length = $this->length;
		if($width==0.0||$height==0.0||$length==0.0)	return false;
		$measureLinear = MeasurementUnit::model()->findByPk($this->Id_measurement_unit_linear);
		if($measureLinear->short_description=='ml')
		{
			$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'m3'));
		}
		if($measureLinear->short_description=='mm')
		{
			$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'mm3'));
		}
		if($measureLinear->short_description=='cm')
		{
			$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'cm3'));
		}
		else if($measureLinear->short_description=='in')
		{
			$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'in3'));				
		}
		else if($measureLinear->short_description=='ft')
		{
			$cubicFrom = MeasurementUnit::model()->findByAttributes(array('short_description'=>'ft3'));
		}
		
		$settings = new Settings();
			
		$cubicTo = $settings->getMeasurementUnit(Settings::MT_VOLUME);
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
		$criteria->compare('time_programation',$this->time_programation,true);
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);

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
		$sort->defaultOrder="model";
		$sort->attributes=array(
				'code',
				'model',
				'part_number',
				'short_description',
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
		$criteria->compare('time_programation',$this->time_programation,true);		
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
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);
		
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
						'model',
						'part_number',
						'short_description',
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
		$criteria->compare('time_programation',$this->time_programation,true);
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);
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
						'model',
						'part_number',
						'short_description',
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
		$criteria->compare('time_programation',$this->time_programation,true);		
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
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);
		
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
						'model',
						'part_number',
						'short_description',
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
		$criteria->compare('time_programation',$this->time_programation,true);
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
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);
		
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
								'model',
								'part_number',
								'short_description',
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
		$criteria->compare('time_programation',$this->time_programation,true);		
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
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);
		
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
				'model',
				'part_number',
				'short_description',
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
	
	public function searchByPending()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('length',$this->length,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('profit_rate',$this->profit_rate,true);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('dealer_cost',$this->dealer_cost,true);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);
	
		$criteria->with[]='brand';
		$criteria->addSearchCondition("brand.description",$this->brand_description);
	
		$criteria->addCondition("(t.width = 0 OR
								t.height = 0 OR
								t.weight = 0 OR
								t.length = 0 OR
								t.msrp = 0 OR
				 				t.dealer_cost = 0)");
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				'model',
				'part_number',
				'short_description',
				'brand_description' => array(
						'asc' => 'brand.description',
						'desc' => 'brand.description DESC',
				),
				'length',
				'width',
				'height',
				'profit_rate',
				'msrp',
				'dealer_cost',
				'weight',
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	
	}
	
	public function searchByBudgetItem()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->select = 't.Id, t.model, t.part_number, t.Id_brand, t.msrp, t.Id_category, t.short_description, CASE WHEN bi.Id_product is not null THEN bi.quantity
		ELSE 0 END AS qty_per_prod';
		
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('short_description',$this->short_description,true);
		
		$filter = '';
		if(isset($this->budget_id))
			$filter = ' and bi.Id_budget = '. $this->budget_id;
		if(isset($this->budget_version))
			$filter .= ' and bi.version_number = '. $this->budget_version;
		if(isset($this->budget_area))
			$filter .= ' and bi.Id_area = '. $this->budget_area;
		
		$criteria->join = 'INNER JOIN brand on (t.Id_brand = brand.Id)
							INNER JOIN category on (t.Id_category = category.Id)
							LEFT OUTER JOIN budget_item bi on (t.Id = bi.Id_product '.$filter.')';
		
		$criteria->addSearchCondition("brand.description",$this->brand_description);
		$criteria->addSearchCondition("category.description",$this->category_description);		
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
				'model',
				'part_number',
				'short_description',
				'brand_description' => array(
						'asc' => 'brand.description',
						'desc' => 'brand.description DESC',
				),
				'category_description' => array(
						'asc' => 'category.description',
						'desc' => 'category.description DESC',
				),
				'msrp',
				'*',
		);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	
	}
}