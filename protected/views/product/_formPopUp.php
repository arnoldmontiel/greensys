
<?php
$settings = new Settings();
$weightToShipping = MeasurementUnit::model()->findByAttributes(array('short_description'=>'kg'));

Yii::app()->clientScript->registerScript(__CLASS__.'#Product', "

fillVolumeTextBox('".ProductController::createUrl("product/AjaxFillVolume")."','txtVolume','product-form');
$('#display-weight').hide();

$('#weight').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	if($('#Id_measurement_unit_weight').val()!='"
		.$weightToShipping->Id.
		"')
	{
		fillWieghtTextBox('".ProductController::createUrl("product/AjaxFillWeight")."','Product_weight','product-form');
	}else{
		$('#Product_weight').val($('#weight').val());
	}
}).keyup(function(){
	validateNumber($(this));
});

$('#Id_measurement_unit_weight').change(function(){
	if($('#Id_measurement_unit_weight').val()!='"
		.$weightToShipping->Id.
		"')
	{
 		$('#display-weight').show();
		fillWieghtTextBox('".ProductController::createUrl("product/AjaxFillWeight")."','Product_weight','product-form');
	}else{
		$('#Product_weight').val($('#weight').val());
 		$('#display-weight').hide();
	}
});

$('#Product_msrp').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	if($('#Product_dealer_cost').val()!=0)
	{
		$('#Product_profit_rate').val(($('#Product_msrp').val()/$('#Product_dealer_cost').val()).toFixed(2));
	}
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_dealer_cost').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	if($('#Product_dealer_cost').val()!=0)
	{
		$('#Product_profit_rate').val(($('#Product_msrp').val()/$('#Product_dealer_cost').val()).toFixed(2));
	}
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_profit_rate').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_length').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("product/AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_width').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("product/AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_height').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("product/AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});
$('#Product_Id_measurement_unit_linear').change(function(){
	fillVolumeTextBox('".ProductController::createUrl("product/AjaxFillVolume")."','txtVolume','product-form');
})

$('#Product_weight').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_code').change(function(){
	$.post(
			'".ProductController::createUrl('product/AjaxCheckCode')."',
			{
			 	code: $(this).val(),
			 	id: '" . $model->Id."'
			 }).success(
					function(data) 
					{ 
						if(data != '')
						{
							$('#errorMsg').text(data);
							$('#errorMsg').animate({opacity: 'show'},2000);
							$('#errorMsg').animate({opacity: 'hide'},2000);
						}
					}
			);
});

$('#Product_need_rack').change(function(){
	if($(this).is(':checked'))
		{
		$('#Product_unit_rack').removeAttr('disabled');
		$('#Product_unit_fan').removeAttr('disabled');
		}
	else
	{
		$('#Product_unit_rack').val('');
		$('#Product_unit_rack').attr('disabled','disabled');
		$('#Product_unit_fan').val('');
		$('#Product_unit_fan').attr('disabled','disabled');
	}
});

$('#deleteIcon').click(function(){
	$.post(
			'".ProductController::createUrl('product/AjaxDeleteIcon')."',
			{
			 	id: '" . $model->Id."'
			 }).success(
					function(data) 
					{ 
						$('#iconArea').animate({opacity: 'hide'},2000);						
					}
			);
	return false;
});
");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'action'=>Yii::app()->createUrl("product/ajaxCreate")
		
)); 
?>

	<?php echo $form->errorSummary($model); ?>

	<?php if (!$model->isNewRecord):?>
		<div class="row">
			<?php echo $form->labelEx($model,'code'); ?>
			<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'code'); ?>
			<p id="errorMsg" class="messageError"></p>
		</div>
	<?php endif; ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'code_supplier'); ?>
		<?php echo $form->textField($model,'code_supplier',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'code_supplier'); ?>
	</div>

	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_brand'); ?>
			<?php echo $form->dropDownList($model, 'Id_brand', CHtml::listData(
	    			Brand::model()->findAll(), 'Id', 'description')); 
			?>
			<?php echo $form->error($model,'Id_brand'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Brand','#',array('onclick'=>'jQuery("#CreateBrand").dialog("open"); return false;'));?>
		</div>
	</div>
	
	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_supplier'); ?>
			<?php echo $form->dropDownList($model, 'Id_supplier', CHtml::listData(
	    			Supplier::model()->findAll(), 'Id', 'business_name')); 
			?>
			<?php echo $form->error($model,'Id_supplier'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Supplier','#',array('onclick'=>'jQuery("#CreateSupplier").dialog("open"); return false;'));?>
		</div>
	</div>

	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_category'); ?>
			<?php
			$categories = Category::model()->findAll();
			echo $form->dropDownList($model, 'Id_category', CHtml::listData(
	    			$categories, 'Id', 'description'),
				array(
					'ajax' => array(
					'type'=>'POST', 
					'url'=>CController::createUrl('product/AjaxFillSubCategory'), 
					'update'=>'#Product_Id_sub_category',
		))); 
			?>
			<?php echo $form->error($model,'Id_category'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Category','#',array('onclick'=>'jQuery("#CreateCategory").dialog("open"); return false;'));?>
		</div>
	</div>
	
	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_sub_category'); ?>
			
			<?php
				$subCategories = array();
				if(!empty($categories))
					$subCategories = $categories[0]->subCategorys;
				$subCategory = CHtml::listData($subCategories, 'Id', 'description');
			?>
			<?php echo $form->dropDownList($model, 'Id_sub_category', $subCategory); ?>
			<?php echo $form->error($model,'Id_sub_category'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Sub Category','#',array('onclick'=>'jQuery("#CreateSubCategory").dialog("open"); return false;'));?>
		</div>
		</div>
	
	
	
	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_nomenclator'); ?>
			<?php echo $form->dropDownList($model, 'Id_nomenclator', CHtml::listData(
	    			Nomenclator::model()->findAll(), 'Id', 'description')); 
			?>
			<?php echo $form->error($model,'Id_nomenclator'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Nomenclator','#',array('onclick'=>'jQuery("#CreateNomenclator").dialog("open"); return false;'));?>
		</div>		
	</div>
	
	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_product_type'); ?>
			<?php echo $form->dropDownList($model, 'Id_product_type', CHtml::listData(
	    			ProductType::model()->findAll(), 'Id', 'description')); 
			?>
			<?php echo $form->error($model,'Id_product_type'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Type','#',array('onclick'=>'jQuery("#CreateProductType").dialog("open"); return false;'));?>
		</div>		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description_customer'); ?>
		<?php echo $form->textField($model,'description_customer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_supplier'); ?>
		<?php echo $form->textField($model,'description_supplier',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discontinued'); ?>
		
		<?php echo $form->checkBox($model,'discontinued'); ?>
		<?php echo $form->error($model,'discontinued'); ?>
	</div>

	<div class="row">
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'length'); ?>
			<?php echo $form->textField($model,'length',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'length'); ?>
		</div>

		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'width'); ?>
			<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'width'); ?>
		</div>

		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'height'); ?>
			<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'height'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'Id_measurement_unit_linear'); ?>
			<?php				
				$measureType = MeasurementType::model()->findByAttributes(array('description'=>'linear'));
				 
				echo $form->dropDownList($model, 'Id_measurement_unit_linear', CHtml::listData(
	    			MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id)), 'Id', 'short_description')); 
			?>
			<?php echo $form->error($model,'Id_measurement_unit_linear'); ?>
		</div>
		<div style="width: 140px; display: inline-block;">
			<?php echo CHtml::label("Volume", "Product_volume"); ?>
			<?php echo CHtml::textField("txtVolume","",array('style'=>'width:90px;')); ?>
			<?php echo $settings->getMUShortDescription(Settings::MT_VOLUME) ?>
		</div>

	</div>
	<div class="row">

		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'weight'); ?>
			<?php echo CHtml::textField("weight",$model->weight,array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'weight'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'Id_measurement_unit_weight'); ?>
			<?php				
				$measureType = MeasurementType::model()->findByAttributes(array('description'=>'weight'));
				$measuremetUnit = MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id));
				echo CHtml::dropDownList('Id_measurement_unit_weight', '',CHtml::listData(
	    			$measuremetUnit, 'Id', 'short_description')); 
			?>
			<?php echo $form->error($model,'Id_measurement_unit_weight'); ?>
		</div>
		<div id="display-weight" style="display: inline-block;">
			<div style="width: 120px; display: inline-block;">
				<?php echo $form->labelEx($model,'weight'); ?>
				<?php echo $form->textField($model,'weight',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'weight'); ?>
			</div>
			<div style="width: 120px; display: inline-block;">
				<?php echo $form->labelEx($model,'Id_measurement_unit_weight'); ?>
				<?php echo $form->dropDownList($model,'Id_measurement_unit_weight', CHtml::listData(
	    			$measuremetUnit, 'Id', 'short_description'));?> 
				<?php //echo $form->textField($model,'Id_measurement_unit_weight',array('size'=>10,'maxlength'=>10,"disabled"=>"disabled")); ?>
				<?php echo $form->error($model,'Id_measurement_unit_weight'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div style="width: 160px; display: inline-block;">
			<?php echo $form->labelEx($model,'msrp'); ?>
			<?php echo $form->textField($model,'msrp',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $settings->getCurrencyShortDescription() ?>
			<?php echo $form->error($model,'msrp'); ?>
		</div>
		<div style="width: 160px; display: inline-block;">
			<?php echo $form->labelEx($model,'dealer_cost'); ?>
			<?php echo $form->textField($model,'dealer_cost',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $settings->getCurrencyShortDescription() ?>
			<?php echo $form->error($model,'dealer_cost'); ?>
		</div>
		<div style="width: 160px; display: inline-block;">
			<?php echo $form->labelEx($model,'profit_rate'); ?>
			<?php echo $form->textField($model,'profit_rate',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo '%' ?>
			<?php echo $form->error($model,'profit_rate'); ?>
		</div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Id_volts'); ?>
		<?php echo $form->dropDownList($model,'Id_volts', CHtml::listData(
			Volts::model()->findAll(), 'Id', 'volts'),array('prompt'=>'None',));?> 
		<?php echo $form->error($model,'Id_volts'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'need_rack'); ?>
		<?php echo $form->checkBox($model,'need_rack'); ?>
		<?php echo $form->error($model,'need_rack'); ?>
	</div>
	
	<div class="row">
	<div style="width: 160px; display: inline-block;" id="div-unit-rack">
		<?php echo $form->labelEx($model,'unit_rack'); ?>
		<?php $racks = CHtml::listData($ddlRacks, 'Id', 'description');?>
		<?php
			if($model->need_rack) 
				echo $form->dropDownList($model, 'unit_rack', $racks);
			else 
				echo $form->dropDownList($model, 'unit_rack', $racks, array('disabled'=>'disabled'));
		?>
		<?php echo $form->error($model,'unit_rack'); ?>
	</div>
	<div style="width: 160px; display: inline-block;" id="div-unit-rack">
		<?php echo $form->labelEx($model,'unit_fan'); ?>
		<?php $racks = CHtml::listData($ddlRacks, 'Id', 'description');?>
		<?php
			if($model->need_rack) 
				echo $form->dropDownList($model, 'unit_fan', $racks);
			else 
				echo $form->dropDownList($model, 'unit_fan', $racks, array('disabled'=>'disabled'));
		?>
		<?php echo $form->error($model,'unit_rack'); ?>
	</div>
	</div>
				
	<div class="row">
		<?php echo $form->labelEx($model,'time_instalation'); ?>
		<?php echo $form->textField($model,'time_instalation'); ?>
		<?php echo $form->error($model,'time_instalation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'color'); ?>
		<?php echo $form->textField($model,'color'); ?>
		<?php echo $form->error($model,'color'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'other'); ?>
		<?php echo $form->textField($model,'other'); ?>
		<?php echo $form->error($model,'other'); ?>
	</div>
	
	<div class="row">
	
		<?php echo $form->labelEx($model,'hide'); ?>
		<?php echo $form->checkBox($model,'hide'); ?>
		<?php echo $form->error($model,'hide'); ?>
	</div>
<?php
$hyperLinks = CHtml::listData($modelHyperlink, 'Id','description');

$this->widget('ext.linkcontainer.linkcontainer', array(
	'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
	'items'=>$hyperLinks,
			));
?>


<?php

 $this->widget('ext.richtext.jwysiwyg', array(
 	'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
 	'notes'=> isset($modelNote)?$modelNote->note:""
 			));

?>

<?php $this->endWidget(); ?>
</div><!-- form -->


	<?php 
	$this->widget('ext.processingDialog.processingDialog', array(
			'buttons'=>array('none'),
			'idDialog'=>'wating',
	));
	//Brand
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateBrand',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Create Brand',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateBrand").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("brand/ajaxCreate").'", $("#brand-form").serialize(),
							function(data) {
								if(data!=null)
								{
									$("#Product_Id_brand").append(
    		  		  					$("<option></option>").val(data.Id).html(data.description)
    								);
									jQuery("#CreateBrand").dialog( "close" );
								}
							jQuery("#wating").dialog("close");
						},"json"
					);

				}'),
			),
	));
	$modelBrand = new Brand;
	echo $this->renderPartial('../brand/_formPopUp', array('model'=>$modelBrand));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
	//Supplier
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateSupplier',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Create Supllier',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateSupplier").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("supplier/ajaxCreate").'", $("#supplier-form").serialize(),
							function(data) {
								if(data!=null)
								{							
									$("#Product_Id_supplier").append(
										$("<option></option>").val(data.Id).html(data.business_name)
									);
									jQuery("#CreateSupplier").dialog( "close" );							
								}	
								jQuery("#wating").dialog("close");
						},"json"
					);
	
	}'),
			),
	));
	$modelSupplier=new Supplier;
	$modelContact = new Contact;
	$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$modelContact->Id,'Id_entity_type'=>SupplierController::getEntityTypeStatic()));
	echo $this->renderPartial('../supplier/_formPopUp', 
			array(
				'model'=>$modelSupplier,
				'modelContact'=>$modelContact,
				'modelHyperlink'=>$modelHyperlink
				)
			);
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	//Category
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateCategory',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Create Category',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateCategory").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("category/ajaxCreate").'", $("#category-form").serialize(),
							function(data) {
								if(data!=null)
								{														
									$("#Product_Id_category").append(
										$("<option></option>").val(data.Id).html(data.description)
									);
									jQuery("#CreateCategory").dialog( "close" );
								}
								jQuery("#wating").dialog("close");
							},"json"
					);
	
	}'),
			),
	));
	$modelCategory = new Category;
	echo $this->renderPartial('../category/_formPopUp', array('model'=>$modelCategory));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	//SubCategory
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateSubCategory',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Create SubCategory',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateSubCategory").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("subCategory/ajaxCreate").'", $("#sub-category-form").serialize(),
							function(data) {
								if(data!=null)
								{														
									jQuery.post("'.Yii::app()->createUrl("subCategory/ajaxAssignToCategory").'",
									 {"Id_sub_category":data.Id,"Id_category":$("#Product_Id_category").val()},
										function(data) {
											if(data!=null)
											{																					
												$("#Product_Id_sub_category").append(
													$("<option></option>").val(data.Id).html(data.description)
												);
												jQuery("#CreateSubCategory").dialog( "close" );
											}
										jQuery("#wating").dialog("close");
									},"json"
								);
								}
								else
								{
									jQuery("#wating").dialog("close");
								}																
						},"json"
					);	
	}'),
			),
	));
	$modelSubCategory = new SubCategory;
	echo $this->renderPartial('../subCategory/_formPopUp', array('model'=>$modelSubCategory));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	//Nomenclator
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateNomenclator',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Create Nomenclator',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateNomenclator").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("nomenclator/ajaxCreate").'", $("#nomenclator-form").serialize(),
							function(data) {
								if(data!=null)
								{
									$("#Product_Id_nomenclator").append(
										$("<option></option>").val(data.Id).html(data.description)
									);
									jQuery("#CreateNomenclator").dialog( "close" );
								}
							jQuery("#wating").dialog("close");
						},"json"
					);
	
	}'),
			),
	));
	$modelNomenclator = new Nomenclator();
	echo $this->renderPartial('../nomenclator/_formPopUp', array('model'=>$modelNomenclator));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	//ProductType
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateProductType',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Create Product Type',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateProductType").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("productType/ajaxCreate").'", $("#product-type-form").serialize(),
							function(data) {
								if(data!=null)
								{
									$("#Product_Id_product_type").append(
										$("<option></option>").val(data.Id).html(data.description)
									);
									jQuery("#CreateProductType").dialog( "close" );
								}
							jQuery("#wating").dialog("close");
							},"json"
					);
	
			}'),
			),
	));
	$modelProductType = new ProductType();
	echo $this->renderPartial('../productType/_formPopUp', array('model'=>$modelProductType));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	
	?>