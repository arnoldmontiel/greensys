<?php
$this->breadcrumbs=array(
	'Review Types',
);
?>
<div class="well well-small">
<h4>Tipos de Formulario</h4>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
