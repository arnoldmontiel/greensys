<?php
//echo $model->name.'' .$model->last_name;

echo CHtml::openTag('div');
$reviews = $modelProject->reviews;
foreach ($reviews as $modelReview)
{
	echo (isset($modelReview->tags[0])?'('.$modelReview->tags[0]->description.') ':'').$modelReview->description;
	echo CHtml::openTag('br');
	$notes = $modelReview->notes;
	if(isset($notes))
	{
		foreach ($notes as $note){
			echo $note->creation_date.' '.$note->user->last_name.' '.$note->user->name.': '.$note->note;
			echo CHtml::openTag('br');
			//echo CHtml::closeTag('br');
			$litleNotes = $note->notes;
			foreach ($litleNotes as $litleNote){
				echo $litleNote->creation_date.' '.$litleNote->user->last_name.' '.$litleNote->user->name.': '.$litleNote->note;
				echo CHtml::openTag('br');
				//echo CHtml::closeTag('br');
			}
		}
	}
	
}
echo CHtml::closeTag('div');
