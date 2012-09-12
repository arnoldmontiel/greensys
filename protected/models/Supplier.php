<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property integer $Id
 * @property string $business_name
 *
 * The followings are the available model relations:
 * @property PriceList[] $priceLists
 * @property PurchaseOrder[] $purchaseOrders
 * @property Contact[] $contacts
 */
class Supplier extends ModelAudit
{
	public $telephone_1;
	public $description;
	public $email;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Supplier the static model class
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
		return 'supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('business_name', 'length', 'max'=>45),
			array('business_name', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, business_name, telephone_1, email, description', 'safe', 'on'=>'search'),
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
			'priceLists' => array(self::HAS_MANY, 'PriceList', 'Id_supplier'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'Id_supplier'),
			'contacts' => array(self::MANY_MANY, 'Contact', 'supplier_contact(Id_supplier, Id_contact)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'business_name' => 'Business Name',
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
		$criteria->compare('business_name',$this->business_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchSupplier()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('business_name',$this->business_name,true);
	
		$criteria->with[]='contact';
		$criteria->addSearchCondition("contact.email",$this->email);
		$criteria->addSearchCondition("contact.telephone_1",$this->telephone_1);
		$criteria->addSearchCondition("contact.description",$this->description);
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
			'business_name',
			'description' => array(
					        'asc' => 'contact.description',
					        'desc' => 'contact.description DESC',
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