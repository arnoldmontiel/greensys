<a onclick="openNewBudget();" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearPresupuesto"><i class="fa fa-plus"></i> Crear Presupuesto</a>
 <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-grid-open',
		'dataProvider'=>$modelBudgets->searchOpen(),
		'selectableRows' => 0,
		'filter'=>$modelBudgets,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
					'name'=>'project_description',
					'value'=>'$data->project->fullDescription',
					'htmlOptions'=>array("style"=>"width:27%;"),
				),
				array(
					'name'=>'version_number',
					'value'=>'$data->version_number',
					'htmlOptions'=>array("style"=>"width:12%;", "class"=>"align-right"),
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
							return '<span class="label '.($rent<50?'label-primary':'label-success').'">'.$rent.'%</span>';						
						},
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"width:12%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
					'header'=>'Total',
					'value'=>
						function($data){
							return $data->currency->short_description." ".number_format($data->getTotalPriceWithDiscountCurrencyConverted());
						},
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"width:12%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
					'name'=>'percent_discount',
					'value'=>'$data->percent_discount',
					'htmlOptions'=>array("style"=>"width:5%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
					'name'=>'date_creation',
					'value'=>'$data->date_creation',
					'htmlOptions'=>array("style"=>"width:15%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
					'name'=>'date_inicialization',
					'value'=>'$data->date_inicialization',
					'htmlOptions'=>array("style"=>"width:15%;", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
						$grid = "'budget-grid-open'";
							return '<div class="buttonsTablePres"><button onclick="editBudget('.$data->Id.', '.$data->version_number.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
									<button onclick="removeBudget('.$data->Id.', '.$data->version_number.', '.$grid.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            						<button onclick="closeVersion('.$data->Id.', '.$data->version_number.', '.$grid.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            						<button onclick="downloadPDF('.$data->Id.', '.$data->version_number.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> PDF</button>
            						<a onclick="viewBudget('.$data->Id.', '.$data->version_number.');" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Ver</a></div>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
		?>