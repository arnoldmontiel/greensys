<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-grid-cancelled',
		'dataProvider'=>$modelBudgets->searchCancelled(),
		'selectableRows' => 0,
		'filter'=>$modelBudgets,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
					'name'=>'project_description',
					'value'=>'$data->project->fullDescription',
				),
				array(
					'name'=>'date_cancelled',
					'value'=>'$data->date_cancelled',
					'htmlOptions'=>array("style"=>"width:10%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
					'name'=>'version_number',
					'value'=>'$data->version_number',
					'htmlOptions'=>array("style"=>"width:10%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
					'name'=>'description',
					'value'=>'GreenHelper::cutString($data->description,40)',
					'htmlOptions'=>array("style"=>"width:20%;"),
				),
				array(
						'header'=>'Rentabilidad',
						'value'=>function($data){
							$rent = $data->ProfitPercenTotal;
							return '<span class="label '.($rent<50?'label-danger':'label-success').'">'.$rent.'%</span>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"width:12%;", "class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),				
				array(
						'name'=>'note',
						'value'=>function($data){
								$value = '<span class="label label-info">'.GreenHelper::cutString($data->note,40).'</span>';
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							$grid = "'budget-grid-cancelled'";
							return '<button onclick="openChangeStateBudget('.$data->Id.', '.$data->version_number.', 1);" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
									<button onclick="downloadPDF('.$data->Id.', '.$data->version_number.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> PDF</button>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
		?>