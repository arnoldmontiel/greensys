<div class="index-review-quick-view">
<?php
	if(!empty($project->reviews))
	{
		echo $this->renderPartial('_quickViewChart', array('project'=>$project));		
	}
?>
<div class="review-action-customer" >
	<?php 
		//echo CHtml::link($customer->person->name.' '.$customer->person->last_name. ' - ' . $customer->tagDesc,
	echo CHtml::link($customer->contact->description.' - '.$project->description,
		ReviewController::createUrl('index',array('Id_customer'=>$customer->Id,'Id_project'=>$project->Id)),
		array('class'=>'index-review-single-link')
		);
	 ?>
</div>
<?php 
foreach ($data as $item){
		$this->renderPartial('_view',array('data'=>$item,'width'=>'95%'));
}

if(count($data) == 0)
	echo '<div  class="index-review-customer-separator"></div>'; 
?>

</div>