<?php

class ModelAudit extends CActiveRecord
{
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			if($this->hasAttribute('username_creation'))
			{
				$this->username_creation = Yii::app()->user->name;
			}
		}
		else
		{
			if($this->hasAttribute('username_modification'))
			{
				$this->username_modification = Yii::app()->user->name;				
			}
			if($this->hasAttribute('date_modification'))
			{
				$date = new DateTime();
				$this->date_modification = Yii::app()->lc->toDatabase($date->getTimestamp(),'datetime','small','datetime',null);//date('Y-m-d',strtotime($this->date_validity));
			}
		}
		return parent::beforeSave();		
	}
	

}