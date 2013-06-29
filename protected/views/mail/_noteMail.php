<?php
echo CHtml::openTag('div');

echo CHtml::openTag('div');
echo $modelNote->creation_date.' '.$modelNote->user->last_name.' - '.$modelNote->user->name;
echo CHtml::closeTag('div');

echo CHtml::openTag('div');
	echo CHtml::openTag('p');
		echo $modelNote->note;
	echo CHtml::closeTag('p');
echo CHtml::closeTag('div');

echo CHtml::link('Ver mas...',Yii::app()->params['hostname'].ReviewController::createUrl('review/update',array('id'=>$modelReview->Id,'newIdNote'=>$modelNote->Id))."#BOTTOM");
echo CHtml::closeTag('div');
