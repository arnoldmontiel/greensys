<?php
$browser = get_browser(null, true);
Yii::app()->clientScript->registerScript('crossView', "
loadPage();
function loadPage()
{		
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
}

function doFilter()
{

		$('#btn-actions-box').removeClass('div-hidden');
		$('#loading').addClass('loading');		
		$.post('".ReviewController::createUrl('AjaxFillCrossView')."', 
		{
			tagFilter: $('#tagFilter').val(),
			isCloseFilter: $('#isCloseFilter').val(),			
			typeFilter: $('#typeFilter').val(),
			reviewTypeFilter: $('#reviewTypeFilter').val(),
			dateFromFilter: $('#dateFromFilter').val(),
			dateToFilter: $('#dateToFilter').val()			
			
		}	
		).success(
		function(data){
			$('#review-area').removeClass('div-hidden');
			$('#loading').removeClass('loading');
			$('#review-area').html(data);
			//tiene que tener al menos un elemento luego de la primer carga para mantener el estado		
			$('#review-area').animate({opacity: 'show'},240);
		});		

}

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

function getCheck(checkName)
{
	var data = { 'value[]' : []};

	$('input:checked').each(function() {
		if($(this).val() != '' && $(this).attr('name') == checkName)
 	 		data['value[]'].push($(this).val());
	});
	
	return data['value[]'];
}
");
?>
<div id="loading" class="loading-place-holder" >
</div>
<div class="review-action-area" id="review-action-area">
<div class="review-action-area-first">

	<div  class="review-action-filters" >
		<?php

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
			
		
		?>
	</div>
</div>
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