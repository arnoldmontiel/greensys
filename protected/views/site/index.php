<?php $this->pageTitle=Yii::app()->name; ?>

<div>
	<div class="home-row" >
		<div class="home-left-view" >
			<div class="home-title-view" >
				<?php echo Yii::app()->lc->t('Master Data');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Brand'),array('/brand/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Supplier'),array('/supplier/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Category'),array('/category/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Sub Category'),array('/subCategory/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Nomenclator'),array('/nomenclator/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Guild'),array('/guild/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Product Requirements'),array('/productRequirement/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Product'),array('/product/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Importer'),array('/importer/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Price List'),array('/pricelist/index'));?>			
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
		</div>
	</div>
	<div class="home-row" >
		<div class="home-left-view" >
			<div class="home-title-view" >
			<?php echo Yii::app()->lc->t('Price List');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Manage'),array('/pricelist/admin'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Create'),array('/pricelist/create'));?>			
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('List'),array('/pricelist/index'));?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Assign Products'),array('/pricelist/priceListItem'));?>
			</div>
		</div><!-- end  home-left-view -->
		<div class="home-right-view" >
			<div class="home-title-view" >
				<?php echo Yii::app()->lc->t('Reports');?>
			</div>
			<div class="home-item-view" >
			<?php echo CHtml::link(Yii::app()->lc->t('Cost'),array('/cost/index'));?>
			</div>
		</div> <!-- end  home-right-view -->
	</div>	<!-- end  home-row -->
</div>
