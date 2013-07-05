<?php
$this->breadcrumbs=array(
	'User Groups',
);
?>

<h1>Grupo de usuarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
