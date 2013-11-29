
<div class="index-review-quick-view">
<div class="review-action-customer" <?php if(isset($isClosed)) echo "style='background-color: #CCCCCC;'"?>>
	<?php
		$tCustomer = TCustomer::model()->findByPk($customer->Id);
		//echo CHtml::link($customer->person->name.' '.$customer->person->last_name. ' - ' . $customer->tagDesc,
		if(isset($collapsed)&& $collapsed!==false)
		{
			echo CHtml::image('images/expand_blue.png','expandir',array('id'=>'collapse_'.$project->Id,'class'=>'collapser','title'=>'expandir'));
		}else {
			echo CHtml::image('images/collapse_blue.png','colapsar',array('id'=>'collapse_'.$project->Id,'class'=>'collapser','title'=>'colapsar'));				
		}
		$pageAction = 'index';
		if(isset($tCustomer) && !isset($tCustomer->username))
		{
			$pageAction = 'dashboardClient';
		}
		echo CHtml::link($customer->contact->description.' - '.$project->description,
		ReviewController::createUrl($pageAction,array('Id_customer'=>$customer->Id,'Id_project'=>$project->Id)),
		array('class'=>'index-review-single-link')
		);
	
	 ?>
</div>
<?php 
	$style =" ";
	if(isset($collapsed)&& $collapsed!==false) 
		$style= 'style=" display:none;" '; 
?>
<div class="index-review-quick-view-collapsable" <?php echo $style;?> id='collapseble_<?php echo $project->Id?>'>
<div class="index-review-quick-view-items" >
<?php 
	foreach ($data as $item){
			$this->renderPartial('_view',array('data'=>$item));
	}
	
	if(count($data) == 0)
		echo '<div  class="index-review-customer-separator"></div>'; 
	?>
</div>
<div class="index-review-quick-view-chart" >
	<?php 		
		if(isset($tCustomer))
		{
			if(!empty($project->reviews) && isset($tCustomer->username))
			{
				echo $this->renderPartial('_quickViewChart', array('project'=>$project));		
			}
		}
	?>
</div>
</div>
</div>