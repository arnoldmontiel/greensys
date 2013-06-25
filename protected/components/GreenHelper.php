<?php
class GreenHelper
{
	static public function saveLinks($links, $id,$idEntityType,$idKey)
	{
		if(isset($links))
		{
			foreach ($links as $link){
				$hyperlink = new Hyperlink;
				$hyperlink->attributes = array(
												'description'=>$link,
												'Id_entity_type'=>$idEntityType,
												$idKey=>$id);
		
				$hyperlink->save();
			}
		}
	}

	/**
	 * 
	 * Get data value (default type = string)
	 * @param array() $data
	 * @param string $field
	 * @param array() $arrFields
	 * @param string $type (boolean, int, string)
	 */
	private function getDataValue($data, $field, $arrFields, $type = 'string')
	{
		$returnValue = null;
		
		$value = $data[array_search($field, $arrFields)];
		switch ($type) {
			case "boolean":
				$returnValue =  ($value == 'True')?1:0;
				break;
			case "int":
				$returnValue =  (!empty($value))?$value:0;
				break;
			case "string":
				$returnValue =  (!empty($value))?$value:'';
				break;
		}
		
		return $returnValue;
	}
	
	static public function importFromExcel($modelUpload)
	{
		$file=CUploadedFile::getInstance($modelUpload,'file');
			
		$handle = fopen($file->tempName, "r");
		if ($handle) {
			
			$firstLine = fgets($handle, 4096);
			$arrFields=  explode( ',',$firstLine);
			
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{

				$description_customer = self::getDataValue($data, '"Short Description"', $arrFields);
				$description_supplier = self::getDataValue($data, '"Long Description"', $arrFields);
				
				$modelProduct = Product::model()->findByAttributes(array('description_customer'=>$description_customer,
														'description_supplier'=>$description_supplier));
				if(!isset($modelProduct))
				{
					$modelProduct = new Product();
					
					$transaction = $modelProduct->dbConnection->beginTransaction();
					try {
						
						$discontinued = self::getDataValue($data, '"Discontinued"', $arrFields, 'boolean');
						$height = self::getDataValue($data, '"Height"', $arrFields,'int');
						$width = self::getDataValue($data, '"Width"', $arrFields,'int');
						$lenght = self::getDataValue($data, '"Depth"', $arrFields,'int');
						$weight = self::getDataValue($data, '"Weight"', $arrFields,'int');						
						$msrp = self::getDataValue($data, '"MSRP"', $arrFields);
						$time_instalation = self::getDataValue($data, '"Labor Hours"', $arrFields);						
						$unit_rack = self::getDataValue($data, '"Rack Units"', $arrFields,'int');
						$need_rack = ($unit_rack>0)?1:0;
						$current = self::getDataValue($data, '"Amps"', $arrFields,'int');					
						$power = self::getDataValue($data, '"Watts"', $arrFields,'int');
						
						$modelProduct->description_customer = $description_customer;
						$modelProduct->description_supplier = $description_supplier;
						$modelProduct->discontinued = $discontinued;
						$modelProduct->height = $height;
						$modelProduct->width = $width;
						$modelProduct->length = $lenght;
						$modelProduct->weight = $weight;
						$modelProduct->msrp = $msrp;
						$modelProduct->time_instalation = $time_instalation;
						$modelProduct->unit_rack = $unit_rack;
						$modelProduct->need_rack = $need_rack;
						$modelProduct->current = $current;
						$modelProduct->power = $power;
						
						//BEGIN NOMENCLATOR-------------------------------------------------
						$modelNomenclator = Nomenclator::model()->findByAttributes(array('description'=>'Dtools'));
						if(!isset($modelNomenclator))
						{
							$modelNomenclator = new Nomenclator();
							$modelNomenclator->description = 'Dtools';
							$modelNomenclator->save();
						}
						$modelProduct->Id_nomenclator = $modelNomenclator->Id;
						//END NOMENCLATOR-------------------------------------------------
						
						//BEGIN MEASURE UNIT WEIGHT-------------------------------------------------
						$modelMeasureUnitWeight = MeasurementUnit::model()->findByAttributes(array('short_description'=>'kg'));
						if(!isset($modelMeasureUnitWeight))
						{
							$modelMeasureType = MeasurementType::model()->findByAttributes(array('description'=>'weight'));
							if(!isset($modelMeasureType))
							{
								$modelMeasureType->description = 'weight';
								$modelMeasureType->save();
							}
							
							$modelMeasureUnitWeight = new MeasurementUnit();
							$modelMeasureUnitWeight->Id_measurement_type = $modelMeasureType->Id;
							$modelMeasureUnitWeight->short_description = 'kg';
							$modelMeasureUnitWeight->description = 'kilograms';
							$modelMeasureUnitWeight->save();
							
						}
						$modelProduct->Id_measurement_unit_weight = $modelMeasureUnitWeight->Id;
						//END MEASURE UNIT WEIGHT-------------------------------------------------
						
						//BEGIN MEASURE UNIT LINEAR-------------------------------------------------
						$modelMeasureUnitLinear = MeasurementUnit::model()->findByAttributes(array('short_description'=>'mm'));
						if(!isset($modelMeasureUnitLinear))
						{
							$modelMeasureType = MeasurementType::model()->findByAttributes(array('description'=>'linear'));
							if(!isset($modelMeasureType))
							{
								$modelMeasureType->description = 'linear';
								$modelMeasureType->save();
							}
						
							$modelMeasureUnitLinear = new MeasurementUnit();
							$modelMeasureUnitLinear->Id_measurement_type = $modelMeasureType->Id;
							$modelMeasureUnitLinear->short_description = 'mm';
							$modelMeasureUnitLinear->description = 'Milimeters';
							$modelMeasureUnitLinear->save();
						
						}
						$modelProduct->Id_measurement_unit_linear = $modelMeasureUnitLinear->Id;
						//END MEASURE UNIT LINEAR-------------------------------------------------
						
						//BEGIN VOLTS-------------------------------------------------
						$volts = self::getDataValue($data, '"Volts"', $arrFields);
						$modelVolts = Volts::model()->findByAttributes(array('volts'=>$volts));
						if(!isset($modelVolts))
						{
							$modelVolts = new Volts();
							$modelVolts->volts = $volts;
							$modelVolts->save();
						}
						$modelProduct->Id_volts = $modelVolts->Id;
						//END VOLTS-------------------------------------------------
						
						//BEGIN BRAND-------------------------------------------------
						$manufacturer = self::getDataValue($data, '"Manufacturer"', $arrFields);
						$modelBrand = Brand::model()->findByAttributes(array('description'=>$manufacturer));
						if(!isset($modelBrand))
						{
							$modelBrand = new Brand();
							$modelBrand->description = $manufacturer;
							$modelBrand->save();
						}
						$modelProduct->Id_brand = $modelBrand->Id;
						//END BRAND-------------------------------------------------
						
						//BEGIN CATEGORY-------------------------------------------------
						$category = self::getDataValue($data, '"Category"', $arrFields);
						$modelCategory = Category::model()->findByAttributes(array('description'=>$category));
						if(!isset($modelCategory))
						{
							$modelCategory = new Category();
							$modelCategory->description = $category;
							$modelCategory->save();
						}
						$modelProduct->Id_category = $modelCategory->Id;
						//END CATEGORY-------------------------------------------------
						
						//BEGIN SUB-CATEGORY-------------------------------------------------
						$subCategory = self::getDataValue($data, '"Subcategory"', $arrFields);
						$modelSubCategory = SubCategory::model()->findByAttributes(array('description'=>$subCategory));
						if(!isset($modelSubCategory))
						{
							$modelSubCategory = new SubCategory();
							$modelSubCategory->description = $subCategory;
							$modelSubCategory->save();
						}
						$modelProduct->Id_sub_category = $modelSubCategory->Id;
						//END SUB-CATEGORY-------------------------------------------------
						
						//BEGIN PRODUCT-TYPE-------------------------------------------------
						$productType = self::getDataValue($data, '"Model"', $arrFields);
						$modelProductType = ProductType::model()->findByAttributes(array('description'=>$productType));
						if(!isset($modelProductType))
						{
							$modelProductType = new ProductType();
							$modelProductType->description = $productType;
							$modelProductType->save();
						}
						$modelProduct->Id_product_type = $modelProductType->Id;
						//END PRODUCT-TYPE-------------------------------------------------
						
						//BEGIN SUPPLIER-------------------------------------------------
						$supplier = self::getDataValue($data, '"Vendor"', $arrFields);
						$modelSupplier = Supplier::model()->findByAttributes(array('business_name'=>$supplier));
						if(!isset($modelSupplier))
						{
							$modelContact = new Contact();
							$modelContact->description = '--';
							$modelContact->telephone_1 = '--';
							$modelContact->email = 'aa@bb.com';
							$modelContact->save();
							
							$modelSupplier = new Supplier();
							$modelSupplier->business_name = $manufacturer;
							$modelSupplier->Id_contact = $modelContact->Id;
							$modelSupplier->save();
						}
						$modelProduct->Id_supplier = $modelSupplier->Id;
						//END SUPPLIER-------------------------------------------------
						
						$modelProduct->from_dtools = 1;
						$modelProduct->hide = 0;
						
						if($modelProduct->save())
							$transaction->commit();
						else
							$transaction->rollback();
						
					} catch (Exception $e) {
						$transaction->rollback();
					}
				}
				
			}
			
			fclose($handle);
		}
	}
}
