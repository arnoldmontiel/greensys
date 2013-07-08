<?php
?>
<div class="well well-small">
<h4>Vista Tipo de Documento</h4>
</div>

<?php 
$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
	'attributes'=>array(
		'name',
		'description',
	),
));
?>
