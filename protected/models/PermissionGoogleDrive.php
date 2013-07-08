<?php

/**
 * This is the model class for table "permission_google_drive".
 *
 * The followings are the available columns in table 'permission_google_drive':
 * @property integer $Id
 * @property string $Id_permission
 * @property string $username
 * @property string $Id_google_drive
 * @property string $role
 *
 * The followings are the available model relations:
 * @property User $username0
 */
class PermissionGoogleDrive extends TapiaActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PermissionGoogleDrive the static model class
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
		return 'permission_google_drive';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_permission, username', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_permission, Id_google_drive', 'length', 'max'=>255),
			array('username', 'length', 'max'=>128),
			array('role', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_permission, username, Id_google_drive, role', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'Permission Google Drive',
			'Id_permission' => 'Id Permission',
			'username' => 'Username',
			'Id_google_drive' => 'Google Drive',
			'role' => 'Role',
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

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('Id_permission',$this->Id_permission,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('Id_google_drive',$this->Id_google_drive,true);
		$criteria->compare('role',$this->role,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}