<?php
class GreenHelper
{ 
	static public function convertCurrencyTo($valueToConvert, $convertFrom, $convertTo)
	{
		if($convertFrom==$convertTo) return round($valueToConvert,2);
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_currency_from='.$convertFrom);
		$criteria->addCondition('Id_currency_to='.$convertTo);
		$criteria->order = 'Id DESC';
		
		$currencyConversor= CurrencyConversor::model()->find($criteria);
		if(isset($currencyConversor))
		{
			return round($valueToConvert*$currencyConversor->factor,2);				
		}
		else
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('Id_currency_from='.$convertTo);
			$criteria->addCondition('Id_currency_to='.$convertFrom);
			$criteria->order = 'Id DESC';
			$currencyConversor= CurrencyConversor::model()->find($criteria);
			if(isset($currencyConversor))
				return round($valueToConvert/$currencyConversor->factor,2);				
		}
		return 0;
		
	}
	static public function convertCurrency($valueToConvert, $convertFrom, $convertTo, $currencyConversor)
	{
		if(!isset($currencyConversor))	return self::convertCurrencyTo($valueToConvert, $convertFrom, $convertTo);

		if($convertFrom==$convertTo) return round($valueToConvert,2);
		if($currencyConversor->Id_currency_from == $convertFrom && $currencyConversor->Id_currency_to == $convertTo)
		{
			return round($valueToConvert*$currencyConversor->factor,2);				
		}
		else if($currencyConversor->Id_currency_from == $convertTo && $currencyConversor->Id_currency_to == $convertFrom)
		{
			$currencyConversor= CurrencyConversor::model()->findByAttributes(array('Id_currency_from'=>$convertTo,'Id_currency_to'=>$convertFrom));
			if(isset($currencyConversor))
				return round($valueToConvert/$currencyConversor->factor,2);				
		}
		return 0;
	}
	static public function generateListaPricesWithChildren($product,$children)
	{
		$transaction = Yii::app()->db->beginTransaction();		
		PriceListItem::model()->deleteAllByAttributes(array('Id_product'=>$product->Id));
		try {
			//compras
			$criteria = new CDbCriteria;
			$criteria->compare('Id_supplier',$product->Id_supplier);
			$criteria->compare('Id_price_list_type',1); //compra
			$criteria->compare('Id_currency',$product->Id_currency);
					
			$priceList = PriceList::model()->find($criteria);
			if(!isset($priceList))
			{
				
				$priceList = new PriceList();
				$priceList->validity = 1;
				//$priceList->date_validity = new CDbExpression('NOW()');
				$priceList->Id_price_list_type = 1;
				$priceList->Id_supplier = $product->Id_supplier;
				$priceList->description = "Generada automaticamente";
				$priceList->Id_currency = $product->Id_currency;
				$priceList->save();
			
			}
			$criteria = new CDbCriteria;
			$criteria->compare('Id_product',$product->Id);
			$criteria->compare('Id_price_list',$priceList->Id);
				
			$priceListItem = PriceListItem::model()->find($criteria);
				
			if(!isset($priceListItem))
			{
				$priceListItem = new PriceListItem;
				$priceListItem->Id_price_list = $priceList->Id;
				$priceListItem->Id_product = $product->Id;
			}
				
			$priceListItem->msrp = 0;
			$priceListItem->dealer_cost = 0;
			foreach($children as $child)
			{
				//TODO: tomar esto de la lista de precios de cada producto, no del producto en si
				$productGroup = ProductGroup::model()->findByPk(array('Id_product_parent'=>$product->Id,'Id_product_child'=>$child->Id));
				if(isset($productGroup))
				{
					$priceListItem->msrp += self::convertCurrencyTo($child->msrp*$productGroup->quantity, $child->Id_currency, $priceList->Id_currency);
					$priceListItem->dealer_cost += self::convertCurrencyTo($child->dealer_cost*$productGroup->quantity, $child->Id_currency, $priceList->Id_currency);						
				}
			}
			$priceListItem->profit_rate = $priceListItem->msrp/$priceListItem->dealer_cost;
			$priceListItem->save();
			
			//Ventas
			$importers = Importer::model()->findAll();
			foreach ($importers as $importer)
			{
				$criteria = new CDbCriteria;
				$criteria->compare('Id_importer',$importer->Id);
				$criteria->compare('Id_price_list_type',2); //venta
				$criteria->compare('Id_currency',$product->Id_currency);
				
			
				$priceList = PriceList::model()->find($criteria);
				if(!isset($priceList))
				{
					$priceList = new PriceList();
					$priceList->validity = 1;
					$priceList->Id_price_list_type = 2;
					//$priceList->date_validity = new CDbExpression('NOW()');
					$priceList->Id_importer = $importer->Id;
					$priceList->description = "Generada automaticamente";
					$priceList->Id_currency = $product->Id_currency;
					$priceList->save();
				}
			
				$criteria = new CDbCriteria;
			
				$criteria->compare('Id_product',$product->Id);
				$criteria->compare('Id_price_list',$priceList->Id);
				$priceListItem = PriceListItem::model()->find($criteria);
				if(!isset($priceListItem))
				{
					$priceListItem = new PriceListItem;
					$priceListItem->Id_price_list = $priceList->Id;
					$priceListItem->Id_product = $product->Id;
				}
				$priceListItem->msrp = 0;
				$priceListItem->dealer_cost = 0;
				$priceListItem->profit_rate = 0;
				foreach($children as $child)
				{										
					$criteria = new CDbCriteria;						
					$criteria->compare('Id_product',$child->Id);
					$criteria->compare('Id_price_list',$priceList->Id);
					$priceListItemChild = PriceListItem::model()->find($criteria);
					if(isset($priceListItemChild))
					{
						$productGroup = ProductGroup::model()->findByPk(array('Id_product_parent'=>$product->Id,'Id_product_child'=>$child->Id));
						
						if(isset($productGroup))
						{						
							$priceListItem->msrp += self::convertCurrencyTo($priceListItemChild->msrp*$productGroup->quantity, $child->Id_currency, $priceList->Id_currency);
							$priceListItem->dealer_cost += self::convertCurrencyTo($priceListItemChild->dealer_cost*$productGroup->quantity, $child->Id_currency, $priceList->Id_currency);
						}
						
					}
							
				}
				if($priceListItem->dealer_cost!=0)
					$priceListItem->profit_rate = $priceListItem->msrp/$priceListItem->dealer_cost;
			
				if(!empty($importer->shippingParameters))
				{
					$shippingParameter = $importer->shippingParameters[0];
					$air = $shippingParameter->shippingParameterAir;
					$maritime = $shippingParameter->shippingParameterMaritime;
					
					$priceListItem->maritime_cost = 0;
					$priceListItem->air_cost= 0;
						
					foreach($children as $child)
					{
							
						$volume = $child->getVolume();
						$weight = $child->getWeightConverted();
						if($volume != 0)
						{
							//$maritime_cost = $priceListItem->dealer_cost+($maritime->cost_measurement_unit*$volume);
							$maritime_cost = $maritime->cost_measurement_unit*$volume;
						}
						else
						{
							//$maritime_cost = $priceListItem->dealer_cost;
							$maritime_cost = 0;
						}
						if($child->hasWeight())
						{
							//$air_cost = $priceListItem->dealer_cost+($air->cost_measurement_unit*$weight);
							$air_cost = $air->cost_measurement_unit*$weight;
						}
						else
						{
							//$air_cost = $priceListItem->dealer_cost;
							$air_cost = 0;
						}
						$productGroup = ProductGroup::model()->findByPk(array('Id_product_parent'=>$product->Id,'Id_product_child'=>$child->Id));
						
						if(isset($productGroup))
						{						
							$priceListItem->maritime_cost += $maritime_cost*$productGroup->quantity;
							$priceListItem->air_cost+= $air_cost*$productGroup->quantity;
						}
					}
					//$priceListItem->maritime_cost = $maritime_cost * $product->profit_rate;
					//$priceListItem->air_cost= $air_cost * $product->profit_rate;
					//$maritime_cost = $maritime_cost + ($priceListItem->dealer_cost*$maritime->percent_over_dealer_cost/100);
				}
				$priceListItem->save();
			
			}				
			$transaction->commit();
			return true;
		} catch (Exception $e) {
			$transaction->rollback();
		}
		return false;		
	}
	static public function generateListPrices($product)
	{
		if(get_class($product)=="Product")
		{
			PriceListItem::model()->deleteAllByAttributes(array('Id_product'=>$product->Id));
				
			$children = $product->productGroupChilds;
			if(!empty($children))
			{
				foreach ($children as $child)
				{
					self::generateListPrices($child);
				}
				return self::generateListaPricesWithChildren($product,$children);
			}		
			$transaction = Yii::app()->db->beginTransaction();
			try {
				if($product->dealer_cost == 0 ||$product->msrp==0)	return false;
				//compras
				$criteria = new CDbCriteria;
				$criteria->compare('Id_supplier',$product->Id_supplier);
				$criteria->compare('Id_price_list_type',1); //compra
				$criteria->compare('Id_currency',$product->Id_currency);
				
				
				$priceList = PriceList::model()->find($criteria);
				if(!isset($priceList))
				{
					$priceList = new PriceList();
					$priceList->validity = 1;
					//$priceList->date_validity = new CDbExpression('NOW()');
					$priceList->Id_price_list_type = 1;
					$priceList->Id_supplier = $product->Id_supplier;
					$priceList->description = "Generada automaticamente";
					$priceList->Id_currency = $product->Id_currency;					
					$priceList->save();
				
				}
				$criteria = new CDbCriteria;
				$criteria->compare('Id_product',$product->Id);
				$criteria->compare('Id_price_list',$priceList->Id);
				$priceListItem = PriceListItem::model()->find($criteria);
				if(!isset($priceListItem))
				{
					$priceListItem = new PriceListItem;
					$priceListItem->Id_price_list = $priceList->Id;
					$priceListItem->Id_product = $product->Id;
				}
				
				$priceListItem->msrp = $product->msrp;
				$priceListItem->dealer_cost = $product->dealer_cost;
				$priceListItem->profit_rate = $product->profit_rate;
				$priceListItem->save();
				
				//Ventas
				$importers = Importer::model()->findAll();
				foreach ($importers as $importer)
				{
					if($importer->contact->description!="FOB")
					{
						if($product->getVolume() == 0 ||!$product->hasWeight())	continue;						
					}
					$criteria = new CDbCriteria;
					$criteria->compare('Id_importer',$importer->Id);
					$criteria->compare('Id_price_list_type',2); //venta
					$criteria->compare('Id_currency',$product->Id_currency);
						
					$priceList = PriceList::model()->find($criteria);
					if(!isset($priceList))
					{
						$priceList = new PriceList();
						$priceList->validity = 1;
						$priceList->Id_price_list_type = 2;
						//$priceList->date_validity = new CDbExpression('NOW()');
						$priceList->Id_importer = $importer->Id;
						$priceList->description = "Generada automaticamente";
						$priceList->Id_currency = $product->Id_currency;						
						$priceList->save();
					}
						
					$criteria = new CDbCriteria;
						
					$criteria->compare('Id_product',$product->Id);
					$criteria->compare('Id_price_list',$priceList->Id);
					$priceListItem = PriceListItem::model()->find($criteria);
					if(!isset($priceListItem))
					{
						$priceListItem = new PriceListItem;
						$priceListItem->Id_price_list = $priceList->Id;
						$priceListItem->Id_product = $product->Id;
					}
					$priceListItem->msrp = $product->msrp;
					$priceListItem->dealer_cost = $product->dealer_cost;
					$priceListItem->profit_rate = $product->profit_rate;
				
					if(!empty($importer->shippingParameters))
					{
						$shippingParameter = $importer->shippingParameters[0];
						$air = $shippingParameter->shippingParameterAir;
						$maritime = $shippingParameter->shippingParameterMaritime;
						$volume = $product->getVolume();
						$weight = $product->getWeightConverted();
						if($volume != 0)
						{
							//$maritime_cost = $priceListItem->dealer_cost+($maritime->cost_measurement_unit*$volume);
							$maritime_cost = $maritime->cost_measurement_unit*$volume;
						}
						else
						{
							//$maritime_cost = $priceListItem->dealer_cost;
							$maritime_cost = 0;
						}
						if($product->hasWeight())
						{
							//$air_cost = $priceListItem->dealer_cost+($air->cost_measurement_unit*$weight);
							$air_cost = $air->cost_measurement_unit*$weight;
						}
						else
						{
							//$air_cost = $priceListItem->dealer_cost;
							$air_cost = 0;
						}
						//$priceListItem->maritime_cost = $maritime_cost * $product->profit_rate;
						//$priceListItem->air_cost= $air_cost * $product->profit_rate;
						//$maritime_cost = $maritime_cost + ($priceListItem->dealer_cost*$maritime->percent_over_dealer_cost/100); 
 						$priceListItem->maritime_cost = $maritime_cost;
 						$priceListItem->air_cost= $air_cost;
					}
					$priceListItem->save();
				
				}
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
			$parents = $product->productGroupParents;
			foreach ($parents as $parent)
			{
				$children = $parent->productGroupChilds;
				if(!empty($children))
				{
					return self::generateListaPricesWithChildren($parent,$children);
				}				
			}
				
			return true;
		}			
	}
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
	static public function getDataValue($data, $field, $arrFields, $type = 'string')
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
	
	static public function cellColor($sheet, $cells, $color)
	{
		$sheet->getStyle($cells)->getFill()
		->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
									        'startcolor' => array('rgb' => $color)
		));
	}
	
	static public function showPrice($number)
	{
		return number_format($number,2,",",".");
	}
	
	static public function exportBudgetToExcel($idBudget, $versionNumber)
	{
		
		Yii::import('ext.phpexcel.XPHPExcel');
		$objPHPExcel= XPHPExcel::createPHPExcel();
		$objPHPExcel->getProperties()->setCreator("Grupo Smartliving")
		->setLastModifiedBy("Maarten Balliauw")
		->setTitle("Office 2007 XLSX Test Document")
		->setSubject("Office 2007 XLSX Test Document")
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		->setKeywords("office 2007 openxml php")
		->setCategory("Test result file");
		
		$arrayServiceTotal = array();
		//INDICES EXCEL
		$indexMain = array('main'=>'A','image'=>'E','mainStart'=>'A','mainEnd'=>'K');
		$indexSummary = array('service'=>'D', 'total'=>'G');
		$indexServiceHeader = array('name'=>'A');
		$indexServiceBody = array('description'=>'A', 'descriptionEnd'=>'K');
		$indexService = array('name'=>'A', 'description'=>'B');
		$indexProductHeader = array('shortDescription'=>'A');
		$indexProductBody = array('image'=>'A', 'description'=>'D', 'descriptionEnd'=>'K');
		$indexProductFooter = array('qtyDesc'=>'A', 'qty'=>'B', 'unitPriceDesc'=>'D', 'unitPrice'=>'F',
										'discountDesc'=>'H', 'discount'=>'I', 'totalDesc'=>'K', 'total'=>'L');
		$indexExtra	  = array('descriptionStart'=>'A', 'descriptionEnd'=>'E', 'quantity'=>'F', 'price'=>'G',
										'discount'=>'H','total'=>'I');
		$indexTotal	  = array('descriptionStart'=>'F','descriptionEnd'=>'H','total'=>'I');
		
		$style_border = array(
		       'borders' => array(
		             'outline' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN,
		                    'color' => array('argb' => '00000000'),
							),
				),
		);		
		
		$style_num = array(
		                'alignment' => array(
		                    		'wrap' => true,
		                                      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
									),
		);
		
		$style_desc = array(
				                'alignment' => array(
				                    		'wrap' => true,
				                                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
								),
		);
		
		//sheet 0
		$sheet = $objPHPExcel->setActiveSheetIndex(0);
		$row = 1;
		
		//MAIN HEADER---------------------------------------------------------------
		$modelBudget = Budget::model()->findByAttributes(array('Id'=>$idBudget,'version_number'=>$versionNumber));
		$currency = "$";
		if(isset($modelBudget))
		{
			$currency = $modelBudget->currencyView->short_description;
			
			$objDrawingPType = new PHPExcel_Worksheet_Drawing();
			$objDrawingPType->setWorksheet($sheet);
			$objDrawingPType->setName("Pareto By Type");
			$objDrawingPType->setPath(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/logoSL.png");
			$objDrawingPType->setCoordinates($indexMain['image'].$row);
			$objDrawingPType->setOffsetX(1);
			$objDrawingPType->setOffsetY(1);
			$objDrawingPType->setHeight(95);
			
			$row = 6;
			$sheet->mergeCells($indexMain['mainStart'].'1:'.$indexMain['mainEnd'].$row);
			
			$row++;
			$sheet->setCellValue($indexMain['main'].$row, 'Propuesta - '. $modelBudget->description);
			$sheet->mergeCells($indexMain['mainStart'].$row.':'.$indexMain['mainEnd'].$row);
			$row++;
			
			$customer = $modelBudget->project->customer;
			$sheet->setCellValue($indexMain['main'].$row, $customer->person->name . ' ' . $customer->person->last_name);
			$sheet->mergeCells($indexMain['mainStart'].$row.':'.$indexMain['mainEnd'].$row);
			$row++;
			
			$sheet->setCellValue($indexMain['main'].$row, 'Revision '.$versionNumber);
			$sheet->mergeCells($indexMain['mainStart'].$row.':'.$indexMain['mainEnd'].$row);
			$row++;
			
			$sheet->setCellValue($indexMain['main'].$row, date("d-m-Y"));
			$sheet->mergeCells($indexMain['mainStart'].$row.':'.$indexMain['mainEnd'].$row);
			
			$sheet->getStyle($indexMain['main'].'1:'.$indexMain['main'].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER) ;
			$row++;
		}
		//END MAIN HEADER---------------------------------------------------------------		
		
		$row++;
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_budget = '.$idBudget);
		$criteria->addCondition('version_number = '.$versionNumber);
		$criteria->group = 'Id_service';
		$budgetItemServices = BudgetItem::model()->findAll($criteria);
		
		$rowSummary = $row; 
		$row = $row + count($budgetItemServices) + 2;
		foreach($budgetItemServices as $budgetItemService)
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('Id_budget = '.$idBudget);
			$criteria->addCondition('version_number = '.$versionNumber);
				
			$serviceCondition = '';
			if(isset($budgetItemService->Id_service))
			{
				$serviceCondition = 'Id_service = '.$budgetItemService->Id_service. ' OR
															(Id_budget_item in (select Id from budget_item bi 	
															where Id_budget = '.$idBudget .' 
															and version_number = '.$versionNumber .'
															and Id_product is not null
															and Id_service = '.$budgetItemService->Id_service.' )
														AND is_included = 1)';
			}
			else
				$serviceCondition = '(Id_service is null and Id_budget_item is null)';
				
			$criteria->addCondition($serviceCondition);
			$criteria->addCondition('Id_product is not null');
			
			$budgetItems = BudgetItem::model()->findAll($criteria);
			
			//SERVICE---------------------------------------------------------------
			$serviceName = '';
			if(count($budgetItems)>0)
			{
				$serviceName = 'General';
				$serviceDesc = 'Items sin agrupar en servicios';
				if(isset($budgetItemService->service))
				{
					$serviceName = $budgetItemService->service->description;
					$serviceDesc = $budgetItemService->service->long_description;
					
					$projectServiceDB = ProjectService::model()->findByAttributes(array('Id_project'=>$budgetItemService->budget->Id_project,
																		'Id_service'=>$budgetItemService->Id_service));
					if(isset($projectServiceDB))
						$serviceDesc = $projectServiceDB->long_description;				
				}
	
				$sheet->setCellValue($indexServiceHeader['name'].$row, $serviceName);
				$sheet->getStyle($indexServiceHeader['name'].$row)->getFont()->setBold(true);
				$row++;
				$sheet->setCellValue($indexServiceBody['description'].$row, $serviceDesc);
				
				$newRow = $row + 5;
				$sheet->getStyle($indexServiceBody['description'].$row)->getAlignment()->setWrapText(true);
				$sheet->mergeCells($indexServiceBody['description'].$row.':'.$indexProductBody['descriptionEnd'].$newRow);
				$sheet->getStyle($indexServiceBody['description'].$row)->applyFromArray($style_desc);
				
				$row = $newRow;
				
			}
			$row++;
			//END SERVICE---------------------------------------------------------------
						
// 			//HEADER BUDGET ITEM---------------------------------------------------------------

// 			//END HEADER BUDGET ITEM---------------------------------------------------------------
			
			//BODY BUDGET ITEM---------------------------------------------------------------
			
			$row++;
			$serviceTotalPrice = 0;
			foreach($budgetItems as $budgetItem)
			{				
				$prodHeader = $budgetItem->product->brand->description .' '. $budgetItem->product->model;
				
				$sheet->setCellValue($indexProductHeader['shortDescription'].$row, $prodHeader);
				$sheet->getStyle($indexProductHeader['shortDescription'].$row)->getFont()->setBold(true);
				$row++;
				
				$criteria = new CDbCriteria();
				$criteria->join = 'inner join product_multimedia pm on (pm.Id_multimedia = t.Id)';
				$criteria->addCondition('t.Id_multimedia_type = 1');
				$criteria->addCondition('pm.Id_product = '. $budgetItem->Id_product);
				
				$modelMultimediaDB = Multimedia::model()->find($criteria);
				if(isset($modelMultimediaDB))
				{				
					$imagePath = "";
					if(file_exists(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/". $modelMultimediaDB->file_name_small))
						$imagePath = Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/". $modelMultimediaDB->file_name_small;
					elseif(file_exists(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/". $budgetItem->product->brand->description . '_' . $budgetItem->product->model.".jpg"))
						$imagePath = Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/". $budgetItem->product->brand->description . '_' . $budgetItem->product->model.".jpg";
					
					if(!empty($imagePath))
					{
						$objDrawingPType = new PHPExcel_Worksheet_Drawing();
						$objDrawingPType->setWorksheet($sheet);
						$objDrawingPType->setName("Pareto By Type");
						$objDrawingPType->setPath($imagePath);
						$objDrawingPType->setCoordinates($indexProductBody['image'].$row);
						$objDrawingPType->setOffsetX(1);
						$objDrawingPType->setOffsetY(1);
						$objDrawingPType->setResizeProportional(true);
						$objDrawingPType->setWidthAndHeight(150,150);
					}
				}
				
				$row++;
				
				$sheet->setCellValue($indexProductBody['description'].$row, $budgetItem->product->short_description);
				$newRow = $row + 5;
				$sheet->getStyle($indexProductBody['description'].$row)->getAlignment()->setWrapText(true);
				$sheet->mergeCells($indexProductBody['description'].$row.':'.$indexProductBody['descriptionEnd'].$newRow);
				$sheet->getStyle($indexProductBody['description'].$row)->applyFromArray($style_desc);
				
				$row = $newRow + 2;
				
				$sheet->setCellValue($indexProductFooter['qtyDesc'].$row, "Cantidad:");
				$sheet->getStyle($indexProductFooter['qtyDesc'].$row)->getFont()->setBold(true);
				$sheet->setCellValue($indexProductFooter['qty'].$row, $budgetItem->quantity);
				$sheet->getStyle($indexProductFooter['qty'].$row)->getFont()->setBold(true);
				$sheet->setCellValue($indexProductFooter['unitPriceDesc'].$row, "Precio Unitario");
				$sheet->getStyle($indexProductFooter['unitPriceDesc'].$row)->getFont()->setBold(true);
				$sheet->setCellValue($indexProductFooter['unitPrice'].$row, $currency .' '. self::showPrice($budgetItem->getPriceCurrencyConverted()));
				$sheet->getStyle($indexProductFooter['unitPrice'].$row)->getFont()->setBold(true);
				
				if($budgetItem->discount > 0)
				{
					$sheet->setCellValue($indexProductFooter['discountDesc'].$row, "Descuento");
					$sheet->getStyle($indexProductFooter['discountDesc'].$row)->getFont()->setBold(true);
					$sheet->setCellValue($indexProductFooter['discount'].$row, $budgetItem->getDiscountType().' '. self::showPrice($budgetItem->getDiscountCurrencyConverted()));
					$sheet->getStyle($indexProductFooter['discount'].$row)->getFont()->setBold(true);
					
					$sheet->setCellValue($indexProductFooter['totalDesc'].$row, "Total:");
					$sheet->getStyle($indexProductFooter['totalDesc'].$row)->getFont()->setBold(true);
					$sheet->setCellValue($indexProductFooter['total'].$row, $currency .' '. self::showPrice($budgetItem->getTotalPriceWOChildernCurrencyConverted()));
					$sheet->getStyle($indexProductFooter['total'].$row)->getFont()->setBold(true);
				}
				else 
				{
					$sheet->setCellValue($indexProductFooter['discountDesc'].$row, "Total:");
					$sheet->getStyle($indexProductFooter['discountDesc'].$row)->getFont()->setBold(true);
					$sheet->setCellValue($indexProductFooter['discount'].$row, $currency .' '. self::showPrice($budgetItem->getTotalPriceWOChildernCurrencyConverted()));
					$sheet->getStyle($indexProductFooter['discount'].$row)->getFont()->setBold(true);
				}
				
				$serviceTotalPrice = $serviceTotalPrice + $budgetItem->getTotalPriceWOChildernCurrencyConverted();				
				
				$row++;
				$row = $row + 2;
			}
				
			$row++;
			$arrayServiceTotal[] = array('serviceName'=>$serviceName, 'total'=>$serviceTotalPrice);
			
		}
		//END BODY BUDGET ITEM---------------------------------------------------------------
		
		//EXTRAS---------------------------------------------------------------
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_budget = '.$idBudget);
		$criteria->addCondition('version_number = '.$versionNumber);
		$criteria->addCondition('Id_service is null');
		$criteria->addCondition('Id_product is null');
			
		$budgetItems = BudgetItem::model()->findAll($criteria);
		
		if(count($budgetItems)>0)
		{
			//SERVICE EXTRAS---------------------------------------------------------------
			$row++;
			$sheet->setCellValue($indexService['name'].$row, 'Extras');
			$sheet->setCellValue($indexService['description'].$row, 'Agregados');
			self::cellColor($sheet, $indexService['name'].$row.':'.$indexService['description'].$row, 'e6e6fa');
			$sheet->getStyle($indexService['name'].$row.':'.$indexService['description'].$row)->applyFromArray($style_border);
			$row++;
			//END SERVICE EXTRAS---------------------------------------------------------------
			
			//HEADER EXTRAS---------------------------------------------------------------
			$sheet->setCellValue($indexExtra['descriptionStart'].$row, 'Descripcion');
			$sheet->setCellValue($indexExtra['quantity'].$row, 'Cantidad');
			$sheet->setCellValue($indexExtra['price'].$row, 'Precio');
			$sheet->setCellValue($indexExtra['discount'].$row, 'Descuento');
			$sheet->setCellValue($indexExtra['total'].$row, 'Total');
			
			$sheet->mergeCells($indexExtra['descriptionStart'].$row.':'.$indexExtra['descriptionEnd'].$row);
				
			self::cellColor($sheet, $indexExtra['descriptionStart'].$row.':'.$indexExtra['total'].$row, '2c86ff');
			$sheet->getStyle($indexExtra['descriptionStart'].$row.':'.$indexExtra['total'].$row)->applyFromArray($style_border);
			$row++;
			//END HEADER EXTRAS---------------------------------------------------------------
			
			//BODY EXTRAS---------------------------------------------------------------
			foreach($budgetItems as $budgetItem)
			{
				$sheet->mergeCells($indexExtra['descriptionStart'].$row.':'.$indexExtra['descriptionEnd'].$row);
				$sheet->setCellValue($indexExtra['descriptionStart'].$row, $budgetItem->description);
				$sheet->getStyle($indexExtra['descriptionStart'].$row)->getAlignment()->setWrapText(true);
				$sheet->setCellValue($indexExtra['quantity'].$row, $budgetItem->quantity);
				$sheet->setCellValue($indexExtra['price'].$row, $currency . ' ' . self::showPrice($budgetItem->getPriceCurrencyConverted()));
				$sheet->setCellValue($indexExtra['discount'].$row, $budgetItem->getDiscountType().' '. self::showPrice($budgetItem->getDiscountCurrencyConverted()));
				$sheet->setCellValue($indexExtra['total'].$row, $currency . ' ' . self::showPrice($budgetItem->getTotalPriceWOChildernCurrencyConverted()));
				$sheet->getStyle($indexExtra['descriptionStart'].$row.':'.$indexExtra['total'].$row)->applyFromArray($style_border);
				
				$sheet->getStyle($indexExtra['quantity'].$row.':'.$indexExtra['total'].$row)->applyFromArray($style_num);
				$row++;
			}
			//END BODY EXTRAS---------------------------------------------------------------
		}
		//END EXTRAS---------------------------------------------------------------
		
		
		//TOTALES---------------------------------------------------------------
		$row++;		
		if(isset($modelBudget))
		{
			//sub total
			$sheet->setCellValue($indexTotal['descriptionStart'].$row, 'Sub Total');
			$sheet->mergeCells($indexTotal['descriptionStart'].$row.':'.$indexTotal['descriptionEnd'].$row);
			self::cellColor($sheet, $indexTotal['descriptionStart'].$row.':'.$indexTotal['descriptionStart'].$row, 'e6e6fa');
			$sheet->getStyle($indexTotal['total'].$row)->applyFromArray($style_num);
			$sheet->getStyle($indexTotal['descriptionStart'].$row.':'.$indexTotal['total'].$row)->applyFromArray($style_border);
			$sheet->setCellValue($indexTotal['total'].$row, $currency . ' ' . self::showPrice($modelBudget->TotalPriceCurrencyConverted));
			$row++;
			
			//sub total
			$sheet->setCellValue($indexTotal['descriptionStart'].$row, 'Descuento');
			$sheet->mergeCells($indexTotal['descriptionStart'].$row.':'.$indexTotal['descriptionEnd'].$row);
			self::cellColor($sheet, $indexTotal['descriptionStart'].$row.':'.$indexTotal['descriptionStart'].$row, 'e6e6fa');
			$sheet->getStyle($indexTotal['total'].$row)->applyFromArray($style_num);
			$sheet->getStyle($indexTotal['descriptionStart'].$row.':'.$indexTotal['total'].$row)->applyFromArray($style_border);			
			$sheet->setCellValue($indexTotal['total'].$row, $currency .' ' . self::showPrice($modelBudget->TotalDiscountCurrencyConverted));
			$row++;
			
			//sub total
			$sheet->setCellValue($indexTotal['descriptionStart'].$row, 'Total');
			$sheet->mergeCells($indexTotal['descriptionStart'].$row.':'.$indexTotal['descriptionEnd'].$row);
			self::cellColor($sheet, $indexTotal['descriptionStart'].$row.':'.$indexTotal['descriptionStart'].$row, 'e6e6fa');
			$sheet->getStyle($indexTotal['total'].$row)->applyFromArray($style_num);
			$sheet->getStyle($indexTotal['descriptionStart'].$row.':'.$indexTotal['total'].$row)->applyFromArray($style_border);
			$sheet->setCellValue($indexTotal['total'].$row, $currency . ' ' . self::showPrice($modelBudget->TotalPriceWithDiscountCurrencyConverted));
			$row++;
						
			$project = isset($modelBudget->project)?$modelBudget->project->description:"";
			$fileName = $project . " - v" .$versionNumber;
		}
		//END TOTALES---------------------------------------------------------------
		$sheet->setCellValue($indexSummary['service'].$rowSummary, "Resumen de propuesta");
		$sheet->getStyle($indexSummary['service'].$rowSummary)->getFont()->setBold(true);
		$rowSummary++;
		foreach($arrayServiceTotal as $currentService)
		{
			if($currentService['total'] > 0)
			{
				$sheet->setCellValue($indexSummary['service'].$rowSummary, $currentService['serviceName']);
				$sheet->setCellValue($indexSummary['total'].$rowSummary, $currency . ' ' . self::showPrice($currentService['total']));
				$rowSummary++;
			}
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Redirect output to a client web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		Yii::app()->end();
	}
	
	static public function importMeasuresFromExcel($modelUpload, $modelMeasureImportLog)
	{		
		$Id_linear = $modelMeasureImportLog->Id_measurement_unit_linear;
		$Id_weight =  $modelMeasureImportLog->Id_measurement_unit_weight;
		
		$file=CUploadedFile::getInstance($modelUpload,'file');
		$sheet_array = Yii::app()->yexcel->readActiveSheet($file->tempName);
		
		$ext = end(explode(".", $file->name));
		$ext = strtolower($ext);
		
		$uniqueId = uniqid();

		$folder = "docs/";
		$fileName = $uniqueId.'.'.$ext;
		$filePath = $folder . $fileName;
		
		//save doc
		move_uploaded_file($file->tempName,$filePath);
		
		$arrCols = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G');
		$col_model =		'';
		$col_weight =		'';
		$col_length =		'';
		$col_width =		'';
		$col_height =		'';
		$col_qty = 			'';
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
			if(strpos($colName, 'QTY')!== false)
			{
				$col_qty = $arrCols[$col_index];
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
				$criteria = new CDbCriteria();
				$criteria->addCondition('t.Id_brand = '. $modelMeasureImportLog->Id_brand);
				$newModel = str_replace('"','',$row[$col_model]);
				
				if(empty($newModel))
					continue;
				
				$criteria->addCondition('"'. $newModel . '" like CONCAT("%", model ,"%")');
				
				$modelProductDB = Product::model()->find($criteria);
				
				if(isset($modelProductDB))
				{	
					$transaction = $modelProductDB->dbConnection->beginTransaction();
					try {						
						$modelProductDB->length = (float)$row[$col_length];
						$modelProductDB->width = (float)$row[$col_width];
						$modelProductDB->height = (float)$row[$col_height];
						$modelProductDB->weight = (float)$row[$col_weight];					
						$modelProductDB->Id_measurement_unit_linear = $Id_linear;
						$modelProductDB->Id_measurement_unit_weight = $Id_weight;
						$modelProductDB->save();
						
						$qty = isset($row[$col_qty])?(int)$row[$col_qty]:0;
						if($qty > 1)
						{
							$modelPackagingDB = Packaging::model()->findByAttributes(array('qty'=>$qty,
																				'Id_product'=>$modelProductDB->Id,
																		));
							if(!isset($modelPackagingDB))
							{
								$modelPackagingDB = new Packaging();
								$modelPackagingDB->Id_product = $modelProductDB->Id;
								$modelPackagingDB->qty = $qty;
								$modelPackagingDB->save();
							}
						}
						
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
					}		
					
				}
				else
				{ 
					$modelProduct = new Product();
					$modelProduct->model = $row[$col_model];
					$modelProduct->length = (float)$row[$col_length];
					$modelProduct->width = (float)$row[$col_width];
					$modelProduct->height = (float)$row[$col_height];
					$modelProduct->weight = (float)$row[$col_weight];
					$modelProduct->Id_measurement_unit_linear = $Id_linear;
					$modelProduct->Id_measurement_unit_weight = $Id_weight;
					$modelProduct->Id_brand = $modelMeasureImportLog->Id_brand;
					$modelProduct = self::setEmptyProduct($modelProduct);
					$modelProduct->save();
					$model_not_found .= $row[$col_model]. ', ';
				}
			}
			$row_index++;			
		}

		$modelMeasureImportLog->file_name = $fileName;
		$modelMeasureImportLog->original_file_name = $file->name;		
		$modelMeasureImportLog->not_found_model = rtrim($model_not_found, ", ");
		$modelMeasureImportLog->save();
	}
	
	static public function importPurchListFromExcel($modelUpload, $modelPriceList)
	{
		$file=CUploadedFile::getInstance($modelUpload,'file');
		$sheet_array = Yii::app()->yexcel->readActiveSheet($file->tempName);
	
		$ext = end(explode(".", $file->name));
		$ext = strtolower($ext);
	
		$uniqueId = uniqid();		
	
		$folder = "docs/";
		$fileName = $uniqueId.'.'.$ext;
		$filePath = $folder . $fileName;
		
		//save doc
		move_uploaded_file($file->tempName,$filePath);
	
		$arrCols = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F');
		$col_model =	'';
		$col_dealer =	'';
		$col_msrp =		'';
		$col_part_num = '';		
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
			if(strpos($colName, 'DEALER')!== false)
			{
				$col_dealer = $arrCols[$col_index];
				continue;
			}
			if(strpos($colName, 'PART')!== false)
			{
				$col_part_num = $arrCols[$col_index];
				continue;
			}
			if(strpos($colName, 'MSRP')!== false || strpos($colName, 'MAP')!== false)
			{
				$col_msrp = $arrCols[$col_index];
				continue;
			}
		}
			
		//save purch list price to add items
		if($modelPriceList->save())
		{		
			$row_index = 1;
			$model_not_found = '';
			foreach( $sheet_array as $row )
			{
				if($row_index != 1)
				{	

					$newModel = str_replace('"','',$row[$col_model]);
					
					if(empty($newModel))
						continue;
					
					$modelProductDB = Product::model()->findByAttributes(array('model'=>$newModel,
																			'Id_supplier'=>$modelPriceList->Id_supplier));
					
					$msrp = (float)str_replace('$','',$row[$col_msrp]);
					$dealer_cost = (float)str_replace('$','',$row[$col_dealer]);
					$profit_rate = 0;
					
					if($dealer_cost != 0)
						$profit_rate = $msrp / $dealer_cost;
					
					if(isset($modelProductDB))
					{
						
						$modelPriceListItem = new PriceListItem();
						$modelPriceListItem->Id_product = $modelProductDB->Id;
						$modelPriceListItem->Id_price_list = $modelPriceList->Id;
						$modelPriceListItem->msrp = $msrp;
						$modelPriceListItem->dealer_cost = $dealer_cost;
						$modelPriceListItem->profit_rate = (float)$profit_rate;
						$modelPriceListItem->save();
					}
					else
					{
						$modelProduct = new Product();
						$transaction = $modelProduct->dbConnection->beginTransaction();
						try 
						{
							$modelProduct->model = $row[$col_model];
							$modelProduct->part_number = isset($row[$col_part_num])?$row[$col_part_num]:"";
							$modelProduct->Id_supplier = $modelPriceList->Id_supplier;
							$modelProduct = self::setEmptyProduct($modelProduct);
							$modelProduct->save();
							
							$modelPriceListItem = new PriceListItem();
							$modelPriceListItem->Id_product = $modelProduct->Id;
							$modelPriceListItem->Id_price_list = $modelPriceList->Id;
							$modelPriceListItem->msrp = $msrp;
							$modelPriceListItem->dealer_cost = $dealer_cost;
							$modelPriceListItem->profit_rate = (float)$profit_rate;
							$modelPriceListItem->save();
							$transaction->commit();
						} 
						catch (Exception $e) 
						{
							$transaction->rollback();
						}
						
						$model_not_found .= $row[$col_model]. ', ';
					}
				}
				$row_index++;
			}
		
			$modelPriceListPuchImportLog = new PriceListPurchImportLog();
			$modelPriceListPuchImportLog->Id_price_list = $modelPriceList->Id;
			$modelPriceListPuchImportLog->file_name = $fileName;
			$modelPriceListPuchImportLog->original_file_name = $file->name;
			$modelPriceListPuchImportLog->Id_supplier = $modelPriceList->Id_supplier;
			$modelPriceListPuchImportLog->not_found_model = rtrim($model_not_found, ", ");
			$modelPriceListPuchImportLog->save();
		}
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
	
	static public function setEmptyProduct($modelProduct)
	{	
		//BEGIN NOMENCLATOR-------------------------------------------------
		if(!isset($modelProduct->Id_nomenclator))
		{
			$modelNomenclator = Nomenclator::model()->findByAttributes(array('description'=>'Dtools'));
			if(!isset($modelNomenclator))
			{
				$modelNomenclator = new Nomenclator();
				$modelNomenclator->description = 'Dtools';
				$modelNomenclator->save();
			}
			$modelProduct->Id_nomenclator = $modelNomenclator->Id;
		}
		//END NOMENCLATOR-------------------------------------------------
		
		
		//BEGIN MEASURE UNIT WEIGHT-------------------------------------------------
		if(!isset($modelProduct->Id_measurement_unit_weight))
		{
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
		}
		//END MEASURE UNIT WEIGHT-------------------------------------------------
			
		//BEGIN MEASURE UNIT LINEAR-------------------------------------------------
		if(!isset($modelProduct->Id_measurement_unit_linear))
		{
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
		}
		//END MEASURE UNIT LINEAR-------------------------------------------------
		
		//BEGIN BRAND-------------------------------------------------
		if(!isset($modelProduct->Id_brand))
		{
			$manufacturer = "--";
			$modelBrand = Brand::model()->findByAttributes(array('description'=>$manufacturer));
			if(!isset($modelBrand))
			{
				$modelBrand = new Brand();
				$modelBrand->description = $manufacturer;
				$modelBrand->save();
			}
			$modelProduct->Id_brand = $modelBrand->Id;
		}
		//END BRAND-------------------------------------------------
		
		//BEGIN VOLTS-------------------------------------------------
		$volts = 0;
		$modelVolts = Volts::model()->findByAttributes(array('volts'=>$volts));
		if(!isset($modelVolts))
		{
			$modelVolts = new Volts();
			$modelVolts->volts = $volts;
			$modelVolts->save();
		}
		$modelProduct->Id_volts = $modelVolts->Id;
		//END VOLTS-------------------------------------------------
		
		//BEGIN CATEGORY-------------------------------------------------
		$category = "--";
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
		$subCategory = "--";
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
		$productType = "--";
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
		if(!isset($modelProduct->Id_supplier))
		{
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
		}
		//END SUPPLIER-------------------------------------------------
		
		$modelProduct->from_dtools = 0;
		$modelProduct->hide = 0;			
					
		return $modelProduct; 
	}
	
	static public function setProduct($data, $arrFields, $importCode)
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
	
	static public function generateProductExcelGrid($idProductImportLog)
	{
		$modelProductImportLog = ProductImportLog::model()->findByPk($idProductImportLog);
		if(isset($modelProductImportLog))
		{
			Yii::import('ext.phpexcel.XPHPExcel');
			$objPHPExcel= XPHPExcel::createPHPExcel();
			$objPHPExcel->getProperties()->setCreator("Grupo Smartliving")
			->setLastModifiedBy("I+D Team")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Green");
			
			
			$arrIndexCols = array('MODELO'=>'A','PART NUMBER'=>'B','LARGO'=>'C','ANCHO'=>'D','ALTO'=>'E','PESO'=>'F','MSRP'=>'G',
					'DEALER COST'=>'H','PORCENTAJE DE DESCUENTO'=>'I','DESCONTINUADO'=>'J','DESCRIPCION CORTA'=>'K','DESCRIPCION CORTA SL'=>'L',
					'DESCRIPCION LARGA'=>'M','DESCRIPCION LARGA SL'=>'N',
					'TIEMPO INSTALACION'=>'O','TIEMPO PROGRAMACION'=>'P','UNIDADES DE RACK'=>'Q','UNIDADES DE FAN'=>'R','VOLTAJE'=>'S','AMPERAJE'=>'T',
					'POTENCIA'=>'U',
					'COLOR'=>'V','CATEGORIA'=>'W','SUB CATEGORIA'=>'X', 'TIPO'=>'Y', 'USA UPS'=>'Z', 'IMPORTANCIA'=>'AA');
			
			//sheet 0
			$sheet = $objPHPExcel->setActiveSheetIndex(0);
			$row = 2;
			
			foreach($arrIndexCols as $key => $value)
			{
				$sheet->setCellValue($value.$row, $key);
			}
			
			$row++;
			
			$modelProducts = Product::model()->findAllByAttributes(array('Id_brand'=>$modelProductImportLog->Id_brand));
			
			foreach($modelProducts as $product)
			{
				$sheet->setCellValue($arrIndexCols['MODELO'].$row, $product->model);
				
				$sheet->setCellValue($arrIndexCols['MODELO'].$row, $product->model);
				$sheet->setCellValue($arrIndexCols['PART NUMBER'].$row, $product->part_number);
				$sheet->setCellValue($arrIndexCols['LARGO'].$row, $product->length);
				$sheet->setCellValue($arrIndexCols['ANCHO'].$row, $product->width);
				$sheet->setCellValue($arrIndexCols['ALTO'].$row, $product->height);
				$sheet->setCellValue($arrIndexCols['PESO'].$row, $product->weight);
				$sheet->setCellValue($arrIndexCols['MSRP'].$row, $product->msrp);
				$sheet->setCellValue($arrIndexCols['DEALER COST'].$row, $product->dealer_cost);
				if($product->discontinued == 1)
					$sheet->setCellValue($arrIndexCols['DESCONTINUADO'].$row, "SI");
				else
					$sheet->setCellValue($arrIndexCols['DESCONTINUADO'].$row, "NO");
				$sheet->setCellValue($arrIndexCols['DESCRIPCION CORTA'].$row, $product->short_description);
				$sheet->setCellValue($arrIndexCols['DESCRIPCION CORTA SL'].$row, $product->description_customer);
				$sheet->setCellValue($arrIndexCols['DESCRIPCION LARGA'].$row, $product->long_description);
				$sheet->setCellValue($arrIndexCols['DESCRIPCION LARGA SL'].$row, $product->description_supplier);
								
				$sheet->setCellValue($arrIndexCols['TIEMPO INSTALACION'].$row, $product->time_instalation);
				$sheet->setCellValue($arrIndexCols['TIEMPO PROGRAMACION'].$row, $product->time_programation);
				$sheet->setCellValue($arrIndexCols['UNIDADES DE RACK'].$row, $product->unit_rack);
				$sheet->setCellValue($arrIndexCols['UNIDADES DE FAN'].$row, $product->unit_fan);
				
				$modelVolt = Volts::model()->findByPk($product->Id_volts);
				if(isset($modelVolt))
					$sheet->setCellValue($arrIndexCols['VOLTAJE'].$row, $modelVolt->volts);
				
				$sheet->setCellValue($arrIndexCols['AMPERAJE'].$row, $product->current);
				$sheet->setCellValue($arrIndexCols['POTENCIA'].$row, $product->power);
				$sheet->setCellValue($arrIndexCols['COLOR'].$row, $product->color);
				$sheet->setCellValue($arrIndexCols['CATEGORIA'].$row, $product->category->description);
				$sheet->setCellValue($arrIndexCols['SUB CATEGORIA'].$row, $product->subCategory->description);
				$sheet->setCellValue($arrIndexCols['TIPO'].$row, $product->productType->description);
				
				if($product->need_ups == 1)
					$sheet->setCellValue($arrIndexCols['USA UPS'].$row, "SI");
				else 
					$sheet->setCellValue($arrIndexCols['USA UPS'].$row, "NO");
				
				$relevance = 'BAJA';
								
				switch ($product->relevance_level) {
					case 1:
						$relevance = 'MEDIA';
						break;
					case 2:
						$relevance = 'ALTA';
						break;
				}
				
				$sheet->setCellValue($arrIndexCols['IMPORTANCIA'].$row, $relevance);
				
				$row++;
			}
			//$sheet->setCellValue($indexMain['main'].$row, 'Revision '.$versionNumber);
			
			
			$objPHPExcel->getActiveSheet()->setTitle('Simple');
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			
			// Redirect output to a client web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$modelProductImportLog->brand->description.'.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');
			
			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			Yii::app()->end();
			
		}
	}
	
	static public function importProductFromExcel($modelUpload, $modelProductImportLog)
	{
		$Id_linear = $modelProductImportLog->Id_measurement_unit_linear;
		$Id_weight =  $modelProductImportLog->Id_measurement_unit_weight;
		$Id_currency =  $modelProductImportLog->Id_currency;
		
		$file=CUploadedFile::getInstance($modelUpload,'file');
		$sheet_array = Yii::app()->yexcel->readActiveSheet($file->tempName);
		
		$excelCols = self::getExcelCols($sheet_array[2]);		
		$row_index = 1;
		$model_not_found = '';
		foreach( $sheet_array as $row )
		{
			if($row_index > 2)
			{
				$criteria = new CDbCriteria();
				$criteria->addCondition('t.Id_brand = '. $modelProductImportLog->Id_brand);
				$newModel = str_replace('"','',$row[$excelCols['MODELO']]);
	
				if(empty($newModel))
					continue;
	
				//$criteria->addCondition('"'. $newModel . '" like CONCAT("%", model ,"%")');
				$criteria->addCondition('t.model like "'. $newModel . '"');
				
				$modelProductDB = Product::model()->find($criteria);
	
				if(isset($modelProductDB))
				{					
					self::setProductAttributes($modelProductDB, $excelCols, $row);
					$modelProductDB->Id_measurement_unit_linear = $Id_linear;
					$modelProductDB->Id_measurement_unit_weight = $Id_weight;
					$modelProductDB->Id_currency = $Id_currency;
					$modelProductDB->save();
					self::generateListPrices($modelProductDB);
				}
				else
				{
					$modelProduct = new Product();
					$modelProduct->Id_brand = $modelProductImportLog->Id_brand;
					self::setProductAttributes($modelProduct, $excelCols, $row);
					$modelProduct->Id_measurement_unit_linear = $Id_linear;
					$modelProduct->Id_measurement_unit_weight = $Id_weight;
					$modelProduct->Id_currency = $Id_currency;
					$modelProduct->save();
					self::generateListPrices($modelProduct);
				}
			}
			$row_index++;
		}
		
		$modelProductImportLog->last_import_date = new CDbExpression('NOW()');
		$modelProductImportLog->save();

	}
	
	static public function setProductAttributes($modelProduct, $excelCols, $row)
	{
		$modelProduct->model = $row[$excelCols['MODELO']];
		$modelProduct->part_number = $row[$excelCols['PART NUMBER']];
		$modelProduct->length = (float)$row[$excelCols['LARGO']];
		$modelProduct->width = (float)$row[$excelCols['ANCHO']];
		$modelProduct->height = (float)$row[$excelCols['ALTO']];
		$modelProduct->weight = (float)$row[$excelCols['PESO']];
		
		if(!empty($row[$excelCols['MSRP']]))
		{
			$modelProduct->msrp = (float)$row[$excelCols['MSRP']];
			
			if(!empty($row[$excelCols['DEALER COST']]))
				$modelProduct->dealer_cost = (float)$row[$excelCols['DEALER COST']];
			else 
			{
				if(!empty($row[$excelCols['MSRP']]) && !empty($row[$excelCols['PORCENTAJE DE DESCUENTO']]))
				{
					$discount = (int)$row[$excelCols['PORCENTAJE DE DESCUENTO']];
					$modelProduct->dealer_cost = round($modelProduct->msrp * (100 - $discount) * 0.01,2);
				}			
			}
		}
		else 
		{
			if(!empty($row[$excelCols['DEALER COST']]))
			{
				$modelProduct->dealer_cost = (float)$row[$excelCols['DEALER COST']];
				if(!empty($row[$excelCols['PORCENTAJE DE DESCUENTO']]))
				{
					$discount = (int)$row[$excelCols['PORCENTAJE DE DESCUENTO']];
					if($discount < 100)
						$modelProduct->msrp = round($modelProduct->dealer_cost * 100 / (100 - $discount),2);
				}
			}
		}
		
		if($modelProduct->dealer_cost != 0)
			$modelProduct->profit_rate = round($modelProduct->msrp / $modelProduct->dealer_cost,2);
		
		$modelProduct->discontinued = (strtoupper($row[$excelCols['DESCONTINUADO']]) == 'NO')?0:1;
		$modelProduct->short_description = $row[$excelCols['DESCRIPCION CORTA']];
		$modelProduct->long_description = $row[$excelCols['DESCRIPCION LARGA']];
		$modelProduct->description_customer = $row[$excelCols['DESCRIPCION CORTA SL']];
		$modelProduct->description_supplier = $row[$excelCols['DESCRIPCION LARGA SL']];
		$modelProduct->time_instalation = (float)$row[$excelCols['TIEMPO INSTALACION']];
		$modelProduct->time_programation = (float)$row[$excelCols['TIEMPO PROGRAMACION']];
			
		$modelProduct->unit_rack = (int)$row[$excelCols['UNIDADES DE RACK']];
		$modelProduct->need_rack = ($modelProduct->unit_rack > 0)?1:0;
		$modelProduct->unit_fan = (int)$row[$excelCols['UNIDADES DE FAN']];
		
		$modelProduct->current = (float)$row[$excelCols['AMPERAJE']];
		$modelProduct->power = (float)$row[$excelCols['POTENCIA']];
			
		$modelProduct->color = $row[$excelCols['COLOR']];
		
		//BEGIN VOLT-------------------------------------------------
		$volts = (int)$row[$excelCols['VOLTAJE']];
		$modelVolts = Volts::model()->findByAttributes(array('volts'=>$volts));
		if(!isset($modelVolts))
		{
			$modelVolts = new Volts();
			$modelVolts->volts = $volts;
			$modelVolts->save();
		}
		$modelProduct->Id_volts = $modelVolts->Id;
		//END VOLT-------------------------------------------------
		
		//BEGIN CATEGORY-------------------------------------------------
		$category = "--";
		if(!empty($row[$excelCols['CATEGORIA']]))
			$category = $row[$excelCols['CATEGORIA']];
		
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
		$subCategory = "--";
		if(!empty($row[$excelCols['SUB CATEGORIA']]))
			$subCategory = $row[$excelCols['SUB CATEGORIA']];
		
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
		$productType = "--";
		if(!empty($row[$excelCols['TIPO']]))
			$productType = $row[$excelCols['TIPO']];
		
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
		$modelSupplier = Supplier::model()->findByAttributes(array('business_name'=>$modelProduct->brand->description));
		if(!isset($modelSupplier))
		{
			$modelContact = new Contact();
			$modelContact->save();
				
			$modelSupplier = new Supplier();
			$modelSupplier->business_name = $modelProduct->brand->description;
			$modelSupplier->Id_contact = $modelContact->Id;
			$modelSupplier->save();
		}
		$modelProduct->Id_supplier = $modelSupplier->Id;
		//END SUPPLIER-------------------------------------------------
		
		//BEGIN NOMENCLATOR-------------------------------------------------
		$modelNomenclator = Nomenclator::model()->findByAttributes(array('description'=>'Importado'));
		if(!isset($modelNomenclator))
		{
			$modelNomenclator = new Nomenclator();
			$modelNomenclator->description = 'Importado';
			$modelNomenclator->save();
		}
		$modelProduct->Id_nomenclator = $modelNomenclator->Id;
		//END NOMENCLATOR-------------------------------------------------
		
		$modelProduct->need_ups = (strtoupper($row[$excelCols['USA UPS']]) == 'NO')?0:1;
			
		$relevance = 0;
		switch ( strtoupper($row[$excelCols['IMPORTANCIA']])) {
			case 'BAJA':
				$relevance = 0;
				break;
			case 'MEDIA':
				$relevance = 1;
				break;
			case 'ALTA':
				$relevance = 2;
				break;
		}
		$modelProduct->relevance_level = $relevance;
		
	}
	
	static public function getExcelCols($firstRow)
	{
		$arrIndexCols = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',
				8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',
				15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',
				22=>'V',23=>'W',24=>'X', 25=>'Y', 26=>'Z', 27=>'AA');
		
		$excelCols = array();
		
		$col_index = 0;
		
		foreach( $firstRow as $header )
		{
			$colName = strtoupper($header); 
			$col_index++;
			if(strpos($colName, 'MODELO')!== false)
			{
				$excelCols['MODELO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'PART NUMBER')!== false)
			{
				$excelCols['PART NUMBER'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'LARGO')!== false)
			{
				$excelCols['LARGO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'ANCHO')!== false)
			{
				$excelCols['ANCHO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'ALTO')!== false)
			{
				$excelCols['ALTO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'PESO')!== false)
			{
				$excelCols['PESO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'MSRP')!== false)
			{
				$excelCols['MSRP'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'DEALER COST')!== false)
			{
				$excelCols['DEALER COST'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'PORCENTAJE DE DESCUENTO')!== false)
			{
				$excelCols['PORCENTAJE DE DESCUENTO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'DESCONTINUADO')!== false)
			{
				$excelCols['DESCONTINUADO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'DESCRIPCION CORTA SL')!== false)
			{
				$excelCols['DESCRIPCION CORTA SL'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'DESCRIPCION LARGA SL')!== false)
			{
				$excelCols['DESCRIPCION LARGA SL'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'DESCRIPCION CORTA')!== false)
			{
				$excelCols['DESCRIPCION CORTA'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'DESCRIPCION LARGA')!== false)
			{
				$excelCols['DESCRIPCION LARGA'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'TIEMPO INSTALACION')!== false)
			{
				$excelCols['TIEMPO INSTALACION'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'TIEMPO PROGRAMACION')!== false)
			{
				$excelCols['TIEMPO PROGRAMACION'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'UNIDADES DE RACK')!== false)
			{
				$excelCols['UNIDADES DE RACK'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'UNIDADES DE FAN')!== false)
			{
				$excelCols['UNIDADES DE FAN'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'VOLTAJE')!== false)
			{
				$excelCols['VOLTAJE'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'AMPERAJE')!== false)
			{
				$excelCols['AMPERAJE'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'POTENCIA')!== false)
			{
				$excelCols['POTENCIA'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'COLOR')!== false)
			{
				$excelCols['COLOR'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'SUB CATEGORIA')!== false)
			{
				$excelCols['SUB CATEGORIA'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'CATEGORIA')!== false)
			{
				$excelCols['CATEGORIA'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'TIPO')!== false)
			{
				$excelCols['TIPO'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'USA UPS')!== false)
			{
				$excelCols['USA UPS'] = $arrIndexCols[$col_index];
				continue;
			}
			if(strpos($colName, 'IMPORTANCIA')!== false)
			{
				$excelCols['IMPORTANCIA'] = $arrIndexCols[$col_index];
				continue;
			}
		}
		
		return $excelCols;
	}
	
	static public function cutString($str, $limit=100){
		$str = trim($str);
		$str = strip_tags($str);
		$tamano = strlen($str);
		$result = '';
		if($tamano <= $limit){
			return $str;
		}else{
			$str = substr($str, 0, $limit);
			$words = explode(' ', $str);
			$result = implode(' ', $words);
			$result .= '...';
		}
		return $result;
	}
	
	static public function getCommissionFactor($modelBudget)
	{
 		$commissionFactor = 1;
 		$modelCommissionists = Commissionist::model()->findAllByAttributes(array('Id_budget'=>$modelBudget->Id, 'version_number'=>$modelBudget->version_number));
		
 		$commission = 0;
 		foreach($modelCommissionists as $item)
 		{
 			$commission = $commission + $item->percent_commission;
 		}
		
		$commissionFactor = 1-($commission/100);
		
 		return $commissionFactor != 0?$commissionFactor:1;
	}
	
	static public function generateBudgetPDF($modelBudget)
	{
		$commissionFactor = self::getCommissionFactor($modelBudget);
		$idBudget = $modelBudget->Id;
		$versionNumber = $modelBudget->version_number;
		$currency = '$';
		
		if(isset($modelBudget->currencyView))
			$currency = $modelBudget->currencyView->short_description;
		
		$serviceContent = "";
		$serviceContentHeader = "";
		$serviceContentBody = "";
		$serviceContentBodyItem = "";
		$serviceContentBodyAccessory = "";
		$serviceContentBodyAdditional = "";
		$serviceContentBodyTotal = "";
		
		$serviceSummaryContent = "";
		$serviceSummaryContentBody = "";
		
		$serviceSummaryContentNoPrice = "";
		$serviceSummaryContentBodyNoPrice = "";
		
		$extraContent = "";
		
		$arrayServiceTotal = array();
		
		$criteria = new CDbCriteria();
		$criteria->join = 'LEFT JOIN project_service ps ON (ps.Id_service = t.Id_service and ps.Id_budget = t.Id_budget and t.version_number = ps.version_number)';
		$criteria->addCondition('t.Id_budget = '.$idBudget);
		$criteria->addCondition('t.version_number = '.$versionNumber);
		$criteria->group = 't.Id_service';
		$criteria->order = 'ps.order ASC';
		$budgetItemServices = BudgetItem::model()->findAll($criteria);
		
		foreach($budgetItemServices as $budgetItemService)
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('Id_budget = '.$idBudget);
			$criteria->addCondition('version_number = '.$versionNumber);
		
			$serviceCondition = '';
			if(isset($budgetItemService->Id_service))
			{
				$serviceCondition = 'Id_service = '.$budgetItemService->Id_service. ' OR
															(Id_budget_item in (select Id from budget_item bi
															where Id_budget = '.$idBudget .'
															and version_number = '.$versionNumber .'
															and Id_product is not null
															and Id_service = '.$budgetItemService->Id_service.' )
														AND is_included = 1)';
			}
			else
				$serviceCondition = '(Id_service is null and Id_budget_item is null)';
		
			$criteria->addCondition($serviceCondition);
			$criteria->addCondition('Id_product is not null');
			$criteria->order = 't.order_by_service';
			$criteria->group = 'Id_product';
			$criteria->select = '*, SUM(quantity) as sum_quantity';
			$budgetItems = BudgetItem::model()->findAll($criteria);
				
			//SERVICE---------------------------------------------------------------
			$serviceName = '';
			$serviceNote = '';
			$serviceAreas = '';
			if(count($budgetItems)>0)
			{
				$serviceName = 'General';
				$idIfGeneral = 'id="servicioGeneralOcultar"';
				$serviceDesc = 'Items sin agrupar en servicios';
				if(isset($budgetItemService->service))
				{
					$idIfGeneral = '';
					$serviceName = $budgetItemService->service->description;
					$serviceDesc = nl2br($budgetItemService->service->long_description);
					$serviceNote = nl2br($budgetItemService->service->note);
					
					$projectServiceDB = ProjectService::model()->findByAttributes(array('Id_project'=>$budgetItemService->budget->Id_project,
							'Id_budget'=>$budgetItemService->Id_budget,
							'version_number'=>$budgetItemService->version_number,
							'Id_service'=>$budgetItemService->Id_service));
					if(isset($projectServiceDB))
					{
						if($projectServiceDB->long_description == "")
							$serviceDesc = nl2br($projectServiceDB->service->long_description);
						else 
							$serviceDesc = nl2br($projectServiceDB->long_description);
						
						$serviceNote = nl2br($projectServiceDB->note);
					}
					
					$criteria = new CDbCriteria();
					$criteria->addCondition('hide = 0');
					$criteria->addCondition('Id IN (SELECT distinct Id_area_project FROM green.budget_item 
											where Id_budget = '.$budgetItemService->Id_budget.'
											and version_number = '.$budgetItemService->version_number.'
											and Id_service = '.$budgetItemService->Id_service.')');
						
					$modeAreaProjects = AreaProject::model()->findAll($criteria);
					$isFirst = true;
					foreach($modeAreaProjects as $projectArea)
					{
						if(isset($projectArea->description))
						{
							if($isFirst){
								$serviceAreas = '&raquo; &Aacute;reas presupuestadas: '.$projectArea->description;
								$isFirst = false;
							}
							else 
								$serviceAreas .= ', '.$projectArea->description;
						}
					}
					
				}
				
				$serviceContentHeader = '
						<div '.$idIfGeneral.' style="page-break-after: always;">
									<div class="budgetTitle">'.$serviceName.'</div>
									<div class="budgetDesc">'.$serviceDesc.' </div>
									<div>'.$serviceAreas.'.</div>
									<div class="budgetNota">'.$serviceNote.' </div>';
				
		
			
				//END SERVICE---------------------------------------------------------------
				
				//ITEMS---------------------------------------------------------------
				$serviceContentBodyItem = '<div class="budgetSubtitle">EQUIPOS</div>
											<table class="table tableReadOnly">
												<tbody>';
				$serviceContentBodyAccessory = '<div class="budgetSubtitle">ACCESORIOS</div>
													<table class="table tableReadOnly">
														<tbody>';
				
				$hasItems = false;
				$hasAccessory = false;
				$hasAdditional = false;
				$totalItemPrice = 0;
				$totalAccessoryPrice = 0;
				

				/* PARA PRUEBASSSSSSSSS -------------------- 
				
				$serviceContentBodyItem = $serviceContentBodyItem . '
						<tr class="pdfProdBIG"><td class="pdfTituloProd"><div class="bold">&bull; Controlador de Pared Universal de 7 (BIG)</div><table width="100%" class="tablaLimpia"><tbody><tr><td width="230" class="descContainer"><img class="imgTD" width="250" src="images/RTI_KX7_small.jpg"></td><td width="500">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non placerat nisl. Sed condimentum ornare turpis, nec fringilla ipsum iaculis id. Curabitur tempor turpis lobortis elit eleifend rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris semper convallis tellus, et convallis odio. Suspendisse ac turpis risus. Aenean et pulvinar est, eget tempus dolor. Sed vitae laoreet elit, non pellentesque augue. In facilisis elementum turpis nec condimentum. Nam bibendum scelerisque est, eleifend pretium purus aliquam in. Aliquam sit amet pulvinar est, non sagittis massa. Sed egestas suscipit sem et convallis. Aenean vitae tellus eget urna tincidunt faucibus et vitae ante. Morbi elementum vel neque vel pretium. Cras vehicula est id ultrices congue. Integer lacinia nec ipsum et pulvinar. In ultrices libero id velit mattis sodales. In venenatis massa sed lobortis mollis. Phasellus eu est eu tellus malesuada vulputate.
						</td></tr></tbody></table><table width="100%" class="tablaLimpia2 sinDesc">
						<tbody><tr>
						<td class="align-left" width="121">Cantidad:</td>
						<td class="align-left" width="121">2.00</td>
						<td class="align-left" width="121">Precio Unitario:</td>
						<td class="align-left" width="121">U$D 1,689.66</td>
						<td class="align-right" width="121">Precio Final:</td>
						<td class="align-right bold" width="121">U$D 3,379.31</td>
						</tr></tbody></table></td></tr>
						
						<tr class="pdfProdMEDIUM"><td class="pdfTituloProd"><div class="bold">&bull; Controlador de Pared Universal de 7 (MED)</div><table width="100%" class="tablaLimpia"><tbody><tr><td width="180" class="descContainer"><img class="imgTD" width="150" src="images/RTI_KX7_small.jpg"></td><td width="550">
						Donec eu elit sem. Phasellus sit amet varius orci. Praesent sit amet lorem tortor. Sed vel enim augue. Ut ac dapibus nunc, ac adipiscing urna. Integer blandit commodo velit, vitae lacinia urna luctus sed. Maecenas tempor scelerisque leo non euismod. Mauris quis volutpat justo. Nulla dapibus velit vitae odio ornare posuere. Ut molestie feugiat congue. Morbi vel volutpat sem, a semper diam.
						</td></tr></tbody></table><table width="100%" class="tablaLimpia2 sinDesc">
						<tbody><tr>
						<td class="align-left" width="121">Cantidad:</td>
						<td class="align-left" width="121">2.00</td>
						<td class="align-left" width="121">Precio Unitario:</td>
						<td class="align-left" width="121">U$D 1,689.66</td>
						<td class="align-right" width="121">Precio Final:</td>
						<td class="align-right bold" width="121">U$D 3,379.31</td>
						</tr></tbody></table></td></tr>
						
						<tr class="pdfProdSMALL"><td class="pdfTituloProd"><div class="bold">&bull; Controlador de Pared Universal de 7 (SMALL)</div><table width="100%" class="tablaLimpia"><tbody><tr><td width="120" class="descContainer"><img class="imgTD" width="100" src="images/RTI_KX7_small.jpg"></td><td width="610">
						Donec eu elit sem. Phasellus sit amet varius orci. Praesent sit amet lorem tortor.
						</td></tr></tbody></table><table width="100%" class="tablaLimpia2 sinDesc">
						<tbody><tr>
						<td class="align-left" width="121">Cantidad:</td>
						<td class="align-left" width="121">2.00</td>
						<td class="align-left" width="121">Precio Unitario:</td>
						<td class="align-left" width="121">U$D 1,689.66</td>
						<td class="align-right" width="121">Precio Final:</td>
						<td class="align-right bold" width="121">U$D 3,379.31</td>
						</tr></tbody></table></td></tr>
						
						<tr class="pdfProdTEXT"><td class="pdfTituloProd"><div class="bold">&bull; Controlador de Pared Universal de 7 (TEXTO)</div><table width="100%" class="tablaLimpia"><tbody><tr><td>
						Donec eu elit sem. Phasellus sit amet varius orci. Praesent sit amet lorem tortor.
						</td></tr></tbody></table><table width="100%" class="tablaLimpia2 sinDesc">
						<tbody><tr>
						<td class="align-left" width="121">Cantidad:</td>
						<td class="align-left" width="121">2.00</td>
						<td class="align-left" width="121">Precio Unitario:</td>
						<td class="align-left" width="121">U$D 1,689.66</td>
						<td class="align-right" width="121">Precio Final:</td>
						<td class="align-right bold" width="121">U$D 3,379.31</td>
						</tr></tbody></table></td></tr>
						
						<tr class="pdfProdTEXT"><td class="pdfTituloProd"><div class="bold">&bull; Controlador de Pared Universal de 7 (TEXTO)</div><table width="100%" class="tablaLimpia"><tbody><tr><td>
						Donec eu elit sem. Phasellus sit amet varius orci. Praesent sit amet lorem tortor.
						</td></tr></tbody></table><table width="100%" class="tablaLimpia2 sinDesc">
						<tbody><tr>
						<td class="align-left" width="121">Cantidad:</td>
						<td class="align-left" width="121">2.00</td>
						<td class="align-left" width="121">Precio Unitario:</td>
						<td class="align-left" width="121">U$D 1,689.66</td>
						<td class="align-right" width="121">Precio Final:</td>
						<td class="align-right bold" width="121">U$D 3,379.31</td>
						</tr></tbody></table></td></tr>
						<tr class="pdfProdTEXT"><td class="pdfTituloProd"><div class="bold">&bull; Controlador de Pared Universal de 7 (TEXTO)</div><table width="100%" class="tablaLimpia"><tbody><tr><td>
						Donec eu elit sem. Phasellus sit amet varius orci. Praesent sit amet lorem tortor.
						</td></tr></tbody></table><table width="100%" class="tablaLimpia2 sinDesc">
						<tbody><tr>
						<td class="align-left" width="121">Cantidad:</td>
						<td class="align-left" width="121">2.00</td>
						<td class="align-left" width="121">Precio Unitario:</td>
						<td class="align-left" width="121">U$D 1,689.66</td>
						<td class="align-right" width="121">Precio Final:</td>
						<td class="align-right bold" width="121">U$D 3,379.31</td>
						</tr></tbody></table></td></tr>
						<tr class="pdfProdTEXT"><td class="pdfTituloProd"><div class="bold">&bull; Controlador de Pared Universal de 7 (TEXTO)</div><table width="100%" class="tablaLimpia"><tbody><tr><td>
						Donec eu elit sem. Phasellus sit amet varius orci. Praesent sit amet lorem tortor.
						</td></tr></tbody></table><table width="100%" class="tablaLimpia2 sinDesc">
						<tbody><tr>
						<td class="align-left" width="121">Cantidad:</td>
						<td class="align-left" width="121">2.00</td>
						<td class="align-left" width="121">Precio Unitario:</td>
						<td class="align-left" width="121">U$D 1,689.66</td>
						<td class="align-right" width="121">Precio Final:</td>
						<td class="align-right bold" width="121">U$D 3,379.31</td>
						</tr></tbody></table></td></tr>';
				 END PARA PRUEBASSSSSSSSS -------------------- */
				
				foreach($budgetItems as $budgetItem)
				{
					
					$criteria = new CDbCriteria();
					$criteria->join = 'inner join product_multimedia pm on (pm.Id_multimedia = t.Id)';
					$criteria->addCondition('t.Id_multimedia_type = 1');
					$criteria->addCondition('pm.Id_product = '. $budgetItem->Id_product);
					
					$modelMultimediaDB = Multimedia::model()->find($criteria);

					$tdImage = '<td>';
					$trClass = "pdfProdTEXT";
					if(isset($modelMultimediaDB))
					{
						$imagePath = '';
						if(file_exists(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/". $modelMultimediaDB->file_name_small))
							$imagePath = "images/". $modelMultimediaDB->file_name_small;
						elseif(file_exists(Yii::app()->basePath.DIRECTORY_SEPARATOR."../images/". $budgetItem->product->brand->description . '_' . $budgetItem->product->model.".jpg"))
							$imagePath = "images/". $budgetItem->product->brand->description . '_' . $budgetItem->product->model.".jpg";
							
						if(!empty($imagePath))
						{
							
							switch ($budgetItem->product->relevance_level) {
								case 0:
									$tdImage = '<td width="230" class="descContainer tdSizeSmall" align="center"><img class="imgTD" width="100" src="'.$imagePath.'"></td><td width="610">';
									$trClass = "pdfProdSMALL";
									break;
								case 1:
									$tdImage = '<td width="230" class="descContainer tdSizeMedium" align="center"><img class="imgTD" width="150" src="'.$imagePath.'"></td><td width="550">';
									$trClass = "pdfProdMEDIUM";
									break;
								case 2:
									$tdImage = '<td width="230" class="descContainer tdSizeBig" align="center"><img class="imgTD" width="250" src="'.$imagePath.'"></td><td width="500">';
									$trClass = "pdfProdBIG";
									break;
							}
							
							
						}
											
					}
					
					$short_description = $budgetItem->product->description_customer!=""?$budgetItem->product->description_customer:$budgetItem->product->short_description;
					$long_description = nl2br($budgetItem->product->description_supplier!=""?$budgetItem->product->description_supplier:$budgetItem->product->long_description);
										
					if($budgetItem->product->is_accessory == 0)
					{
						$hasItems = true;					
						$serviceContentBodyItem = $serviceContentBodyItem . '<tr class="'.$trClass.'">';
						$serviceContentBodyItem = $serviceContentBodyItem . '<td class="pdfTituloProd"><div class="bold">&bull; '.$short_description.'</div><table width="100%" class="tablaLimpia"><tbody><tr>'.$tdImage.$long_description.'</td></tr></tbody></table>';
						
						$budgetItemAreasApp = '';
						$serviceCondition = '';
						if(isset($budgetItem->Id_service))
							$serviceCondition = 'Id_service = '. $budgetItem->Id_service;
						else
							$serviceCondition = 'Id_service is null';
						
						$criteria = new CDbCriteria();
						$criteria->addCondition($serviceCondition);
						$criteria->addCondition('Id_budget = '. $budgetItem->Id_budget);
						$criteria->addCondition('version_number = '. $budgetItem->version_number);
						$criteria->addCondition('Id_product = '. $budgetItem->Id_product);
						$modelbudgetItemAreas = BudgetItem::model()->findAll($criteria);
						
						$isFirst = true;
						foreach($modelbudgetItemAreas as $modelbudgetItemArea)
						{
							$modelAreaProj = AreaProject::model()->findByAttributes(array('Id'=>$modelbudgetItemArea->Id_area_project));
							if(isset($modelAreaProj) && isset($modelAreaProj->description))
							{
								if($isFirst)
								{
									$budgetItemAreasApp = '&raquo; &Aacute;reas de aplicaci&oacute;n: '. round($modelbudgetItemArea->quantity,0) .' en ' .$modelAreaProj->description;
									$isFirst = false;
								}
								else
									$budgetItemAreasApp .= ', '. round($modelbudgetItemArea->quantity,0) .' en ' .$modelAreaProj->description;
							}
							
						}
						
						
						if($budgetItem->getDiscountCurrencyConverted() > 0)
						{
							
							if ($budgetItem->discount_type==0)
							{
								$discount = self::showPrice($budgetItem->discount);							
							}
							else 
							{
								$discount = self::showPrice($budgetItem->getDiscountCurrencyConverted()/$commissionFactor);								
							}
							$serviceContentBodyItem = $serviceContentBodyItem . '<table width="100%" class="tablaLimpia2 conDesc">
								<tbody><tr>
								<td class="align-left" width="91">Cantidad:</td>
								<td class="align-left" width="91">'.number_format($budgetItem->sum_quantity,2,",",".").'</td>
								<td class="align-left" width="91">Precio Unitario:</td>
								<td class="align-left" width="91">'.$currency . ' ' . self::showPrice($budgetItem->getPriceCurrencyConverted()/$commissionFactor).'</td>
								<td class="align-left redDiscount" width="91">Descuento:</td>
								<td class="align-left redDiscount" width="91">'.$budgetItem->getDiscountType().' '. $discount .'</td>
								<td class="align-right" width="91">Total:</td>								
								<td class="align-right bold" width="91">'.$currency . ' ' . self::showPrice(($budgetItem->getTotalPriceCurrencyConvertedByService())/$commissionFactor).'</td>
								</tr>
								<tr><td colspan="8">'.$budgetItemAreasApp.'.</td></tr>
								</tbody></table>';
						}
						else 
						{
							$serviceContentBodyItem = $serviceContentBodyItem . '<table width="100%" class="tablaLimpia2 sinDesc">
								<tbody><tr>
								<td class="align-left" width="121">Cantidad:</td>
								<td class="align-left" width="121">'.number_format($budgetItem->sum_quantity,2,",",".").'</td>
								<td class="align-left" width="121">Precio Unitario:</td>
								<td class="align-left" width="121">'.$currency . ' ' . self::showPrice($budgetItem->getPriceCurrencyConverted()/$commissionFactor).'</td>
								<td class="align-right" width="121">Precio Final:</td>								
								<td class="align-right bold" width="121">'.$currency . ' ' . self::showPrice(($budgetItem->getTotalPriceCurrencyConvertedByService())/$commissionFactor).'</td>
								</tr>
								<tr><td colspan="8">'.$budgetItemAreasApp.'.</td></tr>
								</tbody></table>';
						}
						
						$serviceContentBodyItem = $serviceContentBodyItem . '</td>';
						$serviceContentBodyItem = $serviceContentBodyItem . '</tr>';
	
					}
					else 
					{
						$hasAccessory = true;
						
						$serviceContentBodyAccessory = $serviceContentBodyAccessory . '<tr class="'.$trClass.'">';
						$serviceContentBodyAccessory = $serviceContentBodyAccessory . '<td class="pdfTituloProd"><div class="bold">&bull; '.$short_description.'</div><table width="100%" class="tablaLimpia"><tbody><tr>'.$tdImage.$long_description.'</td></tr></tbody></table>';
							
							
						if($budgetItem->getDiscountCurrencyConverted() > 0)
						{
							if ($budgetItem->discount_type==0)
							{
								$discount = self::showPrice($budgetItem->discount);
							}
							else
							{
								$discount = self::showPrice($budgetItem->getDiscountCurrencyConverted()/$commissionFactor);
							}								
							$serviceContentBodyAccessory = $serviceContentBodyAccessory . '<table width="100%" class="tablaLimpia2 conDesc">
								<tbody><tr>
								<td class="align-left" width="91">Cantidad:</td>
								<td class="align-left" width="91">'.number_format($budgetItem->sum_quantity,2,",",".").'</td>
								<td class="align-left" width="91">Precio Unitario:</td>
								<td class="align-left" width="91">'.$currency . ' ' . self::showPrice($budgetItem->getPriceCurrencyConverted()/$commissionFactor).'</td>
								<td class="align-left redDiscount" width="91">Descuento:</td>
								<td class="align-left redDiscount" width="91">'.$budgetItem->getDiscountType().' '. self::showPrice($discount).'</td>
								<td class="align-right" width="91">Total:</td>
								
								<td class="align-right bold" width="91">'.$currency . ' ' . self::showPrice(($budgetItem->getTotalPriceCurrencyConvertedByService())/$commissionFactor).'</td>
								</tr></tbody></table>';
						}
						else
						{
							$serviceContentBodyAccessory = $serviceContentBodyAccessory . '<table width="100%" class="tablaLimpia2 sinDesc">
								<tbody><tr>
								<td class="align-left" width="121">Cantidad:</td>
								<td class="align-left" width="121">'.number_format($budgetItem->sum_quantity,2,",",".").'</td>
								<td class="align-left" width="121">Precio Unitario:</td>
								<td class="align-left" width="121">'.$currency . ' ' . self::showPrice($budgetItem->getPriceCurrencyConverted()/$commissionFactor).'</td>
								<td class="align-right" width="121">Precio Final:</td>
								
								<td class="align-right bold" width="121">'.$currency . ' ' . self::showPrice(($budgetItem->getTotalPriceCurrencyConvertedByService())/$commissionFactor).'</td>
								</tr></tbody></table>';
						}
							
						$serviceContentBodyAccessory = $serviceContentBodyAccessory . '</td>';
						$serviceContentBodyAccessory = $serviceContentBodyAccessory . '</tr>';
						
					}
					
				}
				$totalItemPrice = $modelBudget->getTotalPriceByService($budgetItemService->Id_service);
				$totalAccessoryPrice = $modelBudget->getTotalPriceAccessoryByService($budgetItemService->Id_service);
				$serviceContentBodyItem = $serviceContentBodyItem . '</tbody></table>
											<table class="table tableReadOnly tablaDatos">
												<tbody>										
													<tr>
														<td class="bold lastRow">Total Equipos </td>
														<td class="align-right bold lastRow">'.$currency . ' ' . self::showPrice($totalItemPrice/$commissionFactor).'</td>																
													</tr>
												</tbody>
											</table>';
				
				$serviceContentBodyAccessory = $serviceContentBodyAccessory . '</tbody></table>
									<table class="table tableReadOnly tablaDatos">
												<tbody>
													<tr>
														<td class="bold lastRow">Total Accesorios </td>
														<td class="align-right bold lastRow">'.$currency . ' ' . self::showPrice($totalAccessoryPrice/$commissionFactor).'</td>
													</tr>
												</tbody>
											</table>';				
				
				
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_budget = '.$idBudget);
				$criteria->addCondition('version_number = '.$versionNumber);
				
				if(isset($budgetItemService->Id_service))
					$criteria->addCondition('Id_service = '.$budgetItemService->Id_service);
				else
					$criteria->addCondition('Id_service is null');
					
				$criteria->addCondition('Id_product is null');
				
				$budgetItemAdditionals = BudgetItem::model()->findAll($criteria);
				
				$serviceContentBodyAdditional = '<div class="budgetSubtitle">Servicios</div>
												<table class="table tableReadOnly tablaDatos">
													<tbody>';
				if(count($budgetItemAdditionals) > 0)
					$hasAdditional = true;
				
				$totalAdditionalPrice = 0;
				foreach($budgetItemAdditionals as $budgetItemAdditional)
				{
					if ($budgetItemAdditional->discount_type==0)
					{
						$discount = self::showPrice($budgetItemAdditional->discount);
					}
					else
					{
						$discount = self::showPrice($budgetItemAdditional->getDiscountCurrencyConverted()/$commissionFactor);
					}
						
					$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<tr>';
						$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<td width="25%">'.$budgetItemAdditional->description.'</td>';
						$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<td class="align-right">'.$currency . ' ' . self::showPrice($budgetItemAdditional->getTotalPriceWODiscountCurrencyConverted()/$commissionFactor).'</td>';
						if($budgetItemAdditional->getDiscountCurrencyConverted()>0)
						{
							$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<td class="align-right redDiscount">DESC. '.$budgetItemAdditional->getDiscountType().' '. $discount.'</td>';								
						}else {
							$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<td class="align-right redDiscount"> &nbsp; </td>';															
						}
						$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<td class="align-right bold">'.$currency . ' ' . self::showPrice($budgetItemAdditional->getTotalPriceWOChildernCurrencyConverted()/$commissionFactor).'</td>';
					$serviceContentBodyAdditional = $serviceContentBodyAdditional . '</tr>';
					
					$totalAdditionalPrice = $totalAdditionalPrice + $budgetItemAdditional->getTotalPriceWOChildernCurrencyConverted();
				}
				
				$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<tr>';
				$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<td class="bold lastRow" colspan="2">Total Servicios</td>';
				$serviceContentBodyAdditional = $serviceContentBodyAdditional . '<td class="align-right bold lastRow" colspan="2">'.$currency . ' ' . self::showPrice($totalAdditionalPrice/$commissionFactor).'</td>';
				$serviceContentBodyAdditional = $serviceContentBodyAdditional . '</tr>';				
				
				$serviceContentBodyAdditional = $serviceContentBodyAdditional . '</tbody></table>';
				
				
				
				$totalServicePrice = 0;
				$serviceContentBodyTotal = '<div class="superBudgetEnd">&bull;&bull;&bull;</div><div class="superBudgetTabla noBreak">
												<table class="table tableReadOnly tablaDatos noBreak">
													<tbody class="noBreak">';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '<tr>';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '<td class="budgetSubtitle superBudgetTotal" colspan="2">RESUMEN  &bull; '.$serviceName.'</td>';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '</tr>';
					
				if($hasItems)
				{
					
					$serviceContentBodyTotal = $serviceContentBodyTotal . '<tr>';
						$serviceContentBodyTotal = $serviceContentBodyTotal . '<td>Equipos</td>';
						$serviceContentBodyTotal = $serviceContentBodyTotal . '<td class="align-right bold">'.$currency . ' ' . self::showPrice($totalItemPrice/$commissionFactor).'</td>';
					$serviceContentBodyTotal = $serviceContentBodyTotal . '</tr>';

					$totalServicePrice = $totalServicePrice + $totalItemPrice;
				}

				if($hasAccessory)
				{
					$serviceContentBodyTotal = $serviceContentBodyTotal . '<tr>';
						$serviceContentBodyTotal = $serviceContentBodyTotal . '<td>Accesorios</td>';
						$serviceContentBodyTotal = $serviceContentBodyTotal . '<td class="align-right bold">'.$currency . ' ' . self::showPrice($totalAccessoryPrice/$commissionFactor).'</td>';
					$serviceContentBodyTotal = $serviceContentBodyTotal . '</tr>';
					
					$totalServicePrice = $totalServicePrice + $totalAccessoryPrice;
				}

				if($hasAdditional)
				{
					$serviceContentBodyTotal = $serviceContentBodyTotal . '<tr>';
						$serviceContentBodyTotal = $serviceContentBodyTotal . '<td>Servicios</td>';
						$serviceContentBodyTotal = $serviceContentBodyTotal . '<td class="align-right bold">'.$currency . ' ' . self::showPrice($totalAdditionalPrice/$commissionFactor).'</td>';
					$serviceContentBodyTotal = $serviceContentBodyTotal . '</tr>';
					
					$totalServicePrice = $totalServicePrice + $totalAdditionalPrice;
				}

				$serviceContentBodyTotal = $serviceContentBodyTotal . '<tr>';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '<td colspan="2" class="newTotal">Total '.$currency . ' ' . self::showPrice($totalServicePrice/$commissionFactor).'</td>';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '</tr>';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '</tbody>';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '</table>';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '</div><! -- cierre div -->';
				$serviceContentBodyTotal = $serviceContentBodyTotal . '</div><! -- cierre page break -->';
				
				if(!$hasItems)
					$serviceContentBodyItem = '';
				
	 			if(!$hasAccessory)
	 				$serviceContentBodyAccessory = '';
				
	 			if(!$hasAdditional)
	 				$serviceContentBodyAdditional = '';
	 			
				$serviceContentBody = $serviceContentBodyItem . $serviceContentBodyAccessory . $serviceContentBodyAdditional . $serviceContentBodyTotal;
				$serviceContent = $serviceContent . $serviceContentHeader . $serviceContentBody;
				
				$arrayServiceTotal[] = array('serviceName'=>$serviceName, 'total'=>$totalServicePrice);
				//END ITEMS---------------------------------------------------------------
			}
			
		}
		
		
		//SERVICE SUMMARY---------------------------------------------------------------
		$totalServices = 0;
		foreach($arrayServiceTotal as $currentService)
		{
			if($currentService['total'] > 0)
			{
				$serviceSummaryContentBody = '<tr>';
				$serviceSummaryContentBody = $serviceSummaryContentBody . '<td>'.$currentService['serviceName'].'</td>';
				$serviceSummaryContentBody = $serviceSummaryContentBody . '<td class="align-right budgetMono bold">'.$currency . ' ' . self::showPrice($currentService['total']/$commissionFactor).'</td>';
				$serviceSummaryContentBody = $serviceSummaryContentBody . '</tr>';
				
				
				$serviceSummaryContent = $serviceSummaryContent . $serviceSummaryContentBody; 
				
				$serviceSummaryContentBodyNoPrice = '<tr>';
				$serviceSummaryContentBodyNoPrice = $serviceSummaryContentBodyNoPrice . '<td>&bull; '.$currentService['serviceName'].'</td>';
				$serviceSummaryContentBodyNoPrice = $serviceSummaryContentBodyNoPrice . '</tr>';
				
				$serviceSummaryContentNoPrice = $serviceSummaryContentNoPrice . $serviceSummaryContentBodyNoPrice;
				
				$totalServices = $totalServices + $currentService['total'];
			}
		}
		//END SERVICE SUMMARY---------------------------------------------------------------
		
		//TOTAL SUMMARY---------------------------------------------------------------
		$gridTotalSummary = '';
		
		$totalBudgetDiscount = 0;
		if($modelBudget->percent_discount > 0)
			$totalBudgetDiscount = round($totalServices * $modelBudget->percent_discount/100,2);
		
							$gridTotalSummary = '<tr>';
			$gridTotalSummary = $gridTotalSummary . '<td class="bold">Sub Total</td>';
			$gridTotalSummary = $gridTotalSummary . '<td colspan="2" class="align-right budgetMono">'.$currency . ' ' . self::showPrice($totalServices/$commissionFactor).'</td>';
		$gridTotalSummary = $gridTotalSummary . '</tr>';
		if($modelBudget->percent_discount>0)
		{
		$gridTotalSummary = $gridTotalSummary . '<tr>';
			$gridTotalSummary = $gridTotalSummary . '<td class="redDiscount">Descuento</td>';
			$gridTotalSummary = $gridTotalSummary . '<td class="budgetMono redDiscount">'.$modelBudget->percent_discount.'%</td>';
			$gridTotalSummary = $gridTotalSummary . '<td class="align-right budgetMono redDiscount">'.$currency .' ' . self::showPrice($totalBudgetDiscount/$commissionFactor).'</td>';
		$gridTotalSummary = $gridTotalSummary . '</tr>';
		}
		$gridTotalSummary = $gridTotalSummary . '<tr>';
			$gridTotalSummary = $gridTotalSummary . '<td class="finalTotal align-left">Total</td>';
			$gridTotalSummary = $gridTotalSummary . '<td class="finalTotal align-right" colspan="2">Total '.$currency . ' ' . self::showPrice(($totalServices - $totalBudgetDiscount)/$commissionFactor).'</td>';
		$gridTotalSummary = $gridTotalSummary . '</tr>';
		
		
		//END TOTAL SUMMARY---------------------------------------------------------------
		
		$caratula = '<div  style="page-break-after: always;">
						<div class="container" id="screenReadOnlyCaratula">
							<div class="logoBig"><img src="images/logoBIG.jpg" width="244" height="67"/></div>
							<table class="mainInfo">
								<tr>
									<td class="bigBold">'.$modelBudget->description.'</td>
								</tr>
								<tr>
									<td>'.$modelBudget->project->fullDescription.'</td>
								</tr>
								<tr>
									<td>Versi&oacute;n '.$modelBudget->version_number.'</td>
								</tr>
								<tr>
									<td>'.date("d/m/Y").'</td>
								</tr>
							</table>
							<div class="caratulaResumen">
								<div class="budgetSubtitle">Resumen de propuesta</div>
								<table class="table tableReadOnly">
	        						<tbody>
										'.$serviceSummaryContentNoPrice.'
							        </tbody>
							    </table>	
							</div>
						</div>
					</div>';
		
		$content = '
				<htmlpageheader name="myHeaderHide" style="display:none">
<div style="text-align: right;  font-size: 12px;">'.$modelBudget->description.' &bull; '.$modelBudget->version_number.'</div>
</htmlpageheader>
				<htmlpagefooter name="myFooter" style="display:none">
				<div style="text-align:center;  font-size: 12px;">P&aacute;gina {PAGENO} de {nbpg}</div>
				</htmlpagefooter>
				<div class="container" id="screenReadOnly">
						<div class="row budgetCabecera budgetBloque">
							<div class="col-sm-12">
								<table width="100%">
									<tbody>
										<tr>
											<td width="50%">		
												<div class="budgetPropuesta">Propuesta</div>
												<div class="budgetName">'.$modelBudget->description.'</div>
												<div class="budgetClient">'.$modelBudget->project->fullDescription.'</div>
												<div class="budgetVersion">Versi&oacute;n '.$modelBudget->version_number.'</div>
												<div class="budgetDate">'.date("d/m/Y").'</div>
											</td>
											<td width="50%" align="right">
												<img src="images/logoBIG.jpg" width="200" height="56"/>
											</td>
										</tr>
									</tbody>
								</table>		
							</div>
						</div>
						<div class="row budgetBloque">
							<div class="col-sm-12">
								'.$serviceContent.'
							</div>
						</div>
					</div><!-- CIERRE CONTAINER -->';
		
		$resumen = '<div class="container" id="screenReadOnlyCaratulaFinal">
						<div class="row budgetBloque">
							<div class="col-sm-12">
								<div class="logoBig"><img src="images/logoBIG.jpg" width="244" height="67"/></div>
								<table class="mainInfo">
									<tr>
										<td class="bigBold">'.$modelBudget->description.'</td>
									</tr>
									<tr>
										<td>'.$modelBudget->project->fullDescription.'</td>
									</tr>
									<tr>
										<td>Versi&oacute;n '.$modelBudget->version_number.'</td>
									</tr>
									<tr>
										<td>'.date("d/m/Y").'</td>
									</tr>
								</table>
								<div class="caratulaResumen">
									<div class="budgetSubtitle">Resumen de propuesta</div>
									<table class="table tableReadOnly">
	        							<tbody>
										'.$serviceSummaryContent.'
										<tr><td class="bold lastRow">TOTAL</td><td class="align-right bold lastRow">'.$currency . ' ' . self::showPrice($totalServices/$commissionFactor).'</td></tr>
							        	</tbody>
							      	</table>
								</div>
							</div>
						</div>
						<div class="row budgetBloque">
							<div class="col-sm-12">
							<div class="superBudgetTabla superBudgetTablaFinal noBreak">		
							<table class="table tableReadOnly tablaDatos noBreak">
												<tbody class="noBreak">
												<tr>
												<td class="budgetSubtitle superBudgetTotal" colspan="3">TOTAL PRESUPUESTO</td>
												</tr>
          										'.$gridTotalSummary.'
        									</tbody>
      									</table>
												</div>
												</div>
												
												
								
          					
							</div><!-- CIERRE CONTAINER -->';
	$clausulas = '<div class="budgetTitle">Cl&aacute;usulas del Contrato</div><div class="budgetClausulas">'.$modelBudget->clause_description .'</div>'; 
// 					<div class="budgetDesc">Maecenas gravida sem et nibh pretium, vel tempor leo imperdiet. Duis ultricies sagittis massa.
// 					</div>
// 					<div class="budgetSubtitle">Pago</div>
// 					<table class="table tableReadOnly tablaDatos">
//         				<tbody>
//           					<tr>
//            						<td>Maecenas gravida sem et nibh pretium, vel tempor leo imperdiet. Duis ultricies sagittis massa.</td>
//          					</tr>
//         				</tbody>
//       				</table>
// 					<div class="budgetSubtitle">DURACI&Oacute;N DE LA OFERTA</div>
// 					<table class="table tableReadOnly tablaDatos">
//         				<tbody>
//           					<tr>
//            						<td>Praesent urna augue, volutpat eleifend neque eu, tristique iaculis massa. Maec.</td>
//          					</tr>
//         				</tbody>
//       				</table>
// 					<div class="budgetSubtitle">TIPO DE CAMBIO</div>
// 					<table class="table tableReadOnly tablaDatos">
//         				<tbody>
// 							<tr>
//            						<td>Maecenas gravida sem et nibh pretium, vel tempor leo imperdiet. Duis ultricies sagittis massa.</td>
//          					</tr>
//         				</tbody>
//       				</table>
// 					<div class="budgetSubtitle">LEGALES</div>
// 					<table class="table tableReadOnly tablaDatos">
//         				<tbody>
//           					<tr>
//            						<td>Praesent urna augue, volutpat eleifend neque eu, tristique iaculis massa. Maec. Maecenas gravida sem et nibh pretium, vel tempor leo imperdiet.</td>
//        						</tr>
//         				</tbody>
//       				</table>
//				</div>
//				';
		
	//limpio el codigo que genera el editor, le saco todos los "styles" inline
	$clausulas = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $clausulas);
	$clausulas = preg_replace("/(<[^>]+) style='.*?'/i", "$1", $clausulas);
	$clausulas ='<div  style="page-break-before: always;">'.$clausulas.'</div>';	
		
		if($modelBudget->print_clause == 1)
			$result = $caratula.$content.$resumen.$clausulas;
		else 
			$result = $caratula.$content.$resumen;
		
		return $result;
	}
}
