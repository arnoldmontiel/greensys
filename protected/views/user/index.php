<?php
$this->breadcrumbs=array(
	'Users',
);
?>
<div class="well well-small">
<h4>Usuarios</h4>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
