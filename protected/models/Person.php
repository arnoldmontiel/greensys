<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $Id
 * @property string $name
 * @property string $last_name
 * @property string $date_birth
 * @property string $uid
 *
 * The followings are the available model relations:
 * @property Customer[] $customers
 */
class Person extends ModelAudit
{
	public function beforeSave()
	{
		$this->date_birth = Yii::app()->lc->toDatabase($this->date_birth,'date','small','date',null);//date('Y-m-d',strtotime($this->date_validity));
		return parent::beforeSave();
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Person the static model class
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
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, last_name, uid', 'length', 'max'=>45),
			array('name,last_name', 'required'),
			array('date_birth', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, name, last_name, date_birth, uid', 'safe', 'on'=>'search'),
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
			'customers' => array(self::HAS_MANY, 'Customer', 'Id_person'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'name' => 'Name',
			'last_name' => 'Last Name',
			'date_birth' => 'Date Birth',
			'uid' => 'Documento',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('date_birth',$this->date_birth,true);
		$criteria->compare('uid',$this->uid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}