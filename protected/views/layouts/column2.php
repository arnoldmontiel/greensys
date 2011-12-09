<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
	<?php if($this->trashDraggableId!=''):?>
		<?php 
		$this->widget('ext.droptrash.droptrash', array(
		'id'=>'dlTrash',	// default is class="ui-sortable" id="yw0"
		'draggableId' => $this->trashDraggableId));
		?>
	<?php endif?>
		

	
</div>
<?php $this->endContent(); ?>