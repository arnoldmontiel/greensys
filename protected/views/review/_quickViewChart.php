<?php
if(User::isAdministartor())
{
	//echo CHtml::openTag('div',array('style'=>'float:left'));
	echo "<div class='chart-container' id='chart-container_".$project->Id."'>";
	$reviews = $project->reviews;
	$dataChart= array();
	foreach ($reviews as $review)
	{
		if(!$review->is_open)
		{
			$dataChart['Finalizado']=isset($dataChart['Finalizado'])?$dataChart['Finalizado']+1:1;
		}
		elseif(isset($review->tags[0]))
		{
			$tag = $review->tags[0];
			if($tag->Id==4) continue;
			$dataChart[$tag->description]=isset($dataChart[$tag->description])?$dataChart[$tag->description]+1:1;
		}
	}
	$tags = Tag::model()->findAll();
	$finalData = array();
	$finalData[]=isset($dataChart['Finalizado'])?
	array("name"=>'Finalizado',
			"y"=>$dataChart['Finalizado'],
			"sliced"=> true,
			"selected"=> false,
			"color"=>"#CCCCCC"):
			array("name"=>'Finalizado',
					"y"=>0,
					"sliced"=> true,
					"selected"=> false,
					"color"=>"#CCCCCC"
			);
	foreach ($tags as $tag)
	{
		if($tag->Id==4) continue;
		$color="#CCCCCC";
		if($tag->description=="Stand By")
		{
			$color="#FFFF99";
		}
		elseif($tag->description=="Pendiente")
		{
			$color="#CC3300";
		}
		elseif("En Ejecución")//en ejecución
		{
			$color="#66FF66";

		}
		if(isset($dataChart[$tag->description]))
		{
			$finalData[]=array(
					"name"=>$tag->description,
					"y"=>$dataChart[$tag->description],
					"sliced"=> true,
					"selected"=> false,
					"color"=>$color);
		}
		else
		{
			$finalData[]=array(
					"name"=>$tag->description,
					"y"=>0,
					"sliced"=> true,
					"selected"=> false,
					"color"=>$color);
		}
	}

	$this->Widget('ext.highcharts.HighchartsWidget', array(
			'htmlOptions'=>array(),
			'options'=>array(
					'chart'=> array(
							'renderTo'=> 'chart-container_'.$project->Id,
							'margin'=> array(0, 0, 0, 0),
							'spacingTop'=> 0,
							'spacingBottom'=> 0,
							'spacingLeft'=> 0,
							'spacingRight'=> 0,
					),
					'credits' => array('enabled' => false),
					'ajax'=>1,
					'title' => array('text' => null),
					'plotOptions'=>
					array('pie'=>
							array('size'=>'80%',
									"dataLabels"=> array("enabled"=> false))),
					'series' => array(
							array("type"=> "pie",'name' => 'Cantidad', 'data' => $finalData),
							//array('name' => 'John', 'data' => array(5, 7, 3))
					)
			)
	));
	echo CHtml::closeTag('div');
}