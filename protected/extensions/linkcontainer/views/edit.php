<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#linkcontainer'.$id, "

	$('#addLink_".$id."').click(function() {	 

		var linkValue = $('#textLink_".$id."').attr('value'); 
		if(validateURL(linkValue)){
			if(!containHTTP(linkValue)){
				linkValue = 'http://' + linkValue; 
			}
		  	var del = '<div class=\'deleteLink\' title=\'Delete\'></div>';
			var hidden = '<input name=\'links[]\' type=\'hidden\' value=\''+linkValue+'\'>';
			$('#links_".$id."').append('<div class=\'linkContainer\'><div class=\'linkAdded\'><a target=\'_blank\' href=\''+linkValue+'\'>'+linkValue+'</a></div>'+del+hidden+'</div>');
			$('#links_".$id."').find('.deleteLink').click(function(){
				$(this).parent().remove();
			});
		}
		else{
			alert('Please enter a valid URL');
		}	
		
	});	
	$('.deleteLink').click(function(){
		$(this).parent().remove();
	});
	");

?>
<div class="links" id="links_<?php echo $id;?>">
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
	<div id="addText_<?php echo $id?>" class="addText">
          <?php echo CHtml::textField('Text', '',
				 array('id'=>'textLink_'.$id, 
				 		'name' =>'textLink',
				       'style'=>"width:200px;",
				       'class' => 'required:true,url:true; ',
				       'maxlength'=>150)); ?>
    </div>
	<div id="addLink_<?php echo $id?>" title="Add link" class="addLink"></div>
</div>
	