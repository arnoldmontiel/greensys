<?php
class TapiaHelper
{
	static public function syncReviewState()
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('CURDATE() > DATE_ADD(change_date, interval '.TSetting::getChangeTagStateDays().' day) ');
		$criteria->addCondition('is_open = 1');
		
		$reviews = Review::model()->findAll($criteria);
		
		$modelLog = new SyncStateLog();
		$ids = "";
		$transaction = $modelLog->dbConnection->beginTransaction();
		
		try {
			foreach($reviews as $modelReview)
			{
				$modelTagReview = TagReview::model()->findByAttributes(array('Id_review'=>$modelReview->Id));
				if(isset($modelTagReview))
				{
					if($modelTagReview->Id_tag == 2) // si estaba en ejecucion
					{
						$modelTagReview->Id_tag = 3; // pasarlo a stand-by
						$modelTagReview->save();
						$ids = $ids . $modelReview->Id . ', ';
					}
				}
	
			}		
			$ids = rtrim($ids, ", ");
			$modelLog->ids_updated = $ids;
			$modelLog->save();
			$transaction->commit();
		} catch (Exception $e) {
			$modelLog->ids_updated = $ids;
			$modelLog->save();
			$transaction->rollback();
		}
	}
		
}
