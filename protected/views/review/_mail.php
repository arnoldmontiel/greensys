
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'mail-form',
		'enableAjaxValidation'=>false,
));

$criteria = new CDbCriteria;
$criteria->addCondition('Id_user_group != 3');
$modelUsers = User::model()->findAll($criteria);
$userList = CHtml::listData($modelUsers, 'username', 'FullnameAndMail');
$modelUser = User::getCurrentUser();
echo $form->hiddenField($model, 'Id');
echo $form->checkBoxList($modelUser, 'username', $userList);

?>
<?php $this->endWidget(); ?>
