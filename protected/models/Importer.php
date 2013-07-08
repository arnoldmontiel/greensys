<?php

/**
 * This is the model class for table "importer".
 *
 * The followings are the available columns in table 'importer':
 * @property integer $Id
 * @property string $description
 * @property integer $Id_contact
 *
 * The followings are the available model relations:
 * @property Contact $idContact
 * @property PurchaseOrder[] $purchaseOrders
 * @property ShippingParameter[] $shippingParameters
 */
class Importer extends ModelAudit
{
	public $contact_telephone_1;
	public $contact_telephone_2;
	public $contact_telephone_3;
	public $contact_description;
	public $contact_email;
	public $shippingParameter_description;

	public function getContactDescription()
	{
		return $this->contact->description;
		
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Importer the static model class
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
		return 'importer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_contact', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id, Id_contact', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_contact,contact_telephone_1,contact_telephone_2,contact_telephone3,contact_email,shippingParameter_description', 'safe', 'on'=>'search'),
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
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'Id_importer'),
			'shippingParameters' => array(self::HAS_MANY, 'ShippingParameter', 'Id_importer'),
		);
	}

	public function getCurrentMaritimeDelayDays()
	{
		$modelShippingParam = ShippingParameter::model()->findByAttributes(array('Id_importer'=>$this->Id,'current'=>1));
		return $modelShippingParam->shippingParameterMaritime->days;
	}
	
	public function getCurrentAirDelayDays()
	{
		$modelShippingParam = ShippingParameter::model()->findByAttributes(array('Id_importer'=>$this->Id,'current'=>1));
		return $modelShippingParam->shippingParameterAir->days;
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_contact',$this->Id_contact);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	* Retrieves a list of models based on the current search/filter conditions.
	* @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	*/
	public function searchSummary()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_contact',$this->Id_contact);
		
		$criteria->with[]='contact';
		$criteria->addSearchCondition("contact.description",$this->contact_description);
		$criteria->addSearchCondition("contact.telephone_1",$this->contact_telephone_1);
		$criteria->addSearchCondition("contact.telephone_2",$this->contact_telephone_2);
		$criteria->addSearchCondition("contact.telephone_3",$this->contact_telephone_3);
		$criteria->addSearchCondition("contact.email",$this->contact_email);

// 		$criteria->with[]='shippingParameter';
// 		$criteria->addSearchCondition("shippingParameter.description",$this->shippingParameter_description);

		
		$sort=new CSort;
		$sort->attributes=array(
			'contact_description' => array(
				'asc' => 'contact.description',
				'desc' => 'contact.description DESC',
			),
			'contact_telephone_1' => array(
				'asc' => 'contact.telephone_1',
				'desc' => 'contact.telephone_1 DESC',
			),
			'contact_telephone_2' => array(
				'asc' => 'contact.telephone_2',
				'desc' => 'contact.telephone_2 DESC',
			),
			'contact_telefone_3' => array(
				'asc' => 'contact.telephone_3',
				'desc' => 'contact.telephone_3 DESC',
			),
			'contact_email' => array(
				'asc' => 'contact.email',
				'desc' => 'contact.email DESC',
			),
// 		'shippingParameter_description' => array(
// 				'asc' => 'shippingParameter_description',
// 				'desc' => 'shippingParameter_description DESC',
// 			),
		'*',
		);
				
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort
		));
	}
	
}