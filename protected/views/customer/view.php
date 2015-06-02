<div class="container" id="screenMarcas">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
  <div class="col-sm-6 align-right">
           <button type="button" class="btn btn-default marginLeft pull-right" onclick="window.location = '<?php echo CustomerController::createUrl('admin')?>'"><i class="fa fa-arrow-left fa-fw"></i> Volver</button>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php 
    $attributes = array(
    				'person.name',
    				'person.last_name',
    		);
    if($model->contact->telephone_1!="")
	    $attributes[]=array(
	    						'label'=>'Telefono ('.$model->contact->tel1_description.')',
	    						'type'=>'raw',
	    						'value'=>$model->contact->telephone_1,
	    				);
    if($model->contact->telephone_2!="")
	    $attributes[]=array(
    						'label'=>'Telefono ('.$model->contact->tel2_description.')',
    						'type'=>'raw',
    						'value'=>$model->contact->telephone_2,
    				);
    if($model->contact->telephone_3!="")
    	$attributes[]=array(
    						'label'=>'Telefono ('.$model->contact->tel3_description.')',
    						'type'=>'raw',
    						'value'=>$model->contact->telephone_3,
    				);
    if($model->contact->email!="")
    	$attributes[]=array(
    						'label'=>'Correo ('.$model->contact->email_description.')',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->email)?$model->contact->email:""),
    				);
    if($model->contact->email_2!="")
    	$attributes[]=array(
    						'label'=>'Correo ('.$model->contact->email_2_description.')',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->email_2)?$model->contact->email_2:""),
    				);
    if($model->contact->email_3!="")
    	$attributes[]=array(
    						'label'=>'Correo ('.$model->contact->email_3_description.')',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->email_3)?$model->contact->email_3:""),
    				);
    $attributes[]=array(
    	'label'=>'Notas',
    	'type'=>'raw',
    	'value'=>(isset($model->contact->comment)?nl2br($model->contact->comment):""),
    );
    if($model->contact->refered!="")
    	$attributes[]=array(
    						'label'=>'Referido',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->refered)?$model->contact->refered:""),
    				);
    $this->widget('zii.widgets.CDetailView', array(
    		'data'=>$model,
    		'htmlOptions' => array('class'=>'table table-striped table-bordered'
    		),
    		'attributes'=>$attributes
    ));    
	?>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row -->
  <div class="row">
  <div class="col-sm-6">
  	<h1 class="pageTitle">Direcciones</h1>
  </div>
  </div>
    	<table class="table table-striped table-bordered">
  		<tbody>
      <?php
     foreach($model->projects as $project)
     {?>
       		<tr class="odd">
       		<th>
       		     <?php
     	echo $project->description;
     	?>
       		
       		</th>
       		<td>
       		       		     <?php
     	echo $project->address;
     	?>
       		
       		</td>
     
			</tr>
     	<?php 
     }
      
    ?>
		</tbody>
	</table>
    </div>