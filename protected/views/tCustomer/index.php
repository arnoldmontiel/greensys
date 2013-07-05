<?php
$this->breadcrumbs=array(
	'Customers',
);
?>
<div class="well well-small">
<h4>Clientes</h4>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
