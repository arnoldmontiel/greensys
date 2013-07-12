<?php

class ReviewController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/tcolumn3';

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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	private function publicNote($idNote,$idCustomer,$idProject,$idReviewType)
	{
		$model = new UserGroupNote;
		UserGroupNote::model()->deleteAllByAttributes(array('Id_note'=>$idNote, 'confirmed'=>0, 'declined'=>0));
		//-----------------------------------------------
		$arrReviewTypeUsrGroup = ReviewTypeUserGroup::model()->findAllByAttributes(
				array('can_read'=>1,
						'Id_review_type'=>$idReviewType,
				));

		foreach($arrReviewTypeUsrGroup as $modelReviewTypeUserGroup)
		{
			$model = new UserGroupNote;

			$model->Id_note = $idNote;
			$model->Id_customer = $idCustomer;
			$model->Id_project = $idProject;
			$model->Id_user_group = $modelReviewTypeUserGroup->Id_user_group;

			$model->can_feedback = $modelReviewTypeUserGroup->can_feedback;
			$model->addressed = $modelReviewTypeUserGroup->can_mail;
			$model->save();
		}

		//review-user First insert
		$modelNote = Note::model()->findByPk($idNote);
		$modelReviewUserDb = ReviewUser::model()->findByPk(array('Id_review'=>$modelNote->Id_review,'username'=>User::getCurrentUser()->username));
		if(!$modelReviewUserDb)
		{
			$modelReviewUser = new ReviewUser;
			$modelReviewUser->Id_review = $modelNote->Id_review;
			$modelReviewUser->username = User::getCurrentUser()->username;
			$modelReviewUser->save();
		}
		GDriveHelper::shareFilesByNote($idNote);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Review('creation');
		$modelNote=new Note('reviewCreation');
		$modelCustomer=new TCustomer;
		$modelProject=new Project;
		$modelReviewType = array();
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidationNote($model,$modelNote);
		
		$dllReviewTypeUserGroup = ReviewTypeUserGroup::model()->findAllByAttributes(
				array('Id_user_group'=>User::getCurrentUserGroup()->Id,
						'can_create'=>1));
		if($dllReviewTypeUserGroup)
		{
			foreach($dllReviewTypeUserGroup as $itemReviewType)
			{
				$item['Id'] = $itemReviewType->Id_review_type;
				$item['description'] = $itemReviewType->reviewType->description;
				$item['long_description'] = $itemReviewType->reviewType->long_description;
				$modelReviewType[$itemReviewType->Id_review_type] = $item;
			}
		}
		
		if(isset($_GET['Id_project']))
		{
			$model->Id_project=$_GET['Id_project'];
			$modelProject = Project::model()->findByPk($model->Id_project);
			$modelCustomer = TCustomer::model()->findByPk($modelProject->Id_customer);
			$model->Id_customer=$modelCustomer->Id;
		}
		if(isset($_POST['Review']))
		{
			$model = $this->loadModel($_POST['Review']['Id']);
			$model->setScenario('creation');
			$model->attributes=$_POST['Review'];
			$transaction = $modelNote->dbConnection->beginTransaction();
			try {
				$this->fillNote($model,$modelNote);
				if($model->save())
				{
					$this->autoTagAssign($model);
					$modelNote->setScenario('reviewCreation');
					if($modelNote->save())
					{
						$this->publicNote($modelNote->Id,$model->Id_customer,$model->Id_project,$model->Id_review_type);
						$transaction->commit();
						$this->sendMailNote($modelNote->Id);
						$this->redirect(array('update','id'=>$model->Id));						
					}
				}				
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		else 
		{
			if(isset($_GET['Id_project']))
			{
				//notas que no tengan usergroup
				$criteria = new CDbCriteria;
				$criteria->compare('Id_project',$_GET['Id_project']);
				$criteria->compare('username',User::getCurrentUser()->username);
				$criteria->addCondition('Id_review IS NOT NULL');
				$criteria->addCondition('t.Id NOT IN(select Id_note from user_group_note)');
				
				$modelNote = Note::model()->find($criteria);
				if(isset($modelNote))
				{
					$model=Review::model()->findByPk($modelNote->Id_review);
				}
				else
				{
					$modelNote=new Note;						
					$model->setScenario('insert');
					//set next review
					$criteria=new CDbCriteria;
					
					$criteria->select='MAX(review) as maxReview';
					$criteria->condition='Id_customer = '.$model->Id_customer . ' AND Id_review_type = '. key($modelReviewType);
					$criteria->condition='Id_project = '.$model->Id_project;
						
					$modelMax = Review::model()->find($criteria);
					
					$model->review = $modelMax->maxReview + 1;
					//------------------
					$reviewType = current($modelReviewType);
					$model->Id_review_type = $reviewType['Id'];
					$modelNote->setScenario('insert');
					try {
						
						if($model->save())//new review
						{
							$this->autoTagAssign($model);
							$this->fillNote($model,$modelNote);
							$modelNote->save();
								
						}						
					} catch (Exception $e) {
					}
				}
			}				
		}
		$model->setScenario('creation');
		$modelNote->setScenario('reviewCreation');
		
		$this->render('create',array(
			'model'=>$model,
			'modelCustomer'=>$modelCustomer,
			'modelProject'=>$modelProject,
			'modelReviewType'=>$modelReviewType,
			'modelNote'=>$modelNote,
		));
	}	
	public function actionAjaxAutoSave()
	{
		if(isset($_POST['Review'])&&isset($_POST['Note']))
		{
			$modelReview = $this->loadModel($_POST['Review']['Id']);
			$modelNote = Note::model()->findByPk($_POST['Note']['Id']);
			$modelNote->attributes = $_POST['Note'];
			$modelReview->attributes = $_POST['Review'];
			$modelNote->Id_review = $modelReview->Id;
			$modelReview->save();
			$modelNote->save();
			echo CJSON::encode(array_merge($modelReview->attributes,$modelNote->attributes));
		}
	}
	private function fillNote($model,&$modelNote)
	{		
		if(isset($_POST['Note']['Id']))
		{
			$modelNote = Note::model()->findByPk($_POST['Note']['Id']);				
		}
		if(isset($_POST['Note']))
		{
			$modelNote->attributes = $_POST['Note'];
		}
		$modelNote->Id_customer = $model->Id_customer;
		$modelNote->Id_review = $model->Id;
		$modelNote->Id_project = $model->Id_project;
		$modelNote->username = User::getCurrentUser()->username;
		$modelNote->Id_user_group_owner = User::getCurrentUserGroup()->Id;
		$modelNote->in_progress = 0;
	}
	private function autoTagAssign($model)
	{
		$modelTagReview = new TagReview;

		$modelTagReview->Id_review = $model->Id;
		
		if(TagReviewType::model()->countByAttributes(array('Id_review_type'=>$model->Id_review_type))>1)
			$modelTagReview->Id_tag = 1;//Pendiente
		else
			$modelTagReview->Id_tag = 4;//Sin seguimiento
		
		$modelTagReview->save();
	}
	
	public function actionAjaxGetNextReviewIndex()
	{
		$idCustomer = $_POST['idCustomer'];
		$idProject = $_POST['idProject'];
		$idReviewType = $_POST['idReviewType'];
		
		$criteria=new CDbCriteria;
		
		$criteria->select='MAX(review) as maxReview';
		$criteria->addCondition('Id_customer = '.$idCustomer);
		$criteria->addCondition('Id_project = '.$idProject);
		$criteria->addCondition('Id_review_type = '.$idReviewType);
		
		$modelMax = Review::model()->find($criteria);
		
		echo $modelMax->maxReview + 1;
	}
	
	public function actionViewClose($id, $newIdNote=null,$order=null)
	{
		$model=$this->loadModel($id);
		
		$modelReviewUser = ReviewUser::model()->findByPk(array('Id_review'=>$id,'username'=>User::getCurrentUser()->username));
		
		if(isset($modelReviewUser))
		{
			if(!$modelReviewUser->read)
			{
				$modelReviewUser->read = 1;
				$modelReviewUser->save();
			}
		}
		
		$this->render('viewClose',array(
					'model'=>$model,
					'newIdNote'=>$newIdNote,
		//'order'=>$order,deprecated
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=null, $newIdNote=null ,$order=null)
	{				
		$model=$this->loadModel($id);
		if(!$model->is_open)
		{
			$this->actionViewClose($id,$newIdNote,$order);
			return;
		}
		$this->modelTag = $model;
		
		$dllReviewTypeUserGroup = ReviewTypeUserGroup::model()->findAllByAttributes(
				array('Id_user_group'=>User::getCurrentUserGroup()->Id));
		
		$ddlReviewType = array();
		if($dllReviewTypeUserGroup)
		{
			foreach($dllReviewTypeUserGroup as $itemReviewType)
			{
				$item['Id'] = $itemReviewType->Id_review_type;
				$item['description'] = $itemReviewType->reviewType->description;
				$ddlReviewType[$itemReviewType->Id_review_type] = $item;
			}
		}
		
	    $modelReviewUser = ReviewUser::model()->findByPk(array('Id_review'=>$id,'username'=>User::getCurrentUser()->username));
		
		if(isset($modelReviewUser))
		{
			if(!$modelReviewUser->read)
			{
				 $modelReviewUser->read = 1;
				 $modelReviewUser->save();
			}
		}
		else
		{
			$modelReviewUser = new ReviewUser();
			$modelReviewUser->read = 1;
			$modelReviewUser->Id_review = $id;
			$modelReviewUser->username = User::getCurrentUser()->username;
			$modelReviewUser->save();
		}
		
		
		$modelNote = Note::model()->findByAttributes(array('in_progress'=>1, 'Id_review'=>$id, 'username'=>User::getCurrentUser()->username ));
		$idNote = null; 
		if(isset($modelNote))
		{
			$idNote = $modelNote->Id;				
		}
				
		$modelMultimedia = TMultimedia::model()->findAllByAttributes(array('Id_review'=>$id, 'Id_user_group'=>User::getCurrentUserGroup()->Id ));
		$modelAlbum = Album::model()->findAllByAttributes(array('Id_review'=>$id, 'Id_user_group_owner'=>User::getCurrentUserGroup()->Id ));
		
		$this->render('update',array(
			'model'=>$model,
			'idNote'=>$idNote,
			'ddlReviewType'=>$ddlReviewType,
			'modelMultimedia'=>$modelMultimedia,
			'modelAlbum'=>$modelAlbum,
			'newIdNote'=>$newIdNote,
			//'order'=>$order,deprecated 
		));
	}

	public function actionAjaxViewImageResource($Id_customer,$Id_project)
	{
		//$this->layout='//layouts/tcolumn2';
		$modelAlbum = Album::model()->findAllByAttributes(array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project,
								'Id_user_group_owner'=>User::getCurrentUserGroup()->Id ));
		
		$this->render('viewImageResource',array(					
					'modelAlbum'=>$modelAlbum,
					'Id_customer'=>$Id_customer,
					'Id_project'=>$Id_project,
		));
	}
	
	public function actionAjaxViewDocResource($Id_customer,$Id_project)
	{
		//$this->layout='//layouts/tcolumn2';		
		$criteria=new CDbCriteria;
		$criteria->addCondition('Id_document_type is null');
		$criteria->addCondition('Id_user_group = '. User::getCurrentUserGroup()->Id);
		$criteria->addCondition('Id_customer = '. $Id_customer);
				
		$modelMultimedia = TMultimedia::model()->findAll($criteria);
	
		$this->render('viewDocResource',array(
						'modelMultimedia'=>$modelMultimedia,
						'Id_customer'=>$Id_customer,
						'Id_project'=>$Id_project,
		));
	}
	
	public function actionAjaxViewTechDocResource($Id_customer,$Id_project)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('Id_document_type is not null');		
		$criteria->addCondition('Id_customer = '. $Id_customer);
		$criteria->addCondition('Id_project = '. $Id_project);
		$criteria->addCondition('Id_multimedia_type <> 1'); //no traigo imagenes		
		$criteria->order = 'Id_document_type, Id DESC';
				
		$modelMultimedia = TMultimedia::model()->findAll($criteria);
		
		$this->render('viewTechDocResource',array(
						'modelMultimedia'=>$modelMultimedia,
						'Id_customer'=>$Id_customer,
						'Id_project'=>$Id_project,
		));
	}
	
	public function actionSelectAttach($id, $idNote)
	{
		//$this->layout='//layouts/tcolumn2';
		$this->render('selectAttach',array(
								'id'=>$id,
								'idNote'=>$idNote,								
		));
	}
	
	public function actionAjaxAttachImage($id, $idNote)
	{
		//$this->layout='//layouts/tcolumn2';
		$model=$this->loadModel($id);
		
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id NOT IN(select Id_multimedia from multimedia_note where Id_note = '. $idNote.')');
		$criteria->addCondition('t.Id_user_group = '. User::getCurrentUserGroup()->Id);
		//$criteria->addCondition('t.Id_review = '. $id);
		$criteria->addCondition('t.Id_customer = '. $model->Id_customer);
		$criteria->addCondition('t.Id_project = '. $model->Id_project);
		$criteria->addCondition('t.Id_multimedia_type = 1'); //image
		
		$modelMultimedia = TMultimedia::model()->findAll($criteria);
		
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id IN(select Id_multimedia from multimedia_note where Id_note = '. $idNote.')');
		//$criteria->addCondition('t.Id_review = '. $id);
		$criteria->addCondition('t.Id_multimedia_type = 1'); //image
		
		$modelMultimediaSelected = TMultimedia::model()->findAll($criteria);
		
		$this->render('attachImages',array(
					'model'=>$model,
					'idNote'=>$idNote,
					'modelMultimediaSelected'=>$modelMultimediaSelected,
					'modelMultimedia'=>$modelMultimedia,		
		));
	}
	
	public function actionUploadImages($id, $idNote)
	{
		//$this->layout='//layouts/tcolumn2';
		$model=$this->loadModel($id);
	
		$modelAlbum = Album::model()->findByAttributes(array('Id_customer'=>$model->Id_customer,
												'Id_project'=>$model->Id_project,
												'Id_user_group_owner'=>User::getCurrentUserGroup()->Id,
		));
	
		if(!isset($modelAlbum))
		{
			$modelAlbum = new Album();
			$modelAlbum->Id_customer = $model->Id_customer;
			$modelAlbum->Id_project = $model->Id_project;
			$modelAlbum->Id_user_group_owner = User::getCurrentUserGroup()->Id;
			$modelAlbum->username = User::getCurrentUser()->username;
			
			$modelAlbum->save();			
			
		}
	
		$this->render('uploadImages',array(
						'model'=>$model,
						'idNote'=>$idNote,						
						'modelAlbum'=>$modelAlbum,
		));
	}
	
	public function actionAjaxAttachDoc($id, $idNote)
	{
		//$this->layout='//layouts/tcolumn2';
		$model=$this->loadModel($id);
	
		$criteria=new CDbCriteria;
	
		$criteria->addCondition('t.Id NOT IN(select Id_multimedia from multimedia_note where Id_note = '. $idNote.')');
		$criteria->addCondition('t.Id_user_group = '. User::getCurrentUserGroup()->Id);
		//$criteria->addCondition('t.Id_review = '. $id);
		$criteria->addCondition('t.Id_customer = '. $model->Id_customer);
		$criteria->addCondition('t.Id_project = '. $model->Id_project);
		$criteria->addCondition('t.Id_document_type is null');
		$criteria->addCondition('t.Id_multimedia_type >= 3'); //docs (pdf or autocad)
		$criteria->order = 't.Id_document_type';
		$modelMultimedia = TMultimedia::model()->findAll($criteria);
		
		$criteria=new CDbCriteria;
		
		$criteria->addCondition('t.Id IN(select Id_multimedia from multimedia_note where Id_note = '. $idNote.')');
		//$criteria->addCondition('t.Id_review = '. $id);
		$criteria->addCondition('t.Id_customer = '. $model->Id_customer);
		$criteria->addCondition('t.Id_project = '. $model->Id_project);
		$criteria->addCondition('t.Id_document_type is null');
		$criteria->addCondition('t.Id_multimedia_type >= 3'); //docs (pdf or autocad)
		
		$modelMultimediaSelected = TMultimedia::model()->findAll($criteria);
		
		$this->render('attachDocs',array(
						'model'=>$model,
						'idNote'=>$idNote,
						'modelMultimedia'=>$modelMultimedia,
						'modelMultimediaSelected'=>$modelMultimediaSelected,
		));
	}
	
	public function actionAjaxAttachTechDoc($id, $idNote)
	{
		//$this->layout='//layouts/tcolumn2';
		$model=$this->loadModel($id);
	
		$criteria=new CDbCriteria;
	
		$criteria->addCondition('t.Id_document_type NOT IN(select m.Id_document_type from multimedia_note mn, multimedia m 
						where mn.Id_multimedia = m.Id AND m.Id_document_type is not null AND Id_note = '. $idNote.')');
		
		$criteria->addCondition('t.Id IN (SELECT max(Id) FROM multimedia
											WHERE Id_customer = '. $model->Id_customer .'
											AND Id_project = '. $model->Id_project .'
											AND Id_document_type is not null 
											AND Id_multimedia_type >= 3
											GROUP BY Id_document_type)');
				
		$modelMultimedia = TMultimedia::model()->findAll($criteria);
	
		$criteria=new CDbCriteria;
	
		$criteria->addCondition('t.Id IN(select Id_multimedia from multimedia_note where Id_note = '. $idNote.')');
		//$criteria->addCondition('t.Id_review = '. $id);
		$criteria->addCondition('t.Id_project = '. $model->Id_project);
		$criteria->addCondition('t.Id_customer = '. $model->Id_customer);
		$criteria->addCondition('t.Id_document_type is not null');
		$criteria->addCondition('t.Id_multimedia_type >= 3'); //docs (pdf or autocad)		
	
		$modelMultimediaSelected = TMultimedia::model()->findAll($criteria);
	
		$this->render('attachTechDocs',array(
							'model'=>$model,
							'idNote'=>$idNote,
							'modelMultimedia'=>$modelMultimedia,
							'modelMultimediaSelected'=>$modelMultimediaSelected,
		));
	}
	
	public function actionAjaxDelete()
	{
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$model = $this->loadModel($id);
			if($this->canDelete($model))
			{
				$model->delete();
				echo $id;
				return;
			}				
		}
		echo "0";
		return;		
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if($this->canDelete($model))
		{			
			$model->delete();
		}
		$idCustomer = $model->Id_customer;
		$idProject = $model->Id_project;
		
		$this->redirect(array('index','Id_customer'=>$idCustomer,'Id_project'=>$idProject));
		
	}
	private function canDelete($model)
	{
		$notes = $model->notes;
		foreach ($notes as $note)
		{
			$litleNotes = $note->notes;
			if(!empty($litleNotes))
			{
				return false;
			}			
		}
		return true;  
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{		
		$modelMultimedia = new TMultimedia;
		$modelNote = new Note;
		
		$Id_customer = -1;
		$Id_project = -1;
		if(isset($_GET['Id_customer']))
		{
			$Id_customer =$_GET['Id_customer'];
		}
		if(isset($_GET['Id_project']))
		{
			$Id_project =$_GET['Id_project'];
		}
		
		$this->showFilter = true;
		
		if($Id_customer==-1)
		{
			$this->showFilter = false;			
		}
		
		$hasAlbum = Album::model()->countByAttributes(array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project,
						'Id_user_group_owner'=>User::getCurrentUserGroup()->Id )) > 0;		
		
		$criteria=new CDbCriteria;
		$criteria->addCondition('Id_document_type is null');
		$criteria->addCondition('Id_user_group = '. User::getCurrentUserGroup()->Id);
		$criteria->addCondition('Id_customer = '. $Id_customer);
		$criteria->addCondition('Id_project = '. $Id_project);
		$criteria->addCondition('Id_multimedia_type > 1 ');
		
		$hasDocs = count(TMultimedia::model()->findAll($criteria)) > 0;
		
		$hasTechDocs = false;
		if (User::useTechnicalDocs())
		{
			$criteria=new CDbCriteria;
			$criteria->addCondition('Id_document_type is not null');			
			$criteria->addCondition('Id_customer = '. $Id_customer);
			$criteria->addCondition('Id_project = '. $Id_project);
			
			$hasTechDocs = count(TMultimedia::model()->findAll($criteria)) > 0;
		}		
		
		$this->render('index',
			array('modelMultimedia'=>$modelMultimedia,
					'modelNote'=>$modelNote,
					'Id_customer'=>$Id_customer,
					'Id_project'=>$Id_project,
					'hasAlbum'=>$hasAlbum,
					'hasDocs'=>$hasDocs,
					'hasTechDocs'=>$hasTechDocs,
			)
		);
	}

	public function actionAjaxCheckLastDoc()
	{
		$idMultimedia = $_POST['idMultimedia'];
		$idDocType = $_POST['idDocType'];
		$idCustomer = $_POST['idCustomer'];
		$idProject = $_POST['idProject'];
		
		$criteria=new CDbCriteria;
		$criteria->select = 'MAX(Id) as last';
		$criteria->addCondition('Id_project = '. $idProject);
		$criteria->addCondition('Id_document_type = '. $idDocType);
		$criteria->addCondition('Id_customer = '. $idCustomer);		
		
		$model = TMultimedia::model()->find($criteria);
		
		if($model->last > $idMultimedia)
		{
			$lastMultimedia = TMultimedia::model()->findByPk($model->last);			
			echo Yii::app()->baseUrl.'/docs/'.$lastMultimedia->file_name;
		}
		
		echo '';
	}
	
	public function actionAjaxGetCustomerName()
	{
		$idCustomer = ($_POST['Id_customer'])?$_POST['Id_customer']:null;
		$idProject = ($_POST['Id_project'])?$_POST['Id_project']:null;
		
		$name = "Buscar";
		if(isset($idCustomer) && isset($idProject) && $idCustomer > 0 && $idProject > 0)
		{
			$modelProject = Project::model()->findByPk($idProject);
			$name = $modelProject->customer->contact->description.' - '.$modelProject->description;
		}	
		echo $name;
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Review('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Review']))
			$model->attributes=$_GET['Review'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Review::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model,$modelNote)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-form')
		{
			echo CActiveForm::validate($model);
			echo CActiveForm::validate($modelNote);			
			Yii::app()->end();
		}
	}
	protected function performAjaxValidationNote($model,$modelNote)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-form')
		{
			echo CActiveForm::validate(array($modelNote,$model));
			//echo CActiveForm::validate();
			Yii::app()->end();
		}
	}
	
	public function actionAjaxUpdateReview()
	{
		$review = $_POST['review'];
		$id = $_POST['id'];
		$model=$this->loadModel($id);
		if(isset($model))
		{
			$model->review = $review;
			$model->save();
		}
	
	}
	
	public function actionAjaxUpdateDescription()
	{
		$description = $_POST['description'];
		$id = $_POST['id'];
		$model=$this->loadModel($id);
		if(isset($model))
		{
			$model->description = $description;
			$model->save();
		}
	
	}
	
	public function actionAjaxCheckUpdate()
	{
		$id = $_POST['id'];
		
		$modelReviewUser = ReviewUser::model()->findByAttributes(array('Id_review'=>$id,'username'=>User::getCurrentUser()->username));
		echo isset($modelReviewUser)?
			$modelReviewUser->read:
			1;	
	}

	
	public function actionAjaxSetReviewType()
	{
		$idReviewType = $_POST['idReviewType'];
		$id = $_POST['id'];
	
		$model=$this->loadModel($id);
		$model->Id_review_type = $idReviewType;
	
		$model->save();
	
	}
	
	public function actionAjaxChangeTag()
	{
		$idTag = $_POST['idTag'];
		$id = $_POST['id'];
		TagReview::model()->deleteAllByAttributes(array('Id_review'=>$id));
		$model = new TagReview();
		$model->Id_review = $id;
		$model->Id_tag = $idTag;
		$model->save();
	
	}
	public function actionAjaxAddTag()
	{
		$idTag = $_POST['idTag'];
		$id = $_POST['id'];
		
		$model = new TagReview();
		$model->Id_review = $id;
		$model->Id_tag = $idTag;
		$model->save();
	
	}
	
	public function actionAjaxRemoveTag()
	{
		$idTag = $_POST['idTag'];
		$id = $_POST['id'];
		
		$model = TagReview::model()->deleteByPk(array('Id_review'=>$id,'Id_tag'=>$idTag));
	
	}
	
	private function fillIndex($Id_customer,$Id_project, $arrFilters,$collapsed)
	{
		
		$review = new Review;
		if($Id_customer > 0)
		{
			$review->Id_customer = $Id_customer;
			$review->Id_project = $Id_project;
				
			$dataProvider = $review->searchSummary($arrFilters);
			
			$dataProvider->pagination->pageSize= 60;
			
			$data = $dataProvider->getData();
				
			foreach ($data as $item){
				$this->renderPartial('_view',array('data'=>$item,'width'=>'95%'));
			}
		}
		else
		{	
			
			$criteria=new CDbCriteria;

			$criteria->select = 't.*, max(n.change_date) as max_date';
			$criteria->join =  	" 
					JOIN tapia.customer cus on (t.Id_customer = cus.Id)
					LEFT OUTER JOIN green.person gp on (cus.Id_person = gp.Id)
					LEFT OUTER JOIN tapia.user_customer uc on (t.Id = uc.Id_project)
					LEFT OUTER JOIN tapia.user u on (u.username = uc.username)
          			LEFT OUTER JOIN tapia.note n ON ( n.Id_project = uc.Id_project)
          			LEFT OUTER JOIN tapia.user_group_note ugn on (u.Id_user_group = ugn.Id_user_group)
				";
			$criteria->addCondition('uc.username = "'. User::getCurrentUser()->username.'"');
			$criteria->addCondition('n.username <> "'. User::getCurrentUser()->username.'"');
			$criteria->group = 't.Id';
			$criteria->order = 'max_date DESC';				
			
			if(isset($arrFilters['customerNameFilter'])&&$arrFilters['customerNameFilter']!='')
			{
 				$criteria->addSearchCondition('gp.name', $arrFilters['customerNameFilter'],true);				
 				$criteria->addSearchCondition('gp.last_name', $arrFilters['customerNameFilter'],true,'OR');
				$criteria->addSearchCondition('CONCAT(CONCAT(gp.name," "),gp.last_name)', $arrFilters['customerNameFilter'],true,'OR');				
			}			
			
			$projects = Project::model()->findAll($criteria);
			$count = 0;	
			foreach ($projects as $project){
				$review->Id_customer = $project->customer->Id;
				$review->Id_project = $project->Id;
				
				$dataProvider = $review->searchQuickView($arrFilters);
	
				$dataProvider->pagination->pageSize= 4;
	
				$data = $dataProvider->getData();
				$isCollapsed = array_search($project->Id, $collapsed);
				if($count>2)
					if(empty($collapsed))
						$isCollapsed = true;
				$this->renderPartial('_quickView',array('data'=>$data, 'customer'=>$project->customer,'project'=>$project,'collapsed'=>$isCollapsed));
				$count++;
				
			}
					
// 			$customers = TCustomer::model()->findAll($criteria);
			
// 			foreach ($customers as $customer){
				
// 				$review->Id_customer = $customer->Id;
				
// 				$dataProvider = $review->searchQuickView($arrFilters);
					
// 				$dataProvider->pagination->pageSize= 4;
					
// 				$data = $dataProvider->getData();
								
// 				$this->renderPartial('_quickView',array('data'=>$data, 'customer'=>$customer));
								
// 			}
			
		}
	}
	
	public function actionAjaxFillInbox()
	{
		if(isset($_POST['Id_customer']))
		{
			$arrFilters = array('tagFilter'=>$_POST['tagFilter'], 
							 'isCloseFilter'=>$_POST['isCloseFilter'],
							 'typeFilter'=>$_POST['typeFilter'],
							 'reviewTypeFilter'=>$_POST['reviewTypeFilter'],
							 'dateFromFilter'=>$_POST['dateFromFilter'],
							 'dateToFilter'=>$_POST['dateToFilter'],
							 'customerNameFilter'=>$_POST['customerNameFilter']);
			$collapsed = array();
			if(isset($_POST['collapsed'])) $collapsed =$_POST['collapsed'];
			$this->fillIndex($_POST['Id_customer'],$_POST['Id_project'], $arrFilters,$collapsed);
		}		
	}
	
	public function actionAjaxUpdateNoteNeedConf()
	{
 		$chk = $_POST['chk'];
 		$id = $_POST['id'];
		$model= Note::model()->findByPk($id);
		
		if(isset($model))
		{
			$model->need_confirmation = $chk;
			$model->save();
		}
		$this->renderPartial('_viewData',array('data'=>$model));
	}
	
	public function actionAjaxConfirmNote()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$id=$_POST['id'];
			// we only allow deletion via POST request
			$model= Note::model()->findByPk($id);
			
			$modelUserGroupNote = UserGroupNote::model()->findByAttributes(array('Id_user_group'=>User::getCurrentUserGroup()->Id, 'Id_note'=>$id));
			$modelUserGroupNote->confirmed = 1;
			$modelUserGroupNote->confirmation_date = new CDbExpression('NOW()');
			$modelUserGroupNote->save();
			$modelUserGroupNote = UserGroupNote::model()->findByAttributes(array('Id_user_group'=>User::getCurrentUserGroup()->Id, 'Id_note'=>$id));
			
			$this->markAsUnread($model);
			
			$this->renderPartial('_viewData',array('data'=>$model,'dataUserGroupNote'=>$modelUserGroupNote));
				
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	private function markAsUnread($model)
	{
		$reviewUsers = ReviewUser::model()->findAllByAttributes(array('Id_review'=>$model->Id_review));
		foreach($reviewUsers as $item)
		{
			if($item->user->Id_user_group == $model->Id_user_group_owner && $item->username != User::getCurrentUser()->username)
			{
				$item->read = 0;
				$item->save();
			}
		}	
	}
	
	public function actionAjaxDeclineNote()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$id=$_POST['id'];
			// we only allow deletion via POST request
			$model= Note::model()->findByPk($id);
			
			$modelUserGroupNote = UserGroupNote::model()->findByAttributes(array('Id_user_group'=>User::getCurrentUserGroup()->Id, 'Id_note'=>$id));
			$modelUserGroupNote->declined = 1;
			$modelUserGroupNote->confirmation_date = new CDbExpression('NOW()');
			$modelUserGroupNote->save();				
			$modelUserGroupNote = UserGroupNote::model()->findByAttributes(array('Id_user_group'=>User::getCurrentUserGroup()->Id, 'Id_note'=>$id));
			
			$this->markAsUnread($model);
			
			$this->renderPartial('_viewData',array('data'=>$model,'dataUserGroupNote'=>$modelUserGroupNote));				
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	
	public function actionAjaxCloseReview()
	{
		$id = $_POST['id'];
		$closingDescription = $_POST['closingDescription'];
		$model=$this->loadModel($id);
		$transaction =  $model->dbConnection->beginTransaction();
		try {
			if($model->is_open==0){ 
				echo 'Ya esta cerrada';
				return;
			}
			$model->closing_description = $closingDescription;
			$model->is_open = 0;
			$model->closing_date = new CDbExpression('NOW()');
			$model->save();
			
			$modelNote = new Note();
			$modelNote->note = $closingDescription;
			$modelNote->Id_customer = $model->Id_customer;
			$modelNote->Id_project = $model->Id_project;
			$modelNote->username = User::getCurrentUser()->username;
			$modelNote->Id_user_group_owner = User::getCurrentUserGroup()->Id;
			$modelNote->in_progress = 0;
			$modelNote->save();
			$modelNoteNote = new NoteNote();
			$modelNoteNote->Id_child = $modelNote->Id;
			$modelNoteParent = Note::model()->findByAttributes(array('Id_review'=>$model->Id));
			if(isset($modelNoteParent ))
			{
				$modelNoteNote->Id_parent = $modelNoteParent->Id;
				$modelNoteNote->save();
			}
					
			$transaction->commit();
			$this->sendMailNote($modelNote->Id);
				
		} catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	public function actionAjaxAddNote()
	{
		$id = $_POST['id'];
		$value = $_POST['value'];
		$idCustomer = $_POST['idCustomer'];
		$idProject = $_POST['idProject'];
		$chk = $_POST['chk'];
		
		$modelNote = new Note;
	
		$transaction = $modelNote->dbConnection->beginTransaction();
		try {
			
			$modelNote->username = User::getCurrentUser()->username;
			$modelNote->Id_user_group_owner = User::getCurrentUserGroup()->Id;
			$modelNote->note = $value;
			$modelNote->Id_customer = $idCustomer;
			$modelNote->Id_project = $idProject;
			$modelNote->in_progress = 0;
			$modelNote->need_confirmation = $chk;
			$modelNote->save();
				
			$modelNoteNote = new NoteNote;
			$modelNoteNote->Id_parent = $id;
			$modelNoteNote->Id_child = $modelNote->Id;
			$modelNoteNote->save();
	
			$this->markUnreadSubNote($id);
			
			$transaction->commit();
				
			$model = Note::model()->findByPk($id);
			$userGroupNote = UserGroupNote::model()->findByPk(array('Id_note'=>$id,'Id_user_group'=>$modelNote->Id_user_group_owner));				
			$this->renderPartial('_viewData',array('data'=>$model,'dataUserGroupNote'=>$userGroupNote));
			
		} catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	public function actionAjaxSaveChangesNoteInProgress()
	{
		if(isset($_POST['id'])&&isset($_POST['value']))
		{
			$id = $_POST['id'];
			$note = Note::model()->findByPk($id);
			if(isset($note))
			{
				$note->note = $_POST['value'];
				$note->save();				
			}				
		}
	}	
	public function actionAjaxPublicNoteInProgress()
	{
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$note = Note::model()->findByPk($id);
			if(isset($note))
			{
				$note->in_progress = 0;
				$note->creation_date = date("Y-m-d H:i:s",time());
				$note->save();
				$this->markUnreadSubNote($note->parentNotes[0]->Id);
				$result = array_merge($note->attributes,$note->user->attributes);
				
				$parents = $note->parentNotes;//shold be only one
				foreach($parents as $parent)
				{
					if($parent->review)
					{
						$criteria = new CDbCriteria();
						$criteria->addCondition('date in (select max(date) from tag_review where Id_review ='.$parent->review->Id.')');
						$criteria->addCondition('t.Id_review = '.$parent->review->Id);
						
						$modelTagReview = TagReview::model()->find($criteria);
						
						if(isset($modelTagReview)){
							$idTag = $modelTagReview->Id_tag;
							$result['Id_tag'] = $idTag;
							$result['tag_description'] = $modelTagReview->tag->description;
							
							$options = "";
							if($idTag==1)
								$options='background-color: #CC3300;color: white;max-width:none';//rojo
							else if($idTag==2)
								$options='background-color: #66FF66;max-width:none';//verde
							else if($idTag==3)
								$options='background-color: #FFFF99;max-width:none';//amarillo
							else if($idTag==4)
								$options='background-color: #FFCC66;max-width:none';//naranja
							$result['tag_style'] = $options;
						}
					}
				}
								
				echo CJSON::encode($result);
				$this->sendMailNote($id);
				//echo CJSON::encode($note->attributes).CJSON::encode($note->user->attributes);				
			}				
		}
	}	
	public function actionAjaxDeleteNoteInProgress()
	{
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			NoteNote::model()->deleteAllByAttributes(array('Id_child'=>$id));
			Note::model()->deleteByPk($id);				
		}
	}
	public function actionAjaxAddNoteInProgress()
	{
		$id = $_POST['id'];
		$value = $_POST['value'];
		$idCustomer = $_POST['idCustomer'];
		$idProject = $_POST['idProject'];
		$chk = $_POST['chk'];
	
		$modelNote = new Note;
	
		$transaction = $modelNote->dbConnection->beginTransaction();
		try {
				
			$modelNote->username = User::getCurrentUser()->username;
			$modelNote->Id_user_group_owner = User::getCurrentUserGroup()->Id;
			$modelNote->note = $value;
			$modelNote->Id_customer = $idCustomer;
			$modelNote->Id_project = $idProject;
			$modelNote->in_progress = 1;
			$modelNote->need_confirmation = $chk;
			$modelNote->save();
			$modelNote->refresh();
	
			$modelNoteNote = new NoteNote;
			$modelNoteNote->Id_parent = $id;
			$modelNoteNote->Id_child = $modelNote->Id;			
			$modelNoteNote->save();
	
			//$this->markUnreadSubNote($id);
				
			$transaction->commit();
	
			$model = Note::model()->findByPk($id);
			//$userGroupNote = UserGroupNote::model()->findByPk(array('Id_note'=>$id,'Id_user_group'=>$modelNote->Id_user_group_owner));
			$this->renderPartial('_viewMiniNoteInProgress',array('modelMiniNote'=>$modelNote,'modelMainNote'=>$model));
				
		} catch (Exception $e) {
			$transaction->rollback();
		}
	}
	
	private function markUnreadSubNote($idParentNote)
	{
		$model = Note::model()->findByPk($idParentNote);
		if($model->in_progress==0)
		{
			$reviewUsers = ReviewUser::model()->findAllByAttributes(array('Id_review'=>$model->Id_review));
			$modelUserGroupNotes = UserGroupNote::model()->findAllByAttributes(array('Id_note'=>$model->Id));
			
			foreach($modelUserGroupNotes as $item)
			{
				foreach($reviewUsers as $revItems)
				{
					if($revItems->user->Id_user_group == $item->Id_user_group && $revItems->username != User::getCurrentUser()->username )
					{
						$revItems->read = 0;
						$revItems->save();
					}
				}
			}				
		}		
	}
	
	public function actionAjaxRemoveSingleNote($id, $idParent)
	{
	
		$model = Note::model()->findByPk($idParent);
		$notes = $model->notesDESC;
		$lastNote = $notes[0];
		if($lastNote->Id==$id)
		{
			$transaction = $model->dbConnection->beginTransaction();
			try {
				NoteNote::model()->deleteAllByAttributes(array('Id_child'=>$id));
				Note::model()->deleteByPk($id);
				$transaction->commit();
					
				//$userGroupNote = UserGroupNote::model()->findByPk(array('Id_note'=>$model->Id,'Id_user_group'=>$model->Id_user_group_owner));
				//$this->renderPartial('_viewData',array('data'=>$model,'dataUserGroupNote'=>$userGroupNote));
				echo $id;
					
			} catch (Exception $e) {
				$transaction->rollback();
			}				
		}			
	}
	
	public function actionAjaxShareDocument()
	{
		//$_FILES
		$file = $_FILES["file"];
				
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
	
			$multi = $_POST['TMultimedia'];
			$model = new TMultimedia;
			
			$transaction = $model->dbConnection->beginTransaction();			
			try {
				$model->attributes = $multi;
				$model->uploadedFile = $file;
				$model->Id_customer = $_POST['Id_customer'];				
				$model->Id_project = $_POST['Id_project'];
				$isTech = isset($model->Id_document_type)&&$model->Id_document_type!='';
				
				if($isTech)
				{
					$criteria=new CDbCriteria;
					$criteria->addCondition('Id_document_type = '. $model->Id_document_type);
					$criteria->addCondition('Id_customer = '. $model->Id_customer);
					$criteria->addCondition('Id_project = '. $model->Id_project);
					$criteria->order = 'Id DESC';
					
					//copio Id_google_drive si ya existe un documento del mismo tipo
					$multimediaDB = TMultimedia::model()->find($criteria);
					
					$model->Id_google_drive = isset($multimediaDB)?$multimediaDB->Id_google_drive:null;
				}
				$model->save();													
				$isFromNote = isset($_POST['Id_note']) && $_POST['Id_note'] != null;
				if($isFromNote)
				{
					if($isTech)
					{
						$criteria=new CDbCriteria;
						$criteria->join ='INNER JOIN multimedia m ON (m.Id = t.Id_multimedia)';
						$criteria->addCondition('m.Id_document_type ='. $model->Id_document_type);
						$criteria->addCondition('t.Id_note = '. $_POST['Id_note']);
						
						$moldeMultimediaNotes = MultimediaNote::model()->findAll($criteria);
						foreach ($moldeMultimediaNotes as $item)
						{
							$item->delete();
						} 
						
					}
					$modelMultimediaNote = new MultimediaNote();
					$modelMultimediaNote->Id_note = $_POST['Id_note'];
					$modelMultimediaNote->Id_multimedia = $model->Id;
					$modelMultimediaNote->save();
				}
				
				$transaction->commit();
				
				if(isset($_POST['Id_review']) && $_POST['Id_review'] != null)
				{
					if($isFromNote)
					{
						if($isTech)
						{							
							$this->redirect(array('AjaxAttachTechDoc','id'=>$_POST['Id_review'],'idNote'=>$_POST['Id_note']));
						}
						else 
						{
							$this->redirect(array('AjaxAttachDoc','id'=>$_POST['Id_review'],'idNote'=>$_POST['Id_note']));
						}
					}
					else
						$this->redirect(array('update','id'=>$_POST['Id_review']));
						
				}
				else
				{					
					$this->redirect(array('index','Id_customer'=>$_POST['Id_customer'],
												'Id_project'=>$_POST['Id_project']));
				}					
					
			} catch (Exception $e) {				
				$transaction->rollback();
			}
		}		
	}
		
	public function actionUpdateDocuments($id)
	{
		
		$model=$this->loadModel($id);
		
		if(isset($model))	
			$this->render('updateDocument',array('model'=>$model));
	}
	
	public function actionUpdateAlbum($id)
	{
	
		$model = Album::model()->findByPk($id);
	
		if(isset($model))
			$this->render('updateAlbum',array('model'=>$model));
	}
	public function actionUpdateAlbumIE($id)
	{
	
		$model = Album::model()->findByPk($id);
	
		if(isset($model))
			$this->render('updateAlbumIE',array('model'=>$model));
	}
	public function actionAjaxSavePermissions()
	{
		$response = 'error';
		if(
			isset($_POST['idUserGroup'])&&
			isset($_POST['idNote'])&&
			isset($_POST['value'])&&
			isset($_POST['type'])&&
			isset($_POST['idCustomer'])&&
			isset($_POST['idProject'])
		)
		{
			$idCustomer = $_POST['idCustomer'];
			$idProject = $_POST['idProject'];
			$idUserGroup = $_POST['idUserGroup'];
			$idNote = $_POST['idNote'];
			$value = $_POST['value']=='true'?1:0;
			$type= $_POST['type'];
			$modelUserGroupNoteArray = UserGroupNote::model()->findAllByAttributes(array('Id_note'=>$idNote,'Id_user_group'=>$idUserGroup));
			$wasDeleted = false;
			
			if(isset($modelUserGroupNoteArray[0]))
			{
				$modelUserGroupNote = $modelUserGroupNoteArray[0];				
				$modelNoteNote = NoteNote::model()->findAllByAttributes(array('Id_parent'=>$idNote));
				$canEditFeedback = true;
				foreach($modelNoteNote as $itemNoteNote)
				{
					if($itemNoteNote->child->Id_user_group_owner == $idUserGroup)
					{
						$canEditFeedback = false;
						break;
					}
				}
				
				$outOfDate = isset($modelUserGroupNote)?$modelUserGroupNote->isOutOfDate():false;
				
				$canEditNeedConf = !($modelUserGroupNote->confirmed || $modelUserGroupNote->declined) && !$outOfDate;
				
				if($type=='canSee')
				{
					$response = 'forbidden';
					if(!$value&&$canEditNeedConf&&$canEditFeedback)
					{
						$modelUserGroupNote->delete();
						$wasDeleted = true;
						$response = 'ok';
					}				
				}
				elseif($type=='addressed')
				{
					$response = 'forbidden';
					$modelUserGroupNote->addressed = $value;				
					$modelUserGroupNote->save();						
					$response = 'ok';
				}
				elseif($type=='canFeedback')
				{
					$response = 'forbidden';
					if($canEditFeedback)
					{
						$modelUserGroupNote->can_feedback = $value;
						$modelUserGroupNote->save();						
						$response = 'ok';
					}
				}
				elseif($type=='needConfirmation')
				{
					$response = 'forbidden';
					if($canEditNeedConf){
						$modelUserGroupNote->need_confirmation = $value;
						$modelUserGroupNote->save();						
						$response = 'ok';
					}
				}				
			}
			else 
			{
				$modelUserGroupNote = new UserGroupNote;
				$modelUserGroupNote->Id_note=$idNote;
				$modelUserGroupNote->Id_user_group=$idUserGroup;
				$modelUserGroupNote->Id_customer=$idCustomer;
				$modelUserGroupNote->Id_project=$idProject;
				if($type=='addressed')
				{
					$modelUserGroupNote->addressed = $value;				
				}
				elseif($type=='canFeedback')
				{
					$modelUserGroupNote->can_feedback = $value;				
				}
				elseif($type=='needConfirmation')
				{
					$modelUserGroupNote->need_confirmation = $value;				
				}				
				$response = 'ok';
				$modelUserGroupNote->save();
			}
			
			if($wasDeleted)
				GDriveHelper::unShareFilesByUserGroup($idNote, $idUserGroup);
			else			
				GDriveHelper::shareFilesByUserGroup($idNote, $idUserGroup);	
			
			
			//Envio de Mail
			
// 			$userGroup = UserGroup::model()->findByPk($idUserGroup);
// 			$users = $userGroup->users;
// 			foreach($users as $user)
// 			{
// 				$message = new YiiMailMessage;
// 				$message->view = '_noteMail';
// 				$message->setBody(array('model'=>$user), 'text/html');
// 				$message->addTo($user->email);
//				$message->setSubject('Nueva nota');
// 				Yii::app()->mail->send($message);				
// 			}
		}
		echo $response;

	}
	
	public function actionAjaxPublicNote()
	{
		$idNote = (isset($_POST['idNote'])?$_POST['idNote']:null);
		$idCustomer = (isset($_POST['idCustomer'])?$_POST['idCustomer']:null);
		$idProject = (isset($_POST['idProject'])?$_POST['idProject']:null);
		$idReviewType = (isset($_POST['idReviewType'])?$_POST['idReviewType']:null);
		$transaction =  Yii::app()->db2->beginTransaction();
		try {
			$this->publicNote($idNote,$idCustomer,$idProject,$idReviewType);
			$transaction->commit();				
		} catch (Exception $e) {
			$transaction->rollback();
		}		
	}
	
	public function actionAjaxSaveNote()
	{
		$id = $_POST['id'];
		$model= Note::model()->findByPk($id);
		
		if(isset($model))
		{				
			$model->in_progress = 0;
			$model->save();
			$model->refresh();
			echo CHtml::openTag('div', array('class'=>'review-container-single-view','id'=>'noteContainer_'.$id));
			$this->renderPartial('_viewPendingData',array('data'=>$model));
			echo CHtml::closeTag('div');
		}
	}
	public function actionAjaxReviewTypeLongDescription()
	{
		if(isset($_POST['idReviewType']))
		{
			$reviewType = ReviewType::model()->findByPk($_POST['idReviewType']);
			echo $reviewType->long_description;
		}		
	}
	public function actionAjaxShareFile()
	{
		$Id_google_drive = ($_POST['Id_google_drive'])?$_POST['Id_google_drive']:null;
		$username = ($_POST['username'])?$_POST['username']:null;
		$shared = ($_POST['shared'])?$_POST['shared']:null;
		
		$response = false;
		
		if(isset($Id_google_drive) && isset($username) && isset($shared))
		{
			$modelUser = User::model()->findByPk($username);
			
			$role = 'reader';
			if(isset($modelUser))
				$role = ($modelUser->userGroup->use_technical_docs != 0)?'writer':$role;
			
			if($shared == 'false')
				$response = GDriveHelper::shareFileByUser($Id_google_drive, $username, $role);
			else
				$response = GDriveHelper::unShareFileByUser($Id_google_drive, $username);
		}
		
		if($response)
			$response = 1;
		else
			$response = 0;
		
		echo $response;
	}
	public function sendMailNote($idNote)
	{
		$modelNote = Note::model()->findByPk($idNote);
		$modelReview = $modelNote->review;
		if(!isset($modelReview))
		{
			$modelReview = $modelNote->parentNotes[0]->review;
		}
		$userCustomers = UserCustomer::model()->findAllByAttributes(array('Id_project'=>$modelNote->Id_project));
		foreach ($userCustomers as $userCustomer)
		{
			$modelUser = $userCustomer->user;
			$reviewTypeUserGroup = ReviewTypeUserGroup::model()->findByAttributes(array('Id_user_group'=>$modelUser->Id_user_group,'Id_review_type'=>$modelReview->Id_review_type));
			if($reviewTypeUserGroup->can_mail)
			{
				$message = new YiiMailMessage;
				$message->view = '_noteMail';
				$message->setBody(array('model'=>$modelUser,'modelReview'=>$modelReview,'modelNote'=>$modelNote), 'text/html');
				$message->addTo($modelUser->email);
				$message->from = Yii::app()->params['adminEmail'];
				
				//$state = isset($review->tags[0])?' ('.$review->tags[0]->description.') ':'';
				//if(!$modelReview->is_open) $state = ' (Finalizada) ';
				
				$message->setSubject(utf8_decode($modelReview->customer->contact->description).' - '.utf8_decode($modelReview->project->description).': '.utf8_decode($modelReview->description));
				Yii::app()->mail->send($message);				
			}				
		}

		
		if(isset($_POST['Review'])&&isset($_POST['User']))
		{
			$review = Review::model()->findByPk($_POST['Review']['Id']);
			$users = $_POST['User'];
			if(!empty($users['username']))
			{
				foreach($users['username'] as $user)
				{
					$modelUser = User::model()->findByPk($user);
					$message = new YiiMailMessage;
					$message->view = '_noteMail';
					$message->setBody(array('model'=>$modelUser,'modelReview'=>$this->loadModel($_POST['Review']['Id'])), 'text/html');
					$message->addTo($modelUser->email);
					$message->from = Yii::app()->params['adminEmail'];
						
					$state = isset($review->tags[0])?' ('.$review->tags[0]->description.') ':'';
					if(!$modelReview->is_open) $state = ' (Finalizada) ';
	
					$message->setSubject(utf8_decode($review->customer->contact->description).' - '.utf8_decode($review->project->description).': '.utf8_decode($review->description).utf8_decode($state));
					Yii::app()->mail->send($message);
				}
			}
		}
	}
	
	public function actionAjaxSendMail()
	{
		if(isset($_POST['Review'])&&isset($_POST['User']))
		{
			$review = Review::model()->findByPk($_POST['Review']['Id']);
			$users = $_POST['User'];
			if(!empty($users['username']))
			{
				foreach($users['username'] as $user)
				{
					$modelUser = User::model()->findByPk($user);
					$message = new YiiMailMessage;
					$message->view = '_noteMail';
					$message->setBody(array('model'=>$modelUser,'modelReview'=>$this->loadModel($_POST['Review']['Id'])), 'text/html');
					$message->addTo($modelUser->email);
					$message->from = Yii::app()->params['adminEmail'];
					
					$state = isset($review->tags[0])?' ('.$review->tags[0]->description.') ':'';
					if(!$modelReview->is_open) $state = ' (Finalizada) ';
						
					$message->setSubject(utf8_decode($review->customer->contact->description).' - '.utf8_decode($review->project->description).': '.utf8_decode($review->description).utf8_decode($state));
					Yii::app()->mail->send($message);
				}	
			}
		}				
	}	
	public function actionGenerateTextPlainSummary()
	{
		if(isset($_GET['Id_review']))
		{
			$modelReview = Review::model()->findByPk($_GET['Id_review']);;
			$modelProject = $modelReview->project;
			header("Content-type: text/plain");
			header('Content-Disposition: attachment; filename="'.utf8_decode($modelProject->customer->contact->description).' - '.utf8_decode($modelProject->description).' - '.utf8_decode($modelReview->description).' ('.date("Y-m-d H:i",time()).').txt"');
			echo utf8_decode($modelProject->customer->contact->description).' - '.utf8_decode($modelProject->description);
			echo "\r\n";
			
			$state = (isset($modelReview->tags[0])?' ('.$modelReview->tags[0]->description.') ':'');
			if(!$modelReview->is_open) $state = ' (Finalizada) ';
				
			echo utf8_decode($modelReview->description) . utf8_decode($state);
			echo "\r\n";
			$notes = $modelReview->notes;
			if(isset($notes))
			{
				foreach ($notes as $note){
					echo $note->creation_date.' '.$note->user->last_name.' '.$note->user->name.': '.utf8_decode(str_replace(array("\n"),"\r\n",$note->note));
					echo "\r\n";
					$criteria = new CDbCriteria();
					$criteria->addCondition('Id_parent = '. $note->Id);
					$criteria->select ='t.*, n.creation_date';
					$criteria->join='LEFT OUTER JOIN tapia.note n on (t.Id_child = n.Id)';
					$criteria->order = 'n.creation_date DESC';
					try {
						$noteNotes = NoteNote::model()->findAll($criteria);
		
					} catch (Exception $e) {
						echo $e.message;
					}
					foreach ($noteNotes as $noteNote){
						$litleNote = $noteNote->child;
						echo $litleNote->creation_date.' '.$litleNote->user->last_name.' '.$litleNote->user->name.': '.utf8_decode(str_replace(array("\n"),"\r\n",$litleNote->note));
						echo "\r\n";
					}
				}
			}					
		}
		elseif(isset($_GET['Id_project']))
		{
			$modelProject = Project::model()->findByPk($_GET['Id_project']);				
			header("Content-type: text/plain;charset=utf-8");			
			header('Content-Disposition: attachment; filename="'.utf8_decode($modelProject->customer->contact->description).' - '.utf8_decode($modelProject->description).' ('.date("Y-m-d H:i",time()).').txt"');
			echo utf8_decode($modelProject->customer->contact->description).' - '.utf8_decode($modelProject->description);
			echo "\r\n";
			$criteria = new CDbCriteria();
			$criteria->addCondition('Id_project = '. $modelProject->Id);
			$criteria->order = 'change_date DESC';
				
			$reviews = Review::model()->findAll($criteria);;
			foreach ($reviews as $modelReview)
			{
				$state = (isset($modelReview->tags[0])?' ('.$modelReview->tags[0]->description.') ':'');
				if(!$modelReview->is_open) $state = ' (Finalizada) ';
				echo utf8_decode($modelReview->description) . utf8_decode($state);
				echo "\r\n";
				$notes = $modelReview->notes;
				if(isset($notes))
				{
					foreach ($notes as $note){
						echo $note->creation_date.' '.$note->user->last_name.' '.$note->user->name.': '.utf8_decode(str_replace(array("\n"),"\r\n",$note->note));
						echo "\r\n";
						$criteria = new CDbCriteria();
						$criteria->addCondition('Id_parent = '. $note->Id);
						$criteria->select ='t.*, n.creation_date';
						$criteria->join='LEFT OUTER JOIN tapia.note n on (t.Id_child = n.Id)';
						$criteria->addCondition('n.in_progress=0');
						$criteria->order = 'n.creation_date DESC';
						try {
							$noteNotes = NoteNote::model()->findAll($criteria);
								
						} catch (Exception $e) {
							echo $e.message;
						}
						foreach ($noteNotes as $noteNote){
							$litleNote = $noteNote->child;
							echo $litleNote->creation_date.' '.$litleNote->user->last_name.' '.$litleNote->user->name.': '.utf8_decode(str_replace(array("\n"),"\r\n",$litleNote->note));
							echo "\r\n";
							//echo CHtml::closeTag('br');
						}
					}
				}
			
			}				
		}
	}
	public function actionAjaxGenerateTechnicalReport()
	{
		if(isset($_GET['Id_project'])&&isset($_GET['dateToReport']))
		{
			$dateFrom = $_GET['dateToReport'].' 00:00:00';
			$dateTo = $_GET['dateToReport'].' 23:59:59';
			$modelProject = Project::model()->findByPk($_GET['Id_project']);				
			header("Content-type: text/plain; charset=utf-8");			
			header('Content-Disposition: attachment; filename="'.utf8_decode($modelProject->customer->contact->description).' - '.utf8_decode($modelProject->description).' '.$_GET['dateToReport'].' ('.date("Y-m-d H:i",time()).').txt"');
			echo utf8_decode($modelProject->customer->contact->description).' - '.utf8_decode($modelProject->description);
			echo "\r\n";
			echo "Servicio del d�a ".$_GET['dateToReport'];
			echo "\r\n";
			$criteria = new CDbCriteria();
			$criteria->addCondition('Id_project = '. $modelProject->Id);
			$criteria->addCondition('Id_review is null');
			$criteria->addCondition('in_progress = 0');
			$criteria->addBetweenCondition('change_date', $dateFrom, $dateTo);
			//$criteria->order = 'change_date DESC';
				
			$notes = Note::model()->findAll($criteria);
			$notesProcessed = array();
			foreach ($notes as $modelNote)
			{
				if(array_search($modelNote->Id,$notesProcessed)!==false)	continue;
				
				$parentNotes = $modelNote->parentNotes;
				$parentNote = $parentNotes[0]; 
				$modelReview= $parentNote->review;
				
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_parent = '. $parentNote->Id);
				$criteria->select ='t.*, n.creation_date';
				$criteria->join='LEFT OUTER JOIN tapia.note n on (t.Id_child = n.Id)';
				$criteria->addCondition('n.in_progress=0');
				$criteria->addBetweenCondition('n.change_date', $dateFrom, $dateTo);
				$criteria->order = 'n.creation_date DESC';
				try {
					$noteNotes = NoteNote::model()->findAll($criteria);
				
				} catch (Exception $e) {
					echo $e.message;
				}
				echo "\r\n";
				echo utf8_decode($modelReview->description) ;
				echo "\r\n";
				foreach ($noteNotes as $noteNote)
				{
					$modelNoteChild = $noteNote->child; 
					$notesProcessed[]=$modelNoteChild->Id;
					echo $modelNoteChild->user->last_name.' '.$modelNoteChild->user->name.' '.date("Y-m-d H:i",strtotime($modelNoteChild->creation_date));
					echo "\r\n";
					echo utf8_decode(str_replace(array("\n"),"\r\n",$modelNoteChild->note));
					echo "\r\n";
				}
			}				
		}
	}
	public function actionAjaxSendProjectByMail()
	{
		if(isset($_POST['Project'])&&isset($_POST['User']))
		{
			$project = Project::model()->findByPk($_POST['Project']['Id']);
			$reviews = $project->reviews;
			$users = $_POST['User'];
			if(!empty($users['username']) && isset($reviews))
			{
				foreach($users['username'] as $user)
				{
					$modelUser = User::model()->findByPk($user);
					$message = new YiiMailMessage;
					$message->view = '_projectMail';
					$message->setBody(array('model'=>$modelUser,'modelProject'=>$project), 'text/html');
					$message->addTo($modelUser->email);
					$message->from = Yii::app()->params['adminEmail'];
					$message->setSubject(utf8_decode($project->customer->contact->description).' - '.utf8_decode($project->description));
					Yii::app()->mail->send($message);
				}
			}
		}
	}	
	
	public function actionAjaxGetGDriveImagen()
	{
		$selectedImgs = $_POST['selectedImgs'];
		$idAlbum = $_POST['idAlbum'];
		$idCustomer = $_POST['idCustomer'];
		$idProject = $_POST['idProject'];
		$idNote = $_POST['idNote'];
		
		$images = json_decode($selectedImgs);
		
		foreach ($images as $key => $imgUrl)
		{			
			
			
			//$httpRequest = Google_Client::$io->authenticatedRequest($request);
			$httpRequest = GDriveHelper::getTheService($imgUrl);
						
			if ($httpRequest !== false) {
				//$setting = Setting::getInstance();
				$file = fopen('images/temp.jpg', 'w');
				fwrite($file,$httpRequest->getResponseBody());
				fclose($file);				
			} else {
				// an error happened
			}
			
			//$httpRequest->getResponseBody()
			$file = array('name'=>$key.'.jpg','tmp_name'=>'images/temp.jpg');
			
			$modelMultimedia = new TMultimedia;
				
			$modelMultimedia->Id_album = $idAlbum;
			$modelMultimedia->uploadedFile = $file;
			$modelMultimedia->Id_multimedia_type = 1;
			$modelMultimedia->Id_customer = $idCustomer;
			$modelMultimedia->Id_project = $idProject;
				
			$modelMultimedia->save();
			
			
			$model = MultimediaNote::model()->findByAttributes(array('Id_note'=>$idNote, 'Id_multimedia'=>$modelMultimedia->Id));
			if(!isset($model))
			{
				$model = new MultimediaNote;
				$model->Id_note = $idNote;
				$model->Id_multimedia = $modelMultimedia->Id;
				$model->save();
			}
		}
	}
	
	public function actionUploadGDriveImage($id, $idNote)
	{
						
		$model=$this->loadModel($id);
		
		$modelAlbum = Album::model()->findByAttributes(array('Id_customer'=>$model->Id_customer,
														'Id_project'=>$model->Id_project,
														'Id_user_group_owner'=>User::getCurrentUserGroup()->Id,
		));
		
		if(!isset($modelAlbum))
		{
			$modelAlbum = new Album();
			$modelAlbum->Id_customer = $model->Id_customer;
			$modelAlbum->Id_project = $model->Id_project;
			$modelAlbum->Id_user_group_owner = User::getCurrentUserGroup()->Id;
			$modelAlbum->username = User::getCurrentUser()->username;
				
			$modelAlbum->save();
				
		}
		
		$files = GDriveHelper::getFiles();
	
		$path = array('root'=>'Inicio');

		$this->render('uploadGDriveImage',array(
						'files'=>$files,
						'path'=>$path,
						'model'=>$model,
						'idNote'=>$idNote,
						'modelAlbum'=>$modelAlbum,
		));
	}
	
	public function actionAjaxGetFiles()
	{
		$id = $_POST['id'];
		$text = $_POST['text'];
		$path = $_POST['path'];
	
		$newPath = array();
		$jsonPath = json_decode($path);
		foreach ($jsonPath as $key => $val)
		{
			$newPath[$key] = $val;
		}
	
		$newPath[$id] = $text;
	
		$files = GDriveHelper::getFiles($id);
		$this->renderPartial('_uploadGDriveImage',array('files'=>$files,'path'=>$newPath));
	}
	
	public function actionAjaxGetFilesFromPath()
	{
		$id = $_POST['id'];
		$path = $_POST['path'];
	
		$newPath = array();
		$jsonPath = json_decode($path);
		foreach ($jsonPath as $key => $val)
		{
			$newPath[$key] = $val;
			if($id == $key)
			break;
		}
	
		$files = GDriveHelper::getFiles($id);
		$this->renderPartial('_uploadGDriveImage',array('files'=>$files,'path'=>$newPath));
	}
}
