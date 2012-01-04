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
class Customer extends CActiveRecord
{
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
			array('Id_person, Id_contact', 'required'),
			array('Id_person, Id_contact', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_person, Id_contact', 'safe', 'on'=>'search'),
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
}