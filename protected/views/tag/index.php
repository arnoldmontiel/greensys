<?php
$this->breadcrumbs=array(
	'Tags',
);

?>
<div class="well well-small">
<h4>Etapas</h4>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
