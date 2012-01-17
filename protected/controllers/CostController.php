<?php

class CostController extends Controller
{
	public function actionIndex()
	{
		$modelPriceList = new PriceList('search');
		$modelImporter = new Importer('search');
		$model = new Cost('search');
		
		$modelPriceList->unsetAttributes();
		$modelImporter->unsetAttributes();
		$model->unsetAttributes();
		
		if(isset($_GET['Cost']))
		{
			$model->attributes=$_GET['Cost'];
		}
		

		if(isset($_GET['PriceList']))
		{
			$modelPriceList->attributes=$_GET['PriceList'];
			$model->Id_priceList = $modelPriceList->Id;
		}
		if(isset($_GET['Importer']))
		{
			$modelImporter->attributes=$_GET['Importer'];
			$model->Id_importer = $modelImporter->Id;
		}
		
		
		$this->render('index',
			array('model'=>$model,
				'modelPriceList'=>$modelPriceList,
				'modelImporter'=>$modelImporter,
			)
		);
	}
	public function actionAjaxFillSidebar()
	{
		if(isset($_POST['PriceList']['Id']))
		{
			$priceList = PriceList::model()->findByPk($_POST['PriceList']['Id']);
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo "Selected List:";
			echo CHtml::closeTag("ul");
			echo CHtml::openTag("ul");
	
			echo CHtml::openTag("li");
			echo $priceList->description;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo $priceList->supplier->business_name;
			echo CHtml::closeTag("li");
				
			echo CHtml::openTag("li");
			echo $priceList->date_validity;
			echo CHtml::closeTag("li");
	
			echo CHtml::closeTag("ul");	
		}
		if(isset($_POST['Importer']['Id']))
		{
			$importer = Importer::model()->findByPk($_POST['Importer']['Id']);
			$shippingParameter = 
				ShippingParameter::model()->findByAttributes(
					array('Id_importer'=>$importer->Id,'current'=>1)
				);
			echo CHtml::openTag("hr");
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo "Selected Importer:";
			echo CHtml::closeTag("ul");

			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));			
			echo CHtml::openTag("li");
			echo $importer->contact->description;
			echo CHtml::closeTag("li");			
			echo CHtml::openTag("li");
			echo $importer->contact->telephone_1;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo $importer->contact->email;
			echo CHtml::closeTag("li");
			echo CHtml::closeTag("ul");
			
			echo CHtml::openTag("hr");
				
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo "Shipping:";
			echo CHtml::closeTag("ul");
			
		
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo CHtml::openTag("li");
			echo $shippingParameter->description;
			echo CHtml::closeTag("li");
			echo CHtml::closeTag("ul");
				
			echo CHtml::openTag("hr");
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo "Air:";
			echo CHtml::closeTag("ul");
				
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo CHtml::openTag("li");
			$unitCost = MeasurementUnit::model()->findByPk($shippingParameter->shippingParameterAir->Id_measurement_unit_cost)->short_description;
			$sizesUnits = MeasurementUnit::model()->findByPk($shippingParameter->shippingParameterAir->Id_measurement_unit_sizes_max)->short_description;
			echo $shippingParameter->shippingParameterAir->cost_measurement_unit.
			" US$ / ".
			$unitCost;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo "H (Max):".$shippingParameter->shippingParameterAir->height_max." ".$sizesUnits;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo "L (Max):".$shippingParameter->shippingParameterAir->length_max." ".$sizesUnits;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo "W (Max):".$shippingParameter->shippingParameterAir->width_max." ".$sizesUnits;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo "Vol (Max): ".$shippingParameter->shippingParameterAir->volume_max." m3";
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo "Days: ".$shippingParameter->shippingParameterAir->days;
			echo CHtml::closeTag("li");
			echo CHtml::closeTag("ul");
				
			echo CHtml::openTag("hr");
				
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo "Maritime:";
			echo CHtml::closeTag("ul");
			
			echo CHtml::openTag("ul",array("style"=>"margin: 0 1em 1em 0;"));
			echo CHtml::openTag("li");
			$unitCost = MeasurementUnit::model()->findByPk($shippingParameter->shippingParameterMaritime->Id_measurement_unit_cost)->short_description;
			echo $shippingParameter->shippingParameterMaritime->cost_measurement_unit.
						" US$ / ".
			$unitCost;
			echo CHtml::closeTag("li");
			echo CHtml::openTag("li");
			echo "Days: ".$shippingParameter->shippingParameterMaritime->days;
			echo CHtml::closeTag("li");
				
		}
		
	}	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}