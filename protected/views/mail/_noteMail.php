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
$action = 'review/update';
if(!$modelReview->is_open)
	$action = 'review/viewClose';

echo CHtml::link('Ver mas...',Yii::app()->params['hostname'].ReviewController::createUrl($action,array('id'=>$modelReview->Id,'newIdNote'=>$modelNote->Id))."#BOTTOM");
echo CHtml::closeTag('div');
echo CHtml::openTag('br');
echo CHtml::openTag('br');
echo CHtml::openTag('div');
echo CHtml::openTag('b',array('style'=>'color:rgb(136,136,136);font-size:small;font-family:arial'));
echo CHtml::openTag('span',array('lang'=>'ES','style'=>'color:rgb(136,136,136);font-size:small;font-family:arial'));
echo 'No responder este correo.';
echo CHtml::openTag('br');		
echo CHtml::closeTag('span');
echo CHtml::closeTag('b');
echo CHtml::openTag('b',array('style'=>'color:rgb(136,136,136);font-size:small;font-family:arial'));
echo CHtml::openTag('span',array('lang'=>'ES','style'=>'color:rgb(136,136,136);font-size:small;font-family:arial'));
echo 'Grupo Smartliving.';
echo CHtml::openTag('br');
echo CHtml::closeTag('span');
echo CHtml::closeTag('b');

echo CHtml::closeTag('div');
