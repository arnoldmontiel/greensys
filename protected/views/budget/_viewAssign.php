<?php

Yii::app()->clientScript->registerScript(__CLASS__.'view-assign', "


");
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->stock,
	'attributes'=>array(
		'username',
		'creation_date',
		'description',
	),
)); ?>
