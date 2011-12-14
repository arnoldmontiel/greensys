<script type="text/javascript">
$(document).ready(function() {
	$('#addLink').click(function() {	 

		$linkValue = $("#textLink").attr("value"); 
		if(validateURL($linkValue)){
		  	$delete = '<div class="deleteLink" title="Delete"></div>';
		  	$hidden = '<input name="links[]" type="hidden" value="'+$linkValue+'">';
			$('.links').append("<div class='linkContainer'><div class='linkAdded'><a target='_blank' href='"+$linkValue+"'>"+$linkValue+"</a></div>"+$delete+$hidden+"</div>");
			$('.links').find(".deleteLink").click(function(){
				$(this).parent().remove();
			});
		}
		else{
			alert("Please enter a valid URL");
		}
		 
	
		
	});
	
	$(".deleteLink").click(function(){
		$(this).parent().remove();
	});



	  	
});

function validateURL(textval) {
	  var urlregex = new RegExp(
	        "^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
	  return urlregex.test(textval);
	}

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
	<div id="addLink" title="Add link"></div>
	<div id="addText">
          <?php echo CHtml::textField('Text', '',
				 array('id'=>'textLink', 
				 		'name' =>'textLink',
				       'width'=>100, 
				       'class' => 'required:true,url:true',
				       'maxlength'=>150)); ?>
    </div>
</div>
	