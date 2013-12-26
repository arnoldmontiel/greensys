<?php 
$settings = new Settings();
$weightToShipping = MeasurementUnit::model()->findByAttributes(array('short_description'=>'kg'));
Yii::app()->clientScript->registerScript(__CLASS__.'#Product', "
fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');

$('#createBrand').click(
		function(){
			$.post(
			'".ProductController::createUrl('brand/AjaxShowCreateModal')."',{field_caller:'Product_Id_brand'}).success(
					function(data)
					{
					if(data!=null)
					{	
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');
					}
				}
			);
		return false;
		}
		);

$('#createSupplier').click(
		function(){
			$.post(
			'".ProductController::createUrl('supplier/AjaxShowCreateModal')."',{field_caller:'Product_Id_supplier'}).success(
					function(data)
					{
					if(data!=null)
					{	
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');
					}
				}
			);
		return false;
		}
		);
					
$('#createCategory').click(
		function(){
			$.post(
			'".ProductController::createUrl('category/AjaxShowCreateModal')."',{field_caller:'Product_Id_category'}).success(
					function(data)
					{
					if(data!=null)
					{	
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');
					}
				}
			);
		return false;
		}
		);

$('#createSubcategory').click(
		function(){
			$.post(
			'".ProductController::createUrl('subCategory/AjaxShowCreateModal')."',{field_caller:'Product_Id_sub_category',field_caller_category:'Product_Id_category'}).success(
					function(data)
					{
					if(data!=null)
					{	
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');
					}
				}
			);
		return false;
		}
);
$('#createNomenclator').click(
		function(){
			$.post(
			'".ProductController::createUrl('nomenclator/AjaxShowCreateModal')."',{field_caller:'Product_Id_nomenclator'}).success(
					function(data)
					{
					if(data!=null)
					{	
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');
					}
				}
			);
		return false;
		}
);
					
					
$('#display-weight').hide();

$('#cancel').click(function()
{
	window.location = '".ProductController::createUrl("index")."';
});		
		$('#saveAndOther').click(function()
{
	$('#other').val('1');
});		
$('#weight').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	if($('#Product_Id_measurement_unit_weight').val()!='"
		.$weightToShipping->Id.
		"')
	{
		fillWieghtTextBox('".ProductController::createUrl("AjaxFillWeight")."','Product_weight','product-form');
	}else{
		$('#Product_weight').val($('#weight').val());
	}
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_Id_measurement_unit_weight').change(function(){
	if($('#Product_Id_measurement_unit_weight').val()!='"
				.$weightToShipping->Id.
				"')
	{
 		$('#display-weight').show();
		fillWieghtTextBox('".ProductController::createUrl("AjaxFillWeight")."','Product_weight','product-form');
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
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_width').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_height').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});
$('#Product_Id_measurement_unit_linear').change(function(){
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
})

$('#Product_weight').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_code').change(function(){
	$.post(
			'".ProductController::createUrl('AjaxCheckCode')."',
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
			'".ProductController::createUrl('AjaxDeleteIcon')."',
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
<div class="container" id="screenAgregarProductos">
  <h1 class="pageTitle">Agregar Producto</h1>
		<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'product-form',
		'enableAjaxValidation'=>true,
		'htmlOptions'=>array('enctype'=>'multipart/form-data','enableClientValidation'=>true),
		)); 
		?>
  <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">Informaci&oacute;n B&aacute;sica</div>
      
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;">
            <?php echo $form->labelEx($model,'model'); ?>
            </td>
            <td width="80%">
            	<?php echo $form->textField($model,'model',array('class'=>"form-control")); ?>
            </td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'part_number'); ?></td>
            <td><?php echo $form->textField($model,'part_number',array('class'=>"form-control")); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_brand'); ?></td>
            <td class="combined"><?php echo $form->dropDownList($model, 'Id_brand', CHtml::listData(
	    			Brand::model()->findAll(), 'Id', 'description'),array('class'=>"form-control")); 
			?>
              <button id="createBrand" type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Marca</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_supplier'); ?></td>
            <td class="combined"><?php echo $form->dropDownList($model, 'Id_supplier', CHtml::listData(
	    			Supplier::model()->findAll(), 'Id', 'business_name'),array('class'=>"form-control")); 
			?>
              <button id="createSupplier" type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Proveedor</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_category'); ?></td>
            <td class="combined"><?php echo $form->dropDownList($model, 'Id_category', CHtml::listData(
	    			Category::model()->findAll(), 'Id', 'description'),
					array(
						'class'=>"form-control",
						'ajax' => array(
						'type'=>'POST', 
						'url'=>CController::createUrl('AjaxFillSubCategory'), 
						'update'=>'#Product_Id_sub_category',
						))); 
			?>
              <button id="createCategory" type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Categor&iacute;a</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_sub_category'); ?></td>
            <td class="combined"><?php $subCategory = CHtml::listData($ddlSubCategory, 'Id', 'description');?>
			<?php echo $form->dropDownList($model, 'Id_sub_category', $subCategory,array(
						'class'=>"form-control")); ?>
              <button id="createSubcategory" type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Subcat.</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_nomenclator'); ?></td>
            <td class="combined"><?php echo $form->dropDownList($model, 'Id_nomenclator', CHtml::listData(
	    			Nomenclator::model()->findAll(), 'Id', 'description'),array('class'=>"form-control")); 
			?>
              <button id="createNomenclator" type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Nomenc.</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_product_type'); ?></td>
            <td class="combined"><?php echo $form->dropDownList($model, 'Id_product_type', CHtml::listData(
	    			ProductType::model()->findAll(), 'Id', 'description'),array('class'=>"form-control")); 
			?>
              <button id="createProductType"  type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Tipo</button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">MEDIDAS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'length'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'length',array('class'=>'form-control')); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'width'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'width',array('class'=>'form-control')); ?></td>
           </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'height'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'height',array('class'=>'form-control','type'=>'number')); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_measurement_unit_linear'); ?></td>
            <td><?php				
				$measureType = MeasurementType::model()->findByAttributes(array('description'=>'linear'));
				echo $form->dropDownList($model, 'Id_measurement_unit_linear', CHtml::listData(
	    			MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id)), 'Id', 'short_description'),array('class'=>'form-control'));?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo CHtml::label("Volume", "Product_volume"); ?></td>
            <td><?php echo CHtml::textField("txtVolume","",array('class'=>'form-control')); ?><?php echo $settings->getMUShortDescription(Settings::MT_VOLUME) ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_measurement_unit_weight'); ?></td>
            <td><?php				
				$measureType = MeasurementType::model()->findByAttributes(array('description'=>'weight'));
				$measuremetUnit = MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id));
				echo $form->dropDownList($model, 'Id_measurement_unit_weight',CHtml::listData(
	    			$measuremetUnit, 'Id', 'short_description'),array('class'=>'form-control')); 
			?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'weight'); ?></td>
            <td><?php echo CHtml::textField("weight",$model->weight,array('class'=>'form-control')); ?></td>
          </tr>
          <tr id="display-weight">
            <td style="text-align:right;"><?php echo $form->labelEx($model,'weight'); ?></td>
            <td><?php echo $form->textField($model,'weight',array('class'=>'form-control')); ?></td>
          </tr>
          </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 --> 
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">EXTRA</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'hide'); ?></td>
            <td width="80%"><div class="checkbox">
                <label>
                  <?php echo $form->checkBox($model,'hide'); ?>
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'discontinued'); ?></td>
            <td><div class="checkbox">
                <label>
                  <?php echo $form->checkBox($model,'discontinued'); ?>
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Id_volts'); ?></td>
            <td><?php echo $form->dropDownList($model,'Id_volts', CHtml::listData(
			Volts::model()->findAll(), 'Id', 'volts'),array('prompt'=>'Seleccione Voltaje','class'=>'form-control'));?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'need_rack'); ?></td>
            <td><div class="checkbox">
                <label>
                  <?php echo $form->checkBox($model,'need_rack'); ?>
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'unit_rack'); ?></td>
            <td><?php $racks = CHtml::listData($ddlRacks, 'Id', 'description');?>
			<?php
			if($model->need_rack) 
				echo $form->dropDownList($model, 'unit_rack', $racks);
			else 
				echo $form->dropDownList($model, 'unit_rack', $racks, array('disabled'=>'disabled','class'=>'form-control'));
			?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'unit_fan'); ?></td>
            <td><?php $racks = CHtml::listData($ddlRacks, 'Id', 'description');?>
		<?php
			if($model->need_rack) 
				echo $form->dropDownList($model, 'unit_fan', $racks);
			else 
				echo $form->dropDownList($model, 'unit_fan', $racks, array('disabled'=>'disabled','class'=>'form-control'));
		?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'color'); ?></td>
            <td><?php echo $form->textField($model,'color', array('class'=>'form-control')); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'Ícon'); ?></td>
            <td><INPUT TYPE=FILE NAME="upfile"></td>
				<?php 
				if($model->Id_multimedia)
				{
					$this->widget('ext.highslide.highslide', array(
													'smallImage'=>"images/".$model->multimedia->file_name_small,
													'image'=>"images/".$model->multimedia->file_name,
													'caption'=>'',
													'Id'=>$model->Id_multimedia,
													'small_width'=>240,
													'small_height'=>180,
					
					));
					echo CHtml::button('Delete Icon',array('id'=>'deleteIcon'));
				}
				?>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">INPUTS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'input_terminals'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'input_terminals', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'input_signals'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'input_signals', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'input_labels'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'input_labels', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">OUTPUTS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'output_terminals'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'output_terminals', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'output_signals'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'output_signals', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'output_labels'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'output_signals', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">HORAS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'time_instalation'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'time_instalation', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'time_programation'); ?></td>
            <td><?php echo $form->textField($model,'time_programation', array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>  
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
   <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">PRECIOS</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'msrp'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'msrp', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dealer_cost'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dealer_cost', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'profit_rate'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'profit_rate', array("class"=>"form-control")); ?></td>
          </tr>
         </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">COSTOS UNIDAD</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'unit_cost_A'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'unit_cost_A', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'unit_cost_B'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'unit_cost_B', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'unit_cost_C'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'unit_cost_C', array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">PRECIOS UNIDAD</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'unit_price_A'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'unit_price_A', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'unit_price_B'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'unit_price_B', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'unit_price_C'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'unit_price_C', array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>  
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
   <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">ENV&iacute;O</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'default_broker'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'default_broker', array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'default_send_format'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'default_send_format', array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">MEDIDAS CAJA ENV&iacute;O</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'shipping_box_lenght'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'shipping_box_lenght',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'shipping_box_width'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'shipping_box_width',array("class"=>"form-control")); ?></td>
		  </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'shipping_box_height'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'shipping_box_height',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'shipping_box_volume'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'shipping_box_volume',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'shipping_box_weight'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'shipping_box_weight',array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">PESOS DIMENSIONALES</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dimensional_weight_IATA'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dimensional_weight_IATA',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dimensional_weight_FEDEX'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dimensional_weight_FEDEX',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dimensional_weight_DHL'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dimensional_weight_DHL',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dimensional_weight_UPS'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dimensional_weight_UPS',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dimensional_weight_custom1'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dimensional_weight_custom1',array("class"=>"form-control")); ?></td>
			</tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dimensional_weight_custom2'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dimensional_weight_custom2',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'dimensional_weight_custom3'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'dimensional_weight_custom3',array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
    
   <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">EXTRA ENV&Iacute;O</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'need_ups'); ?></td>
            <td><div class="checkbox">
                <label>
                  <?php echo $form->checkBox($model,'need_ups'); ?>
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'deale_distributor_price'); ?></td>
            <td><?php echo $form->textField($model,'deale_distributor_price',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'commercial_name'); ?></td>
            <td><?php echo $form->textField($model,'commercial_name',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td style="text-align:right;"><?php echo $form->labelEx($model,'commercial_description'); ?></td>
            <td><?php echo $form->textField($model,'commercial_description',array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">DESCUENTOS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'off'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'off',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'off_category_a'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'off_category_a',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'off_category_b'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'off_category_b',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'off_category_c'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'off_category_c',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'off_category_d'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'off_category_d',array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">ACCESORIOS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'accessory_a'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'accessory_a',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'accessory_b'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'accessory_b',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'accessory_c'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'accessory_c',array("class"=>"form-control")); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'accessory_d'); ?></td>
            <td width="80%"><?php echo $form->textField($model,'accessory_d',array("class"=>"form-control")); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
  
   <div class="row">
   
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">DESCRIPCIONES</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'short_description'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'short_description', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'long_description'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'long_description', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'description_customer'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'description_customer', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
          <tr>
            <td width="20%" style="text-align:right;"><?php echo $form->labelEx($model,'description_supplier'); ?></td>
            <td width="80%"><?php echo $form->textArea($model, 'description_supplier', array("class"=>"form-control",'maxlength' => 300, 'rows' => 2)); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 --> 
    </div>
    <!-- /.row -->
    
	<?php echo CHtml::hiddenField("other",'',array('id'=>'other'));?>
    
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div class="buttonsFloatBottom">
        <button type="button" class="btn btn-default btn-lg" id="cancel"> Cancelar</button>
        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
        <button type="submit" class="btn btn-primary btn-lg" id="saveAndOther"><i class="fa fa-save"></i> Guardar y Cargar Nuevo</button>
      </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
        <?php $this->endWidget(); ?>
  
</div>
<!-- /container --> 