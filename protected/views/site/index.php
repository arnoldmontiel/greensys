<?php $this->pageTitle=Yii::app()->name; ?>

<div>
	<div class="home-row" >
		<div class="home-left-view" >
			<div class="home-title-view" >
				<?php echo Yii::app()->lc->t('Master Data');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Customer'),array('/customer/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Area'),array('/area/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Project'),array('/project/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Supplier'),array('/supplier/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Importer'),array('/importer/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Stock'),array('/stock/index'));?>			
			</div>
		</div>
		<div class="home-right-view" >
			<div class="home-title-view" >
				<?php echo Yii::app()->lc->t('Products');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Manage'),array('/product/admin'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Create'),array('/product/create'));?>			
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('List'),array('/product/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Assign Groups'),array('/product/productGroup'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Assign Requirements'),array('/product/productRequirement'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Import from Excel'),array('/product/importFromExcel'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Import Measures from Excel'),array('/product/importMeasuresFromExcel'));?>
			</div>
		</div>
	</div>
	<div class="home-row" >
		<div class="home-left-view" >
			<div class="home-title-view" >
			<?php echo Yii::app()->lc->t('Price List');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Manage'),array('/priceList/admin'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Create'),array('/priceList/create'));?>			
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('List'),array('/priceList/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Assign Products'),array('/priceList/priceListItem'));?>
			</div>
		</div><!-- end  home-left-view -->
		<div class="home-right-view" >
			<div class="home-title-view" >
				<?php echo Yii::app()->lc->t('Reports');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Cost'),array('/cost/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Stock'),array('/stockSummary/index'));?>
			</div>
		</div> <!-- end  home-right-view -->
	</div>	<!-- end  home-row -->
	<div class="home-row" >
		<div class="home-left-view" >
			<div class="home-title-view" >
			<?php echo Yii::app()->lc->t('Budget');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Manage'),array('/budget/admin'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Create'),array('/budget/create'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('List'),array('/budget/index'));?>
			</div>
		</div><!-- end  home-left-view -->
		<div class="home-right-view" >
			<div class="home-title-view" >
				<?php echo Yii::app()->lc->t('Purchase Order');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Manage'),array('/purchaseOrder/admin'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Create'),array('/purchaseOrder/create'));?>			
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('List'),array('/purchaseOrder/index'));?>
			</div>
		</div> <!-- end  home-right-view -->
	</div>	<!-- end  home-row -->
	<div class="home-row" >
		<div class="home-left-view" >
			<div class="home-title-view" >
			<?php echo Yii::app()->lc->t('Settings');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Settings'),array('/setting/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Measurement'),array('/measurement/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Volts'),array('/volts/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Currency'),array('/currency/index'));?>
			</div>
		</div><!-- end  home-left-view -->
	</div>	<!-- end  home-row -->
</div>
