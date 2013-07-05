<?php
$this->breadcrumbs=array(
	'Document Types',
);
?>

<h1>Tipo de Documentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
