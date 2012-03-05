

<div class="links">
 <!--Links are added here -->
 <?php
 
 if(isset($items))
 {
 	foreach($items as $item)
 	{
	 	echo CHtml::openTag('div',array('class'=>'linkContainer'));
	 	
	 		echo CHtml::tag('div',array('class'=>'linkAdded'));
	 			echo CHtml::link($item,$item,array('target'=>'_blank'));
	 		echo CHtml::closeTag('div');
	 	
	 	echo CHtml::closeTag('div');
 	}
 }	
 ?>
</div>
	