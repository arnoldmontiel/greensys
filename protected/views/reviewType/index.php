<?php
$this->breadcrumbs=array(
	'Review Types',
);
?>

<h1>Tipos de Formulario</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
