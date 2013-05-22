
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'mail-form',
		'enableAjaxValidation'=>false,
));

$criteria = new CDbCriteria;
$criteria->addCondition('Id_user_group != 3');
$modelUser = User::getCurrentUser();
$criteria->addCondition('username != "'.$modelUser->username.'"');
$modelUsers = User::model()->findAll($criteria);
array_unshift($modelUsers, $modelUser);
$userList = CHtml::listData($modelUsers, 'username', 'FullnameAndMail');
echo $form->hiddenField($model, 'Id');
echo $form->checkBoxList($modelUser, 'username', $userList);

?>
<?php $this->endWidget(); ?>
