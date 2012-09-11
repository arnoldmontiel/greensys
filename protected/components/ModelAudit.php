<?php

class ModelAudit extends CActiveRecord
{
	public function afterSave()
	{
		$audit = new Audit;
		if($this->hasAttribute('Id'))
		{			
			$audit->Id_table = $this->Id;
		}
		
		$audit->table_name = $this->tableName();
		$audit->username =  Yii::app()->user->name;		
		
		if($this->isNewRecord)
		{
			$audit->operation = 'C';//creation
		}
		else
		{
			$audit->operation = 'U';//update
			//$date = new DateTime();
			//$this->date_modification = Yii::app()->lc->toDatabase($date->getTimestamp(),'datetime','small','datetime',null);//date('Y-m-d',strtotime($this->date_validity));
		}
		$audit->save();
		return parent::beforeSave();		
	}
	public function afterDelete()
	{
		$audit = new Audit;
		if($this->hasAttribute('Id'))
		{
			$audit->Id_table = $this->Id;				
		}
		
		$audit->table_name = $this->tableName();
		$audit->username =  Yii::app()->user->name;		
		$audit->operation = 'D';//delete
		
		$audit->save();
		return parent::afterDelete();
	}	
// 	public function getEntityType()
// 	{
// 		return EntityType::model()->findByAttributes(array('name'=>get_class(Customer::model())))->Id;
// 	}
	
}