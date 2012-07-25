<?php
	Yii::app()->clientScript->registerScript(__CLASS__.'#selector-budget', "
	");

		$settings= new Settings();
		$cu = $settings->getCurrencyShortDescription();

			echo CHtml::openTag('div',array("class"=>"left"));
			$this->widget('zii.widgets.CDetailView', array(
					'data'=>$modelProduct,
					'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
					'attributes'=>array(
							'code',
							array('label'=>$modelProduct->getAttributeLabel('Id_brand'),
									'type'=>'raw',
									'value'=>$modelProduct->brand->description
							),
							array('label'=>$modelProduct->getAttributeLabel('Id_supplier'),
									'type'=>'raw',
									'value'=>$modelProduct->supplier->business_name
							),
							array('label'=>$modelPriceListItem->getAttributeLabel('dealer_cost'),
									'type'=>'raw',
									'value'=>$modelPriceListItem->dealer_cost." ".$cu
							),
					),
			));
			echo CHtml::closeTag('div');
			echo CHtml::openTag('div',array("class"=>"right"));
			$this->widget('zii.widgets.CDetailView', array(
				'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
				'data'=>$modelProduct,
				'attributes'=>array(
					array('label'=>$modelProduct->getAttributeLabel('Id_category'),
							'type'=>'raw',
							'value'=>$modelProduct->category->description
					),
					array('label'=>$modelProduct->getAttributeLabel('Id_sub_category'),
							'type'=>'raw',
							'value'=>$modelProduct->subCategory->description
					),
					array('label'=>$modelProduct->getAttributeLabel('Id_product_type'),
							'type'=>'raw',
							'value'=>$modelProduct->productType->description
					),
				),
			));
			echo CHtml::closeTag('div');
			echo CHtml::openTag('div',array('style'=>'postion:relative;float:right;margin-right:35px;'));
			echo CHtml::label('Check All', 'selectedAll',array('id'=>'chkAll'));
			echo CHtml::checkBox('selectedAll',false);
			echo CHtml::closeTag('div');
				
			$modelBudgetItem->Id_product = $_POST['Id_product'];
			$this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$modelBudgetItem->searchByProductsPending(),
					'itemView'=>'_selectorBudget',
					'summaryText'=>''
					)); 
