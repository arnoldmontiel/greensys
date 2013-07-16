<?php
$browser = get_browser(null, true);
Yii::app()->clientScript->registerScript('indexWall', "

loadPage();
function loadPage()
{

	
	var id_customer =".$Id_customer."; 
	
		$('#Id_customer').val(id_customer);
		$.post('".ReviewController::createUrl('AjaxGetCustomerName')."', 
			{
				Id_customer: $('#Id_customer').val(),
				Id_project: $('#Id_project').val(),
			}	
			).success(
			function(data){
				if(data != '')
					$('#linkCustomers').text(data);
				else
					$('#linkCustomers').text('Buscar');
					
				$('#typeFilter').val('');
				$('#typeFilter').val(getCheck('chklist-type[]'));
				
				$('#reviewTypeFilter').val('');
				$('#reviewTypeFilter').val(getCheck('chklist-reviewType[]'));
				
				$('#tagFilter').val('');
				$('#tagFilter').val(getCheck('chklist-tag[]'));
				
				$('#isCloseFilter').val('');
				if($('#chkClose').attr('checked') !=undefined && $('#chkClose').attr('checked') == 'checked')
					$('#isCloseFilter').val(1);
		
				$('#dateFromFilter').val('');
				$('#dateFromFilter').val($('#dateFrom').val());
				
				$('#dateToFilter').val('');
				$('#dateToFilter').val($('#dateTo').val());	
				doFilter();
			});

}

$('#linkCustomers').click(function(){

	var id_customer =".$Id_customer.";
	if(id_customer == -1)
	{
		doFilter();
	}
});

$('#Id_customer').change(function(){
	
	$('#typeFilter').val('');
	$('#typeFilter').val(getCheck('chklist-type[]'));
	
	$('#reviewTypeFilter').val('');
	$('#reviewTypeFilter').val(getCheck('chklist-reviewType[]'));
	
	$('#tagFilter').val('');
	$('#tagFilter').val(getCheck('chklist-tag[]'));
	
	doFilter();
	
	return false;
});

setInterval(function() {
   doFilter();
}, 1000*90)

var collapsed = new Array();

function doFilter()
{

		$('#btn-actions-box').removeClass('div-hidden');
		$('#loading').addClass('loading');
		
		var searchTextCust = '';
		if (typeof($('#txtSearchCustomer').val()) != 'undefined')
			searchTextCust = $('#txtSearchCustomer').val();
		$.post('".ReviewController::createUrl('AjaxFillInbox')."', 
		{
			tagFilter: $('#tagFilter').val(),
			isCloseFilter: $('#isCloseFilter').val(),
			Id_customer: $('#Id_customer').val(),
			Id_project: $('#Id_project').val(),
			typeFilter: $('#typeFilter').val(),
			reviewTypeFilter: $('#reviewTypeFilter').val(),
			dateFromFilter: $('#dateFromFilter').val(),
			dateToFilter: $('#dateToFilter').val(),
			customerNameFilter: searchTextCust,
			collapsed: collapsed,
			
		}	
		).success(
		function(data){
			$('#review-area').removeClass('div-hidden');
			$('#loading').removeClass('loading');
			$('#review-area').html(data);
			//tiene que tener al menos un elemento luego de la primer carga para mantener el estado
			collapsed = [];
			if(collapsed.indexOf(0)==-1)
			{
				collapsed.push(0);
			}
			$('.index-review-quick-view-collapsable:hidden').each(
				function(){
					var idProject = $(this).attr('id').split('_')[1];
					collapsed.push(idProject);
				}
				);
			$('#collapserAll').unbind('click');	
			$('#collapserAll').click(function()
				{
				if($(this).attr('src')=='images/collapse_blue.png')
				{
					$(this).attr('title','Expandir/Colapsar todo');
					$(this).attr('src','images/expand_blue.png');
					var target='.index-review-quick-view-collapsable:visible';
				}else
				{
					$(this).attr('title','Expandir/Colapsar todo');
					$(this).attr('src','images/collapse_blue.png')
					var target='.index-review-quick-view-collapsable:hidden';				
				}
				$(target).each(
				function(){
						$(this).toggle('blind', 100 ,
							function(){
								var idProject = $(this).attr('id').split('_')[1];
								if($(this).is(':hidden'))
								{
									collapsed.push(idProject);
									$('#collapse_'+idProject).attr('src','images/expand_blue.png');
									$('#collapse_'+idProject).attr('title','expandir');
								}
								else
								{
									var index = collapsed.indexOf(idProject);
									collapsed.splice(index, 1);
									$('#collapse_'+idProject).attr('src','images/collapse_blue.png');
									$('#collapse_'+idProject).attr('title','colapsar');
								}
							
							}
						);
				}
					)
				}
			);
			$('.collapser').unbind('click');
			$('.collapser').click(function()
			{
				var idProject = $(this).attr('id').split('_')[1];
				$('#collapseble_'+idProject).toggle('blind', { to: { width: 200, height: 60 } }, 100 ,
				function(){
					if($('#collapseble_'+idProject).is(':hidden'))
					{
						collapsed.push(idProject);
						$('#collapse_'+idProject).attr('src','images/expand_blue.png');
						$('#collapse_'+idProject).attr('title','expandir');
					}
					else
					{
						var index = collapsed.indexOf(idProject);
						collapsed.splice(index, 1);
						$('#collapse_'+idProject).attr('src','images/collapse_blue.png');
						$('#collapse_'+idProject).attr('title','colapsar');
					}
				
				});
			});						
			$('#review-area').animate({opacity: 'show'},240);
		});		

}


$('#btn-filter').click(function(){
	$('#typeFilter').val('');
	$('#typeFilter').val(getCheck('chklist-type[]'));
	
	$('#reviewTypeFilter').val('');
	$('#reviewTypeFilter').val(getCheck('chklist-reviewType[]'));
	
	$('#tagFilter').val('');
	$('#tagFilter').val(getCheck('chklist-tag[]'));
	
	$('#isCloseFilter').val('');
	if($('#chkClose').attr('checked') !=undefined && $('#chkClose').attr('checked') == 'checked')
		$('#isCloseFilter').val(1);
	
	$('#dateFromFilter').val('');
	$('#dateFromFilter').val($('#dateFrom').val());
	
	$('#dateToFilter').val('');
	$('#dateToFilter').val($('#dateTo').val());
	
	$('#filter-panel').toggle('blind',{duration:100});
	$('#showFilters').removeClass('active');				
	
	doFilter();
});

$('#btn-clear-filter').click(function(){
	$('#typeFilter').val('');
	
	$('#tagFilter').val('');
	
	$('#isCloseFilter').val('');
	
	$('#reviewTypeFilter').val('');
	
	$('input:checked').attr('checked', false);
	
	$('#dateFromFilter').val('');
	$('#dateFrom').val('');
	
	$('#dateToFilter').val('');
	$('#dateTo').val('');
	
	$('#filter-panel').toggle('blind',{duration:100});
	$('#showFilters').removeClass('active');
	
	doFilter();
});

$('#btnDoc').click(function(){
	if(!EnableButton($(this)))
	{
		return false;
	}
	SelectAButton($(this));
	
	$('#wall-action-album').animate({opacity: 'hide'},240,function()
	{
		$('#wall-action-doc').animate({opacity: 'show'},240);
		$('#docType').val('3'); // PDF
		$('#arrow').removeClass('wall-action-area-images-dialog');
		$('#arrow').addClass('wall-action-area-docs-dialog');
	});

});

function RestoreButtons()
{
	$('#btn-box').children().removeClass('wall-action-btn-disable');
	$('#btn-box').children().removeClass('wall-action-btn-selected');
}

function SelectAButton(btnSelected)
{
	$('#btn-box').children().addClass('wall-action-btn-disable');
	$(btnSelected).removeClass('wall-action-btn-disable');
	$(btnSelected).addClass('wall-action-btn-selected');
}

function EnableButton(btnClicked)
{
	if($(btnClicked).hasClass('wall-action-btn-disable')||$(btnClicked).hasClass('wall-action-btn-selected'))
	{
		return false;
	}
	return true;
}

$('#btnDoc').hover(function(){
	if(!EnableButton($(this)))
	{
		return false;
	}
	$(this).addClass('wall-action-btn-hover');
},function(){
	$(this).removeClass('wall-action-btn-hover');
}
);

$('#btnAlbum').hover(function(){
	if(!EnableButton($(this)))
	{
		return false;
	}
	$(this).addClass('wall-action-btn-hover');
},
function(){
	$(this).removeClass('wall-action-btn-hover');
	}
);
$('#btnCreate').hover(function(){
	if(!EnableButton($(this)))
	{
		return false;
	}
	$(this).addClass('wall-action-btn-hover');
},
function(){
	$(this).removeClass('wall-action-btn-hover');
	}
);

$('#btnCreate').click(function(){
	if(!EnableButton($(this)))
	{
		return false;
	}
	SelectAButton($(this));
	var url = '".ReviewController::createUrl('create') . "' + '&Id_project='+$('#Id_project').val();
	window.location = url;
	return false;
});

$('#btnPublicAlbum').click(function(){
	var url = '".ReviewController::createUrl('index',array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project))."';
	window.location = url;
	return false;
});

$('#btnCancelAlbum').click(function(){
	$('#loading').addClass('loading');
	$.post('".AlbumController::createUrl('album/AjaxCancelAlbum')."', 
		$('#Album_Id_album').serialize()
	).success(
	function(data){
		$('#loading').removeClass('loading');
		$('#wall-action-album').animate({opacity: 'hide'},240,
			function(){		
				RestoreButtons();
				$('#uploaded').html(data);
				$('#files').html('');
				$('#Album_description').val('');
				$('#Album_title').val('');
		});
	});
});

$('#btnAlbum').click(function(){
		if(!EnableButton($(this)))
		{
			return false;
		}
		SelectAButton($(this));

		$('#loading').addClass('loading');
		var url = '".AlbumController::createUrl('album/AjaxCreateAlbum')."';

		if('".$browser['browser']."'=='IE')
		{
			url = '".AlbumController::createUrl('album/AjaxCreateAlbumIE')."';
		}
		$.post(url, 
			{
				idCustomer: ".$Id_customer.",
				idProject: ".$Id_project."

			}
		).success(
		function(data){
			$('#loading').removeClass('loading');
			var param = '&idAlbum='+data+'&idCustomer='+".$Id_customer."+'&idProject='+".$Id_project.";
			$('#XUploadWidget_form').attr('action','".AlbumController::createUrl('album/AjaxUpload')."'+param);
			$('#Album_Id_album').val(data);
			$('#uploader').html(data);
			if('".$browser['browser']."'=='IE')
			{
				$('#file_upload').uploadify({
			        'swf'      : '".Yii::app()->request->baseUrl."/js/uploadify.swf',
			        'uploader' : '".AlbumController::createUrl('album/AjaxUploadify')."&idAlbum='+$('#uploadify_id_album').val()+'&idCustomer='+$('#uploadify_id_customer').val()+'&idProject='+$('#uploadify_id_project').val(),
			        // Put your options here
			        'buttonText' : 'Seleccione',
			        'onUploadSuccess' : function(file, data, response) {
	         		   //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
						var target = $('.album-view-image:first');
						$(target).before(data);
						target = $('.album-view-image:first');
						$(target).animate({opacity: 'show'},400);
						$(target).find('#photo_description').change(function(){
							$.get('".AlbumController::createUrl('album/AjaxAddImageDescription')."',
 							{
								IdMultimedia:$(target).attr('id'),
								description:$(this).val()
 							}).success(
 								function(data) 
 								{
								}
							);                         		
						});
						$(target).find('#photo_cancel').click(function(){
								
							$.get('".AlbumController::createUrl('album/AjaxRemoveImage')."',
 							{
								IdMultimedia:$(target).attr('id')
							}).success(
								function(data) 
								{
									$(target).remove();	
								}
							);
						});
			        }
				});
			}
	
		
			$('#wall-action-album').animate({opacity: 'show'},240);
			$('#files').html('');
			$('#Album_description').val('');
			$('#Album_title').val('');			
		
		}
		);
});

function getCheck(checkName)
{
	var data = { 'value[]' : []};

	$('input:checked').each(function() {
		if($(this).val() != '' && $(this).attr('name') == checkName)
 	 		data['value[]'].push($(this).val());
	});
	
	return data['value[]'];
}

$(document).keypress(function(e) {
    if(e.keyCode == 13) 
    {
    	if($('*:focus').attr('id') == 'txtSearchCustomer')
    	{
    		$('#linkCustomers').click();
    		return false;
    	}    	
		return false; 
    }
});

");
?>

<div class="review-action-area" id="review-action-area">
<div class="review-action-area-first">
<?php if(User::canCreate() && $Id_customer == -1):?>

<?php
	echo CHtml::image('images/expand_blue.png','expandir',array('id'=>'collapserAll','class'=>'collapserAll','title'=>'Expandir/Colapsar todo'));
	echo CHtml::openTag('div',array('class'=>'review-action-box-btn div-hidden','id'=>'btn-actions-box'));
		echo CHtml::textField('txtSearchCustomer','',array('Id'=>'txtSearchCustomer'));			
	echo CHtml::closeTag('div');	
?>
<?php endif;?>

	<div  class="review-action-filters" >
		<?php
		if(isset($Id_customer)&&$Id_customer !=-1)
		{
			$this->widget('zii.widgets.jui.CJuiButton', array(
					'id'=>'showFilters',
					'name'=>'submit',
					'caption'=>'Filtros',
					'htmlOptions' => array('class'=>'btn btn-navbar'),
					'onclick'=>new CJavaScriptExpression('function(){
					$(this).addClass("active");
					if(jQuery("#filter-panel").is(":hidden"))
					{
						$("#filter-panel").toggle("blind",{ direction: "left" },50);
					}
					else
					{
						$(this).removeClass("active");
						$("#filter-panel").toggle("blind",{ direction: "left" },50);
				
						}
					}'
					),
			));
			
		}
		?>
	</div>
	<?php if(User::getCustomer()):?>

	<div id="customer" class="review-action-back" >
	
		<?php	
		echo CHtml::link(User::getCustomer()->person->name.' '.User::getCustomer()->person->last_name,
			ReviewController::createUrl('index',array('Id_customer'=>User::getCustomer()->Id)),
			array('class'=>'index-review-single-link')
			);
		 ?>
	</div>
	<?php else:?>
	
	<div id="customer" class="review-action-back" >
	
		<?php
			echo CHtml::link('Clientes',
				'',
				array('class'=>'index-review-single-link', 'id'=>'linkCustomers')
				);
		 ?>
		
		<?php 
		$this->widget('ext.processingDialog.processingDialog', array(
				'buttons'=>array('save'),
				'idDialog'=>'wating',
		));
		?>
	</div>
	<?php endif;?>	
</div>
<div class="review-action-area-second">
<?php if(User::canCreate() && isset($Id_customer) && $Id_customer > 0):?>

<?php
	echo CHtml::openTag('div',array('class'=>'wall-action-box-btn','id'=>'btn-box'));
		echo CHtml::openTag('div',array('class'=>'wall-action-btn','id'=>'btnCreate'));
		$criteria = new CDbCriteria;
		$criteria->compare('Id_project',$Id_project);
		$criteria->compare('username',User::getCurrentUser()->username);
		$criteria->addCondition('Id_review IS NOT NULL');
		$criteria->addCondition('t.Id NOT IN(select Id_note from user_group_note)');
		$modelNote = Note::model()->find($criteria);
		if(isset($modelNote))
		{
			echo 'Borrador';				
		} 
		else
		{
			echo 'Nuevo';				
		}
		echo CHtml::closeTag('div');
// 		echo CHtml::openTag('div',array('class'=>'wall-action-btn','id'=>'btnAlbum'));
// 			echo 'Album';
// 		echo CHtml::closeTag('div');	
// 		echo CHtml::openTag('div',array('class'=>'wall-action-btn','id'=>'btnDoc'));
// 			echo 'Documentos';
// 		echo CHtml::closeTag('div');
	echo CHtml::closeTag('div');
?>
<?php endif;?>

<div id="send-mail" class="send-mail" >

<?php
	if(User::isAdministartor()&&isset($Id_project)&&$Id_project!=-1)
	{
// 		$this->widget('ext.processingDialog.processingDialog', array(
// 				'idDialog'=>'dialogProcessingMail',
// 				'imgSrc'=>'images/email_loading.gif'
// 		));


		$image = CHtml::image('images/export_plain_text.png','Export',
			array(				
				'style'=>'width:25px;margin-top:15px;'
			)
		);
		echo CHtml::link($image,
			ReviewController::createUrl('generateTextPlainSummary',array('Id_project'=>$Id_project)),
			array('title'=>'Exportar todo')
			);
		
		//echo CHtml::imageButton('images/mail_blue.png',array('onclick'=>'jQuery("#SendMail").dialog("open"); return false;'));
// 		//mail pop up
// 		$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
// 				'id'=>'SendMail',
// 				// additional javascript options for the dialog plugin
// 				'options'=>array(
// 						'title'=>'Enviar Mail',
// 						'autoOpen'=>false,
// 						'modal'=>true,
// 						'width'=> '500',
// 						'buttons'=>	array(
// 								'Cancelar'=>'js:function(){jQuery("#SendMail").dialog( "close" );}',
// 								'Enviar'=>'js:function()
// 								{
// 									jQuery("#dialogProcessingMail").dialog("open");
// 									jQuery.post("'.Yii::app()->createUrl("review/AjaxSendProjectByMail").'", jQuery("#mail-form").serialize(),
// 										function(data) {
// 											jQuery("#dialogProcessingMail").dialog("close");
// 											jQuery("#SendMail").dialog( "close" );
// 										},"json").error(
// 										function()
// 										{
// 											jQuery("#dialogProcessingMail").dialog("close");
// 											jQuery("#SendMail").dialog( "close" );
// 										}
// 									);
// 								}
// 								'),
// 				),
// 		));
// 		echo $this->renderPartial('_mail', array('model'=>Project::model()->findByPk($Id_project)));
		
// 		$this->endWidget('zii.widgets.jui.CJuiDialog');
		
		//mail pop up END
		//techReport pop up
		$image = CHtml::image('images/export_a_day.png','Export',
		array(
				'style'=>'width:25px;margin-top:22px;'
			)
		);
		echo CHtml::link($image,
				'#',
				array(
				'title'=>'Exportar',
				'onclick'=>'jQuery("#TechnicalReport").dialog("open"); return false;',
				'style'=>'margin-left:5px;',
		));

//		echo CHtml::imageButton('images/mail_blue.png',array('title'=>'','onclick'=>'jQuery("#TechnicalReport").dialog("open"); return false;'));
		$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>'TechnicalReport',
				// additional javascript options for the dialog plugin
				'options'=>array(
						'title'=>'Informe t&eacutecnico de visita',
						'autoOpen'=>false,
						'modal'=>true,
						'width'=> '400',
						'buttons'=>	array(								
								'Descargar'=>'js:function()
								{
									window.location.href="'.
										ReviewController::createUrl('AjaxGenerateTechnicalReport',
										array('Id_project'=>$Id_project))
									.'&dateToReport="+$("#dateToReport").val();
									jQuery("#TechnicalReport").dialog( "close" );
								}
								',
								'Cancelar'=>'js:function(){jQuery("#TechnicalReport").dialog( "close" );}',
							),
				),
		));
		echo "<div class='row-fluid'>";
		echo CHtml::label('Fecha: ', 'dateToReport');
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			'id'=>'dateToReport',			
			'name'=>'publishDate',
			'value'=>date("Y-m-d"),
			// additional javascript options for the date picker plugin
			'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
			),
			'htmlOptions'=>array(					
					'style'=>'height:20px;'
			),
		));
		
		$this->endWidget('zii.widgets.jui.CJuiDialog');	
		echo "</div>";
	}
	//techReport pop up END
	?>
</div>
<?php echo CHtml::hiddenField('Id_customer',$Id_customer,array('id'=>'Id_customer'))?>
<?php echo CHtml::hiddenField('Id_project',$Id_project,array('id'=>'Id_project'))?>

</div>
<div id="loading" class="loading-place-holder" >
</div>

</div>

<!-- *************** ALBUM ******************************* -->

<div id="wall-action-album"  class='wall-action-area-note' style="display:none">
	<div class="review-action-area-dialog" style="left: 190px;">
	</div>
	<?php 
		$modeNewlAlbum = new Album;
		$browser = get_browser(null, true);
		if(isset($browser) && $browser['browser']=='IE')
		{
			$this->renderPartial('_formAlbumIE',array('model'=>$modeNewlAlbum));				
		}
		else 
		{
			$this->renderPartial('_formAlbum',array('model'=>$modeNewlAlbum));				
		}
	?>
	<div class="row" style="text-align: center;">
		<?php echo CHtml::button('Publicar',array('class'=>'wall-action-submit-btn','id'=>'btnPublicAlbum'));?>
		<?php echo CHtml::button('Cancelar',array('class'=>'wall-action-submit-btn','id'=>'btnCancelAlbum'));?>
	</div>
		
</div>

<!-- *************** DOCUMENT ******************************* -->
<div id="wall-action-doc"  class='wall-action-area-note' style="display:none">
	<div class="review-action-area-dialog" style="left: 430px;">
	</div>
	<?php
		$modelMulti = new TMultimedia;
		$this->renderPartial('_formDocument',array('model'=>$modelMulti, 'Id_review'=>null, 'Id_customer'=>$Id_customer, 'Id_project'=>$Id_project));
	?>
</div>


<?php
	echo CHtml::hiddenField('tagFilter','',array('id'=>'tagFilter'));
	echo CHtml::hiddenField('isCloseFilter','',array('id'=>'isCloseFilter'));	
	echo CHtml::hiddenField('typeFilter','',array('id'=>'typeFilter'));
	echo CHtml::hiddenField('reviewTypeFilter','',array('id'=>'reviewTypeFilter'));
	echo CHtml::hiddenField('dateFromFilter','',array('id'=>'dateFromFilter'));
	echo CHtml::hiddenField('dateToFilter','',array('id'=>'dateToFilter'));
?>
<div id="review-area" class="index-review-area div-hidden" >
</div>

<?php if(isset($Id_customer) && $Id_customer > 0):?>
<div id="resources-view" class="review-single-view-multimedia">
	<div class="review-resources-title">
		<div class="review-resources-title-text">
			Recursos Multimedia
		</div>
	</div>
<?php
		if($hasAlbum)
		{
			echo CHtml::openTag('div', array('class'=>'review-resources-items'));
				echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
					echo CHtml::image('images/image_resource.png','',array('style'=>'width:25px;'));
				echo CHtml::closeTag('div');
				echo CHtml::link("Im&aacute;genes",
							ReviewController::createUrl('AjaxViewImageResource',array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project))
							);
			echo CHtml::closeTag('div');			
		}
		
		if($hasDocs)
		{
			echo CHtml::openTag('div', array('class'=>'review-resources-items'));
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/document_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
			echo CHtml::link("Documentos Generales",
			ReviewController::createUrl('AjaxViewDocResource',array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project))
			);
			echo CHtml::closeTag('div');
		}
		
		if($hasTechDocs)
		{
			echo CHtml::openTag('div', array('class'=>'review-resources-items'));
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/tech_document_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
			echo CHtml::link("Documentos T&eacute;cnicos",
				ReviewController::createUrl('AjaxViewTechDocResource',array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project))
			);
			echo CHtml::closeTag('div');
		}		
?>
</div>
<?php endif;?>
<?php

$this->widget('ext.processingDialog.processingDialog', array(
		'idDialog'=>'dialogProcessing',
));
?>
