<?php
	Yii::app()->clientScript->registerScript(__CLASS__.'#selector-budget', "
	");

		$settings= new Settings();
		$cu = $settings->getCurrencyShortDescription();
			echo CHtml::hiddenField('Product[Id]',$modelProduct->Id,array('id'=>'Selector_Id_product'));
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
			$isView = isset($modelPurchaseOrderItem);
			if(!$isView)
			{
				echo CHtml::openTag('div',array('style'=>'postion:relative;float:right;margin-right:35px;'));
				echo CHtml::label('Check All', 'selectedAll',array('id'=>'chkAll'));
				echo CHtml::checkBox('selectedAll',false);
				echo CHtml::closeTag('div');
				
			}
			if($isView)
			{
				$this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$modelBudgetItem->searchByPurchaseItemsAssigned($modelPurchaseOrderItem->Id),
						'itemView'=>'_selectorBudgetView',
						'summaryText'=>'',
						'emptyText'=>'',
				));				
			} 
			else
			{
				$modelBudgetItem->Id_product = $modelProduct->Id;
				$this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$modelBudgetItem->searchByProductsPending(),
						'itemView'=>'_selectorBudget',
						'summaryText'=>'',
						'emptyText'=>'',
				));
				
			}
?>
<div class="budget-selector-view-pop">
	<div class="view-left">
		<b><?php echo CHtml::encode('To stock'); ?>:</b>
	</div>
	<div class="view-end"style="float:right">
	<?php if ($isView):?>
		<b><?php
			$criteria = new CDbCriteria();
			$criteria->compare('Id_purchase_order_item', $modelPurchaseOrderItem->Id);
			$criteria->addCondition('Id_budget_item is NULL');
			$quantity = ProductItem::model()->count($criteria);
			echo CHtml::textField('BudgetItem[quantity]',$quantity,array('id'=>'BudgetItem_quantity','class'=>'txt-quantity','style'=>'width:30px;text-align:right;','disabled'=>'disabled')); 
		?></b>		
		<br />
	<?php else:?>
		<b><?php
			echo CHtml::textField('BudgetItem[quantity]',1,array('id'=>'BudgetItem_quantity','class'=>'txt-quantity','style'=>'width:30px;text-align:right;')); 
		?></b>		
		<b><?php
			echo CHtml::checkBox('BudgetItem[Id]',false,array('id'=>'BudgetItem_Id','value'=>0,'class'=>'check-selector'));
			?></b>
		<br />
	<?php endif;?>
	
	</div>
	
</div>
			
			
			