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
					'value'=>'$data->showVolume($data->height)',
				),
				array(
						'name'=>'width',
						'value'=>function($data){
							$value = $data->width;
							if($value == 0)
            					$value =  '<span class="label label-danger">Incompleto</span>';
							return $value;
						},
						'type'=>'html',
				),
				array(
						'name'=>'length',
						'value'=>'$data->showVolume($data->length)',
				),
				array(
						'name'=>'weight',
						'value'=>'$data->showWeight($data->weight)',
				),
				'profit_rate',
				array(
						'name'=>'dealer_cost',
						'value'=>'$data->showPrice($data->dealer_cost)',
				),
				array(
						'name'=>'msrp',
						'value'=>'$data->showPrice($data->msrp)',
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
