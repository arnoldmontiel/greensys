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
    $this->widget('zii.widgets.CDetailView', array(
    		'data'=>$model,
    		'htmlOptions' => array('class'=>'table table-striped table-bordered'
    		),
    		'attributes'=>array(
    				'person.name',
    				'person.last_name',
    				'contact.description',
    				array(
    						'label'=>'Telefono 1 ('.$model->contact->tel1_description.')',
    						'type'=>'raw',
    						'value'=>$model->contact->telephone_1,
    				),
    				array(
    						'label'=>'Telefono 2 ('.$model->contact->tel2_description.')',
    						'type'=>'raw',
    						'value'=>$model->contact->telephone_2,
    				),
    				array(
    						'label'=>'Telefono 3 ('.$model->contact->tel3_description.')',
    						'type'=>'raw',
    						'value'=>$model->contact->telephone_3,
    				),
    				array(
    						'label'=>'Correo 1 ('.$model->contact->email_description.')',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->email)?$model->contact->email:""),
    				),
    				array(
    						'label'=>'Correo 2 ('.$model->contact->email_2_description.')',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->email_2)?$model->contact->email_2:""),
    				),
    				array(
    						'label'=>'Correo 3 ('.$model->contact->email_3_description.')',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->email_3)?$model->contact->email_3:""),
    				),
    				array(
    						'label'=>'Notas',
    						'type'=>'raw',
    						'value'=>(isset($model->contact->comment)?$model->contact->comment:""),
    				),
    		),
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
      <?php
     foreach($model->projects as $project)
     {?>
       <div class="row">
  		<div class="col-sm-6">
     <?php
     	echo $project->description.": ".$project->address;
     	?>
     	  </div>
	  </div>
     	<?php 
     }
    ?>
</div>