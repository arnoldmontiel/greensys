<?php
?>
<div class="well well-small">
<h4>Vista Tipo de Documento</h4>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description',
	),
)); ?>
