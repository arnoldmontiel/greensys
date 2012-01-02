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
	 		echo CHtml::tag('div',array('title'=>'Delete','class'=>'deleteLink'),'');
	 		echo CHtml::hiddenField("links[]",$item);
	 	
	 	echo CHtml::closeTag('div');
 	}
 }	
 ?>
</div>          
<div class="addContainer">
	<div id="addText">
          <?php echo CHtml::textField('Text', '',
				 array('id'=>'textLink', 
				 		'name' =>'textLink',
				       'style'=>"width:200px;",
				       'class' => 'required:true,url:true; ',
				       'maxlength'=>150)); ?>
    </div>
	<div id="addLink" title="Add link"></div>
</div>
	