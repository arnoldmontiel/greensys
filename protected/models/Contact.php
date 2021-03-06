<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $Id
 * @property string $description
 * @property string $telephone_1
 * @property string $telephone_2
 * @property string $telephone_3
 * @property string $email
 * @property string $address
 * @property string $tel1_description
 * @property string $tel2_description
 * @property string $tel3_description
 * @property string $comment
 * @property string $email_description
 * @property string $email_2
 * @property string $email_2_description
 * @property string $email_3
 * @property string $email_3_description
 * @property string $refered
 *
 * The followings are the available model relations:
 * @property Brand[] $brands
 * @property Customer[] $customers
 * @property Hyperlink[] $hyperlinks
 * @property Project[] $projects
 * @property Supplier[] $suppliers
 */
class Contact extends ModelAudit
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
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
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, address, refered', 'length', 'max'=>100),
			//array('telephone_1, description, email', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('tel1_description, tel2_description, tel3_description, email_description, email_2_description, email_3_description', 'length', 'max'=>255),
			array('email', 'unique', 'message'=>'El correo {value} ya ha sido utilizado'),				
			array('telephone_1, telephone_2, telephone_3, email', 'length', 'max'=>45),
			array('comment', 'length', 'max'=>512),
			array('email', 'email', 'allowEmpty'=>true, 'message'=>'El correo ingresado no es una dirección valida'),
			array('email_2', 'email', 'allowEmpty'=>true, 'message'=>'El correo 2 ingresado no es una dirección valida'),
			array('email_3', 'email', 'allowEmpty'=>true, 'message'=>'El correo 3 ingresado no es una dirección valida'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, telephone_1, telephone_2, telephone_3, email, address, tel1_description, tel2_description, tel3_description, comment,email_description,email_2,email_2_description,email_3,email_3_description, refered', 'safe', 'on'=>'search'),
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
			'brands' => array(self::MANY_MANY, 'Brand', 'contact_brand(Id_contact, Id_brand)'),
			'customers' => array(self::MANY_MANY, 'Customer', 'customer_contact(Id_contact, Id_customer)'),
			'hyperlinks' => array(self::HAS_MANY, 'Hyperlink', 'Id_contact'),
			'projects' => array(self::MANY_MANY, 'Project', 'project_contact(Id_contact, Id_project)'),
			'suppliers' => array(self::MANY_MANY, 'Supplier', 'supplier_contact(Id_contact, Id_supplier)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'Designaci&oacute;n',
			'telephone_1' => 'Tel&eacute;fono',
			'telephone_2' => 'Tel&eacute;fono',
			'telephone_3' => 'Tel&eacute;fono',
			'email' => 'Correo',
			'email_2' => 'Correo',
			'email_3' => 'Correo',
			'address' => 'Direcci&oacute;n',
			'tel1_description' => 'Descripci&oacute;n',
			'tel2_description' => 'Descripci&oacute;n',
			'tel3_description' => 'Descripci&oacute;n',
			'comment' => 'Notas',
			'refered' => 'Referido',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('telephone_1',$this->telephone_1,true);
		$criteria->compare('telephone_2',$this->telephone_2,true);
		$criteria->compare('telephone_3',$this->telephone_3,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}