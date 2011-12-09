<script type="text/javascript">
$(document).ready(function() {
	$('#addLink').click(function() {	  	
	  	$delete = '<div class="deleteLink" title="Delete"></div>';
	  	$hidden = '<input name="links[]" type="hidden" value="'+$("#textLink").attr("value")+'">';	  			  			  
		$('.links').append("<div class='linkContainer'><div class='linkAdded'><a href='"+$("#textLink").attr("value")+"'>"+$("#textLink").attr("value")+"</a></div>"+$delete+$hidden+"</div>");
		$('.links').find(".deleteLink").click(function(){
			$(this).parent().remove();
		});
		
	});
	$(".deleteLink").click(function(){
		$(this).parent().remove();
	});
	  	
});
</script>


<div class="links">
 <!--Links are added here -->
 <?php
 
 if(isset($items))
 {
 	foreach($items as $item)
 	{
	 	echo CHtml::openTag('div',array('class'=>'linkContainer'));
	 	
	 		echo CHtml::tag('div',array('class'=>'linkAdded'));
	 			echo CHtml::link($item['value'],$item['value']);
	 		echo CHtml::closeTag('div');
	 		echo CHtml::tag('div',array('title'=>'Delete','class'=>'deleteLink'),'');
	 		echo CHtml::hiddenField("links[]",$item['value']);
	 	
	 	echo CHtml::closeTag('div');
 	}
 }	
 ?>
</div>          
<div class="addContainer">
	<div id="addLink" title="Add link"></div>
	<div id="addText">
          <?php echo CHtml::textField('Text', 'some value',
				 array('id'=>'textLink', 
				       'width'=>100, 
				       'maxlength'=>150)); ?>
    </div>
</div>
	