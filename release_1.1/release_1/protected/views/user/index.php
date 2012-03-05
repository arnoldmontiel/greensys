<?php
$this->breadcrumbs=array(
	Yii::app()->lc->t('Users'),
);

$this->menu=array(
	array('label'=>Yii::app()->lc->t('Create User'), 'url'=>array('create')),
	array('label'=>Yii::app()->lc->t('Manage User'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::app()->lc->t('Users')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
