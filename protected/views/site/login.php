<div class="loginGoogle">
<?php 
	$this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
	if(isset($error_text))
	{
		echo CHtml::openTag('div',array('class'=>"errorMessage",'style'=>'width:200%'));
		echo $error_text;
		echo CHtml::closeTag('div');
		echo "<iframe id='logoutframe' src='https://accounts.google.com/logout' style='display: none'></iframe>";
	}
?>
</div>