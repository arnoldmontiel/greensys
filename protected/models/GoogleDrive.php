<?php

/**
 * This is the model class for Google Drive.
 *
 * The followings are the available attributes in Items file in Google Drive SDK:
 * @property string $Id
 * @property string $title
 * @property string $iconLink
 * @property string $webContentLink
 * @property string $mimeType
 * @property string $thumbnailLink
 * @property boolean $isImage
 *
 * The followings are the available model relations:
 * @property User $username0
 */
class GoogleDrive
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuditLogin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('username', 'length', 'max'=>128),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, username, date, user_group_desc, user_name, user_last_name, email', 'safe', 'on'=>'search'),
		);
	}

	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'username' => 'Usuario',
			'date' => 'Fecha',
			'user_group_desc'=>'Group de Usuario',
			'user_name'=>'Nombre', 
			'user_last_name'=>'Apellido',
			'email'=>'Correo',
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
		$criteria->compare('t.date',$this->date,true);
		$criteria->compare('t.username',$this->username,true);
		
		$criteria->join =	" INNER JOIN user u on (t.username = u.username)";
		
		$criteria->addSearchCondition("u.last_name",$this->user_last_name);
		$criteria->addSearchCondition("u.name",$this->user_name);
		$criteria->addSearchCondition("u.Id_user_group",$this->user_group_desc);
		$criteria->addSearchCondition("u.email",$this->email);
		//$criteria->order ="t.date DESC";
		
		// Create a custom sort
		$sort=new CSort;
		$sort->defaultOrder = 't.date DESC';
		$sort->attributes=array(
				      't.date',
				      't.username' => array(
					        'asc' => 't.username',
					        'desc' => 't.username DESC',
						),
					  'user_last_name' => array(
					        'asc' => 'u.last_name',
					        'desc' => 'u.last_name DESC',
						),
					  'user_name' => array(
					        'asc' => 'u.name',
					        'desc' => 'u.name DESC',
						),
					  'user_group_desc' => array(
					        'asc' => 'u.Id_user_group',
					        'desc' => 'u.Id_user_group DESC',
						),
					  'email' => array(
					        'asc' => 'u.email',
					        'desc' => 'u.email DESC',
						),		
			'*',
		);
		
		return new CActiveDataProvider($this, array(
											'criteria'=>$criteria,
											'sort'=>$sort,
											'pagination' => array('pageSize' => 20,)
		));
		
	}
}