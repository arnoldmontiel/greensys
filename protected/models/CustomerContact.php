<?php

/**
 * This is the model class for table "customer_contact".
 *
 * The followings are the available columns in table 'customer_contact':
 * @property integer $Id_customer
 * @property integer $Id_contact
 */
class CustomerContact extends CActiveRecord
{
	public $description;
	public $telephone_1;
	public $telephone_2;
	public $telephone_3;
	public $email;
	public $address;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerContact the static model class
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
		return 'customer_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_customer, Id_contact', 'required'),
			array('Id_customer, Id_contact', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_customer, Id_contact, description, telephone_1, telephone_2, telephone_3, email, address', 'safe', 'on'=>'search'),
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
				'customer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
				'contact' => array(self::BELONGS_TO, 'Contact', 'Id_contact'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_customer' => 'Id Customer',
			'Id_contact' => 'Id Contact',
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

		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('Id_contact',$this->Id_contact);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchContact()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('Id_contact',$this->Id_contact);
	
		$criteria->with[]='contact';
		$criteria->addSearchCondition("contact.email",$this->email);
		$criteria->addSearchCondition("contact.telephone_1",$this->telephone_1);
		$criteria->addSearchCondition("contact.telephone_2",$this->telephone_2);
		$criteria->addSearchCondition("contact.telephone_3",$this->telephone_3);
		$criteria->addSearchCondition("contact.description",$this->description);
		$criteria->addSearchCondition("contact.address",$this->address);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
					'description' => array(
							        'asc' => 'contact.description',
							        'desc' => 'contact.description DESC',
		),
					'telephone_1' => array(
							        'asc' => 'contact.telephone_1',
							        'desc' => 'contact.telephone_1 DESC',
		),
					'telephone_2' => array(
									        'asc' => 'contact.telephone_2',
									        'desc' => 'contact.telephone_2 DESC',
		),
					'telephone_3' => array(
									        'asc' => 'contact.telephone_3',
									        'desc' => 'contact.telephone_3 DESC',
		),
					'email' => array(
							        'asc' => 'contact.email',
							        'desc' => 'contact.email DESC',
		),
					'address' => array(
									        'asc' => 'contact.address',
									        'desc' => 'contact.address DESC',
		),
					'*',
		);
	
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
								'sort'=>$sort,
		));
	}
}