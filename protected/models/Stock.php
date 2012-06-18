<?php

/**
 * This is the model class for table "stock".
 *
 * The followings are the available columns in table 'stock':
 * @property integer $Id
 * @property integer $Id_movement_type
 * @property integer $Id_project
 * @property string $username
 * @property string $creation_date
 * @property string $description
 *
 * The followings are the available model relations:
 * @property MovementType $idMovementType
 * @property Project $idProject
 * @property User $username0
 * @property StockItem[] $stockItems
 */
class Stock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stock the static model class
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
		return 'stock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_movement_type, Id_project, username', 'required'),
			array('Id_movement_type, Id_project', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>128),
			array('description', 'length', 'max'=>255),
			array('creation_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_movement_type, Id_project, username, creation_date, description', 'safe', 'on'=>'search'),
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
			'movementType' => array(self::BELONGS_TO, 'MovementType', 'Id_movement_type'),
			'project' => array(self::BELONGS_TO, 'Project', 'Id_project'),
			'user' => array(self::BELONGS_TO, 'User', 'username'),
			'stockItems' => array(self::HAS_MANY, 'StockItem', 'Id_stock'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_movement_type' => 'Movement Type',
			'Id_project' => 'Project',
			'username' => 'Username',
			'creation_date' => 'Creation Date',
			'description' => 'Description',
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
		$criteria->compare('Id_movement_type',$this->Id_movement_type);
		$criteria->compare('Id_project',$this->Id_project);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}