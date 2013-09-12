<?php

/**
 * This is the model class for table "budget".
 *
 * The followings are the available columns in table 'budget':
 * @property integer $Id
 * @property integer $Id_project
 * @property string $percent_discount
 * @property string $date_creation
 * @property integer $Id_budget_state
 * @property string $date_inicialization
 * @property string $date_finalization
 * @property string $date_estimated_inicialization
 * @property string $date_estimated_finalization
 * @property integer $version_number
 * @property string $description
 * @property string $note
 *
 * The followings are the available model relations:
 * @property BudgetState $idBudgetState
 * @property Project $idProject
 * @property BudgetItem[] $budgetItems
 * @property GNote[] $notes
 * @property Tracking[] $trackings
 */
class Budget extends ModelAudit
{
	public $curVersion;
	public $totPrice;
	
	public function beforeSave()
	{
		$this->date_estimated_inicialization = (!empty($this->date_estimated_inicialization))?Yii::app()->lc->toDatabase($this->date_estimated_inicialization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
		$this->date_estimated_finalization = (!empty($this->date_estimated_finalization))?Yii::app()->lc->toDatabase($this->date_estimated_finalization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
		$this->date_inicialization = (!empty($this->date_inicialization))?Yii::app()->lc->toDatabase($this->date_inicialization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
		$this->date_finalization = (!empty($this->date_finalization))?Yii::app()->lc->toDatabase($this->date_finalization,'date','small','date',null):null;//date('Y-m-d',strtotime($this->date_validity));
	
		return parent::beforeSave();
	}
	
	protected function afterFind(){
		
		$this->date_estimated_inicialization = isset($this->date_estimated_inicialization)?Yii::app()->dateFormatter->formatDateTime($this->date_estimated_inicialization,'small',null):null;
		
		$this->date_estimated_finalization = isset($this->date_estimated_finalization)?Yii::app()->dateFormatter->formatDateTime($this->date_estimated_finalization,'small',null):null;
		
		$this->date_inicialization = isset($this->date_inicialization)?Yii::app()->dateFormatter->formatDateTime($this->date_inicialization,'small',null):null;
		
		$this->date_finalization = isset($this->date_finalization)?Yii::app()->dateFormatter->formatDateTime($this->date_finalization,'small',null):null;
	
		
	
		return true;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Budget the static model class
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
		return 'budget';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_project, Id_budget_state, version_number', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_project, Id_budget_state, version_number', 'numerical', 'integerOnly'=>true),
			array('percent_discount', 'length', 'max'=>10),
			array('date_creation, date_inicialization, date_finalization, date_estimated_inicialization, date_estimated_finalization, totPrice', 'safe'),
			array('description, note', 'length', 'max'=>255),
			array('date_creation','default',
			              'value'=>new CDbExpression('NOW()'),
			              'setOnEmpty'=>true,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_project, percent_discount, date_creation, Id_budget_state, date_inicialization, date_finalization, date_estimated_inicialization, date_estimated_finalization, version_number, totPrice, note', 'safe', 'on'=>'search'),
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
			'budgetState' => array(self::BELONGS_TO, 'BudgetState', 'Id_budget_state'),
			'project' => array(self::BELONGS_TO, 'Project', 'Id_project'),
			'budgetItems' => array(self::HAS_MANY, 'BudgetItem', 'Id_budget'),
			'notes' => array(self::HAS_MANY, 'GNote', 'budget_Id'),
			'trackings' => array(self::HAS_MANY, 'Tracking', 'Id_budget'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_project' => 'Project',
			'percent_discount' => 'Discount',
			'date_creation' => 'Date Creation',
			'Id_budget_state' => 'State',
			'date_inicialization' => 'Date Inicialization',
			'date_finalization' => 'Date Finalization',
			'date_estimated_inicialization' => 'Date Estimated Inicialization',
			'date_estimated_finalization' => 'Date Estimated Finalization',
			'version_number' => 'Version Number',
			'description' => 'Description',
			'subTotalPrice'=>'Sub Total',
			'totalPrice'=>'Total',
			'note' => 'Note',
		);
	}

	public function getCurrentVersion()
	{
		$criteria=new CDbCriteria;
	
		$criteria->select='MAX(version_number) as curVersion';
		$criteria->condition='Id = '.$this->Id;
		
		$modelMax = Budget::model()->find($criteria);
		
		return $modelMax->curVersion;
	}
	
	public function getTotalRack()
	{
		$criteria=new CDbCriteria;
		
		$criteria->select='SUM(unit_rack) as total_unit_rack';
		$criteria->with[] = 'product';
		$criteria->condition='Id_budget = '.$this->Id . ' 
				AND version_number = '. $this->version_number . '
				AND need_rack = 1';
		
		$modelBudgetItem = BudgetItem::model()->find($criteria);
		
		return (isset($modelBudgetItem))?$modelBudgetItem->total_unit_rack:0;
	}
	
	public function getTotalFan()
	{
		$criteria=new CDbCriteria;
	
		$criteria->select='SUM(unit_fan) as total_unit_fan';
		$criteria->with[] = 'product';
		$criteria->condition='Id_budget = '.$this->Id . '
					AND version_number = '. $this->version_number . '
					AND need_rack = 1';
	
		$modelBudgetItem = BudgetItem::model()->find($criteria);
	
		return (isset($modelBudgetItem))?$modelBudgetItem->total_unit_fan: 0;
	}
	
	public function getTotalPrice()
	{
		
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		
	
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();			
		}
		return number_format($totalPrice,2);
	}
	public function getTotalDiscount()
	{
		$criteria=new CDbCriteria;
		
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
		
		
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();
		}
		return number_format(($totalPrice*$this->percent_discount/100),2);
		
	}
	
	public function getTotalPriceWithDiscount()
	{
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('t.Id_budget',$this->Id);
		$criteria->compare('t.version_number',$this->version_number);
		$criteria->addCondition('(t.Id_budget_item is null)');
	
	
		$modelBudgetItem = BudgetItem::model()->findAll($criteria);
		$totalPrice = 0;
		foreach ($modelBudgetItem as $item)
		{
			$totalPrice += $item->getTotalPriceNotFormated();
		}
		return number_format($totalPrice-($totalPrice*$this->percent_discount/100),2);
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

		$criteria->join = ',(SELECT Id_budget, version_number, SUM(price) as totPrice
												FROM budget_item group by Id_budget, version_number
												) bi';
		$criteria->condition = 't.Id = bi.Id_budget and t.version_number = bi.version_number';
		
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_project',$this->Id_project);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('Id_budget_state',$this->Id_budget_state);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('date_estimated_inicialization',$this->date_estimated_inicialization,true);
		$criteria->compare('date_estimated_finalization',$this->date_estimated_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('description',$this->description,true);

		$criteria->addSearchCondition('bi.totPrice',$this->totPrice);
		
		$sort=new CSort;
		$sort->attributes=array(
					'date_creation',
					'date_inicialization',
					'version_number',
					'description',
					'percent_discount',
					'totPrice' => array(
						'asc' => 'bi.totPrice',
						'desc' => 'bi.totPrice DESC',
					),
		);
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
	
	public function searchSummary()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join = ',(SELECT Id, MAX(version_number) vn
						FROM budget
						GROUP BY Id) b2, 
						project, budget_state';
		
		$criteria->condition = 't.Id = b2.Id and t.version_number = b2.vn and
								project.Id = t.Id_project and budget_state.Id = t.Id_budget_state';
		
		$criteria->compare('Id',$this->Id);
		$criteria->compare('percent_discount',$this->percent_discount,true);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('date_inicialization',$this->date_inicialization,true);
		$criteria->compare('date_finalization',$this->date_finalization,true);
		$criteria->compare('date_estimated_inicialization',$this->date_estimated_inicialization,true);
		$criteria->compare('date_estimated_finalization',$this->date_estimated_finalization,true);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('description',$this->description,true);
		$criteria->order="date_creation DESC";
		
		//$criteria->with[]='project';
		$criteria->addSearchCondition('project.description',$this->Id_project);
		
		//$criteria->with[]='budgetState';
		$criteria->addSearchCondition('budgetState.description',$this->Id_budget_state);
		
		$sort=new CSort;
		$sort->attributes=array(
					'date_creation',
					'date_inicialization',
					'version_number',
					'description',
					'percent_discount',
					'Id_budget_state' => array(
						'asc' => 'budgetState.description',
						'desc' => 'budgetState.description DESC',
					),
					'Id_project' => array(
								'asc' => 'project.description',
								'desc' => 'project.description DESC',
					),
		);
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
	
}