<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $Id
 * @property integer $review
 * @property integer $Id_customer
 * @property string $description
 * @property string $creation_date
 * @property string $change_date
 * @property integer $read
 * @property integer $Id_review_type
 * @property string $username
 * @property integer $Id_user_group
 * @property string $closing_description
 * @property integer $is_open
 * @property string $closing_date
 * 
 * The followings are the available model relations:
 * @property Album[] $albums
 * @property TMultimedia[] $multimedias
 * @property Note[] $notes
 * @property ReviewType $idReviewType
 * @property Customer $idCustomer
 *  @property Tag[] $tags
 * @property Wall[] $walls
 */
class Review extends TapiaActiveRecord
{
	public $maxReview;

	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->Id_user_group = User::getCurrentUserGroup()->Id;
			$this->username = User::getCurrentUser()->username;
		}
		
		return parent::beforeSave();
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Review the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'review';
	}

	public function isOpen()
	{
		return $this->is_open;
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'required', 'on'=> 'creation','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_customer,Id_review_type,Id_project', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('review, Id_customer, read, Id_review_type, is_open,Id_project', 'numerical', 'integerOnly'=>true),
			array('description, creation_date, change_date, closing_description, closing_date', 'safe'),		
			array('username', 'length', 'max'=>128),
			array('change_date','default',
				              'value'=>new CDbExpression('NOW()'),
				              'setOnEmpty'=>false,'on'=>'insert,update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, review, Id_customer,Id_project, description,creation_date, change_date, read, Id_review_type, closing_description, is_open, closing_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'albums' => array(self::HAS_MANY, 'Album', 'Id_review'),
			'multimedias' => array(self::HAS_MANY, 'TMultimedia', 'Id_review'),
			'notes' => array(self::HAS_MANY, 'Note', 'Id_review'),
			'reviewType' => array(self::BELONGS_TO, 'ReviewType', 'Id_review_type'),
			'customer' => array(self::BELONGS_TO, 'TCustomer', 'Id_customer'),
			'project' => array(self::BELONGS_TO, 'Project', 'Id_project'),
			'tags' => array(self::MANY_MANY, 'Tag', 'tag_review(Id_review, Id_tag)'),
			'walls' => array(self::HAS_MANY, 'Wall', 'Id_review'),
			'reviewUsers' => array(self::HAS_MANY, 'ReviewUser', 'Id_review'),
			'reviewTypeUserGroups' => array(self::HAS_MANY, 'ReviewTypeUserGroup', 'Id_review_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'review' => 'Revisión',
			'Id_customer' => 'Id Customer',
			'description' => 'Asunto',
			'creation_date' => 'Creation Date',
			'change_date' => 'Change Date',
			'read' => 'Read',
			'Id_review_type' => 'Formulario',
			'closing_description' => 'Descripción de Finalización',			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('review',$this->review);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('change_date',$this->change_date,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('Id_review_type',$this->Id_review_type);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('Id_user_group',$this->Id_user_group);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function hasResource($userGroupId, $multimediaType)
	{
		$sql = 'select * from multimedia_note mn inner join multimedia m on (mn.Id_multimedia = m.Id)';
		$sql .= ' where mn.Id_note IN (';
		$sql .= ' select ugn.Id_note from user_group_note ugn';
		$sql .= ' where ugn.Id_note IN (select n.Id from note n where n.Id_review = '.$this->Id.')';
		$sql .= ' and ugn.Id_user_group = '.$userGroupId.')';
		$sql .= ' and m.Id_multimedia_type = '.$multimediaType;
		
		$connection = self::getDbConnection();
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();
		
		return sizeof($results) >0;
	}
	
	public function searchSummary($arrFilters)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
		
		if($arrFilters['tagFilter']){
			if($arrFilters['isCloseFilter'])
			{
				$criteria->addCondition('t.is_open = 0 or t.Id IN(select r.Id from review r
				inner join tag_review tr on (r.Id = tr.Id_review)
				where
				tr.date in (select max(date) date from tag_review where Id_review =r.Id)
				and tr.Id_tag IN ('. $arrFilters['tagFilter'].'))');
			}
			else{
				
				$criteria->addCondition('t.Id IN(
				select r.Id from review r
				inner join tag_review tr on (r.Id = tr.Id_review)
				where
				tr.date in (select max(date) date from tag_review where Id_review =r.Id)
				and tr.Id_tag IN('. $arrFilters['tagFilter'].'))');
				$criteria->addCondition('t.is_open = 1');
			}
		}
		
		if($arrFilters['typeFilter'])
		{

			$criteria->join =  	"LEFT OUTER JOIN multimedia m ON (m.Id_review=t.Id)
								inner join multimedia_note mn ON (mn.Id_multimedia = m.Id)";
			$criteria->addCondition("mn.Id_note IN(
									select ugn.Id_note from user_group_note ugn
									where ugn.Id_note IN (select n.Id from note n where n.Id_review = t.Id
									and ugn.Id_user_group = ". User::getCurrentUserGroup()->Id .")
									and m.Id_multimedia_type IN ( ".$arrFilters['typeFilter'] . "))");
		}
		
		if($arrFilters['reviewTypeFilter'])
		{
			$criteria->addCondition('t.Id_review_type IN ('. $arrFilters['reviewTypeFilter'].')');
		}
		
		if($arrFilters['dateFromFilter'])
		{
			$criteria->addCondition('t.change_date >= "'. date("Y-m-d H:i:s",strtotime($arrFilters['dateFromFilter'])) . '"');
		}

		if($arrFilters['dateToFilter'])
		{
			$criteria->addCondition('t.change_date <= "'. date("Y-m-d H:i:s",strtotime($arrFilters['dateToFilter'] . " + 1 day")) . '"');
		}
		
		
		if($arrFilters['isCloseFilter'] && !$arrFilters['tagFilter'])
		{
			$criteria->addCondition('t.is_open = 0');
		}
		
		
		
		//Esto antes era un if para que acote el query si no era Administrador	
		$criteria->join .= '  LEFT OUTER JOIN `note` `n` ON (`n`.`Id_review`=`t`.`Id`) 
							LEFT OUTER JOIN `user_group_note` `ugn` ON (`ugn`.`Id_note`=`n`.`Id`)
							LEFT OUTER JOIN review_user ru ON (ru.username = t.username AND t.Id = ru.Id_review)';
		
		$criteria->addCondition('ugn.Id_user_group = '.User::getCurrentUserGroup()->Id);				
		
		//$criteria->addCondition('t.username = "'. User::getCurrentUser()->username . '"','OR');
		
		//$criteria->addCondition('n.in_progress=0');
		//---------------------------------------------------
		
		$criteria->addCondition('t.Id_customer = '. $this->Id_customer);
		$criteria->addCondition('t.Id_project = '. $this->Id_project);
		$criteria->distinct = true;
		
		$criteria->order = 't.change_date DESC, t.review DESC';
			
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchQuickView($arrFilters)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		//Esto antes era un if para que acote el query si no era Administrador
		$criteria->distinct = true;
		
// 		$criteria->join = ' LEFT OUTER JOIN `note` `n` ON (`n`.`Id_review`=`t`.`Id`)
// 								LEFT OUTER JOIN `user_group_note` `ugn` ON (`ugn`.`Id_note`=`n`.`Id`)
// 								LEFT OUTER JOIN review_user ru ON (ru.username = t.username AND t.Id = ru.Id_review)';
// 		$criteria->join .= 'INNER join note_note nn on (nn.Id_parent = n.Id)
// 							INNER join note nchild on (nn.Id_child = nchild.Id) ';
		
// 		$criteria->addCondition('ugn.Id_user_group = '.User::getCurrentUserGroup()->Id);
// 		$criteria->addCondition('t.username = "'. User::getCurrentUser()->username . '"','OR');
// 		$criteria->addCondition('t.Id_customer = '. $this->Id_customer);
// 		$criteria->addCondition('t.Id_project = '. $this->Id_project);
// 		$criteria->addCondition('nchild.username <> "'.User::getCurrentUser()->username.'"');
// 		$criteria->addCondition('nchild.in_progress=0');
// 		$criteria->addCondition('nchild.change_date in(
// 			select max(note.change_date) from note
// 			inner join note_note nn on (note.Id = nn.Id_child)
// 			inner join note n on (n.Id= nn.Id_parent)
// 			where note.Id_project =  '.$this->Id_project.' and note.Id_customer = '.$this->Id_customer.'
// 			and note.in_progress= 0
// 			and n.Id_review = t.Id
// 			)'
// 		);
		$criteria->addCondition('
		Id in (SELECT distinct `t`.Id FROM `review` `t`
			LEFT OUTER JOIN `note` `n` ON (`n`.`Id_review`=`t`.`Id`)
			LEFT OUTER JOIN `user_group_note` `ugn` ON (`ugn`.`Id_note`=`n`.`Id`)
			LEFT OUTER JOIN review_user ru ON (ru.username = t.username AND t.Id = ru.Id_review)
			LEFT join note_note nn on (nn.Id_parent = n.Id)
			LEFT join note nchild on (nn.Id_child = nchild.Id  AND (nchild.in_progress=0) and
				nchild.change_date =(
				select max(note.change_date) from note
				inner join note_note nn on (note.Id = nn.Id_child)
				inner join note n on (n.Id= nn.Id_parent)
				where note.Id_project =  '.$this->Id_project.'
				and note.Id_customer = '.$this->Id_customer.'
				and note.in_progress= 0
				and n.Id_review = t.Id
				)
			)
		WHERE (((((ugn.Id_user_group = '.User::getCurrentUserGroup()->Id.')
			OR (t.username = "'.User::getCurrentUser()->username.'"))
			AND (t.Id_customer = '.$this->Id_customer.'))
			AND (t.Id_project = '.$this->Id_project.'))		
		)
		and (nchild.username <> "'.User::getCurrentUser()->username.'"))
		or Id in(
			SELECT distinct `t`.Id  FROM `review` `t`
			LEFT OUTER JOIN `note` `n` ON (`n`.`Id_review`=`t`.`Id` and n.Id not in
				(
				select distinct note.Id from note
				inner join note_note nn on (note.Id = nn.Id_parent)
				inner join note n on (n.Id= nn.Id_child)
				where note.Id_project =  '.$this->Id_project.'
				and note.Id_customer = '.$this->Id_customer.'
				)
			)
			LEFT OUTER JOIN `user_group_note` `ugn` ON (`ugn`.`Id_note`=`n`.`Id`)
			LEFT OUTER JOIN review_user ru ON (ru.username = t.username AND t.Id = ru.Id_review)
				WHERE (((((ugn.Id_user_group = '.User::getCurrentUserGroup()->Id.')
				OR (t.username = "'.User::getCurrentUser()->username.'"))
				AND (t.Id_customer = '.$this->Id_customer.'))
				AND (t.Id_project = '.$this->Id_project.'))			
			)
			and n.username <> "'.User::getCurrentUser()->username.'"
		)');
		
		$criteria->order = 't.change_date DESC, t.review DESC';
		$criteria->limit = 4;
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
		));
	}
}