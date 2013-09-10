<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $Id
 * @property integer $Id_person
 * @property integer $Id_contact
 *
 *
 * The followings are the available model relations:
 * @property Contact $idContact
 * @property Person $idPerson
 * @property Contact[] $contacts
 * @property Project[] $projects
 */
class Customer extends ModelAudit
{
	public $name;
	public $last_name;
	public $telephone_1;
	public $email;
	//from tapia
	public $Id_user_group;
	public $username;
	protected function afterSave()
	{
		parent::afterSave();
		$tcustomer = TCustomer::model()->findByPk($this->Id);
		
		$isNewCustomer = false;
		
		if(!isset($tcustomer))
		{
			$tcustomer = new TCustomer();
			$isNewCustomer = true;
		}
		$tcustomer->Id = $this->Id;
		$tcustomer->Id_contact = $this->Id_contact;
		$tcustomer->Id_person= $this->Id_person;
		$tcustomer->Id_user_group = $this->Id_user_group;
		$tcustomer->username = $this->username;
		
		$isOnlyGreenCustomer = false;
		
		if(!isset($this->username))
		{
			$tcustomer->Id_customer_type = 1;
			$isOnlyGreenCustomer = true;
		}
		else
			$tcustomer->Id_customer_type = 3;
		
		$tcustomer->save();
		
		if($isNewCustomer && $isOnlyGreenCustomer)
		{
			$modelProject = new Project();
			$modelProject->Id_customer = $this->Id;
			$modelProject->description = 'XX';
			$modelProject->save();
		}
		
	}
	protected function afterDelete()
	{
		parent::afterDelete();
		Person::model()->deleteByPk($this->Id_person);
		Contact::model()->deleteByPk($this->Id_contact);
		$tcustomer = TCustomer::model()->findByPk($this->Id);
		$user = User::model()->findByPk($tcustomer->username);
		$tcustomer->delete();
		if(isset($user))	$user->delete();
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
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
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_person, Id_contact', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_person, Id_contact', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_person, Id_contact, name, last_name, telephone_1, email', 'safe', 'on'=>'search'),
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
			'contact' => array(self::BELONGS_TO, 'Contact', 'Id_contact'),
			'person' => array(self::BELONGS_TO, 'Person', 'Id_person'),
			'contacts' => array(self::MANY_MANY, 'Contact', 'customer_contact(Id_customer, Id_contact)'),
			'projects' => array(self::HAS_MANY, 'Project', 'Id_customer'),
			'multimedias' => array(self::HAS_MANY, 'TMultimedia', 'Id_customer'),
			'albums' => array(self::HAS_MANY, 'Album', 'Id_customer'),
			'notes' => array(self::HAS_MANY, 'Note', 'Id_customer'),
				
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_person' => 'Id Person',
			'Id_contact' => 'Id Contact',
		);
	}

	public function getFullName()
	{
		return $this->person->last_name . ' - ' . $this->person->name;
	}
	
	public function getDescription()
	{
		return $this->contact->description;
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
		$criteria->compare('Id_person',$this->Id_person);
		$criteria->compare('Id_contact',$this->Id_contact);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchCustomer()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_person',$this->Id_person);
		$criteria->compare('Id_contact',$this->Id_contact);
	
		$criteria->with[]='person';
		$criteria->addSearchCondition("person.name",$this->name);
		$criteria->addSearchCondition("person.last_name",$this->last_name);
	
		$criteria->with[]='contact';
		$criteria->addSearchCondition("contact.telephone_1",$this->telephone_1);
		$criteria->addSearchCondition("contact.email",$this->email);
		$criteria->order="contact.description";
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
			'name' => array(
									        'asc' => 'person.name',
									        'desc' => 'person.name DESC',
			),
			'last_name' => array(
						        'asc' => 'person.last_name',
						        'desc' => 'person.last_name DESC',
			),		
			'telephone_1' => array(
				        'asc' => 'contact.telephone_1',
				        'desc' => 'contact.telephone_1 DESC',
			),
			'email' => array(
				        'asc' => 'contact.email',
				        'desc' => 'contact.email DESC',
			),
			'*',
		);
	
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'sort'=>$sort,
		));
	}
}