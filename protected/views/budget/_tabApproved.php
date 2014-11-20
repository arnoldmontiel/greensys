<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-grid-approved',
		'dataProvider'=>$modelBudgets->searchApproved(),
		'selectableRows' => 0,
		'filter'=>$modelBudgets,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
					'name'=>'project_description',
					'value'=>'$data->project->fullDescription',
					'htmlOptions'=>array("style"=>"width:20%;"),
					'headerHtmlOptions'=>array("style"=>"width:20%;"),
				),
				array(
					'header'=>'N&deg;',
					'name'=>'version_number',
					'value'=>'$data->version_number',
						'htmlOptions'=>array("style"=>"width:5%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("style"=>"width:5%;", "class"=>"align-right"),
				),
				array(
					'header'=>'Descripci&oacute;n',
					'name'=>'description',
					'value'=>'GreenHelper::cutString($data->description,79)',
					'htmlOptions'=>array("style"=>"width:22%;"),
					'headerHtmlOptions'=>array("style"=>"width:22%;"),
				),
				array(
						'header'=>'Rent',
						'value'=>function($data){
							$rent = $data->ProfitPercenTotal;
							return '<span class="label '.($rent<50?'label-primary':'label-success').'">'.$rent.'%</span>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"width:5%;", "class"=>"align-right"),
						'headerHtmlOptions'=>array("style"=>"width:5%;", "class"=>"align-right"),
				),
				array(
						'header'=>'Total',
						'value'=>
						function($data){
							return $data->currency->short_description." ".number_format($data->getTotalPriceWithDiscount(),2);
						},
						'type'=>'raw',
						'htmlOptions'=>array( "style"=>"width:10%;", "class"=>"align-right"),
						'headerHtmlOptions'=>array("style"=>"width:10%;", "class"=>"align-right"),
				),				
				array(
					'header'=>'Desc',
					'name'=>'percent_discount',
					'value'=>'$data->percent_discount',
					'htmlOptions'=>array("style"=>"width:5%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("style"=>"width:5%;","class"=>"align-right"),
				),
				array(
					'header'=>'Creaci&oacute;n',
					'name'=>'date_creation',
					'value'=>'$data->date_creation',
					'htmlOptions'=>array("style"=>"width:3%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("style"=>"width:3%;","class"=>"align-right"),
				),
				array(
					'header'=>'Aprobado',
					'name'=>'date_approved',
					'value'=>'$data->date_approved',
					'htmlOptions'=>array("style"=>"width:3%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("style"=>"width:3%;","class"=>"align-right"),
				),
				array(
					'name'=>'date_inicialization',
					'value'=>'$data->date_inicialization',
					'htmlOptions'=>array("style"=>"width:3%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("style"=>"width:3%;","class"=>"align-right"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return '<div class="buttonsTable"><button onclick="downloadPDF('.$data->Id.', '.$data->version_number.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> PDF</button></div>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
?>