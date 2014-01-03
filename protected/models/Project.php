<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $Id
 * @property integer $Id_customer
 * @property string $description
 * @property string $address
 *
 * The followings are the available model relations:
 * @property Area[] $areas
 * @property Budget[] $budgets
 * @property ProductItem[] $productItems
 * @property Customer $idCustomer
 * @property Contact[] $contacts
 * @property Tracking[] $trackings
 */
class Project extends ModelAudit
{
	public $contact_description;
	public function afterSave()
	{
		parent::afterSave();
		$project = TProject::model()->findByPk($this->Id);
		if(!isset($project))
		{
			$project = new TProject();
		}
		$project->Id = $this->Id;
		$project->Id_customer = $this->Id_customer;
		$project->save();
	}
	public function afterDelete()
	{
		parent::afterDelete();		
		TProject::model()->deleteByPk($this->Id);
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @return Project the static model class
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
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_customer', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_customer', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>45),
			array('address', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_customer, description, address,contact_description', 'safe', 'on'=>'search'),
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
			'areas' => array(self::MANY_MANY, 'Area', 'area_project(Id_project, Id_area)'),
			'budgets' => array(self::HAS_MANY, 'Budget', 'Id_project'),
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'Id_project'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
			'contacts' => array(self::MANY_MANY, 'Contact', 'project_contact(Id_project, Id_contact)'),
			'trackings' => array(self::HAS_MANY, 'Tracking', 'Id_project'),
			'notes' => array(self::HAS_MANY, 'Note', 'Id_project'),
			'multimedias' => array(self::HAS_MANY, 'TMultimedia', 'Id_project'),
			'albums' => array(self::HAS_MANY, 'Album', 'Id_project'),
			'reviews' => array(self::HAS_MANY, 'Review', 'Id_project'),
				
				
		);
	}

	public function getFullDescription()
	{
		$value = $this->description;
		if(!empty($this->customer->contact->description))
			$value = $this->customer->contact->description . ' - ' . $value;
		return $value;	
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_customer' => 'Cliente',
			'contact_description'=>'Cliente',
			'description' => 'Descripción',
			'address' => 'Dirección',
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

		$criteria->compare('t.Id',$this->Id);
		$criteria->compare('t.Id_customer',$this->Id_customer);
		$criteria->compare('t.description',$this->description,true);
		$criteria->compare('t.address',$this->address,true);
		$criteria->join='INNER JOIN `customer` `c` ON (`c`.`Id`=`t`.`Id_customer`)
						INNER JOIN 	`contact` `con` ON (`con`.`Id`=`c`.`Id_contact`)';
		$criteria->compare('con.description',$this->contact_description,true);
		$criteria->order="con.description, t.description";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getLongDescription()
	{
		$customer = $this->customer;
		return $customer->contact->description ." - ".$this->description; 
	}
}