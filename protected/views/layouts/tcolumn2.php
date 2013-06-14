<?php $this->beginContent('//layouts/tmain'); ?>
	<div id="content-center">
		<?php echo $content; ?>
	</div><!-- content -->
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
<?php $this->endContent(); ?>