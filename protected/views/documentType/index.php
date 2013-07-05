<?php
$this->breadcrumbs=array(
	'Document Types',
);
?>
<div class="well well-small">
<h4>Tipo de Documentos</h4>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
