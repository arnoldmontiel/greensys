<?php
$this->breadcrumbs=array(
	'Tags',
);

?>

<h1>Etapas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
