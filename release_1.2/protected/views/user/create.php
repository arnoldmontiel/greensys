<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	Yii::app()->lc->t('Create'),
);

$this->menu=array(
	array('label'=>Yii::app()->lc->t('List User'), 'url'=>array('index')),
	array('label'=>Yii::app()->lc->t('Manage User'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::app()->lc->t('Create User')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>