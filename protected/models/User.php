<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $Id_user_group
 * @property string $name
 * @property string $last_name
 * @property string $address
 * @property string $phone_house
 * @property string $phone_mobile
 * @property string $description
 * @property integer $send_mail
 * @property string $refresh_token
 *
 * The followings are the available model relations:
 * @property Album[] $albums
 * @property Customer[] $customers
 * @property TMultimedia[] $multimedias
 * @property Note[] $notes
 * @property Review[] $reviews
 */
class User extends TapiaActiveRecord
{
	public $userGroupDescription;
	public $building_address;
	public $Id_project;

	protected function afterSave()
	{
		parent::afterSave();

		
		//Asigno permisos de SRBAC si es nuevo el registro
		if($this->isNewRecord)
		{
			$guser = new GUser();
			$guser->username = $this->username;
			$guser->password = $this->password;
			$guser->email = $this->email;
			$guser->save();
			if($this->userGroup->is_administrator)
			{
				$modelAssignment = new Assignments();
				$modelAssignment->userid = $this->username;
				$modelAssignment->data = 's:0:""';
				$modelAssignment->itemname = "Administrator";
				$modelAssignment->save();
				
				$modelAssignment = new Assignments();
				$modelAssignment->userid = $this->username;
				$modelAssignment->data = 's:0:""';
				$modelAssignment->itemname = "Authority";
				$modelAssignment->save();
			}
			else
			{
				$modelAssignment = new Assignments();
				$modelAssignment->userid = $this->username;
				$modelAssignment->data = 's:0:""';
				$modelAssignment->itemname = "User";
				$modelAssignment->save();
			}
		}
		else 
		{
			$guser = GUser::model()->findByPk($this->username);
			$guser->password = $this->password;
			$guser->email = $this->email;
			$guser->save();				
		}
	}
	protected function afterDelete()
	{
		parent::afterDelete();		
		$guser = GUser::model()->deleteByPk($this->username);				
	}
	

	static private $_customer = null;
	static private $_userGroup = null;
	static private $_user = null;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function isAdministartor()
	{
		return self::getCurrentUserGroup()->is_administrator;
	}
	public static function isInternal()
	{
		return self::getCurrentUserGroup()->is_internal;
	}
	public static function useTechnicalDocs()
	{
		return self::getCurrentUserGroup()->use_technical_docs;
	}
	public static function isOwnerOf($modelNote)
	{
		return self::getCurrentUserGroup()->Id==$modelNote->Id_user_group_owner;
	}

	public static function canCreate()
	{
		return (ReviewTypeUserGroup::model()->countByAttributes(
				array('Id_user_group'=>self::getCurrentUserGroup()->Id))> 0);
	}

	public static function getCustomer()
	{
		if(!isset(self::$_customer))
		{
			$user = User::model()->findByPk(Yii::app()->user->Id);
			if(isset($user)&&isset($user->customers[0]))
				self::$_customer = $user->customers[0];
		}
		return self::$_customer;
	}
	public static function getCurrentUserGroup()
	{
		if(!isset(self::$_userGroup))
		{
			$user = User::model()->findByPk(Yii::app()->user->Id);
			if(isset($user)&&isset($user->userGroup))
				self::$_userGroup = $user->userGroup;
		}
		return self::$_userGroup;
	}

	public static function getAdminUserGroupId()
	{
		$model = UserGroup::model()->findByAttributes(array('is_administrator'=>1));
		return $model->Id;
	}

	public static function getAdminUsername()
	{
		$model = User::model()->findByAttributes(array('Id_user_group'=>User::getAdminUserGroupId()));
		return $model->username;
	}

	public static function getCurrentUser()
	{
		if(!isset(self::$_user))
		{
			self::$_user = User::model()->findByPk(Yii::app()->user->Id);
		}
		return self::$_user;
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('username, password, Id_user_group, email', 'required'),
				array('Id_user_group, send_mail', 'numerical', 'integerOnly'=>true),
				array('username, password, email', 'length', 'max'=>128),
				array('name, last_name, address', 'length', 'max'=>100),
				array('phone_house, phone_mobile', 'length', 'max'=>45),
				array('description, refresh_token', 'length', 'max'=>255),
				array('email', 'email', 'allowEmpty'=>true),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('username, password, email, Id_user_group, userGroupDescription, phone_house, phone_mobile, building_address, description, send_mail, refresh_token', 'safe', 'on'=>'search'),
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
				'userCustomers' => array(self::HAS_MANY, 'UserCustomer', 'username'),
				'customers' => array(self::HAS_MANY, 'TCustomer', 'username'),
				'notes' => array(self::HAS_MANY, 'Note', 'username'),
				'multimedias' => array(self::HAS_MANY, 'TMultimedia', 'username'),
				'userGroup' => array(self::BELONGS_TO, 'UserGroup', 'Id_user_group'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'username' => 'Usuario',
				'password' => 'Contrase&ntilde;a',
				'email' => 'Correo',
				'Id_user_group' => 'Grupo',
				'name' => 'Nombre',
				'last_name' => 'Apellido',
				'address' => 'Direcci&oacute;n',
				'userGroupDescription' => 'Grupo de usuario',
				'phone_house' => 'Tel&eacute;fono Casa',
				'phone_mobile' => 'Tel&eacute;fono M&oacute;vil',
				'description'=>'Observaciones',
				'send_mail'=>'Recive Correo',
				'refresh_token' => 'Refresh Token',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Id_user_group',$this->Id_user_group);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone_house',$this->phone_house,true);
		$criteria->compare('phone_mobile',$this->phone_mobile,true);
		$criteria->compare('description',$this->description,true);		
		$criteria->compare('refresh_token',$this->refresh_token,true);
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchUnassigned()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->distinct = true;
		
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Id_user_group',$this->Id_user_group);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone_house',$this->phone_house,true);
		$criteria->compare('phone_mobile',$this->phone_mobile,true);
		$criteria->compare('description',$this->description,true);
		$criteria->join = 'LEFT OUTER JOIN `user_customer` `uc` ON (`t`.`username`=`uc`.`username`)
							INNER JOIN user_group ug ON (t.Id_user_group = ug.Id)';
		$criteria->addCondition('Id_user_group not in(3)');//clients (3) and administrators (1)
		//$criteria->addCondition('ug.is_internal = 0');
		if(isset($this->Id_project)&&$this->Id_project!="")
	 		$criteria->addCondition('t.username not in (
	 				select u.username from user u LEFT OUTER JOIN user_customer uc on (u.username = uc.username)
	 				where uc.Id_project = '.$this->Id_project.')');
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function searchAdmin()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);

		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone_house',$this->phone_house,true);
		$criteria->compare('phone_mobile',$this->phone_mobile,true);
		$criteria->compare('description',$this->description,true);
		
		$criteria->with[]='userGroup';
		$criteria->addSearchCondition("userGroup.description",$this->userGroupDescription);

		$criteria->condition = 'Id_user_group <> 3'; //client


		$sort=new CSort;
		$sort->attributes=array(
				// For each relational attribute, create a 'virtual attribute' using the public variable name
				'username',
				'password',
				'email',
				'name',
				'last_name',
				'address',
				'userGroupDescription' => array(
						'asc' => 'userGroup.description',
						'desc' => 'userGroup.description DESC',
				),
				'*',
		);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
}