<?php

class ReviewTypeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/tcolumn2';
		
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelReviewTypeUserGroup = new ReviewTypeUserGroup('Search');
		$modelReviewTypeUserGroup->Id_review_type = $id;
				
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'modelReviewTypeUserGroup'=>$modelReviewTypeUserGroup
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ReviewType;
		$model->has_tag_tracking = true;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ReviewType']))
		{
			$model->attributes=$_POST['ReviewType'];
			
			if($model->save())
			{				
				$this->createNewTagRelation($model->Id, $model->has_tag_tracking, true);
				
				if(isset($_POST['hidden-user-group-chk']))
					$this->createUserGroupRelation($model->Id, $_POST['hidden-user-group-chk']);
				
				$this->redirect(array('admin'));				
			}
		}

		$this->render('create',array(
			'model'=>$model
		));
	}
	
	private function createNewTagRelation($id, $tagType, $isNew = true)
	{
		$tags = null;
		
		if($tagType == 1)//con seguimiento
			$tags = array(1,2,3);
		else
			$tags = array(4);
		
		if(!$isNew)
		{
			TagReviewType::model()->deleteAllByAttributes(array('Id_review_type'=>$id));
			$reviews = Review::model()->findAllByAttributes(array('Id_review_type'=>$id));			
			
			//agrego el review_type en cada review asociado (historial)
			foreach($reviews as $review)
			{
				if($tagType == 1)// con seguimiento
				{
					$criteria = new CDbCriteria();
					$criteria->join = 'INNER JOIN note_note nn on (t.Id = nn.Id_parent)';
					$criteria->addCondition('t.Id_review = '.$review->Id);
					$notesCount = Note::model()->count($criteria);
					
					if($notesCount == 0)
					{
						$newTagId = 1; //pendiente
					}
					else
					{	
						$reviewChangeDate = date("Y-m-d H:i:s", strtotime($review->change_date));
						$limitDate = date("Y-m-d H:i:s",strtotime(" - ".TSetting::getChangeTagStateDays()." days"));
						if($reviewChangeDate >= $limitDate)
							$newTagId = 2; //en ejecucion
						else
							$newTagId = 3; //stand-by
					}	
				}
				else
				{
					$newTagId = 4; //sin seg
				}
				
				
				$modelTagReview = new TagReview();
				$modelTagReview->Id_review = $review->Id;				
				$modelTagReview->Id_tag = $newTagId;
				$modelTagReview->save();
			}
		}		
	
		foreach ($tags as $i => $value) {
			$modelTagReviewType = new TagReviewType();
			$modelTagReviewType->Id_review_type = $id;
			$modelTagReviewType->Id_tag = $value;
			$modelTagReviewType->save();
		}
	}
	
	private function createUserGroupRelation($id, $chkList)
	{
		//itero por perfil.
		$json = json_decode($chkList);
		
		$transaction = ReviewTypeUserGroup::model()->dbConnection->beginTransaction();
		try {
			foreach ($json as $key => $obj)
			{
				if(isset($obj))
				{
					$exist= true; 				
					
					$modelReviewTypeUserGroup = ReviewTypeUserGroup::model()->findByAttributes(array('Id_review_type'=>$id, 'Id_user_group'=>$key));
					if(isset($modelReviewTypeUserGroup))
					{						
						$exist= true; 				
						$criteria = new CDbCriteria();
						$criteria->distinct = true;
						$criteria->select = 't.Id_note, t.Id_customer, t.Id_project';
						$criteria->join = 'INNER JOIN note n on (t.Id_note = n.Id) 
						inner join review r on (r.Id = n.Id_review)';
						$criteria->addCondition('n.Id_review is not null');
						$criteria->addCondition('r.Id_review_type = '.$id );
	
						//obtengo los Id_note que tienen publicaciones
						$arrResult = UserGroupNote::model()->findAll($criteria);
						
						foreach($arrResult as $item)
						{
							if($obj->read==0)
							{
								UserGroupNote::model()->deleteAllByAttributes(array(
																				'Id_note'=>$item->Id_note,
																				'Id_user_group'=>$key
																				));
								$criteria = new CDbCriteria();								
								$criteria->addCondition('username IN (select u.username from user u where
															u.Id_user_group = '.$key.' )');								
								ReviewUser::model()->deleteAll($criteria);
							}
							else 
							{
								$modelUserGroupNote = UserGroupNote::model()->findByAttributes(
																		array('Id_note'=>$item->Id_note,
																			'Id_user_group'=>$key
																		));
								$id_note = $item->Id_note;
								$id_customer = $item->Id_customer;
								$id_project = $item->Id_project;
								if(isset($modelUserGroupNote))
								{							
// 									$modelUserGroupNote->can_feedback = $obj->feedback;
// 									$modelUserGroupNote->addressed = $obj->mail;
// 									$modelUserGroupNote->save();
									
									$sql="UPDATE user_group_note SET can_feedback=:can_feedback , addressed=:addressed WHERE Id_note=:Id_note and Id_user_group=:Id_user_group";
									$command=Yii::app()->db2->createCommand($sql);
									$command->bindParam(":Id_user_group",$key,PDO::PARAM_INT);
									$command->bindParam(":can_feedback",$obj->feedback,PDO::PARAM_BOOL);
									$command->bindParam(":addressed",$obj->mail,PDO::PARAM_BOOL);
									$command->bindValue(":Id_note",$id_note,PDO::PARAM_INT);
									$command->execute();
								}
								else 
								{
									if($obj->read==1)
									{
										$sql="INSERT INTO user_group_note (Id_note,Id_customer,Id_project,Id_user_group ,can_feedback, addressed) VALUES(:Id_note,:Id_customer,:Id_project,:Id_user_group ,:can_feedback,:addressed)";
										$command=ReviewTypeUserGroup::model()->dbConnection->createCommand($sql);
										$command->bindParam(":Id_note",$id_note,PDO::PARAM_INT);
										$command->bindParam(":Id_customer",$id_customer,PDO::PARAM_INT);
										$command->bindParam(":Id_project",$id_project,PDO::PARAM_INT);
										$command->bindParam(":Id_user_group",$key,PDO::PARAM_INT);
										$command->bindParam(":can_feedback",$obj->feedback,PDO::PARAM_BOOL);
										$command->bindParam(":addressed",$obj->mail,PDO::PARAM_BOOL);
										$command->execute();
										
										$id_review = $item->note->Id_review;
										$criteria = new CDbCriteria();
										$criteria->addCondition('Id_user_group='.$key);
										$criteria->join = 'INNER JOIN user_customer uc ON (uc.username = t.username)';								
										$criteria->addCondition('uc.Id_project='.$id_project);
										$users = User::model()->findAll($criteria);
										foreach ($users as $user)
										{
											$username = $user->username;
											$reviewUser = ReviewUser::model()->findByAttributes(array('username'=>$username,'Id_review'=>$id_review));
											if(!isset($reviewUser))
											{
												$sql="INSERT INTO review_user (Id_review,username) VALUES(:Id_review,:username)";
												$command=ReviewTypeUserGroup::model()->dbConnection->createCommand($sql);
												$command->bindParam(":Id_review",$id_review,PDO::PARAM_INT);
												$command->bindParam(":username",$username,PDO::PARAM_INT);
												$command->execute();
											}												
										}
										
// 										$modelUserGroupNote = new UserGroupNote();
// 										$modelUserGroupNote->Id_note = $item->Id_note;
// 										$modelUserGroupNote->Id_customer = $item->Id_customer;
// 										$modelUserGroupNote->Id_project = $item->Id_project;
// 										$modelUserGroupNote->Id_user_group = $key;
										
// 										$modelUserGroupNote->can_feedback = $obj->feedback;
// 										$modelUserGroupNote->addressed = $obj->mail;
// 										$modelUserGroupNote->save();
									}
								}
							}
						}
					}
					else 
					{
						$exist = false;
// 						$modelReviewTypeUserGroup = new ReviewTypeUserGroup;
// 						$modelReviewTypeUserGroup->Id_user_group =  $key;
// 						$modelReviewTypeUserGroup->Id_review_type = $id;					
					}
					if($exist)
					{
						$sql="UPDATE review_type_user_group SET can_feedback=:can_feedback, can_mail=:can_mail,can_close=:can_close,can_create=:can_create,can_read=:can_read WHERE Id_user_group=:Id_user_group AND Id_review_type=:Id_review_type";
						$command=ReviewTypeUserGroup::model()->dbConnection->createCommand($sql);
						$command->bindParam(":Id_user_group",$key,PDO::PARAM_INT);
						$command->bindParam(":Id_review_type",$id,PDO::PARAM_INT);
						$command->bindParam(":can_feedback",$obj->feedback,PDO::PARAM_BOOL);
						$command->bindParam(":can_mail",$obj->mail,PDO::PARAM_BOOL);
						$command->bindParam(":can_close",$obj->close,PDO::PARAM_BOOL);
						$command->bindParam(":can_create",$obj->create,PDO::PARAM_BOOL);
						$command->bindParam(":can_read",$obj->read,PDO::PARAM_BOOL);
						$command->execute();						
					}
					else
					{
						$sql="INSERT INTO review_type_user_group (Id_user_group,Id_review_type,can_feedback,can_mail,can_close,can_create,can_read) VALUES(:Id_user_group,:Id_review_type,:can_feedback,:can_mail,:can_close,:can_create,:can_read)";
						$command=ReviewTypeUserGroup::model()->dbConnection->createCommand($sql);
						$command->bindParam(":Id_user_group",$key,PDO::PARAM_INT);
						$command->bindParam(":Id_review_type",$id,PDO::PARAM_INT);
						$command->bindParam(":can_feedback",$obj->feedback,PDO::PARAM_BOOL);
						$command->bindParam(":can_mail",$obj->mail,PDO::PARAM_BOOL);
						$command->bindParam(":can_close",$obj->close,PDO::PARAM_BOOL);
						$command->bindParam(":can_create",$obj->create,PDO::PARAM_BOOL);
						$command->bindParam(":can_read",$obj->read,PDO::PARAM_BOOL);
						$command->execute();												
					}
						
// 					$modelReviewTypeUserGroup->can_create = $obj->create;
// 					$modelReviewTypeUserGroup->can_read = $obj->read;
// 					$modelReviewTypeUserGroup->can_feedback = $obj->feedback;
// 					$modelReviewTypeUserGroup->can_mail = $obj->mail;
// 					$modelReviewTypeUserGroup->can_close = $obj->close;
// 					$modelReviewTypeUserGroup->save();
				}
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ReviewType']))
		{
			$tagTypeChange = false;
			if($_POST['ReviewType']['has_tag_tracking'] != $model->has_tag_tracking )
				$tagTypeChange = true;
			
			$model->attributes=$_POST['ReviewType'];
			if($model->save())
			{					
				if($tagTypeChange)					
					$this->createNewTagRelation($model->Id, $model->has_tag_tracking, false);
				
				if(isset($_POST['hidden-user-group-chk']))
					$this->createUserGroupRelation($model->Id, $_POST['hidden-user-group-chk']);
				
				$this->redirect(array('admin'));
				
			}
		}		
		
		$this->render('update',array(
			'model'=>$model,			
		));
	}

	public function actionAjaxChangeTagType()
	{
		$idRadio = (isset($_POST['idRadio'])?$_POST['idRadio']:null);		
		$id = (isset($_POST['idReviewType'])?$_POST['idReviewType']:null);
		
		$tags = null;
		
		if(isset($idRadio) && isset($id))
		{
			if($idRadio == '1')//con seguimiento
			{
				$tags = array(1,2,3);
				$newTag = 1; //pendiente
			}
			else
			{
				$tags = array(4);
				$newTag = 4; //sin seguimiento
			}
			
			$modelReviews = Review::model()->findAllByAttributes(array('Id_review_type'=>$id));
			foreach($modelReviews as $modelReview)
			{
				TagReview::model()->deleteAllByAttributes(array('Id_review'=>$modelReview->Id));
				$modelTagReview = new TagReview();
				$modelTagReview->Id_review = $modelReview->Id;
				$modelTagReview->Id_tag = $newTag;
				$modelTagReview->save();
			}
			
			TagReviewType::model()->deleteAllByAttributes(array('Id_review_type'=>$id));
			foreach ($tags as $i => $value) {
				$modelTagReviewType = new TagReviewType();
				$modelTagReviewType->Id_review_type = $id;
				$modelTagReviewType->Id_tag = $value;
				$modelTagReviewType->save();
			}
		}
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
// 		$dataProvider=new CActiveDataProvider('ReviewType');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));
		$model=new ReviewType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReviewType']))
		$model->attributes=$_GET['ReviewType'];
		
		$this->render('admin',array(
					'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ReviewType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReviewType']))
			$model->attributes=$_GET['ReviewType'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAjaxDelete($id)
	{		
		$model=$this->loadModel($id);		
		
		$criteria=new CDbCriteria;
		$criteria->condition='Id <> '. $id;
		$criteria->addCondition('has_tag_tracking ='.$model->has_tag_tracking); 
		$ddlReviewType = ReviewType::model()->findAll($criteria);
		
		if(count($ddlReviewType)>0)
			echo $this->renderPartial('_deletePopUp', array('model'=>$model, 'ddlReviewType'=>$ddlReviewType));
		else
			echo '';
	}
	
	public function actionAjaxReplace()
	{
		$idReviewType = isset($_POST['Id-to-delete'])?$_POST['Id-to-delete']:null;
		$newIdReviewType = isset($_POST['new-review-type'])?$_POST['new-review-type']:null;
		
		if(isset($idReviewType) && isset($newIdReviewType))
		{
			$model=$this->loadModel($idReviewType);
			$criteria=new CDbCriteria;
			$criteria->condition='Id_review_type = '. $idReviewType;
			
			$transaction = $model->dbConnection->beginTransaction();
			try {			
				Review::model()->updateAll(array('Id_review_type'=>$newIdReviewType),$criteria);
				
				$tagReviewTypes = TagReviewType::model()->findAll($criteria);
				foreach($tagReviewTypes as $item)
				{
					$modelTagReviewType = TagReviewType::model()->findByAttributes(array('Id_tag'=>$item->Id_tag, 'Id_review_type'=>$newIdReviewType));
					if(isset($modelTagReviewType))
						$item->delete();
					else{
						$item->Id_review_type = $newIdReviewType;
						$item->save();
					}
				}

				$reviewTypeUserGroups = ReviewTypeUserGroup::model()->findAll($criteria);
				foreach($reviewTypeUserGroups as $item)
				{
					$modelReviewTypeUserGroup = ReviewTypeUserGroup::model()->findByAttributes(array('Id_user_group'=>$item->Id_user_group, 'Id_review_type'=>$newIdReviewType));
					if(isset($modelReviewTypeUserGroup))
						$item->delete();
					else{
						$item->Id_review_type = $newIdReviewType;
						$item->save();
					}
				}
				$model->delete();
				$transaction->commit();
				return;
			} catch (Exception $e) {
				$transaction->rollback();
			}
			
		}
		echo "Error Reemplazando";
		
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ReviewType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-type-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
