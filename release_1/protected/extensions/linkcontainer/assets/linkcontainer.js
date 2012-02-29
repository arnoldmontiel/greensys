$(document).ready(function() {
	$('#addLink').click(function() {	 

		$linkValue = $("#textLink").attr("value"); 
		if(validateURL($linkValue)){
			if(!containHTTP($linkValue)){
				$linkValue = 'http://' + $linkValue; 
			}
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

function containHTTP(textval) {
	  var urlregex = new RegExp(
	        "^(http:\/\/www.|https:\/\/www.){1}([0-9A-Za-z]+\.)");

	  return urlregex.test(textval);
	}
