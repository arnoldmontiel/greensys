<script type="text/javascript">

</script>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#_body_scripting'.$Id, "
	$(document).ready(function()
	{ 
		var myPhotoSwipe = $('#Gallery_".$Id." a').photoSwipe({ allowUserZoom: true }); 
	});
");

	echo CHtml::openTag('ul',array('id'=>'Gallery_'.$Id,'class'=>'gallery'));
	foreach ($images as $image)
	{
		if(isset($image['image'])&&isset($image['small_image']))
		{
			echo CHtml::openTag('li');
			echo CHtml::openTag('a',array('href'=>$image['image']));
			echo CHtml::openTag('img',array('src'=>$image['small_image'],'alt'=>$image['caption']));
			echo CHtml::closeTag('a');
			echo CHtml::closeTag('li');				
		}		
	}
	echo CHtml::closeTag('ul');
?>