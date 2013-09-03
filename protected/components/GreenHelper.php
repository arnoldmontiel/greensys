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
				$returnValue =  (!empty($value))?(int)$value:0;
				break;
			case "decimal":
				$returnValue =  (!empty($value))?(float)$value:0.00;
				break;
			case "string":
				$returnValue =  (!empty($value))?$value:'';
				break;
		}
		
		return $returnValue;
	}
	
	static public function importMeasuresFromExcel($modelUpload, $Id_linear, $Id_weight)
	{		
		$file=CUploadedFile::getInstance($modelUpload,'file');
		$sheet_array = Yii::app()->yexcel->readActiveSheet($file->tempName);
		
		$ext = end(explode(".", $file->name));
		$ext = strtolower($ext);
		
		$uniqueId = uniqid();

		$fileName = $uniqueId.'.'.$ext;
		$filePath = $fileName;
		
		//save doc
		move_uploaded_file($file->tempName,$filePath);
		
		$arrCols = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F');
		$col_model =	'A';
		$col_weight =	'B';
		$col_length =	'C';
		$col_width =	'D';
		$col_height =	'E';
		$col_index = 0;
		
		foreach( $sheet_array[1] as $header ) 
		{			
			$colName = strtoupper($header);
			$col_index++;
			if(strpos($colName, 'MODEL')!== false)
			{
				$col_model = $arrCols[$col_index];
				continue; 
			}
			if(strpos($colName, 'WEIGHT')!== false)
			{
				$col_weight = $arrCols[$col_index];
				continue;
			}
			if(strpos($colName, 'LENGTH')!== false)
			{
				$col_length = $arrCols[$col_index];
				continue;
			}
			if(strpos($colName, 'WIDTH')!== false)
			{
				$col_width = $arrCols[$col_index];
				continue;
			}
			if(strpos($colName, 'HEIGHT')!== false)
			{
				$col_height = $arrCols[$col_index];
				continue;
			}			
		}
			
		$row_index = 1;
		$model_not_found = '';
		foreach( $sheet_array as $row ) 
		{
			if($row_index != 1)
			{
				$modelProductDB = Product::model()->findByAttributes(array('model'=>$row[$col_model]));
				if(isset($modelProductDB))
				{					
					$modelProductDB->length = (float)$row[$col_length];
					$modelProductDB->width = (float)$row[$col_width];
					$modelProductDB->height = (float)$row[$col_height];
					$modelProductDB->weight = (float)$row[$col_weight];					
					$modelProductDB->Id_measurement_unit_linear = $Id_linear;
					$modelProductDB->Id_measurement_unit_weight = $Id_weight;
					$modelProductDB->save();		
				}
				else 
					$model_not_found .= $row[$col_model]. ', ';
			}
			$row_index++;			
		}

		$modelMeasureImportLog = new MeasureImportLog();
		$modelMeasureImportLog->file_name = $filePath;
		$modelMeasureImportLog->original_file_name = $file->name;
		$modelMeasureImportLog->Id_measurement_unit_linear = $Id_linear;
		$modelMeasureImportLog->Id_measurement_unit_weight = $Id_weight;
		$modelMeasureImportLog->not_found_model = rtrim($model_not_found, ", ");
		$modelMeasureImportLog->save();
	}
	
	/**
	 * 
	 * Imports a csv file to database
	 * @param UploadCsv $modelUpload
	 * @return int Id from ImportLog
	 */
	static public function importFromExcel($modelUpload)
	{	
		$importLogId = null;	
		$successRows = "";
		$errorRows = "";
		$existRows = "";		
		$fileName = "";
		
		$file=CUploadedFile::getInstance($modelUpload,'file');
		
		$fileName = $file->name;
		$importCode = uniqid();
		$handle = fopen($file->tempName, "r");
		if ($handle) {
			$row = 2; //porque el 1 contiene el nombre de los campos
			$firstLine = fgets($handle, 4096);
			$arrFields=  explode( ',',$firstLine);
			
			while (($data = fgetcsv($handle, 4096, ",")) !== FALSE)
			{

				$modelField = self::getDataValue($data, '"Model"', $arrFields);
				$manufacturer = self::getDataValue($data, '"Manufacturer"', $arrFields);
				
				$criteria = new CDbCriteria();
				$criteria->with[]='brand';
				$criteria->addCondition("brand.description = '". $manufacturer."'");
				$criteria->addCondition("t.model = '". $modelField."'");
				
				$modelProduct = Product::model()->find($criteria);
				$modelNewProduct = self::setProduct($data, $arrFields, $importCode);
								
				if(isset($modelNewProduct))
				{
					if(isset($modelProduct))//already exists in DB
					{
						
						$differences = false;
						foreach($modelNewProduct->attributes as $key => $value) {
							if(strstr($key,'Id_') == false &&
							   $key != 'date_creation' &&
							   $key != 'import_code' &&
							   $key != 'code' &&
							   $key != 'Id')
							{
								if($modelProduct->$key != $modelNewProduct->$key)			
									$differences = true;
							}
						}
						
						Product::model()->deleteAllByAttributes(array('Id_product'=>$modelProduct->Id));
						$modelNewProduct->Id_product = $modelProduct->Id;
						
						if(!$differences)
						{							
							$existRows = $existRows . $row. ', ';
							$row++;
							continue;
						}
					}
					
					$transaction = $modelNewProduct->dbConnection->beginTransaction();
					try {
				
						if($modelNewProduct->save())
						{
							$transaction->commit();
							$successRows = $successRows . $row. ', ';
						}
						else
						{
							$transaction->rollback();
							$errorRows = $errorRows . $row. ', ';
						}
				
					} catch (Exception $e) {
						$transaction->rollback();
						$errorRows = $errorRows . $row. ', ';
					}
				}
				else
					$errorRows = $errorRows . $row. ', ';				
				
				$row++;
			} //end while
			
			fclose($handle);
			
			$modelImportLog = new ImportLog();
			$modelImportLog->file_name = $fileName;
			$modelImportLog->already_exist_rows = rtrim($existRows, ", ");
			$modelImportLog->insert_rows = rtrim($successRows, ", ");
			$modelImportLog->error_rows = rtrim($errorRows, ", ");
			$modelImportLog->import_code = $importCode;
			$modelImportLog->total_rows = $row - 1;
			$modelImportLog->save();
			
			$importLogId = $modelImportLog->Id;
		} //end if(handle)
		
		return $importLogId;
	}
	
	private function setProduct($data, $arrFields, $importCode)
	{
		$modelProduct = new Product();
		$transaction = $modelProduct->dbConnection->beginTransaction(); 
		try {
					
			$modelProduct->discontinued = self::getDataValue($data, '"Discontinued"', $arrFields, 'boolean');
			$modelProduct->height = self::getDataValue($data, '"Height"', $arrFields,'decimal');
			$modelProduct->width = self::getDataValue($data, '"Width"', $arrFields,'decimal');
			$modelProduct->length = self::getDataValue($data, '"Depth"', $arrFields,'decimal');
			$modelProduct->weight = self::getDataValue($data, '"Weight"', $arrFields,'decimal');
			$modelProduct->msrp = self::getDataValue($data, '"MSRP"', $arrFields, 'decimal');
			$modelProduct->time_instalation = self::getDataValue($data, '"Labor Hours"', $arrFields);
			$modelProduct->unit_rack = self::getDataValue($data, '"Rack Units"', $arrFields,'int');
			$modelProduct->need_rack = ($modelProduct->unit_rack>0)?1:0;
			$modelProduct->current = self::getDataValue($data, '"Amps"', $arrFields,'int');
			$modelProduct->power = self::getDataValue($data, '"Watts"', $arrFields,'int');
			
			$modelProduct->model = self::getDataValue($data, '"Model"', $arrFields);
			$modelProduct->vendor = self::getDataValue($data, '"Vendor"', $arrFields);
			$modelProduct->long_description =  self::getDataValue($data, '"Long Description"', $arrFields);
			$modelProduct->short_description = self::getDataValue($data, '"Short Description"', $arrFields);
			$modelProduct->part_number = self::getDataValue($data, '"Part Number"', $arrFields);
			$modelProduct->url = self::getDataValue($data, '"URL"', $arrFields);
			$modelProduct->tags = self::getDataValue($data, '"Tags"', $arrFields);
			$modelProduct->phase = self::getDataValue($data, '"Phase"', $arrFields);
			$modelProduct->accounting_item_name = self::getDataValue($data, '"Accounting Item Name"', $arrFields);
			$modelProduct->unit_cost_A = self::getDataValue($data, '"Unit Cost A"', $arrFields, 'decimal');
			$modelProduct->unit_price_A = self::getDataValue($data, '"Unit Price A"', $arrFields, 'decimal');
			$modelProduct->unit_cost_B = self::getDataValue($data, '"Unit Cost B"', $arrFields, 'decimal');
			$modelProduct->unit_price_B = self::getDataValue($data, '"Unit Price B"', $arrFields, 'decimal');
			$modelProduct->unit_cost_C = self::getDataValue($data, '"Unit Cost C"', $arrFields, 'decimal');
			$modelProduct->unit_price_C = self::getDataValue($data, '"Unit Price C"', $arrFields, 'decimal');
			$modelProduct->taxable = self::getDataValue($data, '"Taxable"', $arrFields, 'boolean');
			$modelProduct->btu = self::getDataValue($data, '"BTU"', $arrFields,'int');
			$modelProduct->summarize = self::getDataValue($data, '"Summarize"', $arrFields);
			$modelProduct->sales_tax = self::getDataValue($data, '"Sales Tax"', $arrFields);
			$modelProduct->labor_sales_tax = self::getDataValue($data, '"Labor Sales Tax"', $arrFields);
			$modelProduct->dispersion = self::getDataValue($data, '"Dispersion"', $arrFields);
			$modelProduct->bulk_wire = self::getDataValue($data, '"Bulk Wire"', $arrFields);
			$modelProduct->input_terminals = self::getDataValue($data, '"Input Terminals"', $arrFields);
			$modelProduct->input_signals = self::getDataValue($data, '"Input Signals"', $arrFields);
			$modelProduct->input_labels = self::getDataValue($data, '"Input Labels"', $arrFields);
			$modelProduct->output_terminals = self::getDataValue($data, '"Output Terminals"', $arrFields);
			$modelProduct->output_terminals = self::getDataValue($data, '"Output Terminals"', $arrFields);
			$modelProduct->output_terminals = self::getDataValue($data, '"Output Terminals"', $arrFields);
			
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
			$modelProductType = ProductType::model()->findByAttributes(array('description'=>'--'));
			if(!isset($modelProductType))
			{
				$modelProductType = new ProductType();
				$modelProductType->description = '--';
				$modelProductType->save();
			}
			$modelProduct->Id_product_type = $modelProductType->Id;
			//END PRODUCT-TYPE-------------------------------------------------
			
			//BEGIN SUPPLIER-------------------------------------------------
			$modelSupplier = Supplier::model()->findByAttributes(array('business_name'=>'--'));
			if(!isset($modelSupplier))
			{
				$modelContact = new Contact();
				$modelContact->description = '--';
				$modelContact->telephone_1 = '--';
				$modelContact->email = uniqid().'@bb.com';
				$modelContact->save();
					
				$modelSupplier = new Supplier();
				$modelSupplier->business_name = '--';
				$modelSupplier->Id_contact = $modelContact->Id;
				$modelSupplier->save();
			}
			$modelProduct->Id_supplier = $modelSupplier->Id;
			//END SUPPLIER-------------------------------------------------
			
			$modelProduct->from_dtools = 1;
			$modelProduct->hide = 0;
			$modelProduct->import_code = $importCode;
			
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			return null;
		}
		return $modelProduct; 
	}
}
