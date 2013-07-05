<?php
$this->breadcrumbs=array(
	'User Groups',
);
?>
<div class="well well-small">
<h4>Grupo de usuarios</h4>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
