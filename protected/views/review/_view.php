<?php
$route = 'update';
if(!$data->isOpen())
	$route = 'viewClose';
?>
<a href="<?php echo ReviewController::createUrl($route,array('id'=>$data->Id))?>" class="index-review-single-link">
<div class="index-review-single" id='review_<?php echo $data->Id; ?>' <?php echo (isset($width)?" style='width:".$width."' " :""); ?>>
	<div class="index-review-single-container">		
	<?php
		$classStyle = 'index-review-summary-unread';
		$modelReviewUser = ReviewUser::model()->findByPk(array('Id_review'=>$data->Id,'username'=>User::getCurrentUser()->username));
		if($modelReviewUser && $modelReviewUser->read)
			$classStyle = 'index-review-summary'; ?>
	
	<?php
		if(!$data->is_open)
		{
			echo CHtml::openTag('div',array('class'=>'index-review-close-box','title'=>$data->closing_description));
				echo "Cerrado";
			echo CHtml::closeTag('div');
		}else
		{
			$tags = $data->tags;
			
			$criteria = new CDbCriteria();
			$criteria->addCondition('date in (select max(date) from tag_review where Id_review ='.$data->Id.')');
			$criteria->addCondition('t.Id_review = '.$data->Id);
			
			$modelTagReviewDb = TagReview::model()->find($criteria);
			
			if(isset($modelTagReviewDb))
			{
				$tag = $modelTagReviewDb->tag;
				echo CHtml::openTag('div',array('class'=>'index-review-tag-box'));

					$options = array('class'=>'index-review-single-tag');
					if($tag->Id==1)
					$options['style']='background-color: #CC3300;color: white;max-width:none';//rojo
					else if($tag->Id==2)
					$options['style']='background-color: #66FF66;max-width:none';//verde
					else if($tag->Id==3)
					$options['style']='background-color: #FFFF99;max-width:none';//amarillo
					else if($tag->Id==4)
					$options['style']='background-color: #FFCC66;max-width:none';//amarillo
				
					$options['title']=$tag->description;
					echo CHtml::openTag('div',$options);
					echo $tag->description;
					echo CHtml::closeTag('div');
				
				echo CHtml::closeTag('div');
			}
							
		}	
		echo CHtml::openTag('div',array('class'=>'index-review-type-box','title'=>$data->reviewType->description));
			echo $data->reviewType->description;
		echo CHtml::closeTag('div');
	?>
	
	<div class='<?php echo $classStyle ?>'>
		#<?php echo CHtml::encode($data->review); ?>:
		<?php echo CHtml::encode($data->description); ?>
	</div>
	<div class="index-review-date">
	<?php echo $data->change_date; ?>
		</div>
		
		<?php 
		
		$modelReview = Review::model()->findByPk($data->Id);
		
		echo CHtml::openTag('div',array('class'=>'index-review-resource-box'));
		if($modelReview->hasResource( User::getCurrentUserGroup()->Id, 1))
		{
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/image_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
		}
		
		if($modelReview->hasResource( User::getCurrentUserGroup()->Id, 2))
		{
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/video_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
		}
		
		if($modelReview->hasResource( User::getCurrentUserGroup()->Id, 3))
		{
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/pdf_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
		}
		
		if($modelReview->hasResource( User::getCurrentUserGroup()->Id, 4))
		{
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/autocad_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
		}
		
		if($modelReview->hasResource( User::getCurrentUserGroup()->Id, 5))
		{
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/word_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
		}
		
		if($modelReview->hasResource( User::getCurrentUserGroup()->Id, 6))
		{
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			echo CHtml::image('images/excel_resource.png','',array('style'=>'width:25px;'));
			echo CHtml::closeTag('div');
		}
		echo CHtml::closeTag('div');
		?>
	</div>
	<?php
// 		if(User::isAdministartor())
// 		{
// 			echo CHtml::openTag('div',array('class'=>'index-users'));
// 			$first = true;
// 			foreach ($data->reviewUsers as $item)
// 			{
// 				if($item->username == User::getCurrentUser()->username)
// 					continue;
// 				echo CHtml::openTag('div',array('class'=>$item->read?'index-text-user-read':'index-text-user'));
// 				$name = '';
// 				if(!$first)
// 				$name.=', ';
// 				if($first)
// 				$first = false;
// 				$name.=$item->user->name.' '.$item->user->last_name;
// 				echo $name;
// 				echo CHtml::closeTag('div');
// 			}
// 			echo CHtml::closeTag('div');
// 			$criteria = new CDbCriteria();
// 			$criteria->join = 'inner join review r on (t.change_date = r.change_date)';
// 			$criteria->addCondition('r.Id = '. $data->Id);
			
			$notes = $modelReview->notes;
			
			if(isset($notes[0]))
			{
				$note = $notes[0];
				$modelLastNote = $note;
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_parent = '. $note->Id);
				$criteria->select ='t.*, n.creation_date';
				$criteria->join='LEFT OUTER JOIN tapia.note n on (t.Id_child = n.Id)';
				$criteria->addCondition('n.in_progress=0');
				$criteria->order = 'n.creation_date DESC';
				$criteria->limit = 1;
				try {
					$noteNote = NoteNote::model()->find($criteria);
					if(isset($noteNote))
					{
						$litleNote = $noteNote->child;
						if(isset($litleNote))
							$modelLastNote = $litleNote;						
					}
				
				} catch (Exception $e) {
					echo $e.message;
				}				
				
			}
				
			if(isset($modelLastNote))
			{
					echo CHtml::openTag('div',array('class'=>'index-users'));
						echo CHtml::openTag('div',array('class'=>'index-text-user-read'));
						echo CHtml::closeTag('div');
						echo CHtml::openTag('div',array('class'=>'note-preview'));
						$name = $modelLastNote->change_date . ' - ' . $modelLastNote->user->name.' '.$modelLastNote->user->last_name;
						echo $name;						
						echo CHtml::closeTag('div');
						
					echo CHtml::closeTag('div');
			}
		//} 		
		?>
		<div>
		
	<?php 
	if(User::isAdministartor())
	{
		echo CHtml::link(
		    CHtml::image('images/remove.png','',
						array('id'=>'removeReview'.$data->Id, 'class'=>'review-action-remove-small','title'=>'Eliminar')),
			array( 'delete','id'=>$data->Id),
			array('onclick' => 'return confirm("\u00BFEsta seguro que desea borrar este formulario?")')
		);
	}
		
		?>
		
	</div>
</div>

</a>
