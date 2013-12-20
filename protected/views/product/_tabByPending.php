<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid_pending',
		'dataProvider'=>$modelProducts->searchByPending(),
		'selectableRows' => 0,
		'filter'=>$modelProducts,
		'summaryText'=>'',	
		'columns'=>array(	
				'model',
				'part_number',				 
				array(
		 			'name'=>'brand_description',
					'value'=>'$data->brand->description',
				),
				array(
						'name'=>'height',
						'value'=>function($data){
							$value = $data->height;
							if($value == 0)
								$value =  '<span class="label label-danger">Incompleto</span>';
							else
								$value = $data->showVolume($data->height);
								
							return $value;
						},
						'type'=>'html',
				),
				array(
						'name'=>'width',
						'value'=>function($data){
							$value = $data->width;
							if($value == 0)
            					$value =  '<span class="label label-danger">Incompleto</span>';
							else 
								$value = $data->showVolume($data->width);
							
							return $value;
						},
						'type'=>'html',
				),
				array(
						'name'=>'length',
						'value'=>function($data){
							$value = $data->length;
							if($value == 0)
            					$value =  '<span class="label label-danger">Incompleto</span>';
							else 
								$value = $data->showVolume($data->length);
							
							return $value;
						},
						'type'=>'html',
				),
				array(
						'name'=>'weight',
						'value'=>function($data){
							$value = $data->weight;
							if($value == 0)
								$value =  '<span class="label label-danger">Incompleto</span>';
							else
								$value = $data->showWeight($data->weight);
								
							return $value;
						},
						'type'=>'html',
				),
				'profit_rate',
				array(
						'name'=>'dealer_cost',
						'value'=>function($data){
							$value = $data->dealer_cost;
							if($value == 0)
								$value =  '<span class="label label-danger">Incompleto</span>';
							else
								$value = $data->showPrice($data->dealer_cost);
				
							return $value;
						},
						'type'=>'html',
				),
				array(
						'name'=>'msrp',
						'value'=>function($data){
							$value = $data->msrp;
							if($value == 0)
								$value =  '<span class="label label-danger">Incompleto</span>';
							else
								$value = $data->showPrice($data->msrp);
				
							return $value;
						},
						'type'=>'html',
				),
				'short_description',
				array(
					'value'=>'CHtml::button("Editar",array("class"=>"btn btn-default btn-sm"))',
					'type'=>'raw',
				),
				array(
					'value'=>'CHtml::button("Borrar",array("class"=>"btn btn-default btn-sm"))',
					'type'=>'raw',
				),
			),
		));	
?>
