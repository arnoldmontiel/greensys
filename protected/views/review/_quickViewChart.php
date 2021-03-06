<?php
if(true)//User::isAdministartor()
{
	//echo CHtml::openTag('div',array('style'=>'float:left'));
	echo "<div class='chart-container' id='chart-container_".$project->Id."'>";
	$reviews = $project->reviews;
	$dataChart= array();
	foreach ($reviews as $review)
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition('date in (select max(date) from tag_review where Id_review ='.$review->Id.')');
		$criteria->addCondition('t.Id_review = '.$review->Id);
		
		$modelTagReview = TagReview::model()->find($criteria);
		$tag = $modelTagReview->tag;
		
		if(!$review->is_open)
		{
			$dataChart['Finalizado']=isset($dataChart['Finalizado'])?$dataChart['Finalizado']+1:1;
		}
		elseif(isset($tag))
		{
			if($tag->Id==4) continue;
			$dataChart[$tag->description]=isset($dataChart[$tag->description])?$dataChart[$tag->description]+1:1;
		}
	}
	$tags = Tag::model()->findAll();
	$finalData = array();
	$finalData[]=isset($dataChart['Finalizado'])?
	array("name"=>'Finalizado',
			"y"=>$dataChart['Finalizado'],
			"sliced"=> false,
			"selected"=> false,
			"color"=>"#CCCCCC"):
			array("name"=>'Finalizado',
					"y"=>0,
					"sliced"=> false,
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
					"sliced"=> false,
					"selected"=> false,
					"color"=>$color);
		}
		else
		{
			$finalData[]=array(
					"name"=>$tag->description,
					"y"=>0,
					"sliced"=> false,
					"selected"=> false,
					"color"=>$color);
		}
	}
	
	$datas= array();
	foreach ($finalData as $data)
	{
		$data["name"] = $data["name"].": ".$data["y"];
		$datas[] =$data;
	}
	
	$this->Widget('ext.highcharts.HighchartsWidget', array(
			'htmlOptions'=>array(),
			'options'=>array(
					'chart'=> array(
							'renderTo'=> 'chart-container_'.$project->Id,
							'margin'=> array(-50, 0, 0, 0),
							'spacingTop'=> 0,
							'spacingBottom'=> 0,
							'spacingLeft'=> 0,
							'spacingRight'=> 0,
					),
					'credits' => array('enabled' => false),
					'ajax'=>1,
					"tooltip"=> array(
						"enabled"=> true,
						"pointFormat"=> '',
						"percentageDecimals"=> "1"
					),
					'title' => array('text' => null),
					'plotOptions'=>
					array('pie'=>
							array('size'=>'80%',
									"allowPointSelect"=>true,
									"showInLegend"=> true,
									"dataLabels"=> array(
											
											"enabled"=> false,
											"color"=> "#000000",
											"connectorColor"=> "#000000",
											"formatter"=> "js:function() {
												return '<b>'+ this.point.name +'</b>: '+ this.point.y ;
											}",
											))),
					'series' => array(
							array("type"=> "pie",'name' => 'Cantidad', 'data' => $datas),
							//array('name' => 'John', 'data' => array(5, 7, 3))
					)
			)
	));
	echo CHtml::closeTag('div');
}