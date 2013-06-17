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
				$criteria = new CDbCriteria();
				$criteria->addCondition('date in (select max(date) from tag_review where Id_review ='.$modelReview->Id.')');
				$criteria->addCondition('t.Id_review = '.$modelReview->Id);
				$modelTagReviewDb = TagReview::model()->find($criteria);
								
				if(isset($modelTagReviewDb))
				{
					if($modelTagReviewDb->Id_tag == 1 || $modelTagReviewDb->Id_tag == 2) // si es pendiente o en ejecucion
					{
						$modelTagReview = new TagReview();
						$modelTagReview->Id_review = $modelReview->Id;
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
