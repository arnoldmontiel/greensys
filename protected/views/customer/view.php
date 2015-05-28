<div class="container" id="screenMarcas">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
    <div class="col-sm-6 align-right">
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php 
    $this->widget('zii.widgets.CDetailView', array(
    		'data'=>$model,
    		'attributes'=>array(
    				'person.name',
    				'person.last_name',
    				'contact.description',
    				'contact.telephone_1',
    				'contact.telephone_2',
    				'contact.telephone_3',
    				'contact.email',
    				'contact.email_2',
    				'contact.email_3',
    		),
    ));
    
	?>
    
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>