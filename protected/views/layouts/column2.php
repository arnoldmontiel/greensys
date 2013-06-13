<?php $this->beginContent('//layouts/main'); ?>
<?php if(isset($this->showSideBar)&&$this->showSideBar==true):?>
<div class="span-5 first">
<div id="sidebar" style="float:left;width: 150px;background:#ccc;padding:20px; position: absolute; display:none;opacity: 1">
	<ul id='sidebarTitle'>	
     </ul>
	<ul id='sidebarText'>
	</ul>
</div>
<?php Yii::app()->clientScript-> registerScript('sidebarController', "
var offset = $('#sidebar').offset();
var topPadding = 15;
$(window).scroll(function() {
	if ($('#sidebar').height() < $(window).height() && $(window).scrollTop() > offset.top) {
		$('#sidebar').stop().animate({
			marginTop: $(window).scrollTop() - offset.top + topPadding
		});
	} else {
		$('#sidebar').stop().animate({
			marginTop: 0
		});
	};
});")
?>
</div>
<?php endif?>
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
		
	<?php echo $this->container;?>
	
</div>
<?php $this->endContent(); ?>